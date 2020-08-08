<?php

if ( !function_exists( 'call_build_hook_on_save' ) ) :

    function call_build_hook_on_save( $post_id ) {
        try {
        // ignore changes to the build hook (for now)
            if ( get_field( 'netlify_hook_url', $post_id ) ):
                return;
            endif;

            $netlify_hook_url = get_field( 'netlify_hook_url', 'netlify_settings' ) ?: '';
            if ( !empty( $netlify_hook_url ) ) :
                try {
                    $response = Requests::post( $netlify_hook_url );
                } catch ( Exception $err ) {
                    error_log( $err );
                }
            endif;
            
        } catch ( Exception $err ) {
            error_log( $err );
        }
    }

    add_action( 'acf/save_post', 'call_build_hook_on_save', 20 );
endif;