<?php

/**
 * Activation Manager definition.
 *
 * @package WP_KK_Writer_Plugin
 */

/**
 * The Activation manager.
 */
class KKW_ActivationManager
{

	/**
	 * Initialize the plugin.
	 *
	 * @return boolean
	 */
	public function load_data()
	{
		$result = true;
		error_log( '@@@ Here you call the function to reload data @@@' );

		$result = $result && $this->load_taxonomy_terms();
		$result = $result && $this->load_example_books();
		return $result;
	}


	/**
	 * Create the terms of the taxonomies.
	 *
	 * @return boolean
	 */
	private function load_taxonomy_terms()
	{
		try {
			foreach ( KKW_DEFAULT_TERMS as $item ) {
				foreach ( $item['items'] as $term ) {
					$slug = kkw_generate_slug( $term );
					if (!get_term_by( 'slug', $slug, $item['taxonomy'] ) ) {
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

	/**
	 * Create the books.
	 *
	 * @return boolean
	 */
	private function load_example_books()
	{
		try {
			foreach ( KKW_EXAMPLE_BOOKS as $item ) {
				$book_title     = $item['title'];
				$book_slug      = kkw_generate_slug($item['title']);
				$post_type      = KKW_POST_TYPES[ ID_PT_BOOK ]['name'];
				$book_author    = kkw_generate_slug($item['author']);
				$book_section   = kkw_generate_slug($item['section']);
				$book_publisher = kkw_generate_slug($item['publisher']);

				// Check if the book exists.
				$args = array(
					'name'        => $book_slug,
					'post_type'   => $post_type,
					'numberposts' => 1
				);
				$posts = get_posts( $args );
				if ( $posts ) {
					$book_id = $posts[0]->ID;
				} else {
					// The book does not exist.
					$book_item = array(
						'post_type'    => $post_type,
						'post_name'    => $book_slug,
						'post_title'   => $book_title,
						'post_content' => $book_title,
						'post_status'  => 'publish',
						'post_author'  => get_current_user_id(),
					);
					// Add the book.
					$result  = wp_insert_post($book_item, true);
					$book_id = is_numeric($result) ? $result : 0;
					if ( ! $book_id ) {
						throw new ErrorException('Book not inserted: ' . $book_title);
					}
				}
				// Set the author.
				$taxonomy = get_term_by( 'slug', $book_author, KKW_AUTHOR_TAXONOMY );
				if ( $taxonomy ) {
					$taxonomy_id = $taxonomy->term_id;
					$terms       = array( $taxonomy_id );
					$result      = wp_set_post_terms( $book_id, $terms, KKW_AUTHOR_TAXONOMY );
				}
				// Set the section.
				$taxonomy = get_term_by( 'slug', $book_section, KKW_SECTION_TAXONOMY );
				if ( $taxonomy ) {
					$taxonomy_id = $taxonomy->term_id;
					$terms       = array( $taxonomy_id );
					$result      = wp_set_post_terms( $book_id, $terms, KKW_SECTION_TAXONOMY );
				}
				// Set the publisher.
				$taxonomy = get_term_by( 'slug', $book_publisher, KKW_PUBLISHER_TAXONOMY );
				if ( $taxonomy ) {
					$taxonomy_id = $taxonomy->term_id;
					$terms       = array( $taxonomy_id );
					$result      = wp_set_post_terms( $book_id, $terms, KKW_PUBLISHER_TAXONOMY );
				}
			}
			return true;
		} catch ( Exception $e ) {
			error_log( '@@ Caught exception: ' . $e->getMessage() );
			return false;
		}
	}
}
