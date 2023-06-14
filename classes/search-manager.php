<?php
/**
 * Definition of the Search Manager.
 *
 * @package @package WP_KK_Writer_Plugin
 */


/**
 * The Settings manager.
 */
class KKW_SearchManager {

	public static function get_books() {
		$results = new WP_Query(
			array(
				'post_type' => KKW_POST_TYPES[ ID_PT_BOOK ]['name'],
			),
		);
		$posts = $results->get_posts();

		// Loop through each post to retrieve and include meta tags, related post types and taxonomies.
		foreach ( $posts as &$post ) {
			// Add related meta tags (custom fields).
			$post->meta_tags = array();
			$meta_tags       = get_post_meta( $post->ID );
			array_push( $post->meta_tags, $meta_tags );

			// Add related taxonomies.
			$taxonomies    = get_post_taxonomies( $post->ID );
			$taxonomy_data = array();
			// Loop through each taxonomy and retrieve the terms.
			foreach ( $taxonomies as $taxonomy ) {
				$terms = wp_get_post_terms(
					$post->ID,
					$taxonomy,
					array( 'fields' => 'names' )
				);
				$taxonomy_data[$taxonomy] = $terms;
			}
			// Add the taxonomy data to the post object.
			$post->taxonomies = $taxonomy_data;

			// Add related post (fields of type `custom_attached_posts`).
			$post->related_posts = array();

		}
		return $posts;
	}

	public static function get_book() {
		$book = 'uno';
		return $book;
	}

	public static function find() {
		$results = array( 'uno', 'due', 'tre' );
		return $results;
	}

}
