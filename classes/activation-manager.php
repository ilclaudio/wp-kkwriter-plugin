<?php
/**
 * Activation Manager definition.
 *
 * @package @package WP_KK_Writer_Plugin
 */


/**
 * The Activation manager.
 */
class KKW_ActivationManager {

/**
 * Initialize the plugin.
 *
 * @return boolean
 */
	public function load_data() {
		$result = true;
		error_log( '@@@ Here you call the function to reload data @@@' );

		$result = $result && $this->load_taxonomy_terms();
		return $result;
	}


	/**
	 * Create the terms of the taxonomies.
	 *
	 * @return boolean
	 */
	function load_taxonomy_terms() {
		try{
			foreach ( KKW_DEFAULT_TERMS as $item ) {
				foreach ( $item['items'] as $term ) {
					$slug = kkw_generate_slug( $term );
					if ( ! get_term_by( 'slug', $slug, $item['taxonomy'] ) ) {
						wp_insert_term(
							$term,
							$item['taxonomy'],
							array(
								'slug'        => $slug,
								'description' => $term,
							)
						);
					}
				}
			}
			return true;
		} catch ( Exception $e ) {
			error_log( '@@ Caught exception: ' . $e->getMessage() );
			return false;
		}
	}

}
