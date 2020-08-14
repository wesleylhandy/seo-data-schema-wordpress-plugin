<?php

function register_news_options_pages() {

    // Check function exists.
    if( !function_exists( 'acf_add_options_page' ) )
        return;

    // register options page.
    $option_page = acf_add_options_page( array(
        'page_title'    => __( 'In The News' ),
        'menu_title'    => __( 'news' ),
        'menu_slug'     => 'news-mentions',
        'capability'    => 'edit_posts',
        'position'      => '4.9',
        'icon_url'      => 'dashicons-admin-links',
        'redirect'      => false,
        'autoload'      => true,
        'update_button' => __( 'Update', 'acf' ),
        'updated_message' => __( "News Mentions Updated", 'acf' ),
        'post_id' => 'news_mentions',
        'show_in_graphql' => true,
    ) );
}

// Hook into acf initialization.
add_action( 'acf/init', 'register_news_options_pages' );