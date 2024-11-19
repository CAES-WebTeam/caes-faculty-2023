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
	add_editor_style('./assets/css/editor-only/editor-only.min.css');

	// Add theme script
	// wp_enqueue_script( 'main', get_template_directory_uri() . '/assets/js/main.js', array(), '1.0.0', true );

	// Remove core block patterns.
	remove_theme_support('core-block-patterns');

	/*
	 * Load additional block styles.
	 * See details on how to add more styles in the readme.txt.
	 */
	$styled_blocks = ['separator', 'embed', 'tag-cloud', 'quote', 'pullquote', 'table', 'gallery', 'image'];
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
			'categoryTypes' => array('uga-caes-fac-2023')
		),
		'query'  => array(
			'label'         => __('Post List', 'uga-caes-fac-2023'),
			'categoryTypes' => array('uga-caes-fac-2023')
		),
		'uga-caes-fac-2023-sidebar' => array(
			'label'         => __('Sidebar', 'uga-caes-fac-2023'),
			'categoryTypes' => array('uga-caes-fac-2023')
		),
		'uga-caes-fac-2023-people' => array(
			'label'         => __('People Profiles', 'uga-caes-fac-2023'),
			'categoryTypes' => array('uga-caes-fac-2023')
		),
		'header'  => array(
			'label'         => __('Headers', 'uga-caes-fac-2023'),
			'categoryTypes' => array('uga-caes-fac-2023')
		),
		'footer'  => array(
			'label'         => __('Footers', 'uga-caes-fac-2023'),
			'categoryTypes' => array('uga-caes-fac-2023')
		),
		'tribe-events'  => array(
			'label'         => __('Events', 'uga-caes-fac-2023'),
			'categoryTypes' => array('tribe-events')
		)
	);

	foreach ($block_pattern_categories as $name => $properties) {
		register_block_pattern_category($name, $properties);
	}
}
add_action('init', 'uga_caes_fac_2023_register_block_pattern_categories', 9);

// Unregister people block patterns if plugin is not installed
add_action('init', function () {
	if (!function_exists('create_block_caes_people_block_init')) {
		unregister_block_pattern('uga-caes-fac-2023/people-cpt-1-cards');
		unregister_block_pattern('uga-caes-fac-2023/people-cpt-2-grid');
		unregister_block_pattern('uga-caes-fac-2023/people-cpt-3-list');
	}
	if (!is_plugin_active('the-events-calendar/the-events-calendar.php')) {
		unregister_block_pattern('uga-caes-fac-2023/caes-tribe-events-list');
	}
	if (is_plugin_active('gutenslider/eedee-gutenslider.php')) {
		unregister_block_pattern('gutenslider/pattern-testimonial-slider');
	}
});

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

// Adds some custom style choices to core blocks with add-block-styles.js

function add_block_style()
{
	wp_enqueue_script(
		'add-block-style',
		get_theme_file_uri() . '/assets/js/add-block-styles.js',
		array('wp-blocks', 'wp-dom-ready', 'wp-edit-post'),
		// filemtime( plugin_dir_path( __FILE__ ) . '/assets/js/add-block-styles.js' )
	);
}
add_action('enqueue_block_editor_assets', 'add_block_style');

// Adds excerpts to posts

add_post_type_support('page', 'excerpt');


////////////////// START BLOCKS FOR THEME //////////////////

function uga_caes_caes_fac_blocks_block_init()
{
	register_block_type(
		__DIR__ . '/blocks/build/breadcrumbs',
		array(
			'render_callback' => 'uga_caes_caes_fac_breadcrumbs_brand_render_callback',
		)
	);
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

function uga_caes_caes_fac_breadcrumbs_brand_render_callback($attributes, $content, $block)
{
	ob_start();
	require get_template_directory() . '/blocks/build/breadcrumbs/template.php';
	return ob_get_clean();
}

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
////////////////// END BLOCKS FOR THEME //////////////////

/////////////////// START EXTEND CORE BLOCKS ///////////////////

// Function to activate extend core blocks if theme active

require_once get_template_directory() . '/extend-core-blocks/caes-extend-core-blocks.php';

/////////////////// END EXTEND CORE BLOCKS ///////////////////

////////////////// ADD LOG IN PAGE STYLING //////////////////
function uga_caes_fac_2023_login_stylesheet()
{
	wp_enqueue_style('custom-login', get_stylesheet_directory_uri() . '/assets/css/login/caes-login.min.css');
}
add_action('login_enqueue_scripts', 'uga_caes_fac_2023_login_stylesheet');
////////////////// END LOG IN PAGE STYLING //////////////////


////////////////// GOOGLE TAG MANAGER //////////////////
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
			// $output = '
			// <!-- Google Tag Manager custom -->
			// <script>
			// var initGTMOnEvent=function(t){initGTM(),t.currentTarget.removeEventListener(t.type,initGTMOnEvent)},initGTM=function(){if(window.gtmDidInit)return!1;window.gtmDidInit=!0;var t=document.createElement("script");t.type="text/javascript",t.async=!0,t.onload=function(){dataLayer.push({event:"gtm.js","gtm.start":(new Date).getTime(),"gtm.uniqueEventId":0})},t.src="https://www.googletagmanager.com/gtm.js?id=GTM-M75RTPD",document.head.appendChild(t)};document.addEventListener("DOMContentLoaded",(function(){setTimeout(initGTM,2e3)})),document.addEventListener("scroll",initGTMOnEvent),document.addEventListener("mousemove",initGTMOnEvent),document.addEventListener("touchstart",initGTMOnEvent);
			// </script>
			// <!-- Google Tag Manager custom -->
			// ';
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

add_action('wp_head', 'gtag_code', 1);

function gtag_body_code()
{
	if (!is_user_logged_in()) {
		$getDocRoot = strtolower($_SERVER['DOCUMENT_ROOT']);
		if (strpos($getDocRoot, 'devcaes') !== false || strpos($getDocRoot, 'devextension') !== false) return;

		if (strpos($getDocRoot, 'caes') !== false) {
			$output = '
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5BZ6L8B"
height="0" width="0" style="display:none;visibility:hidden" aria-hidden="true"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
';
		} else {
			$output = '
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M75RTPD"
height="0" width="0" style="display:none;visibility:hidden" aria-hidden="true"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
';
		}
		echo $output;
	}
}

add_action('wp_body_open', 'gtag_body_code', -9999);

////////////////// END GOOGLE TAG MANAGER //////////////////

/* Filter <title> tag's separator */

function change_title_separator($separator)
{
	return '|';
}
add_filter('document_title_separator', 'change_title_separator');

/* END Filter <title> tag's separator */

/* Remove Openverse images as a media option */
add_filter(
	'block_editor_settings_all',
	function ($settings) {
		$settings['enableOpenverseMediaCategory'] = false;

		return $settings;
	},
	10
);


/* META TAGS */

function add_meta_tags()
{

	global $post;

	// Title tags
	$title = strip_tags(wp_get_document_title());
	echo '<meta property="og:title" content="' . $title . '" />' . "\n";
	echo '<meta property="twitter:title" content="' . $title . '" />' . "\n";

	// Page address
	$canon_url = wp_get_canonical_url();
	echo '<meta property="og:url" content="' . $canon_url . '" />' . "\n";

	if (is_singular()) {

		// Description tags
		if (has_excerpt()) {
			$des = strip_tags(get_the_excerpt());
			echo '<meta name="description" content="' . $des . '" />' . "\n";
			echo '<meta property="og:description" content="' . $des . '" />' . "\n";
			echo '<meta property="twitter:description" content="' . $des . '" />' . "\n";
		}

		// Preview image tags
		if (has_post_thumbnail()) {
			$image = wp_get_attachment_url(get_post_thumbnail_id());
			echo '<meta property="og:image" content="' . esc_attr($image) . '" />' . "\n";
			echo '<meta property="twitter:image" content="' . esc_attr($image) . '" />' . "\n";
		}
	}

	// If the homepage is the default latest posts page
	if (is_home()) {

		// Description tags
		if (get_bloginfo('description')) {
			$des = strip_tags(get_bloginfo('description'));
			echo '<meta name="description" content="' . $des . '" />' . "\n";
			echo '<meta property="og:description" content="' . $des . '" />' . "\n";
			echo '<meta property="twitter:description" content="' . $des . '" />' . "\n";
		}
	}
}

add_action('wp_head', 'add_meta_tags', 2);

// ADD RSS IMAGE FROM CONTENT
function add_feed_content($content)
{
	if (is_feed()) {
		global $post;
		$imgsize = 'medium';
		if (isset($_GET['imgsize'])) {
			if ($_GET['imgsize'] == 'lg') $imgsize = 'large';
		}
		$output = '';
		$thumbnail_ID = get_post_thumbnail_id($post->ID);
		if ($thumbnail_ID != '') {
			$thumbnail = wp_get_attachment_image_src($thumbnail_ID, $imgsize);
			$thumbnail0 = $thumbnail[0] ?? null;
			$thumbnail1 = $thumbnail[1] ?? null;
			$thumbnail2 = $thumbnail[2] ?? null;
			if ($thumbnail0 != null || $thumbnail1 != null || $thumbnail2 != null) $output .= '<media:content xmlns:media="http://search.yahoo.com/mrss" url="' . $thumbnail0 . '" medium="image" width="' . $thumbnail1 . '" height="' . $thumbnail2 . '" />';
		}
		if ($output != '') echo $output;
	}
	return $content;
}
add_filter('rss2_item', 'add_feed_content');

//Adds a pretty "Continue Reading" link to custom post excerpts..
function caes_custom_excerpt_more($output)
{
	$output .= '<br /><a href="' . get_the_permalink() . '" class="more-link">Read More</a>';;
	return $output;
}
add_filter('the_excerpt_rss', 'caes_custom_excerpt_more');


// Include the required files
include_once(ABSPATH . 'wp-admin/includes/plugin.php');
if (is_plugin_active('wp-job-manager/wp-job-manager.php')) require_once('job_manager/wpjm-functions.php');
if (is_plugin_active('the-events-calendar/the-events-calendar.php')) require_once('tribe/tribe-events-functions.php');

////////////////// FAVICON //////////////////

function blog_favicon()
{
	if (has_site_icon()) {
		return;
	} else {
		$url = get_stylesheet_directory_uri() . '/favicon.ico';
		$output = '<link rel="icon" type="image/x-icon" href="' . $url . '" />';
		$output .= '<link rel="shortcut icon" type="image/x-icon" href="' . $url . '" />';
		echo $output;
	}
}
add_action('wp_head', 'blog_favicon', 10, 3);

////////////////// END FAVICON //////////////////

////////////////// START GUEST AUTHOR NAME //////////////////
// Filter the_author to guestname if existed
function update_the_author($display_name)
{
	if (get_post_meta(get_the_ID(), 'guestauthorname', true) != '')
		return get_post_meta(get_the_ID(), 'guestauthorname', true);
	else
		return $display_name;
}
//add_filter( 'the_author', 'update_the_author', PHP_INT_MAX, 1 );
add_filter('the_author', 'update_the_author', 12);
add_filter('get_the_author_display_name', 'update_the_author', 12);
add_filter('get_the_author_user_nicename', 'update_the_author', 12);
add_filter('get_the_author_nickname', 'update_the_author', 12);

////////////////// END GUEST AUTHOR NAME //////////////////

////////////////// START SEARCH GLOBAL //////////////////
//<input type="hidden" name="search-type" value="global" />
//if(is_main_site()) { $wSearch = 'global'; $searchText = 'Search all sites'; }

function searchfilter($query)
{
	if (is_main_site() && $query->is_search) {
		$current_blog_id = get_current_blog_id();
		if (function_exists('get_sites') && class_exists('WP_Site_Query')) {
			$args  = array(
				//'public' => 1,
				//'site__not_in' => $current_blog_id,
				'number' => 200,
				'orderby' => 'path',
			);
			$sites = get_sites($args);
			foreach ($sites as $site) {
				switch_to_blog($site->blog_id);
				$query->set('post_type', array('post', 'page', 'caes-people'));
			}
			//restore_current_blog();
		}
		switch_to_blog($current_blog_id);
		$GLOBALS['_wp_switched_stack'] = array();
		$GLOBALS['switched'] = false;
	}
	return $query;
}
//add_filter('pre_get_posts', 'searchfilter');


////////////////// END SEARCH GLOBAL //////////////////


/**
 * Disable the emoji's
 */
function disable_emojis()
{
	remove_action('wp_head', 'print_emoji_detection_script', 7);
	remove_action('admin_print_scripts', 'print_emoji_detection_script');
	remove_action('wp_print_styles', 'print_emoji_styles');
	remove_action('admin_print_styles', 'print_emoji_styles');
	remove_filter('the_content_feed', 'wp_staticize_emoji');
	remove_filter('comment_text_rss', 'wp_staticize_emoji');
	remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
	add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
	add_filter('wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2);
}
add_action('init', 'disable_emojis');

/**
 * Filter function used to remove the tinymce emoji plugin.
 * 
 * @param array $plugins 
 * @return array Difference betwen the two arrays
 */
function disable_emojis_tinymce($plugins)
{
	if (is_array($plugins)) {
		return array_diff($plugins, array('wpemoji'));
	} else {
		return array();
	}
}

/**
 * Remove emoji CDN hostname from DNS prefetching hints.
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed for.
 * @return array Difference betwen the two arrays.
 */
function disable_emojis_remove_dns_prefetch($urls, $relation_type)
{
	if ('dns-prefetch' == $relation_type) {
		/** This filter is documented in wp-includes/formatting.php */
		$emoji_svg_url = apply_filters('emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/');

		$urls = array_diff($urls, array($emoji_svg_url));
	}

	return $urls;
}

// Allow block locking for Super Admins
add_filter(
	'block_editor_settings_all',
	static function ($settings) {
		if (is_super_admin()) {
			$settings['canLockBlocks'] = true; // Allow block locking for Super Admins.
		} else {
			$settings['canLockBlocks'] = false; // Disallow for other roles.
		}
		return $settings;
	},
	10,
	2
);

// Disable the font library addded in WordPress 6.5
function disable_font_library_ui( $editor_settings ) { 
	$editor_settings['fontLibraryEnabled'] = false;
	return $editor_settings; 
}
add_filter( "block_editor_settings_all", "disable_font_library_ui" );