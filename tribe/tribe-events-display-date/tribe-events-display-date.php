<?php

/**
 * Plugin Name:       CAES Tribe Events Display Date
 * Plugin URI:        https://oit.caes.uga.edu
 * Description:       CAES custom block to display the date of an event from the Tribe Events Calendar.
 * Requires at least: 5.9
 * Requires PHP:      7.0
 * Version:           1.0.2
 * Author:            CAES OIT Web Team
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       tribe-events-caes
 *
 * @package           uga-caes
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
