<?php
/**
 * Extensions support: "WooCommerce Product CSV Import Suite".
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


add_action( 'init', 'ddw_wcde_extension_product_csv_import_suite', 0 );
/**
 * Load the "WooCommerce Product CSV Import Suite" translations by DECKERWEB.
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
function ddw_wcde_extension_product_csv_import_suite() {

	/** Set $mofile to plugin path */
	$mofile = WP_PLUGIN_DIR . '/woocommerce-de/wc-pomo-extensions/product-csv-import-suite/wc_csv_import-' . get_locale() . '.mo';

	/** Finally, load the translations */
	if ( file_exists( $mofile ) ) {

		load_textdomain( 'wc_csv_import', $mofile );
		load_textdomain( 'woocommerce', $mofile );			// textdomain needs fix by plugin dev!
		load_textdomain( 'wordpress-importer', $mofile );	// textdomain needs fix by plugin dev!
		load_textdomain( 'default', $mofile );				// textdomain needs fix by plugin dev!

	}  // end-if $mofile check

}  // end of function ddw_wcde_extension_product_csv_import_suite