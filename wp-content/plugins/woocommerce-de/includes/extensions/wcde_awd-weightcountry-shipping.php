<?php
/**
 * Extensions support: "AWD Weight/Country Shipping".
 *
 * @package    WooCommerce German (de_DE)
 * @subpackage Extensions
 * @author     David Decker - DECKERWEB
 * @copyright  Copyright (c) 2013, David Decker - DECKERWEB
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL-2.0+
 * @link       http://genesisthemes.de/en/wp-plugins/woocommerce-de/
 * @link       http://deckerweb.de/twitter
 *
 * @since      3.0.7
 */

/**
 * Exit if accessed directly
 *
 * @since 3.0.7
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Sorry, you are not allowed to access this file directly.' );
}


add_action( 'after_setup_theme', 'ddw_wcde_extension_awd_weightcountry_shipping', 0 );
/**
 * Load the "AWD Weight/Country Shipping" translations by DECKERWEB.
 *
 * @since  3.0.7
 *
 * @uses   get_locale()
 * @uses   load_textdomain()
 *
 * @param  $mofile
 *
 * @return file/ strings Load custom translation files.
 */
function ddw_wcde_extension_awd_weightcountry_shipping() {

	/** Set $mofile to plugin path */
	$mofile = WP_PLUGIN_DIR . '/woocommerce-de/wc-pomo-extensions/awd-weightcountry-shipping/woocommerce-' . get_locale() . '.mo';

	/** Finally, load the translations */
	if ( file_exists( $mofile ) ) {

		load_textdomain( 'woocommerce', $mofile );

	}  // end-if $mofile check

}  // end of function ddw_wcde_extension_awd_weightcountry_shipping