<?php
/**
 * Definition of the Search Manager.
 *
 * @package WP_KK_Writer_Plugin
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
		// Get all the posts.
		$results = new WP_Query(
			array(
				'post_type' => KKW_POST_TYPES[ ID_PT_BOOK ]['name'],
				'orderby'   => 'title',
				'order'     => 'ASC',
			)
		);
		$posts = $results->get_posts();
		// Loop through each post to retrieve and include meta tags, related post types and taxonomies.
		foreach ( $posts as &$post ) {
			self::fill_post_with_meta( $post );
		}
		// Get a normalized array.
		$normalized = array();
		foreach ( $posts as &$post ) {
			$book_object = self::normalize_book( $post );
			array_push( $normalized, $book_object );
		}
		return $normalized;
	}

	/**
	 * Return a book by id.
	 *
	 * @param integer $id.
	 * @return object.
	 */
	public static function get_book( $id ) {
		// Get all the posts.
		$results = new WP_Query(
			array(
				'p'         => $id,
				'post_type' => KKW_POST_TYPES[ ID_PT_BOOK ]['name'],
			)
		);
		$post = $results->get_posts()[0];
		self::fill_post_with_meta( $post );
		$book_object = self::normalize_book( $post );
		return $book_object;
	}

	/**
	 * Find books.
	 *
	 * @param array $parameters
	 * @return array.
	 */
	public static function find( $parameters ) {

		// Base args of the query.
		$query_args = array(
			'post_type'         => KKW_POST_TYPES[ ID_PT_BOOK ]['name'],
			'orderby'           => 'title',
			'order'             => 'ASC',
			'meta_query'        => array(),
			'tax_query'         => array(),
		);

		// Prepare title and search_string filters.
		if ( $parameters['title'] ) {
			$query_args['title'] = $parameters['title'];
		}
		if ( $parameters['search_string'] ) {
			$query_args['s'] = $parameters['search_string'];
		}

		// Prepare filters.
		$meta_filters = array();
		$tax_filters  = array();
		self::prepare_filters( $parameters, $meta_filters, $tax_filters );

		// Add meta filters.
		if ( count ( $meta_filters ) ) {
			$query_args['meta_query'] = array_merge(
				array( 'relation' => 'AND' ),
				$meta_filters,
			);
		}

		// Add tax filters.
		if ( count ( $tax_filters ) ) {
			$query_args['tax_query'] = array_merge(
				array( 'relation' => 'AND' ),
				$tax_filters,
			);
		}

		// Find the posts.
		$results = new WP_Query( $query_args );
		$posts = $results->get_posts();
		// Loop through each post to retrieve and include meta tags, related post types and taxonomies.
		foreach ( $posts as &$post ) {
			self::fill_post_with_meta( $post );
		}
		// Get a normalized array.
		$normalized = array();
		foreach ( $posts as &$post ) {
			$book_object = self::normalize_book( $post );
			array_push( $normalized, $book_object );
		}
		return $normalized;
	}

	private static function prepare_filters( $parameters, &$meta_filters, &$tax_filters ) {
		foreach ( $parameters as $label => $value ) {
			if ( $value ) {
				switch ( $label ) {
					case 'section':
						array_push(
							$tax_filters,
							array(
								'taxonomy' => KKW_SECTION_TAXONOMY,
								'field'    => 'slug',
								'terms'    => $value,
							),
						);
						break;
					case 'publisher':
						array_push(
							$tax_filters,
							array(
								'taxonomy' => KKW_PUBLISHER_TAXONOMY,
								'field'    => 'slug',
								'terms'    => $value,
							),
						);
						break;
					// case 'arrival_date':
					// 	array_push(
					// 		$meta_filters,
					// 		array(
					// 			'key'     => 'emt_start_date',
					// 			'value'   =>  DateTime::createFromFormat( EMT_FORM_DATE_FORMAT, $par['value'] )->format( EMT_ACF_DB_DATE_FORMAT ),
					// 			'compare' => '>=',
					// 			'type'    => 'DATE',
					// 		),
					// 	);
					// 	break;
				}
			}
		}
		return true;
	}

	/**
	 * Fill the post adding meta_tags, taxonomies, etc.
	 *
	 * @param WP_Post $post.
	 * @return void.
	 */
	private static function fill_post_with_meta( &$post ) {
		// Add related meta tags (custom fields).
		$post->meta_tags = array();
		$meta_tags       = get_post_meta( $post->ID );
		array_push( $post->meta_tags, $meta_tags );

		// Add related taxonomies.
		$post->taxonomies = array();
		$taxonomies       = get_post_taxonomies( $post->ID );
		$taxonomy_data    = array();
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

		// Add post images.
		$featured_image       = self::get_featured_image( $post->ID );
		$post->featured_image = $featured_image;
	}

	/**
	 * Retrieve the featured image of the post.
	 *
	 * @param integer $post_id
	 * @return array
	 */
	private static function get_featured_image( int $post_id ){
		$image = array();
		$thumbnail_id = get_post_thumbnail_id( $post_id );
		if ( $thumbnail_id ) {
				$image_src    = wp_get_attachment_image_src( $thumbnail_id, 'full' );
				$image['id']  = $thumbnail_id;
				$image['url'] = $image_src ? $image_src[0] : '';
		}
		return $image;
	}

	/**
	 * Convert a nested Wordpress object into a onel-level array.
	 *
	 * @param WP_Post $post - The post to be converted.
	 * @return array.
	 */
	private static function normalize_book ( $post ) {
		$book = array();

		// Add the post fields.
		$book['id']      = $post->ID;
		$book['title']   = $post->post_title;
		$book['status']  = $post->post_status;
		$book['slug']    = $post->post_name;
		$book['type']    = $post->post_type;
		$book['content'] = $post->post_content;

		// Add the meta-tags.
		$has_meta      = ( count( $post->meta_tags) > 0 ) && ( count( $post->meta_tags[0] )  > 0 );
		$prefix        = 'kkw_';
		$book['group'] = $has_meta &&
			array_key_exists( $prefix . 'group', $post->meta_tags[0]) &&
			$post->meta_tags[0][ $prefix . 'group'][0] ?
			$post->meta_tags[0][ $prefix . 'group'][0] : '';
		$book['description'] = $has_meta &&
			array_key_exists( $prefix . 'short_description', $post->meta_tags[0]) &&
			$post->meta_tags[0][ $prefix . 'short_description'][0] ?
			$post->meta_tags[0][ $prefix . 'short_description'][0] : '';
		$book['year']        = $has_meta && 
			array_key_exists( $prefix . 'year', $post->meta_tags[0]) &&
			$post->meta_tags[0][ $prefix . 'year'][0] ?
				$post->meta_tags[0][ $prefix . 'year'][0] : '';
		$book['pages']        = $has_meta && 
			array_key_exists( $prefix . 'pages', $post->meta_tags[0]) &&
			$post->meta_tags[0][ $prefix . 'pages'][0] ?
			$post->meta_tags[0][ $prefix . 'pages'][0] : '';
		$book['isbn']        = $has_meta &&
			array_key_exists( $prefix . 'isbn', $post->meta_tags[0]) &&
				$post->meta_tags[0][ $prefix . 'isbn'][0] ?
				$post->meta_tags[0][ $prefix . 'isbn'][0] : '';
		$book['price']        = $has_meta &&
				array_key_exists( $prefix . 'price', $post->meta_tags[0]) &&
					$post->meta_tags[0][ $prefix . 'price'][0] ?
					$post->meta_tags[0][ $prefix . 'price'][0] : '';

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
