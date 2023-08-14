<?php

/**
 * CAES The Events Calendar Functions
 *
 */

// TRIBE EVENTS RELATED FUNCTIONS

// Replace default single event page template with our pattern
add_filter('tribe_events_editor_default_template', function ($template) {

	// Template for single event page
	$template = [
		// Top Group
		[
			'core/group',
			[
				'layout' => [
					'type' => 'constrained',
				],
			],
			[
				// Top Group > Columns Block
				[
					'core/columns',
					[
						'verticalAlignment' => 'center',
						'align' => 'full',
						'style' => [
							'spacing' => [
								'blockGap' => [
									'top' => '0',
									'left' => '0',
								],
							],
						],
						'backgroundColor' => 'base-two',
					],
					[
						// Top Group > Columns > Column 1
						[
							'core/column',
							[
								'verticalAlignment' => 'center',
							],
							[ // Post Featured Image Block
								[
									'core/post-featured-image',
								]
							]
						],
						// Top Group > Columns > Column 2
						[
							'core/column',
							[
								'verticalAlignment' => 'center',
								'style' => [
									'spacing' => [
										'padding' => [
											'top' => 'var:preset|spacing|60',
											'right' => 'var:preset|spacing|60',
											'bottom' => 'var:preset|spacing|60',
											'left' => 'var:preset|spacing|60',
										],
									],
								],
							],
							[
								[
									'core/group',
									[
										'style' => [
											'spacing' => [
												'blockGap' => 'var:preset|spacing|40',
											],
										],
										'layout' => [
											'type' => 'constrained',
										],
									],
									[
										[
											'core/post-title',
											[
												'level' => 1,
											]
										],
										[
											'tribe/event-datetime',
										]
									]
								],
							]
						],
					]
				]
			]
		],
		// Bottom Group
		[
			'core/group',
			[
				'layout' => [
					'type' => 'constrained',
				],
			],
			[
				// Bottom Group > Columns Block
				[
					'core/columns',
					[
						'align' => 'full',
					],
					[
						// Bottom Group > Columns > Column 1
						[
							'core/column',
							[
								'width' => '70%'
							],
							[
								// Bottom Group > Columns > Column 1 > Paragraph Block
								[
									'core/paragraph',
									[
										'content' => 'Add description here.',
									],
								]
							]
						],
						// Bottom Group > Columns > Column 2
						[
							'core/column',
							[
								'width' => '30%',
							],
							[
								[
									'core/group',
									[
										'style' => [
											'spacing' => [
												'padding' => [
													'top' => '0',
													'right' => '0',
													'bottom' => '0',
													'left' => '0',
												],
												'blockGap' => 'var:preset|spacing|60',
											],
											'layout' => [
												'type' => 'constrained',
											],
										],
									],
									[
										[
											'core/group',
											[
												'style' => [
													'spacing' => [
														'padding' => [
															'top' => '0',
															'right' => '0',
															'bottom' => '0',
															'left' => '0',
														],
														'blockGap' => 'var:preset|spacing|40',
													],
													'layout' => [
														'type' => 'constrained',
													],
												],
											],
											[
												// Heading Block for Contact
												[
													'core/heading',
													[
														'fontSize' => 'x-large',
														'level' => 2,
														'content' => 'Contact',
													],
												],
												// Tribe Event Organizer Block
												[
													'tribe/event-organizer',
												]
											],
										],
										[
											'core/group',
											[
												'style' => [
													'spacing' => [
														'padding' => [
															'top' => '0',
															'right' => '0',
															'bottom' => '0',
															'left' => '0',
														],
														'blockGap' => 'var:preset|spacing|40',
													],
													'layout' => [
														'type' => 'constrained',
													],
												],
											],
											[
												// Heading for Location
												[
													'core/heading',
													[
														'fontSize' => 'x-large',
														'level' => 2,
														'content' => 'Location',
													],
												],
												// Venue Block
												[
													'tribe/event-venue'
												],
											]
										],
										// Tribe Event Links Block
										[
											'tribe/event-links',
										],
									]
								],
							]
						],
					]
				]
			]
		]
	];

	return $template;
}, 11, 1);

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
function tribe_caes_upcoming_events_pre_render_block($pre_render, $parsed_block)
{
	$filter = function ($query) use ($parsed_block, &$filter) {
		if (!empty($parsed_block['attrs']['namespace']) && 'uga-caes-fac-2023/caes-tribe-events-list' === $parsed_block['attrs']['namespace']) {
			// get today's date
			$today = date('Y-m-d');
			// the meta key was event_date, compare to today to get event's from today or later
			$query['meta_key'] = '_EventStartDate';
			$query['meta_value'] = $today;
			$query['meta_compare'] = '>=';
			// also likely want to set order by this key in ASC so next event listed first
			$query['orderby'] = 'meta_value';
			$query['order'] = 'ASC';
		}
		remove_filter('query_loop_block_query_vars', $filter, 10, 3);
		return $query;
	};
	// Verify it's the block that should be modified using the namespace
	if (!empty($parsed_block['attrs']['namespace']) && 'uga-caes-fac-2023/caes-tribe-events-list' === $parsed_block['attrs']['namespace']) {
		add_filter('query_loop_block_query_vars', $filter, 10, 3);
	}
	return $pre_render;
}
add_filter('pre_render_block', 'tribe_caes_upcoming_events_pre_render_block', 10, 3);

// Sort by event start date in EDITOR
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
add_filter('rest_tribe_events_query', 'tribe_caes_rest_upcoming_events', 10, 2);

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
