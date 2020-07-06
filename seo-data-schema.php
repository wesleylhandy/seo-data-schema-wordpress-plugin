<?php
/*
Plugin Name: SEO-friendly Data-Schema with Options Pages and Netlify Build Trigger
Plugin URI: https://www.wesleylhandy.net
Description: Worpress Plugin to add SEO-friendly Books, Events, and FAQ data-schema with Options Pages using Advanced Custom Fields Pro, and optimized for connecting via graphql to Static Site Generators and triggering builds on Netlify.
Version: 1.2.8
Author: Wesley L. Handy <wesley@wearecreativ.media>
Author URI: https://www.wesleylhandy.net
Text Domain: seo_data_schema
License: MIT
*/

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists('Seo_data_schema') ):

class Seo_data_schema {
    /** @var string The plugin version number. */
    var $version = '1.2.8';
    
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

		// include_once( SEO_DATA_SCHEMA_PATH . "includes/post-types/book-post-type.php");
        // include_once( SEO_DATA_SCHEMA_PATH . "includes/post-types/event-post-type.php");
        // include_once( SEO_DATA_SCHEMA_PATH . "includes/post-types/faq-post-type.php");
        include_once( SEO_DATA_SCHEMA_PATH . "includes/options-pages/book-options-page.php");
        include_once( SEO_DATA_SCHEMA_PATH . "includes/options-pages/event-options-page.php");
		include_once( SEO_DATA_SCHEMA_PATH . "includes/options-pages/faq-options-page.php");
		include_once( SEO_DATA_SCHEMA_PATH . "includes/options-pages/netlify-settings-options-page.php");
        include_once( SEO_DATA_SCHEMA_PATH . "includes/custom-fields/acf-book-definition.php");
        include_once( SEO_DATA_SCHEMA_PATH . "includes/custom-fields/acf-event-definition.php");
		include_once( SEO_DATA_SCHEMA_PATH . "includes/custom-fields/acf-faq-definition.php");
		include_once( SEO_DATA_SCHEMA_PATH . "includes/custom-fields/acf-netlify-settings-definition.php");
		include_once( SEO_DATA_SCHEMA_PATH . "includes/filters/unique-ids.php");
		include_once( SEO_DATA_SCHEMA_PATH . "includes/filters/validate-slugs.php");
		
		include_once( SEO_DATA_SCHEMA_PATH . "includes/webhooks/netlify.php");
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
		if( !defined($name) ) {
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

    add_action( 'admin_init', 'seo_data_schema_plugin_has_parents' );
    function seo_data_schema_plugin_has_parents() {
        $can_init =  is_admin() && current_user_can( 'activate_plugins') && is_plugin_active( 'advanced-custom-fields/acf.php') && is_plugin_active( 'advanced-custom-fields-pro/acf.php' );
        if ( !$can_init ) {

            add_action( 'admin_notices', 'seo_data_schema_plugin_notice' );
            function seo_data_schema_plugin_notice() {
                if( ! function_exists('acf_add_local_field_group') ):
                  echo '<div class="error"><p>' . __( 'Warning: The theme needs Advanced Custom Fields and Advanced Custom Fields Pro plugins to function', 'fia-petitions' ) . '</p></div>';
                endif;
                if ( ! class_exists('acf_pro') ):
                  echo '<div class="error"><p>' . __( 'Warning: The theme needs Advanced Custom Fields Pro plugin to function', 'fia-petitions' ) . '</p></div>';
                endif;
            }

            deactivate_plugins( plugin_basename( __FILE__) );
            if ( isset( $_GET['activate'] ) ) {
                unset( $_GET['activate'] );
            }
        } 
    }

    if( !isset($seo_data_schema) ) {
        $seo_data_schema = new Seo_data_schema();
        $seo_data_schema->initialize();
    }
    return $seo_data_schema;

}

// Instantiate.
seo_data_schema();

endif; // class_exists check