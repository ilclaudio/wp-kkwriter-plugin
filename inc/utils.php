<?php

if ( ! function_exists( 'kkw_register_single_template' ) ) {
	/**
	 * Return the template of the detail page of the post type with these rules:
	 *  - if $template_name exists in th theme folder, use it,
	 *  - if $template_name exists i in the plugin folder, use it.
	 *  - otherwise use the template in $single.
	 *
	 * @param [String] $pt - The post type.
	 * @param [String] $single - The path of the template found.
	 * @return [String] - The path of the template to use.
	 */
	function kkw_register_single_template( $pt, $single ) {
		global $post;
		$template_name = KKW_POST_TYPES[ $pt ]['single-page'];
		$template_path = KKW_PLUGIN_PATH . '/templates/single/' . $template_name;
		$theme_template = locate_template( array( $template_name ) );
		if ( KKW_POST_TYPES[ $pt ]['name'] === $post->post_type ) {
			if ( $theme_template ) {
				return $theme_template;
			} else if ( file_exists( $template_path ) ) {
				return $template_path;
			}
		}
		return $single;
	}
}

if ( ! function_exists( 'kkw_register_archive_template' ) ) {
	/**
	 * Return the template of the detail page of the post type with these rules:
	 *  - if $template_name exists in th theme folder, use it,
	 *  - if $template_name exists i in the plugin folder, use it.
	 *  - otherwise use the template in $archive.
	 *
	 * @param [String] $pt - The post type.
	 * @param [String] $archive - The path of the template found.
	 * @return [String] - The path of the template to use.
	 */
	function kkw_register_archive_template( $pt, $archive ) {
		global $post;
		$template_name = KKW_POST_TYPES[ $pt ]['archive-page'];
		$template_path = KKW_PLUGIN_PATH . '/templates/archive/' . $template_name;
		$theme_template = locate_template( array( $template_name ) );
		if ( is_archive() && ( KKW_POST_TYPES[ $pt ]['name'] === $post->post_type ) ) {
			if ( $theme_template ) {
				return $theme_template;
			} else if ( file_exists( $template_path ) ) {
				return $template_path;
			}
		}
		return $archive;

	}
}