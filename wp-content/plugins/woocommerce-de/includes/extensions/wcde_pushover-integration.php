<?php
/**
 * Extensions support: "Pushover for WooCommerce".
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


add_action( 'after_setup_theme', 'ddw_wcde_extension_pushover_integration', 0 );
/**
 * Load the "Pushover for WooCommerce" translations by DECKERWEB.
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
function ddw_wcde_extension_pushover_integration() {

	/** Set $mofile to plugin path */
	$mofile = WP_PLUGIN_DIR . '/woocommerce-de/wc-pomo-extensions/pushover-integration/wc_pushover-' . get_locale() . '.mo';

	/** Finally, load the translations */
	if ( file_exists( $mofile ) ) {

		load_textdomain( 'wc_pushover', $mofile );
		load_textdomain( 'wc_ups', $mofile );		// textdomain needs fix by plugin dev!

	}  // end-if $mofile check

}  // end of function ddw_wcde_extension_pushover_integration