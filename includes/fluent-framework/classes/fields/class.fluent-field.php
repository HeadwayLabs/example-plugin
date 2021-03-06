<?php
/**
 * Fluent_Field
 *
 * @package Fluent
 * @since 1.0.0
 * @version 1.0.0
 */

//add_action('fluent/options/field/type/render', array('Fluent_type_Field', 'render'), 1, 2);
//add_action('fluent/options/field/type/enqueue', array('Fluent_type_Field', 'enqueue'), 1, 2);
//add_action('fluent/options/field/type/schema', array('Fluent_type_Field', 'schema'), 1, 2);
//add_action('fluent/options/field/type/default', array('Fluent_type_Field', 'default_value'), 1, 2);

/**
 * Fluent_Field can be extended to create field classes and contains all basic methods required.
 */
class Fluent_Field extends Fluent_Base{
    
    /**
     * Returns the default field data.
     *
     * @since 1.0.0
     *
     * @return array default field data
     */
    public static function field_data(){
        return array();
    }
    
    /**
     * Parse passed data with default data.
     *
     * @since 1.0.0
     *
     * @param array $data supplied field data.
     *
     * @return array parsed field data
     */
    public static function data_setup( $data = array() ){
        return self::parse_args( $data, static::field_data() );
    }
    
    /**
     * Enqueue or register styles and scripts to be used when the field is rendered.
     *
     * @since 1.0.0
     *
     * @param array $data field data.
     *
     * @param array $field_data locations and other data for the field type.
     */
    public static function enqueue( $data = array(), $field_data = array() ){
        
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
     *
     * @return mixed schema value type
     */
    public static function schema($value = '', $data = array() ){
        return '';
    }
    
    /**
     * Allows the field class to reformat any supplied default value from the original supplied to the object instance.
     *
     * @since 1.0.0
     *
     * @param string $default current default
     *
     * @param array $data field data
     *
     * @return mixed default value
     */
    public static function default_value($default = '', $data = array()){
        return $default;
    }
    
}