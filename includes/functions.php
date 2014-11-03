<?php

/**
 * Helper functions
 * 
 * @package Example_Plugin
 * @since 1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )
	exit;

/* Get options for use in the loop when I know the ID */
function example_options( $id = false ) {

    if ( !$id ) $id = get_the_ID();
    
    $options = get_post_meta( $id, 'custom_pt_options', true );

    return $options;
    
}


/* How to get the custom post type id? */

$id = example_plugin()->id;

/* Then I can call the options like this */

$options = get_post_meta( $id, 'custom_pt_options', true );