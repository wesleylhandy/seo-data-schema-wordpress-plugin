<?php

function register_faqs_options_pages() {

    // Check function exists.
    if( !function_exists( 'acf_add_options_page' ) )
        return;

    // register options page.
    $option_page = acf_add_options_page( array(
        'page_title'    => __( 'Frequently Asked Questions' ),
        'menu_title'    => __( 'FAQs' ),
        'menu_slug'     => 'faqs-settings',
        'capability'    => 'edit_posts',
        'position'      => '4.4',
        'icon_url'      => 'dashicons-format-status',
        'redirect'      => false,
        'autoload'      => true,
        'update_button' => __( 'Update', 'acf' ),
        'updated_message' => __( "Faqs Updated", 'acf' ),
        'post_id' => 'faqs',
        'show_in_graphql' => true,
    ) );
}

// Hook into acf initialization.
add_action( 'acf/init', 'register_faqs_options_pages' );