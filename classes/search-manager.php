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

	/**
	 * Return all the books
	 *
	 * @return array.
	 */
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
				$taxonomy_data[ $taxonomy ] = $terms;
			}
			// Add the taxonomy data to the post object.
			$post->taxonomies = $taxonomy_data;

			// Add related post (fields of type `custom_attached_posts`).
			// $post->related_posts = array();
		}

		$normalized = array();
		foreach ( $posts as &$post ) {
			$norm_item = self::normalize_book( $post );
			array_push( $normalized, $norm_item );
		}
		return $normalized;
	}

	public static function get_book() {
		$book = 'uno';
		return $book;
	}

	public static function find() {
		$results = array( 'uno', 'due', 'tre' );
		return $results;
	}

	/**
	 * Convert a nested Wordpress object into a onel-level array.
	 *
	 * @param WP_Post $post - The post to be converted.
	 * @return array.
	 */
	public static function normalize_book ( $post ){
		$book = array();

		// Add the post fields.
		$book['id']          = $post->ID;
		$book['title']       = $post->post_title;
		$book['status']      = $post->post_status;
		$book['slug']        = $post->post_name;
		$book['type']        = $post->post_type;
		$book['content']     = $post->post_content;

		// Add the meta-tags.
		$has_meta            = ( count( $post->meta_tags) > 0 ) && ( count( $post->meta_tags[0] )  > 0 );
		$book['description'] = $has_meta && $post->meta_tags[0]['kkw_book_short_description'][0] ?
			$post->meta_tags[0]['kkw_book_short_description'][0] : '';
		$book['year']        = $has_meta && $post->meta_tags[0]['kkw_book_year'][0] ?
			$post->meta_tags[0]['kkw_book_year'][0] : '';
		$book['pages']        = $has_meta && $post->meta_tags[0]['kkw_book_pages'][0] ?
			$post->meta_tags[0]['kkw_book_pages'][0] : '';
		$book['isbn']        = $has_meta && $post->meta_tags[0]['kkw_book_isbn'][0] ?
			$post->meta_tags[0]['kkw_book_isbn'][0] : '';

		// Add the taxonomies.
		$has_taxonomies = count( $post->taxonomies ) > 0;
		$book['sections'] = $has_taxonomies && $post->taxonomies['section'] ?
			$post->taxonomies['section'] : array();
		$book['categories'] = $has_taxonomies && $post->taxonomies['category'] ?
			$post->taxonomies['category'] : array();
		$book['collections'] = $has_taxonomies && $post->taxonomies['collection'] ?
			$post->taxonomies['collection'] : array();
		$book['authors'] = $has_taxonomies && $post->taxonomies['author'] ?
			$post->taxonomies['author'] : array();
		$book['publishers'] = $has_taxonomies && $post->taxonomies['publisher'] ?
			$post->taxonomies['publisher'] : array();
		return $book;
	}

}
