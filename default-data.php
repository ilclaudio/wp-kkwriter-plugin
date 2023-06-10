<?php
/**
 * Default data of the plugin.
 *
 * @package @package WP_KK_Writer_Plugin
 */

define(
	'KKW_BLOG_TYPE_TERMS',
	array(
		'Article',
		'Event',
		'News',
	)
);

define(
	'KKW_SECTION_TERMS',
	array(
		'Poetry',
		'Novels',
		'Stories',
		'Essays',
	)
);

define(
	'KKW_DEFAULT_TERMS',
	array(
		array(
			'taxonomy' => KKW_SECTION_TAXONOMY,
			'items'    => KKW_SECTION_TERMS,
		),
		array(
			'taxonomy' => KKW_BLOG_TYPE_TAXONOMY,
			'items'    => KKW_BLOG_TYPE_TERMS,
		),
	)
);
