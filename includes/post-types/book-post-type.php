<?php

if ( ! function_exists( 'create_book_post_type' ) ) :

function create_book_post_type() {
	$labels = array(
		'name'                => 'Books',
		'singular_name'       => 'Book',
		'menu_name'           => 'Books',
		'parent_item_colon'   => 'Parent Book',
		'all_items'           => 'All Book',
		'view_item'           => 'View Book',
		'add_new_item'        => 'Add New Book',
		'add_new'             => 'Add New',
		'edit_item'           => 'Edit Book',
		'update_item'         => 'Update Book',
		'search_items'        => 'Search Book',
		'not_found'           => 'Not Found',
		'not_found_in_trash'  => 'Not found in Trash'
	);

	$args = array(
		'label' => 'books',
		'description' => 'Books to be promoted on the site',
		'labels' => $labels,
		'public' => true,
		'supports' => array ( 'title', 'custom-fields', 'page-attributes' ), // do you need all of these options?
		'taxonomies' => array( 'post_tags' ),
		'hierarchical' => false,
		'has_archive' => true,
		'can_export' => true,
		'menu_icon' => 'dashicons-book-alt',
		'rewrite' => false,
		'show_ui' => true,
        'show_in_menu' => true,
        'show_in_nav_menus' => true,
        'exclude_from_search' => false,
		'menu_position' => 4,
		'query_var' => true,
		'show_in_rest' => true,
		'rest_base' => 'books',
		'rest_controller_class' => 'WP_REST_Posts_Controller'
	);

	register_post_type( 'books', $args);

}
add_action( 'init', 'create_book_post_type' );

add_filter('single_template', 'books_custom_single_template');
function books_custom_single_template($single) {
    global $post;

    /* Checks for single template by post type */
    if ( $post->post_type == 'books' ) {
        if ( file_exists( dirname( __FILE__, 3 ) . '/single-books.php' ) ) {
            return dirname( __FILE__, 3 ) . '/single-books.php';
        }
    }
    return $single;
}

add_filter('archive_template', 'books_custom_archive_template');
function books_custom_archive_template($archive) {
    global $post;

    /* Checks for archive template by post type */
    if ( $post->post_type == 'books' ) {
        if ( file_exists( dirname( __FILE__, 3 ) . '/templates/archive-books.php' ) ) {
            return dirname( __FILE__, 3 ) . '/templates/archive-books.php';
        }
    }
    return $single;
}

endif;