<?php

if ( ! class_exists( 'BookManager' ) ) {
	include_once 'book-manager.php';
}

/**
 * The manager that builds the tool and configures Wordpress.
 */
class PluginManager {

	/**
	 * The static instance of the LabManager.
	 *
	 * @var object
	 */
	protected static $instance = null;


	/**
	 * Create the instance of the manager.
	 *
	 * @return void
	 */
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Used to install and configure the plugin.
	 *
	 * @return void
	 */
	public function plugin_setup() {

		// Setup the book post type.
		$bm = new Book_Manager();
		$bm->setup();

		// // Setup di Polylang.
		// $polylang = new Polylang_Manager();
		// $polylang->setup();

		// // Setup del post type News.
		// $ctprog = new News_Manager();
		// $ctprog->setup();

		// // Setup del post type Eventi.
		// $ctprog = new Event_Manager();
		// $ctprog->setup();

		// // Setup del post.
		// $ctprog = new Post_Manager();
		// $ctprog->setup();

	}
}
