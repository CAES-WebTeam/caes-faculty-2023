<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package uga-caes-fac-2023
 * @since 1.0.0
 */

/**
 * The theme version.
 *
 * @since 1.0.0
 */
define( 'UGA_CAES_FAC_2023_VERSION', wp_get_theme()->get( 'Version' ) );

/**
 * Add theme support.
 */
function uga_caes_fac_2023_setup() {
	add_theme_support( 'wp-block-styles' );
	add_editor_style( './assets/css/style-shared.min.css' );

	/*
	 * Load additional block styles.
	 * See details on how to add more styles in the readme.txt.
	 */
	// $styled_blocks = [ 'button', 'file', 'quote', 'search' ];
	// foreach ( $styled_blocks as $block_name ) {
	// 	$args = array(
	// 		'handle' => "uga-caes-fac-2023-$block_name",
	// 		'src'    => get_theme_file_uri( "assets/css/blocks/$block_name.min.css" ),
	// 		'path'   => get_theme_file_path( "assets/css/blocks/$block_name.min.css" ),
	// 	);
	// 	// Replace the "core" prefix if you are styling blocks from plugins.
	// 	wp_enqueue_block_style( "core/$block_name", $args );
	// }
}
add_action( 'after_setup_theme', 'uga_caes_fac_2023_setup' );

/**
 * Registers block categories, and type.
 *
 * @since 0.9.2
 */
function uga_caes_fac_2023_register_block_pattern_categories() {

	/* Functionality specific to the Block Pattern Explorer plugin. */
	if ( function_exists( 'register_block_pattern_category_type' ) ) {
		register_block_pattern_category_type( 'uga-caes-fac-2023', array( 'label' => __( 'CAES Faculty 2023', 'uga-caes-fac-2023' ) ) );
	}

	$block_pattern_categories = array(
		'caes-fac-2023-header'  => array(
			'label'         => __( 'CAES Headers', 'uga-caes-fac-2023' ),
			'categoryTypes' => array( 'uga-caes-fac-2023' ),
		),
		'caes-fac-2023-footer'  => array(
			'label'         => __( 'CAES Footers', 'uga-caes-fac-2023' ),
			'categoryTypes' => array( 'uga-caes-fac-2023' ),
		)
	);

	foreach ( $block_pattern_categories as $name => $properties ) {
		register_block_pattern_category( $name, $properties );
	}
}
add_action( 'init', 'uga_caes_fac_2023_register_block_pattern_categories', 9 );

/**
 * Enqueue the CSS files.
 *
 * @since 1.0.0
 *
 * @return void
 */

 // Enqueue style sheet.
// add_action( 'wp_enqueue_scripts', 'uga_caes_fac_2023_enqueue_style_sheet' );
// function uga_caes_fac_2023_enqueue_style_sheet() {

// 	wp_enqueue_style( 'uga-caes-fac-2023', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );

// }

function bluh_styles() {
	wp_enqueue_style(
		'bluh-style',
		get_stylesheet_uri(),
		[],
		wp_get_theme()->get( 'Version' )
	);
	wp_enqueue_style(
		'bluh-shared-styles',
		get_theme_file_uri( 'assets/css/style-shared.min.css' ),
		[],
		wp_get_theme()->get( 'Version' )
	);
}
add_action( 'wp_enqueue_scripts', 'bluh_styles' );