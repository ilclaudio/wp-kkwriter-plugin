<?php
/**
 * Definition of the Search Manager.
 *
 * @package @package WP_KK_Writer_Plugin
 */


/**
 * The Settings manager.
 */
class KKW_SearchManager {

	public static function get_books() {
		$books = array( 'uno', 'due', 'tre' );
		return wp_json_encode( $books );
	}

	public static function get_book() {
		$book = 'uno';
		return wp_json_encode( $book );
	}

	public static function find() {
		$results = array( 'uno', 'due', 'tre' );
		return wp_json_encode( $results );
	}

}
