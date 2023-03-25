<?php

if ( ! class_exists( 'ConfigurationManager' ) ) {
	include_once 'configuration-manager.php';
}
if ( ! class_exists( 'MultilangManager' ) ) {
	include_once 'multilang-manager.php';
}
if ( ! class_exists( 'SectionManager' ) ) {
	include_once 'sections-manager.php';
}
if ( ! class_exists( 'BookManager' ) ) {
	include_once 'books-manager.php';
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
	 * Used to install and configure the plugin.
	 *
	 * @return void
	 */
	public function plugin_setup() {

		// Setup of the Configuration manager.
		$polylang = new Configurations_Manager();
		$polylang->setup();

		// Setup of the Multilang features.
		$polylang = new Multilang_Manager();
		$polylang->setup();

		// Setup of the sections.
		$secm = new Sections_Manager();
		$secm->setup();

		// Setup the book post type.
		$bm = new Books_Manager();
		$bm->setup();



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
