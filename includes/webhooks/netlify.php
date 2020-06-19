<?php

if ( ! function_exists( 'call_build_hook_on_save' ) ) :

    function call_build_hook_on_save($post_id) {
        // ignore changes to the build hook (for now)
        if ( get_field( 'netlify_hook_url', $post_id ) ) {
            return;
        }

        $netlify_hook_url = get_field('netlify_hook_url', 'netlify_settings') ?: '';
        if ( !empty( $netlify_hook_url ) ) :
            $response = Requests::post( $netlify_hook_url );
        endif;
    }

    add_action('acf/save_post', 'call_build_hook_on_save', 20);
endif;