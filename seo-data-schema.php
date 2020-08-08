<?php
/*
Plugin Name: SEO-friendly Data-Schema with Options Pages
Description: Worpress Plugin to add SEO-friendly Books, Events, and FAQ data-schema with Options Pages using Advanced Custom Fields Pro, and optimized for connecting via graphql to Static Site Generators.
Version: 1.4.2
Author: Wesley L. Handy <wesley@wearecreativ.media>
Author URI: https://www.wesleylhandy.net
Text Domain: seo_data_schema
License: MIT
*/

// if this file is called directly, abort!!
if ( !function_exists( 'add_action' ) ):
    die( 'Three blind mice, three blind mice...see how they run!' );
endif;

if ( !class_exists( 'Seo_data_schema' ) ):

class Seo_data_schema {
    /** @var string The plugin version number. */
    var $version = '1.4.2';
    
    /**
	 * __construct
	 *
	 * A dummy constructor to ensure Seo_data_schema is only setup once.
	 *
	 * @date	06/15/20
	 * @since	0.0.1
	 *
	 * @param	void
	 * @return	void
	 */	
	function __construct() {
		// Do nothing.
    }
    
    /**
	 * initialize
	 *
	 * Sets up the Seo_data_schema plugin.
	 *
	 * @date	06/15/20
	 * @since	0.0.1
	 *
	 * @param	void
	 * @return	void
	 */
	function initialize() {
        // Define constants.
		$this->define( 'SEO_DATA_SCHEMA', true );
		$this->define( 'SEO_DATA_SCHEMA_PATH', plugin_dir_path( __FILE__ ) );
		$this->define( 'SEO_DATA_SCHEMA_BASENAME', plugin_basename( __FILE__ ) );
		$this->define( 'SEO_DATA_SCHEMA_VERSION', $this->version );
		
		// INCLUDE POST TYPES
		// include_once( SEO_DATA_SCHEMA_PATH . "includes/post-types/book-post-type.php");
        // include_once( SEO_DATA_SCHEMA_PATH . "includes/post-types/event-post-type.php");
		// include_once( SEO_DATA_SCHEMA_PATH . "includes/post-types/faq-post-type.php");

		// INCLUDE OPTION PAGES		
        include_once( SEO_DATA_SCHEMA_PATH . "includes/options-pages/book-options-page.php" );
        include_once( SEO_DATA_SCHEMA_PATH . "includes/options-pages/event-options-page.php" );
		include_once( SEO_DATA_SCHEMA_PATH . "includes/options-pages/faq-options-page.php" );
		include_once( SEO_DATA_SCHEMA_PATH . "includes/options-pages/netlify-settings-options-page.php" );

		// INCLUDE ACF DEFINITIONS
        include_once( SEO_DATA_SCHEMA_PATH . "includes/custom-fields/acf-book-definition.php" );
        include_once( SEO_DATA_SCHEMA_PATH . "includes/custom-fields/acf-event-definition.php" );
		include_once( SEO_DATA_SCHEMA_PATH . "includes/custom-fields/acf-faq-definition.php" );
		include_once( SEO_DATA_SCHEMA_PATH . "includes/custom-fields/acf-netlify-settings-definition.php" );

		// INCLUDE ACF FILTERS
		include_once( SEO_DATA_SCHEMA_PATH . "includes/filters/unique-ids.php" );
		include_once( SEO_DATA_SCHEMA_PATH . "includes/filters/validate-slugs.php" );
		
		// INCLUDE NETLIFY WEBHOOK
		include_once( SEO_DATA_SCHEMA_PATH . "includes/webhooks/netlify.php" );
    }

    /**
	 * define
	 *
	 * Defines a constant if doesnt already exist.
	 *
	 * @date	06/15/20
	 * @since	0.0.1
	 *
	 * @param	string $name The constant name.
	 * @param	mixed $value The constant value.
	 * @return	void
	 */
	function define( $name, $value = true ) {
		if( !defined( $name ) ) {
			define( $name, $value );
		}
	}
}

/*
 * seo_data_schema
 *
 * The main function responsible for returning the one true seo_data_schema Instance to functions everywhere.
 * Use this function like you would a global variable, except without needing to declare the global.
 *
 * Example: <?php $seo_data_schema = seo_data_schema(); ?>
 *
 * @date	06/15/20
 * @since	0.0.1
 *
 * @param	void
 * @return	Seo_data_schema
 */
function seo_data_schema() {
    global $seo_data_schema;

    if( !isset( $seo_data_schema ) ) {
        $seo_data_schema = new Seo_data_schema();
        $seo_data_schema->initialize();
    }
    return $seo_data_schema;
}

function activate_seo_data_schema() {
	if( !function_exists( 'acf_add_local_field_group' ) ):
		deactivate_plugins( plugin_basename( __FILE__ ) );
		wp_die( __( 'Warning: Please install Advanced Custom Fields and Advanced Custom Fields Pro', 'seo_data_schema' ), 'Plugin dependency check' );
	elseif ( !class_exists( 'acf_pro' ) ):
		deactivate_plugins( plugin_basename( __FILE__ ) );
		wp_die( __( 'Warning: Please install Advanced Custom Fields Pro', 'seo_data_schema' ), 'Plugin dependency check' );
	endif;
}

// Instantiate.
seo_data_schema();

// ADD ACTIVATION HOOK TO CHECK FOR REQUIRED DEPENDENCIES
register_activation_hook( __FILE__, 'activate_seo_data_schema' );

endif; // class_exists check