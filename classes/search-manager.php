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
		$results = new WP_Query(
			array(
				'post_type' => KKW_POST_TYPES[ ID_PT_BOOK ]['name'],
			),
		);
		return $results->get_posts();
	}

	public static function get_book() {
		$book = 'uno';
		return $book;
	}

	public static function find() {
		$results = array( 'uno', 'due', 'tre' );
		return $results;
	}

}
