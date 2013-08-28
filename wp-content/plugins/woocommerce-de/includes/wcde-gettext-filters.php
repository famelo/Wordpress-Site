<?php
/**
 * Helper functions for the Gettext strings - usas 'gettext' filter.
 *
 * @package    WooCommerce German (de_DE)
 * @subpackage Gettext
 * @author     David Decker - DECKERWEB
 * @copyright  Copyright (c) 2012-2013, David Decker - DECKERWEB
 * @license    http://www.opensource.org/licenses/gpl-license.php GPL-2.0+
 * @link       http://genesisthemes.de/en/wp-plugins/woocommerce-de/
 * @link       http://deckerweb.de/twitter
 *
 * @since      3.0.1
 */

/**
 * Exit if accessed directly
 *
 * @since 3.0.1
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'Sorry, you are not allowed to access this file directly.' );
}


add_filter( 'gettext', 'ddw_wcde_gettext_read_accept_string', 10, 4 );
/**
 * Search for 'I have read and accept the' Gettext string and add changed text.
 *
 * @since  3.0.1
 *
 * @uses   get_translations_for_domain()
 * @uses   Translations::translate()
 *
 * @param  string $translation
 * @param  string $text
 * @param  string $domain
 * @param  string $translations
 * @param  $wcde_read_accept_string
 *
 * @return string For 'I have read and accept the' string
 */
function ddw_wcde_gettext_read_accept_string( $translation, $text, $domain ) {

	/** Get only WooCommerce translation strings */
	$translations = get_translations_for_domain( 'woocommerce' );

	/** Our new string translation, filterable */
	$wcde_read_accept_string = apply_filters( 'wcde_filter_gettext_read_accept_string', 'Bedingungen gelesen und zur Kenntnis genommen:' );

	/** Display Submit string */
	if ( $text == 'I have read and accept the' || $text == 'I accept the' ) {

		return $translations->translate( esc_html( $wcde_read_accept_string ) );

	}  // end-if gettext check

	/** Finally output the string translation */
	return $translation;

}  // end of function ddw_wcde_gettext_read_accept_string


add_filter( 'gettext', 'ddw_wcde_gettext_terms_string', 10, 4 );
/**
 * Search for 'terms &amp; conditions' Gettext string and add changed text.
 *
 * @since  3.0.1
 *
 * @uses   get_translations_for_domain()
 * @uses   Translations::translate()
 *
 * @param  string $translation
 * @param  string $text
 * @param  string $domain
 * @param  string $translations
 * @param  $wcde_terms_string
 *
 * @return string For 'terms &amp; conditions' string
 */
function ddw_wcde_gettext_terms_string( $translation, $text, $domain ) {

	/** Get only WooCommerce translation strings */
	$translations = get_translations_for_domain( 'woocommerce' );

	/** Our new string translation, filterable */
	$wcde_terms_string = apply_filters( 'wcde_filter_gettext_terms_string', 'Liefer- und Zahlungsbedingungen (AGB)' );

	/** Display Submit string */
	if ( $text == 'terms &amp; conditions' ) {

		return $translations->translate( esc_html( $wcde_terms_string ) );

	}  // end-if gettext check

	/** Finally output the string translation */
	return $translation;

}  // end of function ddw_wcde_gettext_terms_string