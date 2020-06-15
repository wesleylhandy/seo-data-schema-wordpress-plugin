<?php

if ( ! function_exists( 'create_faq_post_type' ) ) :

function create_faq_post_type() {
	$labels = array(
		'name'                => 'FAQs',
		'singular_name'       => 'FAQ',
		'menu_name'           => 'FAQs',
		'parent_item_colon'   => 'Parent FAQ',
		'all_items'           => 'All faq',
		'view_item'           => 'View FAQ',
		'add_new_item'        => 'Add New FAQ',
		'add_new'             => 'Add New',
		'edit_item'           => 'Edit FAQ',
		'update_item'         => 'Update FAQ',
		'search_items'        => 'Search FAQ',
		'not_found'           => 'Not Found',
		'not_found_in_trash'  => 'Not found in Trash'
	);

	$args = array(
		'label' => 'faqs',
		'description' => 'Frequently Asked Questions',
		'labels' => $labels,
		'public' => true,
		'supports' => array ( 'title', 'custom-fields', 'page-attributes' ), // do you need all of these options?
		'taxonomies' => array( 'post_tags' ),
		'hierarchical' => false,
		'has_archive' => false,
		'can_export' => true,
		'menu_icon' => 'dashicons-format-status',
		'rewrite' => array ( 'slug' => 'faqs', 'with_front' => false ),
		'show_ui' => true,
		'show_in_menu' => true,
        'menu_position' => 6,
        'show_in_menu' => true,
        'show_in_nav_menus' => false,
        'exclude_from_search' => true,
		'query_var' => true,
		'show_in_rest' => true,
		'rest_base' => 'faqs',
		'rest_controller_class' => 'WP_REST_Posts_Controller'
	);

	register_post_type( 'faqs', $args);

}
add_action( 'init', 'create_faq_post_type' );

add_filter('single_template', 'faqs_custom_single_template');
function faqs_custom_single_template($single) {
    global $post;

    /* Checks for single template by post type */
    if ( $post->post_type == 'faqs' ) {
        if ( file_exists( dirname( __FILE__, 3 ) . '/single-faqs.php' ) ) {
            return dirname( __FILE__, 3 ) . '/single-faqs.php';
        }
    }
    return $single;
}

add_filter('archive_template', 'faqs_custom_archive_template');
function faqs_custom_archive_template($archive) {
    global $post;

    /* Checks for archive template by post type */
    if ( $post->post_type == 'faqs' ) {
        if ( file_exists( dirname( __FILE__, 3 ) . '/templates/archive-faqs.php' ) ) {
            return dirname( __FILE__, 3 ) . '/templates/archive-faqs.php';
        }
    }
    return $single;
}

endif;