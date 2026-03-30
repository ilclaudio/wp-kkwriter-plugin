<?php
/**
 * Definition of the plugin settings and of the main menu.
 *
 * @package WP_KK_Writer_Plugin
 */

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
	 * Get translated plural label for a configured post type.
	 *
	 * @param string $post_type_id Configured post type ID constant value.
	 * @return string
	 */
	private function get_post_type_plural_label( $post_type_id ) {
		$label_key        = KKW_POST_TYPES[ $post_type_id ]['plural_label'];
		$translated_data  = kkw_translate_data();
		$translated_label = isset( $translated_data[ $label_key ] ) ? $translated_data[ $label_key ] : $label_key;

		return $translated_label;
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
			__( 'KKW Plugin', 'kkwdomain' ),
			KKW_EDIT_PERMISSION,
			$main_menu,
			array( $this, 'get_plugin_presentation' ),
			'dashicons-welcome-write-blog',
			3
		);

		// Taxonomy: sections.
		add_submenu_page(
			$main_menu,
			__( 'Sections', 'kkwdomain' ),
			__( 'Sections', 'kkwdomain' ),
			KKW_EDIT_PERMISSION,
			'edit-tags.php?taxonomy=' . KKW_SECTION_TAXONOMY
		);

		// Taxonomy: collections.
		add_submenu_page(
			$main_menu,
			__( 'Collections', 'kkwdomain' ),
			__( 'Collections', 'kkwdomain' ),
			KKW_EDIT_PERMISSION,
			'edit-tags.php?taxonomy=' . KKW_COLLECTION_TAXONOMY
		);

		// Taxonomy: authors.
		add_submenu_page(
			$main_menu,
			__( 'Authors', 'kkwdomain' ),
			__( 'Authors', 'kkwdomain' ),
			KKW_EDIT_PERMISSION,
			'edit-tags.php?taxonomy=' . KKW_AUTHOR_TAXONOMY
		);

		// Taxonomy: publishers.
		add_submenu_page(
			$main_menu,
			__( 'Publishers', 'kkwdomain' ),
			__( 'Publishers', 'kkwdomain' ),
			KKW_EDIT_PERMISSION,
			'edit-tags.php?taxonomy=' . KKW_PUBLISHER_TAXONOMY
		);

		// List of the books.
		$book_plural_label = $this->get_post_type_plural_label( ID_PT_BOOK );
		add_submenu_page(
			$main_menu,                                                      // parent slug.
			$book_plural_label,                                             // page title.
			$book_plural_label,                                             // sub-menu title.
			KKW_EDIT_PERMISSION,                                             // capability.
			'edit.php?post_type=' . KKW_POST_TYPES[ ID_PT_BOOK ]['name']     // link.
		);

		// Add a book.
		add_submenu_page(
			$main_menu,
			__( 'Add a book', 'kkwdomain' ),
			__( 'Add a book', 'kkwdomain' ),
			KKW_EDIT_PERMISSION,
			'post-new.php?post_type=' . KKW_POST_TYPES[ ID_PT_BOOK ]['name']
		);

		// List of the reviews.
		$review_plural_label = $this->get_post_type_plural_label( ID_PT_REVIEW );
		add_submenu_page(
			$main_menu,
			$review_plural_label,
			$review_plural_label,
			KKW_EDIT_PERMISSION,
			'edit.php?post_type=' . KKW_POST_TYPES[ ID_PT_REVIEW ]['name']
		);

		// Add a review.
		add_submenu_page(
			$main_menu,
			__( 'Add a review', 'kkwdomain' ),
			__( 'Add a review', 'kkwdomain' ),
			KKW_EDIT_PERMISSION,
			'post-new.php?post_type=' . KKW_POST_TYPES[ ID_PT_REVIEW ]['name']
		);

		// List of the interviews.
		$interview_plural_label = $this->get_post_type_plural_label( ID_PT_INTERVIEW );
		add_submenu_page(
			$main_menu,
			$interview_plural_label,
			$interview_plural_label,
			KKW_EDIT_PERMISSION,
			'edit.php?post_type=' . KKW_POST_TYPES[ ID_PT_INTERVIEW ]['name']
		);

		// Add an interview.
		add_submenu_page(
			$main_menu,
			__( 'Add an interview', 'kkwdomain' ),
			__( 'Add an interview', 'kkwdomain' ),
			KKW_EDIT_PERMISSION,
			'post-new.php?post_type=' . KKW_POST_TYPES[ ID_PT_INTERVIEW ]['name']
		);

		// List of the excerpts.
		$excerpt_plural_label = $this->get_post_type_plural_label( ID_PT_EXCERPT );
		add_submenu_page(
			$main_menu,
			$excerpt_plural_label,
			$excerpt_plural_label,
			KKW_EDIT_PERMISSION,
			'edit.php?post_type=' . KKW_POST_TYPES[ ID_PT_EXCERPT ]['name']
		);

		// Add an excerpt.
		add_submenu_page(
			$main_menu,
			__( 'Add an excerpt', 'kkwdomain' ),
			__( 'Add an excerpt', 'kkwdomain' ),
			KKW_EDIT_PERMISSION,
			'post-new.php?post_type=' . KKW_POST_TYPES[ ID_PT_EXCERPT ]['name']
		);

		// List of the multimedia.
		$multimedia_plural_label = $this->get_post_type_plural_label( ID_PT_MULTIMEDIA );
		add_submenu_page(
			$main_menu,
			$multimedia_plural_label,
			$multimedia_plural_label,
			KKW_EDIT_PERMISSION,
			'edit.php?post_type=' . KKW_POST_TYPES[ ID_PT_MULTIMEDIA ]['name']
		);

		// Add a multimedia.
		add_submenu_page(
			$main_menu,
			__( 'Add a media', 'kkwdomain' ),
			__( 'Add a media', 'kkwdomain' ),
			KKW_EDIT_PERMISSION,
			'post-new.php?post_type=' . KKW_POST_TYPES[ ID_PT_MULTIMEDIA ]['name']
		);

		// Page to reload default data.
		add_submenu_page(
			$main_menu,
			__( 'Load example data', 'kkwdomain' ),
			__( 'Load example data', 'kkwdomain' ),
			KKW_EDIT_PERMISSION,
			'kkw_loadexamples_menu',
			array( $this, 'get_loadexamples_page' )
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
	public function get_loadexamples_page() {
		// @TODO: check the user permission
		$result_activation = false;
		$is_reload         = false;
		$action            = isset( $_GET['action'] ) ? sanitize_key( wp_unslash( $_GET['action'] ) ) : '';
		$nonce             = isset( $_GET['_wpnonce'] ) ? sanitize_text_field( wp_unslash( $_GET['_wpnonce'] ) ) : '';
		if ( 'reload' === $action && wp_verify_nonce( $nonce, 'kkw_reload_examples' ) ) {
			$is_reload         = true;
			$actm              = new KKW_ActivationManager();
			$result_activation = $actm->load_data();
		}
		$reload_url = wp_nonce_url(
			admin_url( 'admin.php?page=kkw_loadexamples_menu&action=reload' ),
			'kkw_reload_examples'
		);

		echo "<div class='wrap'>";
		echo '<h1>Load examples</h1>';

		echo '<div id="admin_load_examples">';

		echo '<p>Click the button load some example data: books, sections, authors, publishers, etc. .</p>';
		echo '<a href="' . esc_url( $reload_url ) . '" class="button button-primary">Load example data</a>';
		echo '</div>';

		if ( $is_reload ) {
			if ( $result_activation ) {
				echo '<div class="admin_result_reload"><em>Example data loaded successfully</em>.</div>';
			} else {
				echo '<div class="admin_result_reload"><em>Example data not reloaded</em>.</div>';
			}
		}

		echo '</div>';
	}

	/**
	 * Return the name of the parent of a taxonomy in the menu.
	 *
	 * @param string $parent_file Parent menu slug.
	 * @return string
	 */
	public function keep_taxonomy_menu_open( $parent_file ) {
		global $current_screen;
		$taxonomy = $current_screen->taxonomy;
		if ( in_array( $taxonomy, KKW_CUSTOM_BOOK_TAXONOMIES, true ) ) {
			$parent_file = KKW_SLUG_MAIN_MENU;
		}
		return $parent_file;
	}
}
