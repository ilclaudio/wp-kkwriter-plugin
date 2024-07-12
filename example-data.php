<?php

/**
 * Default data of the plugin.
 *
 * @package @package WP_KK_Writer_Plugin
 */

define(
	'KKW_SECTION_TERMS',
	array(
		'Poetry',
		'Fiction',
		'Essays',
	)
);

define(
	'KKW_AUTHORS',
	array(
		'John Doe',
	)
);

define(
	'KKW_PUBLISHERS',
	array(
		'Best Books Publisher',
	)
);

define(
	'KKW_EXAMPLE_BOOKS',
	array(
		array(
			'title'     => 'Nice poems',
			'author'    => 'John Doe',
			'section'   => 'Poetry',
			'publisher' => 'Best Books Publisher',
		),
		array(
			'title'     => 'A novel',
			'author'    => 'John Doe',
			'section'   => 'Fiction',
			'publisher' => 'Best Books Publisher',
		),
		array(
			'title'     => 'Short stories',
			'author'    => 'John Doe',
			'section'   => 'Fiction',
			'publisher' => 'Best Books Publisher',
		),
		array(
			'title'     => 'An essay',
			'author'    => 'John Doe',
			'section'   => 'Essays',
			'publisher' => 'Best Books Publisher',
		),
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
			'taxonomy' => KKW_AUTHOR_TAXONOMY,
			'items'    => KKW_AUTHORS,
		),
		array(
			'taxonomy' => KKW_PUBLISHER_TAXONOMY,
			'items'    => KKW_PUBLISHERS,
		),
	)
);
