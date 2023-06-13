<?php
/**
 * Definition of the plugin settings and of the main menu.
 *
 * @package @package WP_KK_Writer_Plugin
 */

require_once( 'search-manager.php' );

/**
 * The Settings manager.
 */
class KKW_RestApiManager {

	/**
	 * Setup the REST end points.
	 *
	 * @return void
	 */
	public function setup() {

		register_rest_route(
			'wp-kkwriter/v1',
			'getBooks',
			array(
				'methods'  => WP_REST_SERVER::READABLE,
				'callback' => array( $this, 'get_books' ),
			)
		);

		register_rest_route(
			'wp-kkwriter/v1',
			'find',
			array(
				'methods'  => WP_REST_SERVER::READABLE,
				'callback' => array( $this, 'find' ),
			)
		);

		register_rest_route(
			'wp-kkwriter/v1',
			'getBook',
			array(
				'methods'  => WP_REST_SERVER::READABLE,
				'callback' => array( $this, 'get_book' ),
			)
		);
	}

	/**
	 * Return the books.
	 *
	 * @return void
	 */
	public function get_books() {
		return 'get_books';
	}

	/**
	 * Return the book.
	 *
	 * @return void
	 */
	public function get_book() {
		return 'get_book';
	}

	/**
	 * Find objects.
	 *
	 * @return void
	 */
	public function find() {
		return 'find';
	}

}
