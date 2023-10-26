<?php

/**
 * Plugin Name:       Tribe Events Categories List
 * Plugin URI:        https://oit.caes.uga.edu
 * Description:       CAES custom block to display a list of event categories from the Tribe Events Calendar.
 * Requires at least: 6.1
 * Requires PHP:      7.0
 * Version:           1.0.0
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