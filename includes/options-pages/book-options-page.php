<?php

function register_book_options_pages() {

    // Check function exists.
    if( !function_exists('acf_add_options_page') )
        return;

    // register options page.
    $option_page = acf_add_options_page(array(
        'page_title'    => __('Books and Publications'),
        'menu_title'    => __('Books'),
        'menu_slug'     => 'books-settings',
        'capability'    => 'edit_posts',
        'position'      => '4.3',
        'icon_url'      => 'dashicons-book-alt',
        'redirect'      => false,
        'autoload'      => true,
        'update_button' => __('Update', 'acf'),
        'updated_message' => __("Books Updated", 'acf'),
        'post_id' => 'books',
        'show_in_graphql' => true,
    ));
}

// Hook into acf initialization.
add_action('acf/init', 'register_book_options_pages');