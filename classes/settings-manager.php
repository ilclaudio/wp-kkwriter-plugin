<?php

/**
 * The Settings manager.
 */
class KKW_SettingsManager {
	/**
	 * Constructor of the Manager.
	 */
	public function __construct() {}

	/**
	 * Setup the Settings and the menu of the plugin.
	 *
	 * @return void
	 */
	public function setup() {

		// Register the menu.
		add_action( 'admin_menu', array( $this, 'register_custom_menu' ) );
	}

	/**
	 * Build the menu of the plugin.
	 *
	 * @return void
	 */
	public function register_custom_menu() {

		$main_menu = KKW_SLUG_MAIN_MENU;

		// Page that describes the plugin: general information / readme.
		add_menu_page(
			'',
			'KK Writer Plugin',
			KKW_EDIT_PERMISSION,
			$main_menu,
			array( $this, 'get_plugin_presentation' ),
			'dashicons-book',
			3
		);

		// add_submenu_page(
		// 	$main_menu,                                 // parent slug.
		// 	'All ' . ORGANIZER_LABEL_PLURAL,            // page title.
		// 	'All ' . ORGANIZER_LABEL_PLURAL,            // sub-menu title.
		// 	KKW_EDIT_PERMISSION,                        // capability.
		// 	'edit.php?post_type=' . ORGANIZER_POST_TYPE // your menu menu slug.
		// );

		// add_submenu_page(
		// 	$main_menu,
		// 	'Opportunity Types',
		// 	'Opportunity Types',
		// 	KKW_EDIT_PERMISSION,
		// 	'edit-tags.php?taxonomy=' . TAXONOMY_OPPORTUNITY_TYPE . '&post_type=emt-types'
		// );

		// add_submenu_page(
		// 	$main_menu,
		// 	'Settings',
		// 	'Settings',
		// 	KKW_EDIT_PERMISSION,
		// 	'kkw_settings_menu',
		// 	array( $this, 'get_settings_page' )
		// );

		// Page to reload default data.
		add_submenu_page(
			$main_menu,
			'Reload data',
			'Reload data',
			KKW_EDIT_PERMISSION,
			'kkw_reload_menu',
			array( $this, 'get_reloaddata_page' )
		);

	}

	/**
	 * Render the presentation page of the plugin.
	 *
	 * @return void
	 */
	public function get_plugin_presentation() {
		require_once KKW_PLUGIN_PATH . '/admin/plugin-presentation.php';
	}

	/**
	 * Render the Settings page.
	 *
	 * @return void
	 */
	public function get_reloaddata_page() {
		// @TODO: check the user permission
		$result_activation = false;
		$is_reload         = false;
		if( isset( $_GET['action'] ) && 'reload' === $_GET['action'] ) {
			$is_reload         = true;
			$actm              = new KKW_ActivationManager();
			$result_activation = $actm->load_data();
		}

		echo "<div class='wrap'>";
		echo '<h1>Reload default plugin data</h1>';

		echo '<div id="admin_reload_data">';

		echo '<p>Click the button to reload all the data of the plugin: pages, templates and default post types, taxonomies, etc. .</p>';
		echo '<a href="admin.php?page=kkw_reload_menu&action=reload" class="button button-primary">Reload data</a>';
		echo '</div>';

		if ( $is_reload ) {
			if ( $result_activation ) {
				echo '<div id="admin_result_reload"><em>Data reloaded successfully</em>.</div>';
			} else {
				echo '<div id="admin_result_reload"><em>Data reloaded failed</em>.</div>';
			}
		}

		echo '</div>';

	}

}
