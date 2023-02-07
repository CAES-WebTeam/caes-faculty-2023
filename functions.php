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
	$styled_blocks = ['navigation', 'query', 'separator', 'columns', 'embed', 'image', 'file', 'comments', 'tag-cloud', 'search'];
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

// Adds excerpts to posts

add_post_type_support('page', 'excerpt');


/* START BLOCKS FOR THEME */

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
	require get_template_directory() . '/blocks/build/footer-brand/template.php';
	return ob_get_clean();
}

function uga_caes_caes_fac_footer_copyright_render_callback($attributes, $content, $block)
{
	ob_start();
	require get_template_directory() . '/blocks/build/footer-copyright/template.php';
	return ob_get_clean();
}

function uga_caes_caes_fac_preheader_brand_render_callback($attributes, $content, $block)
{
	ob_start();
	require get_template_directory() . '/blocks/build/preheader-brand/template.php';
	return ob_get_clean();
}

function uga_caes_caes_fac_uga_footer_render_callback($attributes, $content, $block)
{
	ob_start();
	require get_template_directory() . '/blocks/build/uga-footer/template.php';
	return ob_get_clean();
}

function uga_caes_caes_fac_post_social_share_render_callback($attributes, $content, $block)
{
	ob_start();
	require get_template_directory() . '/blocks/build/post-social-share/template.php';
	return ob_get_clean();
}
/* END BLOCKS FOR THEME */

/* ADD LOG IN PAGE STYLING */
function uga_caes_fac_2023_login_stylesheet()
{
	wp_enqueue_style('custom-login', get_stylesheet_directory_uri() . '/assets/css/login/caes-login.min.css');
}
add_action('login_enqueue_scripts', 'uga_caes_fac_2023_login_stylesheet');
/* END LOG IN PAGE STYLING */


/* GOOGLE TAG MANAGER */
/* GTM adds analytics tags for Siteimprove and Google Analytics. */

function gtag_code()
{
	if (!is_user_logged_in()) {
		$getDocRoot = strtolower($_SERVER['DOCUMENT_ROOT']);
		if (strpos($getDocRoot, 'devcaes') !== false || strpos($getDocRoot, 'devextension') !== false) return;

		if (strpos($getDocRoot, 'caes') !== false) {
			$output = " 
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-5BZ6L8B');</script>
<!-- End Google Tag Manager -->
";
		} else {
			$output = "
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-M75RTPD');</script>
<!-- End Google Tag Manager -->
";
		}
		echo $output;
	}
}

add_action('wp_head', 'gtag_code', 11);

function gtag_afterbody_code()
{
	if (!is_user_logged_in()) {
		$getDocRoot = strtolower($_SERVER['DOCUMENT_ROOT']);
		if (strpos($getDocRoot, 'devcaes') !== false || strpos($getDocRoot, 'devextension') !== false) return;

		if (strpos($getDocRoot, 'caes') !== false) {
			$output = '
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5BZ6L8B"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
';
		} else {
			$output = '
			<!-- Please work. -->
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M75RTPD"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
';
		}
		echo $output;
	}
}

add_action('wp_footer', 'gtag_afterbody_code', 11);

/* END GOOGLE TAG MANAGER */

/* Filter <title> tag's separator */

function change_title_separator( $separator ) {
    return '|';
}
add_filter( 'document_title_separator', 'change_title_separator' );

/* END Filter <title> tag's separator */


/* META TAGS */

function add_meta_tags()
{

	global $post;

	// Title tags
	$title = strip_tags(wp_get_document_title());
	echo '<meta property="og:title" content="'. $title .'" />' . "\n";
	echo '<meta property="twitter:title" content="'. $title .'" />' . "\n";

	// Page address
	$canon_url = wp_get_canonical_url();
	echo '<meta property="og:url" content="'. $canon_url .'" />' . "\n";

	if (is_singular()) {

		// Description tags
		if ( has_excerpt() ) {
			$des = strip_tags(get_the_excerpt());
			echo '<meta name="description" content="'. $des .'" />' . "\n";
			echo '<meta property="og:description" content="'. $des .'" />' . "\n";
			echo '<meta property="twitter:description" content="'. $des .'" />' . "\n";
		}

		// Preview image tags
		if ( has_post_thumbnail() )  {
			$image = wp_get_attachment_url( get_post_thumbnail_id() );
			echo '<meta property="og:image" content="'. esc_attr( $image ) .'" />' . "\n";
			echo '<meta property="twitter:image" content="'. esc_attr( $image ) .'" />' . "\n";
		}

	}

	// If the homepage is the default latest posts page
	if (is_home()) {

		// Description tags
		if ( get_bloginfo( 'description' ) ) {
			$des = strip_tags(get_bloginfo('description'));
			echo '<meta name="description" content="'. $des .'" />' . "\n";
			echo '<meta property="og:description" content="'. $des .'" />' . "\n";
			echo '<meta property="twitter:description" content="'. $des .'" />' . "\n";
		}

	}
}

add_action('wp_head', 'add_meta_tags');

// Include the required files
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
  if(is_super_admin() && is_plugin_active('wp-job-manager/wp-job-manager.php')) require_once('job_manager/wpjm-functions.php');

/* FAVICON */

// Remove WordPress's default rel="icon" tags
remove_action ('wp_head', 'wp_site_icon', 99);

// Add our theme's default favicon
function caes_fac_2023_favicon()
{
	echo '<link rel="icon" href="' . get_stylesheet_directory_uri() . '/favicon.ico" type="image/x-icon" />' . "\n";
}
add_action('wp_head', 'caes_fac_2023_favicon');

/* END FAVICON */
