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

function shortcode( $atts ) {
	extract( shortcode_atts( array(
		'id' => 0,
	), $atts ) );

	$options = example_options( $id );

	return vb_render_view( $id );
}
add_shortcode( 'display_shortcode', 'shortcode' );


/* returns shorcode */
function render_view( $id ) {

	return 'shortcode output';

}


/* How to get the custom post type id? */

$id = example_plugin()->id;

/* Then I can call the options like this */

$options = get_post_meta( $id, 'custom_pt_options', true );


/* Example of how I would enqueue the script if I could get the ID and options */

function enqueue_scripts() {

	wp_enqueue_script('layout1', example_plugin()->plugin_url . 'includes/assets/layouts/js/layout1.js', array(), example_plugin()->version, 1);
}

if ($options['layout'] == 'layout1') {
	add_action( 'wp_enqueue_scripts', 'enqueue_scripts' );
}

