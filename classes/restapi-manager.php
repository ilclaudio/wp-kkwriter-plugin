<?php
/**
 * Definition of the plugin settings and of the main menu.
 *
 * @package WP_KK_Writer_Plugin
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
		// Define REST API endpoints.
		add_action( 'rest_api_init', array( $this, 'define_endpoints' ) );
	}

	// Definition of all the endpoints.
	public function define_endpoints () {
		register_rest_route(
			'wp-kkwriter/v1',
			'getBooks',
			array(
				'methods'  => WP_REST_SERVER::READABLE,
				'callback' => array( $this, 'get_books' ),
				'permission_callback' => '__return_true',
			)
		);
		register_rest_route(
			'wp-kkwriter/v1',
			'find',
			array(
				'methods'  => WP_REST_SERVER::READABLE,
				'callback' => array( $this, 'find' ),
				'permission_callback' => '__return_true',
			)
		);
		register_rest_route(
			'wp-kkwriter/v1',
			'getBook/(?P<id>\d+)',
			array(
				'methods'  => WP_REST_SERVER::READABLE,
				'callback' => array( $this, 'get_book' ),
				'permission_callback' => '__return_true',
			)
		);
	}

	/**
	 * Return all the books.
	 *
	 * @return array.
	 */
	public function get_books() {
		$results = KKW_SearchManager::get_books();
		return rest_ensure_response( $results );
	}

	/**
	 * Return a book by id.
	 *
	 * @param WP_REST_Request $request - The request.
	 * @return object.
	 */
	public function get_book( WP_REST_Request $request ) {
		$id = isset( $request['id'] ) ? $request['id'] : null;
		return rest_ensure_response( KKW_SearchManager::get_book( $id ) );
	}

	/**
	 * Find objects by: section, title, text.
	 * 
	 * @param WP_REST_Request $request - The request.
	 * @return array.
	 */
	public function find( WP_REST_Request $request ) {
		$title         = isset( $request['title'] ) ? $request['title'] : '';
		$section       = isset( $request['section'] ) ? $request['section'] : null;
		$publisher     = isset( $request['publisher'] ) ? $request['publisher'] : null;
		$search_string = isset( $request['search_string'] ) ? $request['search_string'] : '';

		$parameters = array(
			'title'        => $title,
			'section'      => $section,
			'publisher'    => $publisher,
			'search_string' => $search_string,
		);
		return rest_ensure_response( KKW_SearchManager::find( $parameters ) );
	}

}
