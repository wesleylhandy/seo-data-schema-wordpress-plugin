<?php
if( !function_exists( 'validate_slug_on_defined_object' ) ):

    function validate_slug_on_defined_object( $valid, $value, $field, $input_name ) {
        if( $valid !== true ) {
            return $valid;
        }
        if ( preg_match('/^[0-9a-z-_]{1,}$/i', $value) != 1 ) {
            return __( 'Please use only the letters A-Z, numbers, dashes or underscores' );
        }
        return $valid;
    }

    add_filter( 'acf/validate_value/name=slug', 'validate_slug_on_defined_object', 10, 4 );

endif;