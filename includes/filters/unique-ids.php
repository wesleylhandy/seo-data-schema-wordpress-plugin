<?php
if( !function_exists('add_uniqid_on_save') ):

    function load_id_as_read_only( $field ){
        $field['default_value'] = uniqidReal();
        $field['disabled'] = 1;
        $field['readonly'] = 1;
        return $field;
    }

    add_filter('acf/load_field/name=id', 'load_id_as_read_only');


    function uniqidReal($length = 13) {
        // uniqid gives 13 chars, but you could adjust it to your needs.
        if (function_exists("random_bytes")) {
            $bytes = random_bytes(ceil($length / 2));
        } elseif (function_exists("openssl_random_pseudo_bytes")) {
            $bytes = openssl_random_pseudo_bytes(ceil($length / 2));
        } else {
            throw new Exception("no cryptographically secure random function available");
        }
        return substr(bin2hex($bytes), 0, $length);
    }

    function add_uniqid_on_save( $value, $post_id, $field ) {
        if ( empty($value) ) :
            $value = uniqidReal();
        endif;
        return $value;
    }


    add_filter('acf/update_value/name=id', 'add_uniqid_on_save', 10, 3);

endif;
