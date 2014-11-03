<?php
/**
 * Example usage of the framework classes.
 *
 * @package Fluent
 * @since 1.0.1
 * @version 1.0.2
 */

//this sections shows how you can section tabs feature and use the group field to nest and repeat fields, it can go as deep as you want it to (consider the implications on screen space though)
$sections['group'] = array(
    'dash_icon' => 'feedback',
    'title' => __('Layout Select', 'fluent'),
    'description' => '',
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        //this is where the sorter must be added
        'layout' => array(
            'type'  => 'select',//sorter
            'title' => 'Select a layout',
            'options' => array(
                'layout1' => 'Layout 1',
                'layout2' => 'Layout 2',
                'layout3' => 'Layout 3',
                'layout4' => 'Layout 4'
            )
        )
    ),
);


/* load meta boxes */
$args = array(
    //'dev_mode' => true,
    'option_name' => 'custom_pt_options',
    'post_types' => array(
        'custom_pt'
    )
);
//you can create and store in one line too
//Fluent_Store::set('metaboxes', new Fluent_Options_Meta( $args, $sections ));

$instance = new Fluent_Options_Meta($args, $sections);

//creating post types - all args are optional, added for documentation
$name = 'Custom PT';//name will be converted to lowercase with underscores for spaces and dashes
$args = array(
    //normal register_post_type() args, defaults used unless otherwise stated
    'labels'               => array(
        'name'               => sprintf(__('%ss', 'domain'), $name),
        'singular_name'      => $name,
        'menu_name'          => sprintf(__( '%ss', 'domain' ), $name),
        'name_admin_bar'     => sprintf(__( '%s', 'domain' ), $name),
        'add_new'            => __( 'Add New', 'domain' ),
        'add_new_item'       => sprintf(__( 'Add New %s', 'domain' ), $name),
        'new_item'           => sprintf(__( 'New %s', 'domain' ), $name),
        'edit_item'          => sprintf(__( 'Edit %s', 'domain' ), $name),
        'view_item'          => sprintf(__( 'View %s', 'domain' ), $name),
        'all_items'          => sprintf(__( 'All %ss', 'domain' ), $name),
        'search_items'       => sprintf(__( 'Search %ss', 'domain' ), $name),
        'parent_item_colon'  => sprintf(__( 'Parent %ss:', 'domain' ), $name),
        'not_found'          => sprintf(__( 'No %ss found.', 'domain' ), strtolower($name)),
        'not_found_in_trash' => sprintf(__( 'No %ss found in Trash.', 'domain' ), strtolower($name))
    ),
    'description'          => '',
    'public'               => true,
    'hierarchical'         => false,
    'exclude_from_search'  => null,
    'publicly_queryable'   => null,
    'show_ui'              => null,
    'show_in_menu'         => null,
    'show_in_nav_menus'    => null,
    'show_in_admin_bar'    => null,
    'menu_position'        => null,
    'menu_icon'            => null,
    'capability_type'      => 'post',
    'capabilities'    => array(
        'edit_post'          => 'edit_theme_options',
        'delete_post'        => 'edit_theme_options',
        'read_post'          => 'read',
        'edit_posts'         => 'edit_theme_options',
        'edit_others_posts'  => 'edit_theme_options',
        'publish_posts'      => 'edit_theme_options',
        'read_private_posts' => 'edit_theme_options'
    ),
    'map_meta_cap'         => null,
    'supports'             => array( 'title' ),
    'register_meta_box_cb' => null,
    'taxonomies'           => array(),//default is empty array, we have assigned the tag taxonomy for demostration purposes. Any taxonomies added here must be builtin or registered before the init priority 10. If you want to assign Fluent_Taxonomies you need to declare this post type when registering the taxonomy.
    'has_archive'          => true,//default = false but we have set to true so you can see the archive template overwrite
    'rewrite'              => true,
    'query_var'            => true,
    'can_export'           => true,
    'delete_with_user'     => null,
    '_edit_link'           => 'post.php?post=%d',
    //our custom messages array, defaults detailed below. this allows you to change the notices when posts are changed in some way without adding yet more filters
    'messages' => array(
        0  => '', // Unused. Messages start at index 1.
        1  => __( '%s updated.', 'domain' ),
        2  => __( 'Custom field updated.', 'domain' ),
        3  => __( 'Custom field deleted.', 'domain' ),
        4  => __( '%s updated.', 'domain' ),
        5  => __( '%s restored to revision from %s', 'domain' ),
        6  => __( '%s published.', 'domain' ),
        7  => __( '%s saved.', 'domain' ),
        8  => __( '%s submitted.', 'domain' ),
        9  => __( '%s scheduled for: <strong>%s</strong>.', 'domain' ),
        10 => __( '%s draft updated.', 'domain' )
    ),
    //want to disable people adding new posts?
    'disable_add_new' => false,
    //here you can set the template paths if creating the post type in a plugin, you can also set it to override the theme version with override = true. default behavior is to provide a fallback not to override.
    'templates' => array(
        'single' => array(//the single post page
            'override' => true,//default = false. set to true to force this to be used before the theme version
            'path' => dirname(FLUENT_FILE) . '/example-singular-template.php'//full path to file, default = false
        ),
        'archive' => array(//the archive/list page (if post type supports archives)
            'override' => true,//default = false. set to true to force this to be used before the theme version
            'path' => dirname(FLUENT_FILE) . '/example-archive-template.php'//full path to file, default = false
        )
    ),
);
new Fluent_Post_Type($name, $args);

