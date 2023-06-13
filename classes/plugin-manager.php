<?php
/**
 * Definition of the Plugin Manager.
 *
 * @package @package WP_KK_Writer_Plugin
 */

if ( ! class_exists( 'KKW_MultilangManager' ) ) {
	include_once 'multilang-manager.php';
}
if ( ! class_exists( 'KKW_CollectionsManager' ) ) {
	include_once 'collections-manager.php';
}
if ( ! class_exists( 'KKW_BookManager' ) ) {
	include_once 'books-manager.php';
}
if ( ! class_exists( 'KKW_ReviewsManager' ) ) {
	include_once 'reviews-manager.php';
}
if ( ! class_exists( 'KKW_ExcerptsManager' ) ) {
	include_once 'excerpts-manager.php';
}
if ( ! class_exists( 'KKW_MultimediaManager' ) ) {
	include_once 'multimedia-manager.php';
}
if ( ! class_exists( 'KKW_InterviewsManager' ) ) {
	include_once 'interviews-manager.php';
}
if ( ! class_exists( 'KKW_PostManager' ) ) {
	include_once 'post-manager.php';
}
if ( ! class_exists( 'KKW_ActivationManager' ) ) {
	include_once 'activation-manager.php';
}
if ( ! class_exists( 'KKW_SettingsManager' ) ) {
	include_once 'settings-manager.php';
}
if ( ! class_exists( 'KKW_RestApiManager' ) ) {
	include_once 'restapi-manager.php';
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

		// Setup of the Multilang features.
		$langm = new KKW_MultilangManager();
		$langm->setup();

		// Setup the collection post type.
		$cm = new KKW_CollectionsManager();
		$cm->setup();

		// Setup the book post type.
		$bm = new KKW_BooksManager();
		$bm->setup();

		// Setup the review post type.
		$rm = new KKW_ReviewsManager();
		$rm->setup();

		// Setup the excerpt post type.
		$em = new KKW_ExcerptsManager();
		$em->setup();

		// Setup the media post type.
		$mm = new KKW_MultimediaManager();
		$mm->setup();

		// Setup the interview post type.
		$im = new KKW_InterviewsManager();
		$im->setup();

		// Setup the default post type.
		$em = new KKW_PostManager();
		$em->setup();

		// Setup of the Settings manager (menu).
		$settm = new KKW_SettingsManager();
		$settm->setup();

		// Setup of the Rest Api manager.
		$rest = new KKW_RestApiManager();
		$rest->setup();

		// Needed to refresh permalinks.
		// Same as: Admin->Settings->Permalinks->Save.
		flush_rewrite_rules();
	}
}
