<?php

if ( ! function_exists( 'create_event_post_type' ) ) :

function create_event_post_type() {
	$labels = array(
		'name'                => 'Events',
		'singular_name'       => 'Event',
		'menu_name'           => 'Events',
		'parent_item_colon'   => 'Parent Event',
		'all_items'           => 'All Event',
		'view_item'           => 'View Event',
		'add_new_item'        => 'Add New Event',
		'add_new'             => 'Add New',
		'edit_item'           => 'Edit Event',
		'update_item'         => 'Update Event',
		'search_items'        => 'Search Event',
		'not_found'           => 'Not Found',
		'not_found_in_trash'  => 'Not found in Trash'
	);

	$args = array(
		'label' => 'events',
		'description' => 'Speaking Engagements and Events',
		'labels' => $labels,
		'public' => true,
		'supports' => array ( 'title', 'custom-fields', 'page-attributes' ), // do you need all of these options?
		'taxonomies' => array( 'post_tags' ),
		'hierarchical' => false,
		'has_archive' => true,
		'can_export' => true,
		'menu_icon' => 'dashicons-tickets-alt',
		'rewrite' => array ( 'slug' => 'events', 'with_front' => false ),
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'query_var' => true,
		'show_in_rest' => true,
		'rest_base' => 'events',
		'rest_controller_class' => 'WP_REST_Posts_Controller'
	);

	register_post_type( 'events', $args);

}
add_action( 'init', 'create_event_post_type' );

add_filter('single_template', 'events_custom_single_template');
function events_custom_single_template($single) {
    global $post;

    /* Checks for single template by post type */
    if ( $post->post_type == 'events' ) {
        if ( file_exists( dirname( __FILE__, 3 ) . '/single-events.php' ) ) {
            return dirname( __FILE__, 3 ) . '/single-events.php';
        }
    }
    return $single;
}

add_filter('archive_template', 'events_custom_archive_template');
function events_custom_archive_template($archive) {
    global $post;

    /* Checks for archive template by post type */
    if ( $post->post_type == 'events' ) {
        if ( file_exists( dirname( __FILE__, 3 ) . '/templates/archive-events.php' ) ) {
            return dirname( __FILE__, 3 ) . '/templates/archive-events.php';
        }
    }
    return $single;
}

endif;