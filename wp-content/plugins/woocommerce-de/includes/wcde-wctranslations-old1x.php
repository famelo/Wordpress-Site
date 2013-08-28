<?php
/**
 * Translations loader for: WooCommerce 1.6.x (v1.6.6).
 *
 * @package    WooCommerce German (de_DE)
 * @subpackage Translations Loader
 * @author     David Decker - DECKERWEB
 * @copyright  Copyright (c) 2012-2013, David Decker - DECKERWEB
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL-2.0+
 * @link       http://genesisthemes.de/en/wp-plugins/woocommerce-de/
 * @link       http://deckerweb.de/twitter
 *
 * @since      3.0.0
 */

/**
 * Exit if accessed directly
 *
 * @since 3.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Sorry, you are not allowed to access this file directly.' );
}


add_action( 'plugins_loaded', 'ddw_wcde_old1x_load_textdomain', 6 );
/**
 * Load the WooCommerce 1.6.x translations by DECKERWEB.
 *
 * @since  3.0.0
 *
 * @uses   ddw_wcde_woocommerce_is_informal()
 * @uses   get_locale()
 * @uses   load_textdomain()
 *
 * @param  $wcde_lang_type
 * @param  $mofile
 *
 * @return file/ strings Load custom translation files.
 */
function ddw_wcde_old1x_load_textdomain() {

	/** Load formal/ informal translations depending on WooCommerce settings */
	if ( ! ddw_wcde_woocommerce_is_informal() ) {

		/** Check for custom version in WP_LANG_DIR */
		if ( is_readable( WP_LANG_DIR . '/woocommerce-de/custom-1x/woocommerce-de_DE.mo' ) ) {

			$mofile = WP_LANG_DIR . '/woocommerce-de/custom-1x/' . apply_filters( 'wcde_woocommerce_old_custom_locale', 'woocommerce-' . get_locale() ) . '.mo';

		}

		/** Check in theme folder - only for backwards compatibility of this plugin (v1.x - v2.x)! */
		elseif ( is_readable( get_stylesheet_directory() . '/woocommerce/sprachdatei/woocommerce-de_DE.mo' ) ) {

			$mofile = get_stylesheet_directory() . '/woocommerce/sprachdatei/woocommerce-' . get_locale() . '.mo';

		}

		/** Check for formal version - via plugin */
		else {

			$mofile = WP_PLUGIN_DIR . '/woocommerce-de/wc-pomo-1x/sie-version/' . apply_filters( 'wcde_woocommerce_old_formal_plugin_locale', 'woocommerce-' . get_locale() ) . '.mo';

		}  // end-if formal custom/ plugin file check

	} elseif ( ddw_wcde_woocommerce_is_informal() ) {

		/** Check for custom version in WP_LANG_DIR */
		if ( is_readable( WP_LANG_DIR . '/woocommerce-de/custom-1x/woocommerce-de_DE.mo' ) ) {

			$mofile = WP_LANG_DIR . '/woocommerce-de/custom-1x/' . apply_filters( 'wcde_woocommerce_old_custom_locale', 'woocommerce-' . get_locale() ) . '.mo';

		}

		/** Check in theme folder - only for backwards compatibility of this plugin (v1.x - v2.x)! */
		elseif ( is_readable( get_stylesheet_directory() . '/woocommerce/sprachdatei/woocommerce-de_DE.mo' ) ) {

			$mofile = get_stylesheet_directory() . '/woocommerce/sprachdatei/woocommerce-' . get_locale() . '.mo';

		}
		
		/** Check for informal version - via plugin */
		else {

			$mofile = WP_PLUGIN_DIR . '/woocommerce-de/wc-pomo-1x/du-version/' . apply_filters( 'wcde_woocommerce_old_informal_plugin_locale', 'woocommerce-' . get_locale() ) . '.mo';

		}  // end-if informal custom/ plugin file check

	}  // end-if settings check


	/** Finally, load the translations */
	if ( file_exists( $mofile ) ) {

		return load_textdomain( 'woocommerce', $mofile );

	}  // end-if $mofile check

}  // end of function ddw_wcde_old1x_load_textdomain