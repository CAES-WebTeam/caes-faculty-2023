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
define('UGA_CAES_FAC_2023_VERSION', wp_get_theme()->get('Version'));

/**
 * Add theme support.
 */
function uga_caes_fac_2023_setup()
{

	// Add theme style
	add_editor_style('./assets/css/style-shared.min.css');

	// Add theme script
	// wp_enqueue_script( 'main', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true );

	// Add block styles.
	add_theme_support('wp-block-styles');

	// Remove core block patterns.
	remove_theme_support('core-block-patterns');

	/*
	 * Load additional block styles.
	 * See details on how to add more styles in the readme.txt.
	 */
	$styled_blocks = ['navigation', 'query', 'button', 'separator', 'columns', 'embed', 'image', 'file', 'comments', 'tag-cloud'];
	foreach ($styled_blocks as $block_name) {
		$args = array(
			'handle' => "uga-caes-fac-2023-$block_name",
			'src'    => get_theme_file_uri("assets/css/blocks/$block_name.min.css"),
			'path'   => get_theme_file_path("assets/css/blocks/$block_name.min.css"),
		);
		// Replace the "core" prefix if you are styling blocks from plugins.
		wp_enqueue_block_style("core/$block_name", $args);
	}
}
add_action('after_setup_theme', 'uga_caes_fac_2023_setup');

/**
 * Enqueue the CSS files.
 *
 * @since 1.0.0
 *
 * @return void
 */

/** Enqueue style sheet and JavaScript. */

function uga_caes_fac_2023_styles()
{
	wp_enqueue_style(
		'uga-caes-fac-2023-style',
		get_stylesheet_uri(),
		[],
		wp_get_theme()->get('Version')
	);
	wp_enqueue_style(
		'uga-caes-fac-2023-shared-styles',
		get_theme_file_uri('assets/css/style-shared.min.css'),
		[],
		wp_get_theme()->get('Version')
	);
	wp_enqueue_style('dashicons');
	wp_enqueue_script('uga-caes-fac-2023-script', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'uga_caes_fac_2023_styles');

/**
 * Registers block categories, and type.
 *
 * @since 0.9.2
 */
function uga_caes_fac_2023_register_block_pattern_categories()
{

	/* Functionality specific to the Block Pattern Explorer plugin. */
	if (function_exists('register_block_pattern_category_type')) {
		register_block_pattern_category_type('uga-caes-fac-2023', array('label' => __('UGA CAES Faculty 2023', 'uga-caes-fac-2023')));
	}

	$block_pattern_categories = array(
		'uga-caes-fac-2023-general'  => array(
			'label'         => __('General', 'uga-caes-fac-2023'),
			'categoryTypes' => array('uga-caes-fac-2023'),
		),
		'uga-caes-fac-2023-query'  => array(
			'label'         => __('Post List', 'uga-caes-fac-2023'),
			'categoryTypes' => array('uga-caes-fac-2023'),
		),
		'header'  => array(
			'label'         => __('Site Header', 'uga-caes-fac-2023'),
			'categoryTypes' => array('uga-caes-fac-2023'),
		),
		'footer'  => array(
			'label'         => __('Site Footer', 'uga-caes-fac-2023'),
			'categoryTypes' => array('uga-caes-fac-2023'),
		)
	);

	foreach ($block_pattern_categories as $name => $properties) {
		register_block_pattern_category($name, $properties);
	}
}
add_action('init', 'uga_caes_fac_2023_register_block_pattern_categories', 9);

// Removes some default core styles with remove-block-styles.js

function remove_block_style()
{
	// Register the block editor script.
	wp_register_script('remove-block-style', get_theme_file_uri() . '/assets/js/remove-block-styles.js', ['wp-blocks', 'wp-edit-post']);
	// register block editor script
	register_block_type('remove/block-style', [
		'editor_script' => 'remove-block-style',
	]);
}
add_action('init', 'remove_block_style');


//////////////////////// START BLOCKS FOR THEME ////////////////////////////

function uga_caes_caes_fac_blocks_block_init()
{
	register_block_type(
		__DIR__ . '/blocks/build/footer-brand',
		array(
			'render_callback' => 'uga_caes_caes_fac_footer_brand_render_callback',
		)
	);
	register_block_type(
		__DIR__ . '/blocks/build/footer-copyright',
		array(
			'render_callback' => 'uga_caes_caes_fac_footer_copyright_render_callback',
		)
	);
	register_block_type(
		__DIR__ . '/blocks/build/preheader-brand',
		array(
			'render_callback' => 'uga_caes_caes_fac_preheader_brand_render_callback',
		)
	);
	register_block_type(
		__DIR__ . '/blocks/build/uga-footer',
		array(
			'render_callback' => 'uga_caes_caes_fac_uga_footer_render_callback',
		)
	);
	register_block_type(
		__DIR__ . '/blocks/build/post-social-share',
		array(
			'render_callback' => 'uga_caes_caes_fac_post_social_share_render_callback',
		)
	);
}
add_action('init', 'uga_caes_caes_fac_blocks_block_init');

/**
 * Render callback function.
 *
 * @param array    $attributes The block attributes.
 * @param string   $content    The block content.
 * @param WP_Block $block      Block instance.
 *
 * @return string The rendered output.
 */


function uga_caes_caes_fac_footer_brand_render_callback($attributes, $content, $block)
{
	ob_start();
	require get_template_directory().'/blocks/build/footer-brand/template.php';
	return ob_get_clean();
}

function uga_caes_caes_fac_footer_copyright_render_callback($attributes, $content, $block)
{
	ob_start();
	require get_template_directory().'/blocks/build/footer-copyright/template.php';
	return ob_get_clean();
}

function uga_caes_caes_fac_preheader_brand_render_callback($attributes, $content, $block)
{
	//not found this file
	//wp_enqueue_script('uga-caes-caes-fac-preheader-brand-view-script');	
	//wp_register_script('uga-caes-caes-fac-preheader-brand-view-script', $blockpath . 'js/script.js','','1.0',true);
	ob_start();
	require get_template_directory().'/blocks/build/preheader-brand/template.php';
	return ob_get_clean();
}

function uga_caes_caes_fac_uga_footer_render_callback($attributes, $content, $block)
{
	ob_start();
	require get_template_directory().'/blocks/build/uga-footer/template.php';
	return ob_get_clean();
}

function uga_caes_caes_fac_post_social_share_render_callback($attributes, $content, $block)
{
	ob_start();
	require get_template_directory().'/blocks/build/post-social-share/template.php';
	return ob_get_clean();
}

//////////////////////// END BLOCKS FOR THEME ////////////////////////////