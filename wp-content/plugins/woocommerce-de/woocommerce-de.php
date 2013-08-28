<?php
/**
 * Main plugin file.
 * This plugin extends the WooCommerce shop plugin with complete German language
 *    packs - formal and informal. - WooCommerce endlich komplett auf deutsch!
 *
 * @package   WooCommerce German (de_DE)
 * @author    David Decker
 * @link      http://deckerweb.de/twitter
 * @copyright Copyright (c) 2012-2013, David Decker - DECKERWEB
 *
 * Plugin Name: WooCommerce German (de_DE)
 * Plugin URI: http://genesisthemes.de/en/wp-plugins/woocommerce-de/
 * Description: This plugin extends the WooCommerce shop plugin with complete German language packs - formal and informal. - WooCommerce endlich komplett auf deutsch!
 * Version: 3.0.13
 * Author: David Decker - DECKERWEB
 * Author URI: http://deckerweb.de/
 * License: GPL-2.0+
 * License URI: http://www.opensource.org/licenses/gpl-license.php
 * Text Domain: woocommerce-german
 * Domain Path: /wcde-languages/
 *
 * Copyright (c) 2012-2013 David Decker - DECKERWEB
 *
 *     This file is part of WooCommerce German (de_DE),
 *     a plugin for WordPress.
 *
 *     WooCommerce German (de_DE) is free software:
 *     You can redistribute it and/or modify it under the terms of the
 *     GNU General Public License as published by the Free Software
 *     Foundation, either version 2 of the License, or (at your option)
 *     any later version.
 *
 *     WooCommerce German (de_DE) is distributed in the hope that
 *     it will be useful, but WITHOUT ANY WARRANTY; without even the
 *     implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR
 *     PURPOSE. See the GNU General Public License for more details.
 *
 *     You should have received a copy of the GNU General Public License
 *     along with WordPress. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Exit if accessed directly.
 *
 * @since 3.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Sorry, you are not allowed to access this file directly.' );
}


/**
 * Setting constants
 *
 * @since 1.0.0
 */
/** Plugin directory */
define( 'WCDE_PLUGIN_DIR', dirname( __FILE__ ) );

/** Set constant path to the Plugin basename (folder) */
define( 'WCDE_PLUGIN_BASEDIR', dirname( plugin_basename( __FILE__ ) ) );

/** Plugin directory */
define( 'WCDE_EXTENSIONS_DIR', dirname( __FILE__ ) . '/includes/extensions' );

/** Define constants and set defaults for removing certain functions/ filters */
if ( ! defined( 'WCDE_LOAD_GETTEXT_FILTERS' ) ) {
	define( 'WCDE_LOAD_GETTEXT_FILTERS', TRUE );
}

if ( ! defined( 'WCDE_LOAD_EXTENSION_SUPPORT' ) ) {
	define( 'WCDE_LOAD_EXTENSION_SUPPORT', TRUE );
}

	
add_action( 'after_setup_theme', 'ddw_wcde_init' );
/**
 * Load the text domain for translation of the plugin.
 * Load admin helper functions - only within 'wp-admin'.
 * 
 * @since 1.0.0
 *
 * @uses  is_admin()
 * @uses  load_plugin_textdomain()
 */
function ddw_wcde_init() {

	/** If 'wp-admin' include admin helper functions */
	if ( is_admin() ) {

		/** Load plugin textdomain plus translation files */
		load_plugin_textdomain( 'woocommerce-german', false, WCDE_PLUGIN_BASEDIR . '/wcde-languages/' );

		/** Include admin helper functions */
		require_once( WCDE_PLUGIN_DIR . '/includes/wcde-admin.php' );

	}  // end-if is_admin() check

	/** Add "Settings Page" link to plugin page - only within 'wp-admin' */
	if ( is_admin() && current_user_can( 'manage_woocommerce' ) ) {

		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ) , 'ddw_wcde_settings_page_link' );

	}  // end-if is_admin() & cap check

	/** Include deprecated classes/ functions */
	require_once( WCDE_PLUGIN_DIR . '/includes/wcde-deprecated.php' );

}  // end of function ddw_wcde_init


/**
 * Helper function: Detects WooCommerce settings and returns TRUE or FALSE.
 *
 * @since  3.0.2
 *
 * @uses   get_option()
 *
 * @param  $wcde_lang_type
 *
 * @return boolean TRUE if informal translations should be loaded, FALSE if not.
 */
function ddw_wcde_woocommerce_is_informal() {
	
	/** Get the option from WooCommerce settings */
	$wcde_lang_type = 'yes' == get_option( 'woocommerce_informal_localisation_type' ) ? TRUE : FALSE;

	/** Return TRUE or FALSE based on setting */
	return $wcde_lang_type;

}  // end of function ddw_wcde_woocommerce_is_informal


add_action( 'plugins_loaded', 'ddw_wcde_setup_translation_loader', 0 );
/**
 * Translation loader - setup.
 *
 * @since 3.0.0
 *
 * @uses  WOOCOMMERCE_VERSION
 * @uses  version_compare()
 * @uses  is_admin()
 */
function ddw_wcde_setup_translation_loader() {

	/** Bail early if WooCommerce is not active */
	if ( ! defined( 'WOOCOMMERCE_VERSION' ) ) {

		return;

	}  // end-if WooCommerce check

	/** Load translations depending on WooCommerce version */
	if ( version_compare( WOOCOMMERCE_VERSION, '2.0.0' ) >= 0 ) {

		/** WooCommerce 2.0+: Include plugin part for general/ frontend translations */
		require_once( WCDE_PLUGIN_DIR . '/includes/wcde-wctranslations-general.php' );

		/** For admin area only */
		if ( is_admin() ) {

			/** WooCommerce 2.0+: Include plugin part for admin-only translations */
			require_once( WCDE_PLUGIN_DIR . '/includes/wcde-wctranslations-admin.php' );

		}  // end-if is_admin() check

	} else {

		/** WooCommerce 1.6.x: Include plugin part for translations */
		require_once( WCDE_PLUGIN_DIR . '/includes/wcde-wctranslations-old1x.php' );

	}  // end-if WooCommerce version check

}  // end of function ddw_wcde_setup_translation_loader


/**
 * Include frontend helper functions for returning other order button strings.
 *
 * @since 2.1.0
 *
 * @uses  is_admin()
 */
if ( ! is_admin() ) {

	require_once( WCDE_PLUGIN_DIR . '/includes/wcde-frontend-helpers.php' );

}  // end-if is_admin() check


/**
 * Enforce "Buttonlösung" default from language pack if no filter is active.
 *
 * @since 3.0.1
 *
 * @uses  is_admin()
 * @uses  has_filter()
 * @uses  __wcde_order_button_kaufen() Our helper function.
 */
if ( ! is_admin() && ! has_filter( 'woocommerce_order_button_text' ) ) {

	add_filter( 'woocommerce_order_button_text', '__wcde_order_button_kaufen' );

}  // end-if is_admin() & filter check


/**
 * Include WooCommerce extensions support.
 *
 * @since 3.0.4
 *
 * @uses  WCDE_LOAD_EXTENSION_SUPPORT Our helper constant.
 */
if ( defined( 'WCDE_LOAD_EXTENSION_SUPPORT' ) && WCDE_LOAD_EXTENSION_SUPPORT ) {

	require_once( WCDE_PLUGIN_DIR . '/includes/wcde-extensions-support.php' );

}  // end-if constant check


/**
 * Include Gettext helper functions for enforcing certain strings.
 *
 * @since 3.0.1
 *
 * @uses  is_admin()
 * @uses  WCDE_LOAD_GETTEXT_FILTERS Our helper constant.
 */
if ( defined( 'WCDE_LOAD_GETTEXT_FILTERS' ) && WCDE_LOAD_GETTEXT_FILTERS ) {

	require_once( WCDE_PLUGIN_DIR . '/includes/wcde-gettext-filters.php' );

}  // end-if constant check


/**
 * Returns current plugin's header data in a flexible way.
 *   Only used and loaded within '/wp-admin/'.
 *
 * @since  2.5.2
 *
 * @uses   get_plugins()
 *
 * @param  $wcde_plugin_value
 * @param  $wcde_plugin_folder
 * @param  $wcde_plugin_file
 *
 * @return string Plugin data.
 */
function ddw_wcde_plugin_get_data( $wcde_plugin_value ) {

	/** Bail early if we are not it wp-admin */
	if ( ! is_admin() ) {
		return;
	}

	/** Include WordPress plugin data */
	if ( ! function_exists( 'get_plugins' ) ) {
		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	}

	$wcde_plugin_folder = get_plugins( '/' . plugin_basename( dirname( __FILE__ ) ) );
	$wcde_plugin_file = basename( ( __FILE__ ) );

	return $wcde_plugin_folder[ $wcde_plugin_file ][ $wcde_plugin_value ];

}  // end of function ddw_wcde_plugin_get_data


/**
 * Special patch for "WooCommerce EU VAT Number" extension because of its code
 *    structure we have no other chance as loading here directly and without
 *    additional checks. Sadly, I hope the extension devs will fix that soon.
 *
 * @since 3.0.4
 *
 * @uses  WCDE_LOAD_EXTENSION_SUPPORT Our helper constant.
 * @uses  get_locale()
 * @uses  load_textdomain()
 *
 * @param $wcde_euvat_mofile
 */
if ( defined( 'WCDE_LOAD_EXTENSION_SUPPORT' ) && WCDE_LOAD_EXTENSION_SUPPORT ) {

	/** Set $mofile to plugin path */
	$wcde_euvat_mofile = WP_PLUGIN_DIR . '/woocommerce-de/wc-pomo-extensions/eu-vat-number/wc_eu_vat_number-' . get_locale() . '.mo';

	/** Finally, load the translations */
	if ( file_exists( $wcde_euvat_mofile ) ) {

		load_textdomain( 'wc_eu_vat_number', $wcde_euvat_mofile );

	}  // end-if $wcde_euvat_mofile check

}  // end-if constant check


/**
 * Special patch for "WooCommerce Menu Cart (Lite Version)"
 *    (free, via WordPress.org) extension because of its code structure we have
 *    no other chance as loading here directly and without additional checks.
 *    Sadly, I hope the extension devs will fix that soon.
 *
 * @since 3.0.4
 *
 * @uses  WCDE_LOAD_EXTENSION_SUPPORT Our helper constant.
 * @uses  get_locale()
 * @uses  load_textdomain()
 *
 * @param $wcde_menucart_mofile
 */
if ( ( defined( 'WCDE_LOAD_EXTENSION_SUPPORT' ) && WCDE_LOAD_EXTENSION_SUPPORT )
	&& in_array( 'woocommerce-menu-bar-cart/woocommerce-menu-cart.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )
) {

	/** Set $mofile to plugin path */
	$wcde_menucart_mofile = WP_PLUGIN_DIR . '/woocommerce-de/wc-pomo-extensions/menu-cart/wcmenucart-' . get_locale() . '.mo';

	/** Finally, load the translations */
	if ( file_exists( $wcde_menucart_mofile ) ) {

		load_textdomain( 'wcmenucart', $wcde_menucart_mofile );
		load_textdomain( 'default', $wcde_menucart_mofile );		// textdomain needs fix by plugin dev!

	}  // end-if $wcde_menucart_mofile check

}  // end-if constant & plugin check



/**
 * Special patch for "WooCommerce Product Gift Wrap"
 *    (free, via WordPress.org) extension because of its code structure we have
 *    no other chance as loading here directly and without additional checks.
 *    Sadly, I hope the extension devs will fix that soon.
 *
 * @since 3.0.4
 *
 * @uses  WCDE_LOAD_EXTENSION_SUPPORT Our helper constant.
 * @uses  get_locale()
 * @uses  load_textdomain()
 *
 * @param $wcde_giftwrap_mofile
 */
if ( ( defined( 'WCDE_LOAD_EXTENSION_SUPPORT' ) && WCDE_LOAD_EXTENSION_SUPPORT )
	&& in_array( 'woocommerce-product-gift-wrap/woocommerce-product-gift-wrap.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )
) {

	/** Set $mofile to plugin path */
	$wcde_giftwrap_mofile = WP_PLUGIN_DIR . '/woocommerce-de/wc-pomo-extensions/product-gift-wrap/product_gift_wrap-' . get_locale() . '.mo';

	/** Finally, load the translations */
	if ( file_exists( $wcde_giftwrap_mofile ) ) {

		load_textdomain( 'product_gift_wrap', $wcde_giftwrap_mofile );
		load_textdomain( 'woocommerce_limited_deals', $wcde_giftwrap_mofile );	// textdomain needs fix!
		load_textdomain( 'woocommerce', $wcde_giftwrap_mofile );				// textdomain needs fix!

	}  // end-if $wcde_giftwrap_mofile check

}  // end-if constant & plugin check