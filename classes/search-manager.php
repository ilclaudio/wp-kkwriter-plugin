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
		$books = [ 'uno', 'due', 'tre' ];
		return wp_json_encode( $books );
	}

}


