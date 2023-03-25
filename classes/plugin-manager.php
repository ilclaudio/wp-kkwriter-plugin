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
if ( ! class_exists( 'ReviewsManager' ) ) {
	include_once 'reviews-manager.php';
}
if ( ! class_exists( 'ExcerptsManager' ) ) {
	include_once 'excerpts-manager.php';
}
if ( ! class_exists( 'MultimediaManager' ) ) {
	include_once 'multimedia-manager.php';
}
if ( ! class_exists( 'InterviewsManager' ) ) {
	include_once 'interviews-manager.php';
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
		$confm = new ConfigurationManager();
		$confm->setup();

		// Setup of the Multilang features.
		$langm = new MultilangManager();
		$langm->setup();

		// Setup of the sections.
		$sm = new SectionsManager();
		$sm->setup();

		// Setup the book post type.
		$bm = new BooksManager();
		$bm->setup();

		// Setup the review post type.
		$rm = new ReviewsManager();
		$rm->setup();

		// Setup the excerpt post type.
		$em = new ExcerptsManager();
		$em->setup();

		// Setup the media post type.
		$mm = new MultimediaManager();
		$mm->setup();

		// Setup the interview post type.
		$im = new InterviewsManager();
		$im->setup();
	}
}
