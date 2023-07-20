<?php
/**
 * CAES The Events Calendar Functions
 *
 */

// TRIBE EVENTS RELATED FUNCTIONS

// Replace default single event page template with our pattern
add_filter( 'tribe_events_editor_default_template', function( $template ) {

  $template = [
    [ 'core/pattern', [
      'slug' => 'uga-caes-fac-2023/caes-tribe-calendar-event',
      ]
  ] ];

  return $template;

}, 11, 1 );

// Pull in a custom query block variation for event feeds
function tribe_events_list_caes_list()
{
	wp_enqueue_script(
		'enqueue-tribe-events-caes-list',
		get_template_directory_uri() . '/tribe-events-calendar/caes-tribe-events-list.js',
		array('wp-blocks')
	);
}

add_action('enqueue_block_editor_assets', 'tribe_events_list_caes_list');

// Sort by event start date on FRONT END
add_filter('pre_render_block', 'tribe_caes_upcoming_events_pre_render_block', 10, 2);
function tribe_caes_upcoming_events_pre_render_block($pre_render, $parsed_block)
{
	// Verify it's the block that should be modified using the namespace
	if (!empty($parsed_block['attrs']['namespace']) && 'uga-caes-fac-2023/caes-tribe-events-list' === $parsed_block['attrs']['namespace']) {
		add_filter(
			'query_loop_block_query_vars',
			function ($query, $block) {
				// get today's date
				$today = date('Y-m-d');
				// the meta key was event_date, compare to today to get event's from today or later
				$query['meta_key'] = '_EventStartDate';
				$query['meta_value'] = $today;
				$query['meta_compare'] = '>=';
				// also likely want to set order by this key in ASC so next event listed first
				$query['orderby'] = 'meta_value';
				$query['order'] = 'ASC';
				return $query;
			},
			10,
			2
		);
	}
	return $pre_render;
}

// Sort by event start date in EDITOR
add_filter('rest_tribe_events_query', 'tribe_caes_rest_upcoming_events', 10, 2);
function tribe_caes_rest_upcoming_events($args, $request)
{

	// grab value from the request
	$dateFilter = $request['filterByDate'];

	// proceed if it exists
	// add same meta query arguments
	//   if ( $dateFilter ) {
	$today = date('Y-m-d');
	$args['meta_key'] = '_EventStartDate';
	$args['meta_value'] = $today;
	$args['meta_compare'] = '>=';
	$args['orderby'] = 'meta_value';
	$args['order'] = 'ASC';
	//   }

	return $args;
}

// Registering our custom Event Date block
function caes_tribe_events_date_render_callback($attributes, $content, $block)
{
	ob_start();
	require get_template_directory() . '/tribe-events-calendar/tribe-events-display-date/build/template.php';
	return ob_get_clean();
}

function caes_tribe_events_date_init()
{
	register_block_type(
		__DIR__ . '/../tribe-events-calendar/tribe-events-display-date/build',
		array(
			'render_callback' => 'caes_tribe_events_date_render_callback',
		)
	);
}
add_action('init', 'caes_tribe_events_date_init');

?>