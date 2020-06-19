<?php

if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
        'key' => 'group_5eecf79785b2f',
        'title' => 'Netlify Settings',
        'fields' => array(
            array(
                'key' => 'field_5eecf7b99e9cc',
                'label' => 'Netlify Hook Url',
                'name' => 'netlify_hook_url',
                'type' => 'url',
                'instructions' => '***DO NOT UPDATE*** This is used by netlify to update the site based on changes to custom fields',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'netlify-settings',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_graphql' => 1,
        'graphql_field_name' => 'netlify_settings',
    ));
    
    endif;