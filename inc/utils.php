<?php
/**
 * Utility helpers for the plugin.
 *
 * @package WP_KK_Writer_Plugin
 */

if ( ! function_exists( 'kkw_generate_slug' ) ) {
	/**
	 * Generate a taxonomy-safe slug and enforce max length.
	 *
	 * @param string $text Source text.
	 * @return string
	 */
	function kkw_generate_slug( $text ) {
		$new_text = sanitize_title( $text );
		$new_text = substr( $new_text, 0, KKW_MAX_TAXONOMY_LENGTH );
		return $new_text;
	}
}
