<?php

function register_events_options_pages() {

    // Check function exists.
    if( !function_exists('acf_add_options_page') )
        return;

    // register options page.
    $option_page = acf_add_options_page(array(
        'page_title'    => __('Events and Speaking Engagements'),
        'menu_title'    => __('Events'),
        'menu_slug'     => 'events-settings',
        'capability'    => 'edit_posts',
        'position'      => '4.4',
        'icon_url'      => 'dashicons-tickets-alt',
        'redirect'      => false,
        'autoload'      => true,
        'update_button' => __('Update', 'acf'),
        'updated_message' => __("Events Updated", 'acf'),
        'post_id' => 'events',
        'show_in_graphql' => true,
    ));
}

// Hook into acf initialization.
add_action('acf/init', 'register_events_options_pages');