<?php
/**
 * Fluent_Support
 *
 * @package Fluent
 * @since 1.0.5
 * @version 1.0.0
 */

/**
 * Fluent_Support
 */
class Fluent_Support extends Fluent_Base{
    
    /**
     * @var string $version Class version.
     */
    public $version = '1.0.0';
    
    /**
     * @var array $args Class args to be run attached after <code>parse_args</code>.
     */
    public $args = array();

    /**
     * @var boolean $assets_loaded stores if the assets were loaded.
     */
    private static $assets_loaded = false;
    
    /**
      * Function used across extended classes used in conjunction with <code>parse_args</code> to format supplied arrays and ensure all keys are supplied.
      *
      * @since 1.0.0
      *
      * @return array
      *
      */
    private function default_args(){
        
        return array(
            'id' => null,
            'email' => '',
            'subject' => __('Support Request', $this->domain),
            'data' => array(
              'wordpress' => true,
              'plugins' => true,
              'theme' => true,
              'php' => false,
              'server' => false
            ),
            'success_message' => __('Your message has been sent successfully.', $this->domain)
        );
    }

    /**
     * __construct() parse arguments supplied, setup the class.
     *
     * @uses Fluent_Options::parse_args(); to merge supplied data with some sane defaults.
     *
     * @since 1.0.0
     *
     * @param array $args class setup arguments. Used to change some base settings.
     *
     * @return none
     */
    public function __construct( $args = array() ){
        
      $this->args = $this->parse_args( $args, $this->default_args(), 'fluent/support/args' );

      add_action('wp_ajax_fluent_support-'.sanitize_key($this->args['id']), $this->provide('response'));

    }

    /**
     * Respond to ajax requests of the form being submitted.
     *
     * @since 1.0.0
     *
     * @return none
     */
    public function response(){
    	if(!isset($_POST['fluent_support_form_nonce']) || !wp_verify_nonce($_POST['fluent_support_form_nonce'], 'fluent_support_form')){
    		echo json_encode(array('status' => 'error', 'message' => __('Nonce Failure, please reload the page and try again.', $this->domain)));
    		die();
    	}
    	if(!isset($_POST['email']) || $_POST['email'] == ''){
    		echo json_encode(array('status' => 'error', 'message' => __('Please enter your email address.', $this->domain)));
    		die();
    	}
    	if(!isset($_POST['message']) || $_POST['message'] == ''){
    		echo json_encode(array('status' => 'error', 'message' => __('Please enter a message to be sent.', $this->domain)));
    		die();
    	}


    	$message = '<strong>Message:</strong><br/><br/>';
    	$message .= $_POST['message'].'<br/><br/>';
    	if(!empty($_POST['data'])){
    		$message .= '<br/><strong>Additional Data</strong><br/><br/><br/>';
    	}
    	foreach($_POST['data'] as $type){
    		if($type == 'wordpress'){
    			global $wp_version;
    			$message .= '<strong>WordPress Version:</strong> ' . $wp_version . '<br/>';
    			$message .= '<strong>WordPress Multisite:</strong> ' . ((is_multisite()) ? 'yes' : 'no') . '<br/><br/>';
    		}elseif($type == 'plugins'){
    			$plugins = get_option('active_plugins');
    			$message .= '<strong>Activated Plugins:</strong><br/><ul>';
    			include_once(ABSPATH . '/wp-admin/includes/plugin.php');
    			foreach($plugins as $plugin){
    				$data = get_plugin_data(WP_CONTENT_DIR . '/plugins/' . $plugin);
    				$message .= '<li>'.$data['Title'].' - '.$data['Version'].'</li>';
    			}
    			$message .= '</ul><br/>';
    		}elseif($type == 'theme'){
    			$theme = wp_get_theme();
    			$message .= '<strong>Theme:</strong> <a href="'.$theme->get('ThemeURI').'">' . $theme->get('Name') . '</a> - ' . $theme->get('Version') . '<br/><br/>';
    		}elseif($type == 'server'){
    			$message .= '<strong>Server Details:</strong><br/><ul>';
    			foreach($_SERVER as $key => $value){
    				$message .= '<li><strong>'.$key.'</strong> - '.$value.'</li>';
    			}
    			$message .= '</ul><br/>';
    		}elseif($type == 'php'){
    			ob_start();
				phpinfo();
				$phpinfo = array('phpinfo' => array());
				if(preg_match_all('#(?:<h2>(?:<a name=".*?">)?(.*?)(?:</a>)?</h2>)|(?:<tr(?: class=".*?")?><t[hd](?: class=".*?")?>(.*?)\s*</t[hd]>(?:<t[hd](?: class=".*?")?>(.*?)\s*</t[hd]>(?:<t[hd](?: class=".*?")?>(.*?)\s*</t[hd]>)?)?</tr>)#s', ob_get_clean(), $matches, PREG_SET_ORDER)){
				    foreach($matches as $match){
				        if(strlen($match[1])){
				            $phpinfo[$match[1]] = array();
				        }
				        elseif(isset($match[3])){
				            $phpinfo[end(array_keys($phpinfo))][$match[2]] = isset($match[4]) ? array($match[3], $match[4]) : $match[3];
				        }
				        else{
				            $phpinfo[end(array_keys($phpinfo))][] = $match[2];
				        }
				    }
				}
				foreach($phpinfo as $name => $section) {
			        $message .= "<strong>$name</strong>\n<table>\n";
			        foreach($section as $key => $val) {
			            if(is_array($val))
			                $message .= "<tr><td>$key</td><td>$val[0]</td><td>$val[1]</td></tr>\n";
			            elseif(is_string($key))
			                $message .= "<tr><td>$key</td><td>$val</td></tr>\n";
			            else
			                $message .= "<tr><td>$val</td></tr>\n";
			        }
			        $message .= "</table>\n";
			    }

    		}
    	}
    	wp_mail($this->args['email'], $this->args['subject'], $message, array('From: ' . $_POST['email'] . ' <'.$_POST['email'].'>', 'Content-Type: text/html'));

    	echo json_encode(array('status' => 'success', 'message' => $this->args['success_message']));
    	die();
    }

    /**
     * Returns the form html, and conditionally loads assets.
     *
     * @since 1.0.0
     *
     * @return none
     */
    public function get_form(){
      $this->load_assets();

      $form = '<div class="fluent-support-form">';
        $form .= '<input type="hidden" id="fluent-support-form-url" value="'.admin_url('admin-ajax.php').'?action=fluent_support-'.sanitize_key($this->args['id']).'"/>';
        $form .= wp_nonce_field('fluent_support_form', 'fluent_support_form_nonce');
        $form .= '<div class="fluent-support-form-row response"><img src="'.admin_url('images/spinner-2x.gif').'"/><ul></ul></div>';
        $form .= '<div class="fluent-support-form-row"><label for="fluent-support-email" class="fluent-support-form-label"><strong>'.__('Email Address', $this->domain).'</strong></label><input type="email" class="large-text" name="email" id="fluent-support-email" placeholder="'.__('Email', $this->domain).'" value="'.get_option('admin_email').'"/></div>';
        $form .= '<div class="fluent-support-form-row"><label for="fluent-support-message" class="fluent-support-form-label"><strong>'.__('Message', $this->domain).'</strong></label><textarea class="large-text" name="message" id="fluent-support-message" placeholder="'.__('Enter your message', $this->domain).'" rows="6"></textarea></div>';
        $form .= '<div class="fluent-support-form-row"><label class="fluent-support-form-label"><strong>Data to send with this message</strong></label></div>';
        $form .= '<div class="fluent-support-form-row">';
          $form .= '<label for="fluent-support-wordpress"><input type="checkbox" '.checked(true, $this->args['data']['wordpress'], false).' id="fluent-support-wordpress" name="data[]" value="wordpress"/> '.__('WordPress Details', $this->domain).'</label>';
          $form .= ' <label for="fluent-support-plugins"><input type="checkbox" '.checked(true, $this->args['data']['plugins'], false).' id="fluent-support-plugins" name="data[]" value="plugins"/> '.__('Active Plugins', $this->domain).'</label>';
          $form .= ' <label for="fluent-support-theme"><input type="checkbox" '.checked(true, $this->args['data']['theme'], false).' id="fluent-support-theme" name="data[]" value="theme"/> '.__('Active Theme', $this->domain).'</label>';
          $form .= ' <label for="fluent-support-php"><input type="checkbox" '.checked(true, $this->args['data']['php'], false).' id="fluent-support-php" name="data[]" value="php"/> '.__('PHP Details', $this->domain).'</label>';
          $form .= ' <label for="fluent-support-server"><input type="checkbox" '.checked(true, $this->args['data']['server'], false).' id="fluent-support-server" name="data[]" value="server"/> '.__('Server Details', $this->domain).'</label>';
        $form .= '</div>';
        $form .= '<div class="fluent-support-form-row"><a href="#" class="button-primary" title="'.__('Send', $this->domain).'">'.__('Send', $this->domain).'</a></div>';
      $form .= '</div>';

      return $form;
    }

    /**
     * Echo wrapper around the <code>get_form();</code> function.
     *
     * @since 1.0.0
     *
     * @return none
     */
    public function the_form(){
      echo $this->get_form();
    }

    /**
     * Conditionally load the assets. This class could be used more than once but we only need to enqueue it once.
     *
     * @since 1.0.0
     *
     * @return none
     */
    private function load_assets(){
      if(!static::$assets_loaded){
        static::$assets_loaded = true;
        wp_enqueue_script('fluent-support', Fluent_Base::$url . 'assets/js/support.min.js', array('jquery'), $this->version, true);
        wp_enqueue_style('fluent-support', Fluent_Base::$url . 'assets/css/support.min.css', array(), $this->version);
      }
    }

}