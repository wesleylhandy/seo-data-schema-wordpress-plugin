<?php
/*
Plugin Name: Books, Events, and FAQ ACF Options Pages with Netlify Build Trigger
Plugin URI: https://www.wesleylhandy.net
Description: Add Books, Events, and FAQ Options Pages using Advanced Custom Fields Pro for connecting to Static Site Generator and triggering build on Netlify
Version: 1.0.0
Author: Wesley L. Handy <wesley@wearecreativ.media>
Author URI: https://www.wesleylhandy.net
Text Domain: books_events_faq
License: MIT
*/

if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( ! class_exists('BEFC') ):

class BEFC {
    /** @var string The plugin version number. */
    var $version = '1.0.0';
    
    /**
	 * __construct
	 *
	 * A dummy constructor to ensure BEFC is only setup once.
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
	 * Sets up the BEFC plugin.
	 *
	 * @date	06/15/20
	 * @since	0.0.1
	 *
	 * @param	void
	 * @return	void
	 */
	function initialize() {
        		// Define constants.
		$this->define( 'BEFC', true );
		$this->define( 'BEFC_PATH', plugin_dir_path( __FILE__ ) );
		$this->define( 'BEFC_BASENAME', plugin_basename( __FILE__ ) );
        $this->define( 'BEFC_VERSION', $this->version );

		// include_once( BEFC_PATH . "includes/post-types/book-post-type.php");
        // include_once( BEFC_PATH . "includes/post-types/event-post-type.php");
        // include_once( BEFC_PATH . "includes/post-types/faq-post-type.php");
        include_once( BEFC_PATH . "includes/options-pages/book-options-page.php");
        include_once( BEFC_PATH . "includes/options-pages/event-options-page.php");
		include_once( BEFC_PATH . "includes/options-pages/faq-options-page.php");
		include_once( BEFC_PATH . "includes/options-pages/netlify-setings-options-page.php");
        include_once( BEFC_PATH . "includes/custom-fields/acf-book-definition.php");
        include_once( BEFC_PATH . "includes/custom-fields/acf-event-definition.php");
		include_once( BEFC_PATH . "includes/custom-fields/acf-faq-definition.php");
		include_once( BEFC_PATH . "includes/custom-fields/acf-netlify-settings-definition.php");
		
		include_once( BEFC_PATH . "includes/webhooks/netlify.php");
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
 * befc
 *
 * The main function responsible for returning the one true berfc Instance to functions everywhere.
 * Use this function like you would a global variable, except without needing to declare the global.
 *
 * Example: <?php $befc = befc(); ?>
 *
 * @date	06/15/20
 * @since	0.0.1
 *
 * @param	void
 * @return	BEFC
 */
function befc() {
    global $befc;

    add_action( 'admin_init', 'befc_plugin_has_parents' );
    function befc_plugin_has_parents() {
        $can_init =  is_admin() && current_user_can( 'activate_plugins') && is_plugin_active( 'advanced-custom-fields/acf.php') && is_plugin_active( 'advanced-custom-fields-pro/acf.php' );
        if ( !$can_init ) {

            add_action( 'admin_notices', 'befc_plugin_notice' );
            function befc_plugin_notice() {
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

    if( !isset($befc) ) {
        $befc = new BEFC();
        $befc->initialize();
    }
    return $befc;

}

// Instantiate.
befc();

endif; // class_exists check