<?php
/**
 * Helper functions for the admin - plugin links.
 *
 * @package    WooCommerce German (de_DE)
 * @subpackage Admin
 * @author     David Decker - DECKERWEB
 * @copyright  Copyright (c) 2012-2013, David Decker - DECKERWEB
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL-2.0+
 * @link       http://genesisthemes.de/en/wp-plugins/woocommerce-de/
 * @link       http://deckerweb.de/twitter
 *
 * @since      1.0.0
 */

/**
 * Exit if accessed directly
 *
 * @since 3.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Sorry, you are not allowed to access this file directly.' );
}


/**
 * Setting internal plugin helper links constants
 *
 * @since 2.2.0
 *
 * @uses  get_locale()
 */
define( 'WCDE_URL_TRANSLATE',		'http://translate.wpautobahn.com/projects/wordpress-plugins-deckerweb/woocommerce-de' );
define( 'WCDE_URL_WPORG_FAQ',		'http://wordpress.org/extend/plugins/woocommerce-de/faq/' );
define( 'WCDE_URL_WPORG_FORUM',		'http://wordpress.org/support/plugin/woocommerce-de' );
define( 'WCDE_URL_WPORG_PROFILE',	'http://profiles.wordpress.org/daveshine/' );
define( 'WCDE_URL_SNIPPETS',		'https://gist.github.com/deckerweb/5098515' );
define( 'WCDE_PLUGIN_LICENSE', 		'GPL-2.0+' );
if ( get_locale() == 'de_DE' || get_locale() == 'de_AT' || get_locale() == 'de_CH' || get_locale() == 'de_LU' ) {
	define( 'WCDE_URL_DONATE', 		'http://deckerweb.de/sprachdateien/spenden/' );
	define( 'WCDE_URL_PLUGIN',		'http://genesisthemes.de/plugins/woocommerce-de/' );
	define( 'WCDE_IS_GERMAN', 		TRUE );
} else {
	define( 'WCDE_URL_DONATE', 		'http://genesisthemes.de/en/donate/' );
	define( 'WCDE_URL_PLUGIN',		'http://genesisthemes.de/en/wp-plugins/woocommerce-de/' );
	define( 'WCDE_IS_GERMAN', 		FALSE );
}


/**
 * Add "Settings" link to plugin page
 *
 * @since  2.0.0
 *
 * @param  $wcde_links
 * @param  $wcde_settings_link
 *
 * @return strings Admin settings pages link.
 */
function ddw_wcde_settings_page_link( $wcde_links ) {

	/** WooCommerce Admin link */
	$wcde_settings_link = sprintf(
		'<a href="%s" title="%s">%s</a>',
		admin_url( 'admin.php?page=woocommerce_settings' ),
		__( 'Go to the WooCommerce settings page', 'woocommerce-german' ),
		__( 'WooCommerce Settings', 'woocommerce-german' )
	);

	/** Set the order of the links */
	array_unshift( $wcde_links, $wcde_settings_link );

	/** Display plugin settings links */
	return apply_filters( 'wcde_filter_settings_page_link', $wcde_links );

}  // end of function ddw_wcde_settings_page_link


add_filter( 'plugin_row_meta', 'ddw_wcde_plugin_links', 10, 2 );
/**
 * Add various support links to plugin page
 *
 * @since  1.0.0
 *
 * @param  $wcde_links
 * @param  $wcde_file
 *
 * @return strings Plugin links.
 */
function ddw_wcde_plugin_links( $wcde_links, $wcde_file ) {

	/** Capability check */
	if ( ! current_user_can( 'install_plugins' ) ) {

		return $wcde_links;

	}  // end-if cap check

	/** List additional links only for this plugin */
	if ( $wcde_file == WCDE_PLUGIN_BASEDIR . '/woocommerce-de.php' ) {

		$wcde_links[] = '<a href="' . esc_url( WCDE_URL_WPORG_FAQ ) . '" target="_new" title="' . __( 'FAQ', 'woocommerce-german' ) . '">' . __( 'FAQ', 'woocommerce-german' ) . '</a>';

		$wcde_links[] = '<a href="' . esc_url( WCDE_URL_WPORG_FORUM ) . '" target="_new" title="' . __( 'Support', 'woocommerce-german' ) . '">' . __( 'Support', 'woocommerce-german' ) . '</a>';

		$wcde_links[] = '<a href="' . esc_url( WCDE_URL_SNIPPETS ) . '" target="_new" title="' . __( 'Code Snippets for Customization', 'woocommerce-german' ) . '">' . __( 'Code Snippets', 'woocommerce-german' ) . '</a>';

		$wcde_links[] = '<a href="' . esc_url( WCDE_URL_TRANSLATE ) . '" target="_new" title="' . __( 'Translations', 'woocommerce-german' ) . '">' . __( 'Translations', 'woocommerce-german' ) . '</a>';

		$wcde_links[] = '<a href="' . esc_url( WCDE_URL_DONATE ) . '" target="_new" title="' . __( 'Donate', 'woocommerce-german' ) . '"><strong>' . __( 'Donate', 'woocommerce-german' ) . '</strong></a>';

	}  // end-if plugin check

	/** Output the links */
	return apply_filters( 'wcde_filter_plugin_links', $wcde_links );

}  // end of function ddw_wcde_plugin_links


add_action( 'load-woocommerce_page_woocommerce_settings', 'ddw_wcde_woocommerce_help_tab', 5 );
add_action( 'load-toplevel_page_woocommerce', 'ddw_wcde_woocommerce_help_tab', 5 );					// deprecated!
add_action( 'load-woocommerce_page_woocommerce_status', 'ddw_wcde_woocommerce_help_tab', 5 );
add_action( 'load-woocommerce_page_woocommerce_reports', 'ddw_wcde_woocommerce_help_tab', 5 );
/**
 * Create and display plugin help tab.
 *
 * @since  2.2.0
 *
 * @uses   get_current_screen()
 * @uses   WP_Screen::add_help_tab()
 * @uses   WP_Screen::set_help_sidebar()
 * @uses   ddw_wcde_woocommerce_help_sidebar_content()
 *
 * @global mixed $pagenow, $wcde_woocommerce_screen
 */
function ddw_wcde_woocommerce_help_tab() {

	global $pagenow, $wcde_woocommerce_screen;

	$wcde_woocommerce_screen = get_current_screen();

	/** Display help tabs only for WordPress 3.3 or higher */
	if( ! class_exists( 'WP_Screen' ) || ! $wcde_woocommerce_screen ) {
		return;
	}

	/** Add the help tab */
	$wcde_woocommerce_screen->add_help_tab( array(
		'id'       => 'wcde-woocommerce-help',
		'title'    => __( 'WooCommerce German (de_DE)', 'woocommerce-german' ),
		'callback' => apply_filters( 'wcde_filter_help_tab_content', 'ddw_wcde_woocommerce_help_content' ),
	) );

	/** Add help sidebar */
	if ( $wcde_woocommerce_screen->id == 'woocommerce_page_woocommerce_settings'
		|| $wcde_woocommerce_screen->id == 'woocommerce_page_woocommerce_status'
	) {

		$wcde_woocommerce_screen->set_help_sidebar( ddw_wcde_plugin_help_sidebar_content() );

	}  // end-if page hook check

}  // end of function ddw_wcde_woocommerce_help_tab


/**
 * Create and display plugin help tab content.
 *
 * @since  2.2.0
 *
 * @uses   ddw_wcde_plugin_get_data()
 * @uses   WCDE_IS_GERMAN
 * @uses   ddw_wcde_plugin_help_content_footer()
 *
 * @param  string 	$wcde_legal_style
 *
 * @global mixed $wcde_woocommerce_screen, $pagenow
 */
function ddw_wcde_woocommerce_help_content() {

	echo '<h3>' . __( 'Plugin', 'woocommerce-german' ) . ': ' . __( 'WooCommerce German (de_DE)', 'woocommerce-german' ) . ' <small>v' . esc_attr( ddw_wcde_plugin_get_data( 'Version' ) ) . '</small></h3>' .		
		'<ul>';

		/** FAQ/Legal info for German users */
		if ( WCDE_IS_GERMAN ) {

			$wcde_legal_style = 'style="color: #cc0000;"';

			echo '<li ' . $wcde_legal_style . '"><em><strong>Haftungsausschluss:</strong> Durch den Einsatz dieses Plugins und der damit angebotenen Sprachdateien entstehen KEINE Garantien für eine korrekte Funktionsweise oder etwaige Verpflichtungen durch den Übersetzer bzw. Plugin-Anbieter! — Alle Angaben ohne Gewähr. Änderungen und Irrtümer ausdrücklich vorbehalten. Verwendung des Plugins inkl. Sprachdateien geschieht ausschliesslich auf eigene Verantwortung!</em></li>' .
				'<li><strong ' . $wcde_legal_style . '><em>Hinweis 1:</em></strong> Dieses Plugin ist ein reines Sprach-/ Übersetzungs-Plugin, es hat nichts mit "Rechtssicherheit" zu tun. Für alle rechtlichen Fragen ist der Shop-Betreiber zuständig, nicht die "Sprachdatei"!</li>' .
				'<li><strong ' . $wcde_legal_style . '><em>Hinweis 2:</em></strong> Eine RechtsBERATUNG zu diesem Themenkomplex kann NUR durch einen ANWALT erfolgen (am besten auf Online-Recht spezilisierte Anwälte!). Bitte auch Infos in den einschlägigen Blogs für Shopbetreiber, der (Fach-) Presse sowie von den Industrie- und Handelskammern beachten. -- Ich als Übersetzer und Plugin-Entwickler kann via Sprachdatei KEINE "Rechtssicherheit" garantieren, dies können nur Shop-Betreiber selbst, mit anwaltlicher Unterstützung!</li>' .
				'<li><strong ' . $wcde_legal_style . '><em>Hinweis 3:</em></strong> JA, die sogenannte "Button-Lösung" wird seit Version 2.1.0 dieses Plugins und Sprachdatei-Version 1.5.5 (aka WooCommerce 1.5.5+) unterstützt. &mdash; Weitere Informationen bei den <a href="' . esc_url( WCDE_URL_WPORG_FAQ ) . '" target="_new" title="Häufige Fragen (FAQ)"><em>Häufigen Fragen (FAQ)</em></a></li>';

		}  // end if isGerman check

		echo '<li><em>' . __( 'Other, recommended WooCommerce plugins', 'woocommerce-german' ) . '</em>:';

			/** Optional: recommended plugins */
			if ( WCDE_IS_GERMAN && ! defined( 'WCABA_PLUGIN_BASEDIR' ) ) {

				echo '<br />&raquo; <a href="http://wordpress.org/extend/plugins/woocommerce-admin-bar-addition/" target="_new" title="WooCommerce Admin Bar Addition">WooCommerce Admin Bar Addition</a> &mdash; Dieses Plugin fügt der WordPress Wergzeugleiste bzw. Adminbar nützliche Administratorenlinks und Ressourcen für das WooCommerce Shop-Plugin hinzu.';

			}  // end-if plugin check

			if ( WCDE_IS_GERMAN && ! class_exists( 'WooCommerce_Delivery_Notes' ) ) {

				echo '<br />&raquo; <a href="http://wordpress.org/extend/plugins/woocommerce-delivery-notes/" target="_new" title="WooCommerce Print Invoices & Delivery Notes">WooCommerce Print Invoices & Delivery Notes</a> &mdash; Dieses Plugin stellt einfache Rechnungen und Lieferscheine für das WooCommerce Shop Plugin bereit. Es können dabei auch Firmen-/ Shop-Infos ebenso wie persönliche Anmerkungen oder Bedingungen/ Widerrufsbelehrungen zu den Druckseiten hinzugefügt werden.';

			}  // end-if plugin check

		echo '<br />&raquo; <a href="http://ddwb.me/wccc" target="_new" title="' . __( 'More premium plugins/extensions at CodeCanyon Marketplace', 'woocommerce-german' ) . ' &hellip;">' . __( 'More premium plugins/extensions at CodeCanyon Marketplace', 'woocommerce-german' ) . ' &hellip;</a>' .
		'<br />&raquo; <a href="http://wordpress.org/extend/plugins/search.php?q=woocommerce" target="_new" title="' . __( 'More free plugins/extensions at WordPress.org', 'woocommerce-german' ) . ' &hellip;">' . __( 'More free plugins/extensions at WordPress.org', 'woocommerce-german' ) . ' &hellip;</a></li>' .
		'</ul>';

		echo ddw_wcde_plugin_help_content_footer();

}  // end of function ddw_wcde_woocommerce_help_tab


add_action( 'admin_init', 'ddw_wcde_woocommerce_cpt_help_tabs' );
/**
 * Display plugin help tab on various WooCommerce Post Type admin pages.
 *
 * @since  2.5.2
 *
 * @global mixed $pagenow, $typenow
 */
function ddw_wcde_woocommerce_cpt_help_tabs() {

	global $pagenow, $typenow;

	/** Check for WordPress Post Types Bases */
	if ( $pagenow == 'post-new.php' || $pagenow == 'post.php' || $pagenow == 'edit.php' ) {

		/** Check for WooCommerce Post Types */
		if ( in_array( $typenow, array( 'product', 'shop_coupon', 'shop_order' ) ) ) {

			add_action( 'load-' . $pagenow, 'ddw_wcde_woocommerce_help_tab', 5 );

		}  // end-if WC check

	}  // end-if base check

}  // end of function ddw_wcde_woocommerce_cpt_help_tabs


/**
 * Create and display plugin help tab content for "footer info" part.
 *
 * @since  3.0.1
 *
 * @uses   ddw_wcde_plugin_get_data()
 *
 * @param  string 	$wcde_legal_style
 * @param  string 	$wcde_footer_content
 *
 * @return string HTML help content footer info.
 */
function ddw_wcde_plugin_help_content_footer() {

	$wcde_legal_style = 'style="color: #cc0000;"';

	$wcde_footer_content = '<p><strong>' . __( 'Important plugin links:', 'woocommerce-german' ) . '</strong>' . 
		'<br /><a href="' . esc_url( WCDE_URL_PLUGIN ) . '" target="_new" title="' . __( 'Plugin Website', 'woocommerce-german' ) . '">' . __( 'Plugin Website', 'woocommerce-german' ) . '</a> | <a href="' . esc_url( WCDE_URL_WPORG_FAQ ) . '" target="_new" title="' . __( 'FAQ', 'woocommerce-german' ) . '">' . __( 'FAQ', 'woocommerce-german' ) . '</a> | <a href="' . esc_url( WCDE_URL_WPORG_FORUM ) . '" target="_new" title="' . __( 'Support', 'woocommerce-german' ) . '">' . __( 'Support', 'woocommerce-german' ) . '</a> | <a href="' . esc_url( WCDE_URL_SNIPPETS ) . '" target="_new" title="' . __( 'Code Snippets for Customization', 'woocommerce-german' ) . '">' . __( 'Code Snippets', 'woocommerce-german' ) . '</a> | <a href="' . esc_url( WCDE_URL_TRANSLATE ) . '" target="_new" title="' . __( 'Translations', 'woocommerce-german' ) . '">' . __( 'Translations', 'woocommerce-german' ) . '</a> | <a href="' . esc_url( WCDE_URL_DONATE ) . '" target="_new" title="' . __( 'Donate', 'woocommerce-german' ) . '"><strong ' . $wcde_legal_style . '>' . __( 'Donate', 'woocommerce-german' ) . '</strong></a></p>' .
		'<p><a href="http://www.opensource.org/licenses/gpl-license.php" target="_new" title="' . esc_attr( WCDE_PLUGIN_LICENSE ). '">' . esc_attr( WCDE_PLUGIN_LICENSE ). '</a> &copy; 2012-' . date( 'Y' ) . ' <a href="' . esc_url( ddw_wcde_plugin_get_data( 'AuthorURI' ) ) . '" target="_new" title="' . esc_attr__( ddw_wcde_plugin_get_data( 'Author' ) ) . '">' . esc_attr__( ddw_wcde_plugin_get_data( 'Author' ) ) . '</a></p>';

	return apply_filters( 'wcde_filter_help_footer_content', $wcde_footer_content );

}  // end of function ddw_wcde_plugin_help_content_footer


/**
 * Helper function for returning the Help Sidebar content.
 *
 * @since  3.0.0
 *
 * @uses   ddw_wcde_plugin_get_data()
 *
 * @param  string 	$wcde_help_sidebar
 *
 * @return string/HTML of help sidebar content.
 */
function ddw_wcde_plugin_help_sidebar_content() {

	$wcde_help_sidebar = '<p><strong>' . __( 'More about the plugin author', 'woocommerce-german' ) . '</strong></p>' .
			'<p>' . __( 'Social:', 'woocommerce-german' ) . '<br /><a href="http://twitter.com/deckerweb" target="_blank" title="@ Twitter">Twitter</a> | <a href="http://www.facebook.com/deckerweb.service" target="_blank" title="@ Facebook">Facebook</a> | <a href="http://deckerweb.de/gplus" target="_blank" title="@ Google+">Google+</a> | <a href="' . esc_url( ddw_wcde_plugin_get_data( 'AuthorURI' ) ) . '" target="_blank" title="@ deckerweb.de">deckerweb</a></p>' .
			'<p><a href="' . esc_url( WCDE_URL_WPORG_PROFILE ) . '" target="_blank" title="@ WordPress.org">@ WordPress.org</a></p>';

	return apply_filters( 'wcde_filter_help_sidebar_content', $wcde_help_sidebar );

}  // end of function ddw_wcde_plugin_help_sidebar_content