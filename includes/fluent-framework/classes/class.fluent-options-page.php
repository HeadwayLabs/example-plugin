<?php
/**
 * Fluent_Options_Page
 *
 * @package Fluent
 * @since 1.0.0
 * @version 1.0.2
 */

/**
 * Fluent_Options_Page. Create and stores fields and sections.
 */
class Fluent_Options_Page extends Fluent_Options{

    /**
     * @var string $version Class version.
     */
    public $version = '1.0.2';
    
    /**
     * @var $page Fluent_Page instance. If supplied the Options class should be used in page context and we use this to register the output we need on the page.
     */
    public $page = null;
    
    /**
     * __construct() parse arguments supplied, setup framework depending on the $context supplied.
     *
     * @uses Fluent_Options::parse_args(); to merge supplied data with some sane defaults.
     * @uses Fluent_Options::prepare_sections(); to prepare data.
     * @uses Fluent_Options::provide();
     * @uses add_action();
     * @uses add_filter();
     *
     * @since 1.0.0
     *
     * @param array $args framework setup arguments. Used to change some base settings for the options including context.
     *
     * @param array $sections the sections an fields to be used.
     *
     * @param object $page if suppplied should be an instance of Fluent_Page and used to render the meatboxes on none metabox pages.
     *
     * @return none
     */
    public function __construct( $args = array(), $sections = array() ){
        
        $this->args = $this->parse_args( $args, $this->default_args(), 'fluent/options/page/args' );
        
        //prepare sections and fields before merging values
        $sections = $this->parse_args( $sections, array(), 'fluent/options/page/'.$this->args['option_name'].'/sections' );
        
        //save user data about layouts used - this is global
        add_action('wp_ajax_options_save_layout', $this->provide('save_screen_settings'));
            
        $this->page = new Fluent_Page( $this->args['page_args'] );
        
        $this->options = $this->get_option($this->args['option_name']);
    
        $this->prepare_sections($sections);
    
        add_action('fluent/page/'.$this->page->args['slug'].'/load', $this->provide('load_page'));
        add_action('fluent/page/'.$this->page->args['slug'].'/render', $this->provide('render_page'));

        if(isset($this->args['page_args']['network']) && $this->args['page_args']['network'] == true){
            add_filter( 'site_option_' . $this->args['option_name'], $this->provide( 'format_option' ) );
        }else{
            add_filter( 'option_' . $this->args['option_name'], $this->provide( 'format_option' ) );
        }
            
    }

    private function get_option($option_name, $default_value = false, $use_cache = true){
        if(isset($this->args['page_args']['network']) && $this->args['page_args']['network'] == true){
            return get_site_option($option_name, $default_value, $use_cache);
        }
        return get_option($option_name, $default_value);
    }

    private function update_option($option_name, $value){
        if(isset($this->args['page_args']['network']) && $this->args['page_args']['network'] == true){
            return update_site_option($option_name, $value);
        }
        return update_option($option_name, $value);
    }
    
    /**
      * Returns the default arguments for the $args property.
      *
      * This gets merged with user supplied array via <code>parse_args</code>.
      *
      * @since 1.0.0
      *
      * @return array
      */
    protected function default_args(){
        
        return self::parse_args(array(
            'option_name'   => 'option_name',
            'dev_mode'      => false,
            'sections'      => array(),
            'default_layout' => 'options-normal',
            'page_args' => array(),
            'restore' => true,
            'show_updated' => true,
            'messages' => array(
            	'save_button' => __('Save Options', $this->domain),
            	'saved' => __('Settings saved.', $this->domain),
            	'restore' => __('Settings reset to defaults.', $this->domain),
            	'save_box' => ''
            )
        ), parent::default_args());
        
    }
    
    /**
      * Loops through supplied data and prepares the $sections array.
      *
      * @uses Fluent_Options::parse_args(); to merge supplied data with some sane defaults.
      * @uses Fluent_Options::get_default_values(); to merge default values with the saved values if not set.
      * @uses Fluent_Options::prepare_fields(); to prepare the nested fields contained in the supplied array.
      * @uses sanitize_key(); to sanitize the section ID.
      *
      * @since 1.0.0
      *
      * @param array $sections framework setup arguments. Used to change some base settings for the options including context.
      *
      * @param array $context the sections an fields to be used.
      *
      * @param object $id if suppplied should be an instance of Fluent_Page and used to render the meatboxes on none metabox pages.
      *
      * @return none
      */
    protected function prepare_sections($sections, $id = null, $context = null){

        $this->options = $this->get_option($this->args['option_name']);
        if(!$this->options || $this->options == ''){
            $this->options = $this->get_default_values();
        }
        
        foreach($sections as $key => $section){
            $key = sanitize_key($key);
            $this->sections[$key] = $this->parse_args( $section, $this->section_args() );
            $this->sections[$key] = $this->prepare_tabs($this->sections[$key]);
            $fields = $this->sections[$key]['fields'];
            unset($this->sections[$key]['fields']);
            $this->sections[$key]['fields'] = $this->prepare_fields($fields, $this->options, $key);
        }
        
    }
    
    /**
     * Attached to the <code>get_option_{$option_name}</code> filter this function merges the value blueprint with the actual data ensuring all keys are set.
     *
     * Also uses wp_unslash to remove slashes from values.
     *
     * @uses Fluent_Options::parse_args(); to merge supplied data with some sane defaults.
     * @uses Fluent_Options::get_options_schema(); to merge supplied data with a default array index for the option.
     * @uses wp_unslash(); to remove escaped slashes.
     *
     * @since 1.0.0
     *
     * @param array $value data supplied from the database.
     *
     * @return array
     */
    public function format_option($value = false){
        
        if( !is_array( $value ) ){
            $value = array();
        }
        return wp_unslash($this->parse_args($value, $this->get_options_schema(), 'fluent/options/page/'.$this->args['option_name'].'/get'));
        
    }
    
    /**
     * Fires events on the <code>load_page-{$page-hook}</code> hook point to register/enqueue styles/javascript.
     *
     * Save the page options. Register metaboxes and screen options.
     * It also adds filters to the metaboxes which help remove the padding applied by WordPress.
     *
     * @uses isset();
     * @uses check_admin_refferer();
     * @uses update_option();
     * @uses add_screen_option();
     * @uses get_option();
     * @uses add_action();
     * @uses do_action();
     * @uses add_filter();
     * @uses wp_enqueue_style();
     * @uses wp_enqueue_script();
     * @uses wp_localize_script();
     * @uses add_meta_box();
     * @uses time();
     * @uses Fluent_Options::prepare_sections();
     * @uses Fluent_Options::get_default_values();
     * @uses Fluent_Options::remove_clones();
     * @uses Fluent_Options::provide();
     *
     * @since 1.0.0
     *
     * @param object $page_object Fluent_Page instance.
     *
     * @return none
     */
    public function load_page($page_object){
        
        if(isset($_POST['restore-defaults']) && $_POST['restore-defaults'] == true && $this->args['restore'] == true){
            check_admin_referer('save_'.$this->args['option_name'], $this->args['option_name'].'_nonce');
            $newoptions = $this->get_default_values();
            $this->update_option($this->args['option_name'], $newoptions);
            //save seperate fields if needed
            foreach($this->sections as $section){
                foreach($section['fields'] as $id => $field){
                    if($field['seperate'] === true){
                        $this->update_option($this->args['option_name'].'_'.$id, $newoptions[$id]);
                    }
                }
            }
            $option = get_option($this->args['option_name'] . '_meta' );
            $option['options-updated'] = time();
            $this->update_option($this->args['option_name'] . '_meta', $option);
            add_action('admin_notices', $this->provide('settings_default_updated'));
            add_action('network_admin_notices', $this->provide('settings_default_updated'));
        }elseif(isset($_POST[$this->args['option_name']])){
            check_admin_referer('save_'.$this->args['option_name'], $this->args['option_name'].'_nonce');
            $options = $_POST[$this->args['option_name']];
            $newoptions = apply_filters('fluent/options/page/'.$this->args['option_name'].'/save', $this->remove_clones($_POST[$this->args['option_name']]));
            $this->update_option($this->args['option_name'], $newoptions);
            //save seperate fields if needed
            foreach($this->sections as $section){
                foreach($section['fields'] as $id => $field){
                    if($field['seperate'] === true){
                        $this->update_option($this->args['option_name'].'_'.$id, $newoptions[$id]);
                    }
                }
            }
            $option = $this->get_option($this->args['option_name'] . '_meta' );
            $option['options-updated'] = time();
            $this->update_option($this->args['option_name'] . '_meta', $option);
            add_action('admin_notices', $this->provide('settings_updated'));
            add_action('network_admin_notices', $this->provide('settings_updated'));
            do_action('fluent/options/page/'.$this->args['option_name'].'/save', $newoptions);
        }
        
        //re run prepare sections to ensure the options are set
        $this->prepare_sections($this->sections);
        
        //add column choice and style choices
        add_screen_option('layout_columns', array('max' => 2, 'default' => 2) );
        add_filter('screen_settings', $this->provide('add_screen_settings'));
        
        $this->load_assets();
        $this->localize_script(array(
            'context' => 'page'
        ));
        
        add_meta_box( 'submitdiv', __( 'Details', $this->domain ), $this->provide( 'save_box_content' ), get_current_screen(), 'side', 'high' );
        
        foreach($this->sections as $key => $section){
            add_meta_box( $key, $section['title'], $this->provide( 'box_content' ), get_current_screen(), $section['context'], $section['priority'], $key );
            add_filter('postbox_classes_'.get_current_screen()->id.'_'.$key, $this->provide('remove_box_padding'));
        }
        
        if($this->args['dev_mode'] === true){
            add_meta_box( 'dev-mode', __('Dev Mode', $this->domain), $this->provide( 'box_content_dev' ), get_current_screen(), 'advanced', 'low' );
            add_filter('postbox_classes_'.get_current_screen()->id.'_dev-mode', $this->provide('remove_box_padding'));
        }
        
        foreach($this->sections as $key => $section){
            foreach($section['fields'] as $k => $field){
                if(isset(static::$field_types[$field['type']])){
                    do_action('fluent/options/field/'.$field['type'].'/enqueue', $field, static::$field_types[$field['type']]);
                }
            }
        }
        
    }
    
    /**
     * Display a settings updated notice on the <code>admin_notices</code> action.
     *
     * @since 1.0.0
     *
     * @return none
     */
    public function settings_updated(){
        echo '<div class="updated"><p><strong>'.apply_filters('fluent/options/page/'.$this->args['option_name'].'/saved/message', $this->args['messages']['saved']).'</strong></p></div>';
        do_action('fluent/options/page/'.$this->args['option_name'].'/saved/messages', $this);
    }
    
    /**
     * Display a settings updated message when restire defaults is clicked.
     *
     * @since 1.0.0
     *
     * @return none
     */
    public function settings_default_updated(){
        echo '<div class="updated info"><p><strong>'.apply_filters('fluent/options/page/'.$this->args['option_name'].'/restore/message', $this->args['messages']['restore']).'</strong></p></div>'; 
        do_action('fluent/options/page/'.$this->args['option_name'].'/restore/messages', $this); 
    }
    
    /**
     * Renders the options page if $context is page. Hooked onto the Fluent_Page render action.
     *
     * @uses get_admin_page_title();
     * @uses wp_nonce_field();
     * @uses get_current_screen();
     * @uses do_meta_boxes();
     * @uses Fluent_Options::prepare_meta_box_titles();
     *
     * @since 1.0.0
     *
     * @param object $page_object Fluent_Page instance
     *
     * @return none
     */
    public function render_page($page_object){
        
        //current workaround to prevent icons in screen options
        $this->setup_meta_box_titles();
        
        echo '<div class="wrap">';
            echo '<h2>'.get_admin_page_title().'</h2>';
            echo '<form method="post" action="" id="options-form">';
                /* Used to save closed metaboxes and their order */
				wp_nonce_field( 'meta-box-order', 'meta-box-order-nonce', false );
				wp_nonce_field( 'closedpostboxes', 'closedpostboxesnonce', false );
            
                echo '<input type="hidden" name="save-action" value="save-options-'.$this->args['option_name'].'" />';
                
                $columns = ( 1 == get_current_screen()->get_columns() ) ? '1' : '2';
                echo '<div id="poststuff">';
                    echo '<div id="post-body" class="metabox-holder columns-'.$columns.'">';
                        echo '<div id="postbox-container-1" class="postbox-container">';
                            do_meta_boxes( get_current_screen()->id, 'side', null );
                        echo '</div>';
                        echo '<div id="postbox-container-2" class="postbox-container">';
                            do_meta_boxes( get_current_screen()->id, 'normal', null );
                            do_meta_boxes( get_current_screen()->id, 'advanced', null );
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</form>';
        echo '</div>';
    }
    
    /**
     * Display the Save Options meta box on options pages.
     *
     * @uses get_option();
     * @uses date();
     * @uses get_submit_button();
     *
     * @since 1.0.0
     *
     * @return none
     */
    public function save_box_content(){
        
        $option = $this->get_option($this->args['option_name'] . '_meta');
            
        $updated = ( isset($option['options-updated']) ) ? date(get_option('date_format') . ' ' . get_option('time_format'), $option['options-updated']) : __('Never', $this->domain);
        
        echo '<div class="submitbox" id="submitpost">'.
                (($this->args['show_updated'] == true) ? '<div id="minor-publishing">
                <div id="misc-publishing-actions">
                    <div class="misc-pub-section curtime misc-pub-curtime"><span id="timestamp">
                        Last Updated: <b>' . $updated . '</b></span>
                    </div>
                </div>
                <div class="clear"></div>
            </div>' : '').

                (($this->args['messages']['save_box'] != '') ? '<div class="misc-pub-section fluent-options-save-box-message">'.$this->args['messages']['save_box'].'</div>' : '')


                
            .'<div id="major-publishing-actions">'.
                (($this->args['restore'] == true) ? '<div id="delete-action"><a class="submitdelete deletion options-restore-default" href="#">' . __( 'Restore Defaults', $this->domain ) . '</a></div>' : '')
            
                .'<div id="publishing-action"><span class="spinner"></span>'.get_submit_button( apply_filters('fluent/options/page/'.$this->args['option_name'].'/save/button', $this->args['messages']['save_button']), 'primary large', 'fluent[save]', false).'</div>
                <div class="clear"></div>
            </div>
        </div>';
    }
}