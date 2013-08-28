<?php
/**
 * Extensions support: include plugin parts with translations loaders.
 *
 * @package    WooCommerce German (de_DE)
 * @subpackage Extensions
 * @author     David Decker - DECKERWEB
 * @copyright  Copyright (c) 2012-2013, David Decker - DECKERWEB
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


add_action( 'plugins_loaded', 'ddw_wcde_extensions_support_setup', 0 );
//add_action( 'init', 'ddw_wcde_extensions_support_setup', 10 );
/**
 * Include plugin parts with certain extensions support. Only loaded if needed.
 *
 * @since 3.0.4
 */
function ddw_wcde_extensions_support_setup() {

	/** Table Rate Shipping (premium, via WooThemes) */
	if ( defined( 'TABLE_RATE_SHIPPING_VERSION' ) ) {

		require_once( WCDE_EXTENSIONS_DIR . '/wcde_table-rate-shipping.php' );

	}  // end-if constant check


	/** Table Rate Shipping - *CodeCanyon Marketplace Version* (premium, via CodeCanyon Marketplace) */
	if ( function_exists( 'woocommerce_table_rate_shipping_init' ) ) {

		require_once( WCDE_EXTENSIONS_DIR . '/wcde_table-rate-shipping-cc.php' );

	}  // end-if function check


	/** Shipping Per Product (premium, via WooThemes) */
	if ( defined( 'PER_PRODUCT_SHIPPING_VERSION' ) ) {

		require_once( WCDE_EXTENSIONS_DIR . '/wcde_shipping-per-product.php' );

	}  // end-if constant check


	/** Shipping Details (premium, via CodeCanyon Marketplace) */
	if ( class_exists( 'wooshippinginfo' ) ) {

		require_once( WCDE_EXTENSIONS_DIR . '/wcde_shipping-details.php' );

	}  // end-if class check


	/** Subscribe To Newsletter (premium, via WooThemes) */
	if ( class_exists( 'WC_Subscribe_To_Newsletter' ) ) {

		require_once( WCDE_EXTENSIONS_DIR . '/wcde_subscribe-to-newsletter.php' );

	}  // end-if class check


	/** (WooCommerce) Brands (premium, via WooThemes) */
	if ( class_exists( 'WC_Brands' ) ) {

		require_once( WCDE_EXTENSIONS_DIR . '/wcde_brands.php' );

	}  // end-if class check


	/** (WooCommerce) Branding (premium, via WooThemes) */
	if ( function_exists( 'activate_woocommerce_branding' ) ) {

		require_once( WCDE_EXTENSIONS_DIR . '/wcde_branding.php' );

	}  // end-if function check


	/** (WooCommerce) PIP - Print Invoice/Packing List (premium, via WooThemes) */
	if ( function_exists( 'woocommerce_pip_activate' ) ) {

		require_once( WCDE_EXTENSIONS_DIR . '/wcde_pip.php' );

	}  // end-if function check


	/** (WooCommerce) Product CSV Import Suite (premium, via WooThemes) */
	if ( is_admin()
		&& in_array( 'woocommerce-product-csv-import-suite/product-csv-import.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )
	) {

		require_once( WCDE_EXTENSIONS_DIR . '/wcde_product-csv-import-suite.php' );

	}  // end-if is_admin() & in_array() check


	/** Google Wallet Gateway (premium, via WooThemes) */
	if ( class_exists( 'WC_Gateway_Google_Wallet' ) ) {

		require_once( WCDE_EXTENSIONS_DIR . '/wcde_google-wallet.php' );

	}  // end-if class check


	/** Klarna Gateway (premium, via WooThemes) */
	if ( class_exists( 'WC_Gateway_Klarna' ) ) {

		require_once( WCDE_EXTENSIONS_DIR . '/wcde_klarna.php' );

	}  // end-if class check


	/** Skrill Gateway (premium, via WooThemes) */
	if ( function_exists( 'woocommerce_skrill_init' ) ) {

		require_once( WCDE_EXTENSIONS_DIR . '/wcde_skrill.php' );

	}  // end-if function check


	/** Ogone Gateway (premium, via WooThemes) */
	if ( function_exists( 'init_ogone' ) ) {

		require_once( WCDE_EXTENSIONS_DIR . '/wcde_ogone.php' );

	}  // end-if function check


	/** PayPal Express Gateway (premium, via WooThemes) */
	if ( function_exists( 'woocommerce_paypal_express_init' ) ) {

		require_once( WCDE_EXTENSIONS_DIR . '/wcde_paypal-express.php' );

	}  // end-if function check


	/** PayPal Digital Goods Gateway (premium, via WooThemes) */
	if ( function_exists( 'init_paypal_digital_goods_gateway' ) ) {

		require_once( WCDE_EXTENSIONS_DIR . '/wcde_paypal-digital-goods.php' );

	}  // end-if function check


	/** QR Code Generator (premium, via WooThemes) */
	if ( is_admin() && function_exists( 'qr_load' ) ) {

		require_once( WCDE_EXTENSIONS_DIR . '/wcde_qr-code-generator.php' );

	}  // end-if is_admin() & function check


	/** (WooCommerce) All In One SEO Pack (free, via WordPress.org) */
	if ( is_admin() && function_exists( 'woo_ai_admin_init' ) ) {

		require_once( WCDE_EXTENSIONS_DIR . '/wcde_wc-all-in-one-seo-pack.php' );

	}  // end-if is_admin() & function check


	/** (WooCommerce) Gravity Forms Product Add-Ons (premium, via WooThemes) */
	if ( class_exists( 'woocommerce_gravityforms' ) ) {

		require_once( WCDE_EXTENSIONS_DIR . '/wcde_gravityforms-addons.php' );

	}  // end-if class check


	/** (WooCommerce) Custom Availability (premium, via CodeCanyon Marketplace) */
	if ( is_admin() && class_exists( 'WC_Custom_Availability' ) ) {

		require_once( WCDE_EXTENSIONS_DIR . '/wcde_custom-availability.php' );

	}  // end-if is_admin() & class check


	/** (WooCommerce) Region Filter (premium, via CodeCanyon Marketplace) */
	if ( defined( 'WOOCOMMERCE_REGION_FILTER_VERSION' ) ) {

		require_once( WCDE_EXTENSIONS_DIR . '/wcde_region-filter.php' );

	}  // end-if constant check


	/** Dvin Woocommerce Wishlist (premium, via CodeCanyon Marketplace) */
	if ( defined( 'DVIN_PLUGIN_WEBURL' ) ) {

		require_once( WCDE_EXTENSIONS_DIR . '/wcde_dvin-wishlist.php' );

	}  // end-if constant check


	/** (WooCommerce) Cart Based Shipping (premium, via CodeCanyon Marketplace) */
	if ( class_exists( 'WC_Cart_Based_Shipping' ) ) {

		require_once( WCDE_EXTENSIONS_DIR . '/wcde_cart-based-shipping.php' );

	}  // end-if class check


	/** (WooCommerce) Bundle Rate Shipping (premium, via CodeCanyon Marketplace) */
	if ( function_exists( 'woocommerce_bundle_rate_shipping_load' ) ) {

		require_once( WCDE_EXTENSIONS_DIR . '/wcde_bundle-rate-shipping.php' );

	}  // end-if function check


	/** (WooCommerce) Paymill Gateway (premium, via CodeCanyon Marketplace) */
	if ( defined( 'WC_PAYMILL_VERSION' ) ) {

		require_once( WCDE_EXTENSIONS_DIR . '/wcde_paymill-cc.php' );

	}  // end-if constant check


	/** (WooCommerce) Video Product Tab (free, via WordPress.org) */
	if ( function_exists( 'woo_video_tab_min_required' ) ) {

		require_once( WCDE_EXTENSIONS_DIR . '/wcde_video-product-tab.php' );

	}  // end-if function check


	/** (WooCommerce) Photos Product Tab (free, via WordPress.org) */
	if ( function_exists( 'woo_photos_tab_min_required' ) ) {

		require_once( WCDE_EXTENSIONS_DIR . '/wcde_photos-product-tab.php' );

	}  // end-if function check


	/** (WooCommerce) Payment Discounts (free, via WordPress.org) */
	if ( is_admin() && class_exists( 'WC_Payment_Discounts' ) ) {

		require_once( WCDE_EXTENSIONS_DIR . '/wcde_payment-discounts.php' );

	}  // end-if is_admin() & class check


	/** (WooCommerce) Custom Coupon Message (free, via WordPress.org) */
	if ( is_admin() && function_exists( 'wccm_meta_boxes_setup' ) ) {

		require_once( WCDE_EXTENSIONS_DIR . '/wcde_custom-coupon-message.php' );

	}  // end-if is_admin() & function check


	/** (WooCommerce) Email Validation (free, via WordPress.org) */
	if ( ! is_admin()
		&& in_array( 'woocommerce-email-validation/woocommerce-email-validation.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) )
	) {

		require_once( WCDE_EXTENSIONS_DIR . '/wcde_email-validation.php' );

	}  // end-if !is_admin() & in_array() check


	/** Pushover for WooCommerce (free, via WordPress.org) */
	if ( is_admin() && defined( 'WC_PUSHOVER_DIR' ) ) {

		require_once( WCDE_EXTENSIONS_DIR . '/wcde_pushover-integration.php' );

	}  // end-if is_admin() & constant check


	/** AWD Weight/Country Shipping (free, via WordPress.org) */
	if ( function_exists( 'init_awd_shipping' ) ) {

		require_once( WCDE_EXTENSIONS_DIR . '/wcde_awd-weightcountry-shipping.php' );

	}  // end-if function check


	/** 404 Silent Salesman (free, via WordPress.org) */
	if ( function_exists( 'silentsalesman_404_init' ) ) {

		require_once( WCDE_EXTENSIONS_DIR . '/wcde_404-silent-salesman.php' );

	}  // end-if function check


	/** Woo Product Importer (free, via GitHub.com) */
	if ( is_admin() && class_exists( 'WebPres_Woo_Product_Importer' ) ) {

		require_once( WCDE_EXTENSIONS_DIR . '/wcde_woo-product-importer.php' );

	}  // end-if is_admin() & class check

}  // end of function ddw_wcde_extensions_support_setup