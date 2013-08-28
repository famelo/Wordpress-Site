<?php
/**
 * Extensions support: "WooCommerce Gravity Forms Product Add-Ons".
 *
 * @package    WooCommerce German (de_DE)
 * @subpackage Extensions
 * @author     David Decker - DECKERWEB
 * @copyright  Copyright (c) 2013, David Decker - DECKERWEB
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL-2.0+
 * @link       http://genesisthemes.de/en/wp-plugins/woocommerce-de/
 * @link       http://deckerweb.de/twitter
 *
 * @since      3.0.4
 */

/**
 * Exit if accessed directly
 *
 * @since 3.0.4
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Sorry, you are not allowed to access this file directly.' );
}


add_action( 'after_setup_theme', 'ddw_wcde_extension_gravityforms_addons', 0 );
//add_action( 'woocommerce_loaded', 'ddw_wcde_extension_gravityforms_addons', 0 );
/**
 * Load the "WooCommerce Gravity Forms Product Add-Ons" translations by DECKERWEB.
 *
 * @since  3.0.4
 *
 * @uses   get_locale()
 * @uses   load_textdomain()
 *
 * @param  $mofile
 *
 * @return file/ strings Load custom translation files.
 */
function ddw_wcde_extension_gravityforms_addons() {

	/** Set $mofile to plugin path */
	$mofile = WP_PLUGIN_DIR . '/woocommerce-de/wc-pomo-extensions/gravityforms-addons/wc_gravityforms-' . get_locale() . '.mo';

	/** Finally, load the translations */
	if ( file_exists( $mofile ) ) {

		load_textdomain( 'wc_gravityforms', $mofile );
		load_textdomain( 'wc_gf_addons', $mofile );		// textdomain needs fix by plugin dev!
		load_textdomain( 'woocommerce', $mofile );		// textdomain needs fix by plugin dev!
		
	}  // end-if $mofile check

}  // end of function ddw_wcde_extension_gravityforms_addons