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

		// Fix the menu navigation for taxonomies.
		add_action( 'parent_file', array( $this, 'keep_taxonomy_menu_open' ) );
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
			__( 'KK Writer Plugin', 'kkwdomain' ),
			KKW_EDIT_PERMISSION,
			$main_menu,
			array( $this, 'get_plugin_presentation' ),
			'dashicons-book',
			3
		);

		// Taxonomy: sections.
		add_submenu_page(
			$main_menu,
			'Sections',
			'Sections',
			KKW_EDIT_PERMISSION,
			'edit-tags.php?taxonomy=' . KKW_SECTION_TAXONOMY
		);

		// Taxonomy: collections.
		add_submenu_page(
			$main_menu,
			'Collections',
			'Collections',
			KKW_EDIT_PERMISSION,
			'edit-tags.php?taxonomy=' . KKW_COLLECTION_TAXONOMY
		);

		// Taxonomy: authors.
		add_submenu_page(
			$main_menu,
			'Authors',
			'Authors',
			KKW_EDIT_PERMISSION,
			'edit-tags.php?taxonomy=' . KKW_AUTHOR_TAXONOMY
		);

		// Taxonomy: publishers.
		add_submenu_page(
			$main_menu,
			'Publishers',
			'Publishers',
			KKW_EDIT_PERMISSION,
			'edit-tags.php?taxonomy=' . KKW_PUBLISHER_TAXONOMY
		);

		// List of the books.
		add_submenu_page(
			$main_menu,                                                      // parent slug.
			__( KKW_POST_TYPES[ ID_PT_BOOK ]['plural_label'], 'kkwdomain' ), // page title.
			__( KKW_POST_TYPES[ ID_PT_BOOK ]['plural_label'], 'kkwdomain' ), // sub-menu title.
			KKW_EDIT_PERMISSION,                                             // capability.
			'edit.php?post_type=' . KKW_POST_TYPES[ ID_PT_BOOK ]['name']     // link.
		);
		
		// Add a book.
		add_submenu_page(
			$main_menu,
			__( 'Add a ' . KKW_POST_TYPES[ ID_PT_BOOK ]['singular_label'], 'kkwdomain' ),
			__( 'Add a ' . KKW_POST_TYPES[ ID_PT_BOOK ]['singular_label'], 'kkwdomain' ),
			KKW_EDIT_PERMISSION,
			'post-new.php?post_type=' . KKW_POST_TYPES[ ID_PT_BOOK ]['name']
		);

		// List of the reviews.
		add_submenu_page(
			$main_menu,
			__( KKW_POST_TYPES[ ID_PT_REVIEW ]['plural_label'], 'kkwdomain' ),
			__( KKW_POST_TYPES[ ID_PT_REVIEW ]['plural_label'], 'kkwdomain' ),
			KKW_EDIT_PERMISSION,
			'edit.php?post_type=' . KKW_POST_TYPES[ ID_PT_REVIEW ]['name']
		);

		// Add a review.
		add_submenu_page(
			$main_menu,
			__( 'Add a ' . KKW_POST_TYPES[ ID_PT_REVIEW ]['singular_label'], 'kkwdomain' ),
			__( 'Add a ' . KKW_POST_TYPES[ ID_PT_REVIEW ]['singular_label'], 'kkwdomain' ),
			KKW_EDIT_PERMISSION,
			'post-new.php?post_type=' . KKW_POST_TYPES[ ID_PT_REVIEW ]['name']
		);

		// Page to reload default data.
		add_submenu_page(
			$main_menu,
			__( 'Reload data', 'kkwdomain' ),
			__( 'Reload data', 'kkwdomain' ),
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

	/**
	 * Return the name of the parent of a taxonomy in the menu.
	 *
	 * @param [type] $parent_file
	 * @return void
	 */
	public function keep_taxonomy_menu_open( $parent_file ) {
		global $current_screen;
		$taxonomy = $current_screen->taxonomy;
		if ( in_array( $taxonomy, KKW_CUSTOM_BOOK_TAXONOMIES ) )
			$parent_file = KKW_SLUG_MAIN_MENU;
		return $parent_file;
	}

}
