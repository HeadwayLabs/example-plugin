<?php
/**
 * Fluent_Select_Field
 *
 * @package Fluent
 * @since 1.0.0
 * @version 1.0.1
 */

add_action('fluent/options/field/select/render', array('Fluent_Select_Field', 'render'), 1, 2);
add_action('fluent/options/field/select/schema', array('Fluent_Select_Field', 'schema'), 1, 2);

/**
 * Fluent_Select_Field simple select field.
 */
class Fluent_Select_Field extends Fluent_Field{

    /**
     * @var string $version Class version.
     */
    public $version = '1.0.1';
    
    /**
     * Returns the default field data.
     *
     * @since 1.0.0
     *
     * @return array default field data
     */
    public static function field_data(){
        return array(
            'options' => array(), 
            'multiple' => false,
            'placeholder' => ''
        );
    }
    
    /**
     * Notify the Fluent_Options class of the schema needed for this field type within the values array.
     *
     * Generally this will be an empty string just to register the key in the array, but custom fields and things like multi selects will need this to be an array.
     * Groups use this to define the nested fields as well.
     *
     * @since 1.0.0
     *
     * @param string $value the current value that will be used.
     *
     * @param array $data field data as supplied by the section or group.
     */
    public static function schema($value = '', $data = array()){
        $data = self::data_setup($data);
        if($data['multiple'] == true){
            return array();
        }
    }
    
    /**
     * Render the field HTML based on the data provided.
     *
     * @since 1.0.0
     *
     * @param array $data field data.
     *
     * @param object $object Fluent_Options instance allowing you to alter anything if required.
     */
    public static function render($data = array(), $object){
        
        $data = self::data_setup($data);
        
        $multiple = ($data['multiple'] == true) ? '[]" multiple="multiple' : '';

        if($data['value'] == '' && isset($data['default']) && $data['default'] != ''){
            $data['value'] = $data['default'];
        }
        
        echo '<select name="'.$data['option_name'].'['.$data['name'].']'.$multiple.'" class="selectize" placeholder="'.$data['placeholder'].'">';
            foreach($data['options'] as $key => $value){
                if($data['multiple'] == true){
                    $selected = (in_array($key, $data['value'])) ? ' selected="selected"' : '';
                }else{
                   $selected = selected($data['value'], $key, false); 
                }
                echo '<option value="'.$key.'"'.$selected.'>'.$value.'</option>';
            }
        echo '</select>';
    }
    
}