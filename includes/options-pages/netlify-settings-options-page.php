<?php

function register_netlify_settings_options_pages() {

    // Check function exists.
    if( !function_exists( 'acf_add_options_page' ) )
        return;

    // register options page.
    $option_page = acf_add_options_page(array(
        'page_title'    => __( 'Netlify Settings' ),
        'menu_title'    => __( 'Netlify Settings' ),
        'menu_slug'     => 'netlify-settings',
        'capability'    => 'edit_posts',
        'position'      => '4.1',
        'icon_url'      => 'dashicons-cloud',
        'redirect'      => false,
        'autoload'      => true,
        'update_button' => __( 'Update', 'acf' ),
        'updated_message' => __( "Settings Updated", 'acf' ),
        'post_id' => 'netlify_settings',
        'show_in_graphql' => true,
    ) );
}

// Hook into acf initialization.
add_action( 'acf/init', 'register_netlify_settings_options_pages' );