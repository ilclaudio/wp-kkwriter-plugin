<?php

/**
 * The Multilang manager.
 */
class KKW_MultilangManager {
	/**
	 * Constructor of the Manager.
	 */
	public function __construct() {}

	/**
	 * Setup the configurations.
	 *
	 * @return void
	 */
	public function setup() {
		add_action( 'init', array( $this, 'upload_languages' ) );
	}

	/**
	 * Upload labels translations.
	 *
	 * @return void
	 */
	public function upload_languages() {
		load_plugin_textdomain( 'kkwdomain', false, KKW_PLUGIN_NAME . '/languages' );
	}

}
