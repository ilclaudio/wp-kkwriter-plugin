<?php

if ( ! function_exists( 'kkw_generate_slug' ) ) {
	function kkw_generate_slug( $text ) {
		$new_text = sanitize_title( $text );
		$new_text = substr( $new_text, 0, KKW_MAX_TAXONOMY_LENGTH );
		return $new_text;
	}
}
