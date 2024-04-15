<?php

defined('ABSPATH') || exit;

///////////////// START EXTEND TABLE BLOCK //////////////////

/**
 * Add filter at block level to extend core table block
 * @param string $block_content
 * @param array $block
 * @return void
 */
add_filter('render_block_core/table', 'extend_core_table', 10, 2);

function extend_core_table($block_content, $block)
{
    // Return if not table block
    if ($block['blockName'] !== 'core/table') {
        return $block_content;
    }

    // Get block attributes
    $attributes = isset($block['attrs']) ? $block['attrs'] : array();
    $headerColumn = isset($attributes['headerColumn']) ? $attributes['headerColumn'] : false;
    $stickyHeaderRow = isset($attributes['stickyHeaderRow']) ? $attributes['stickyHeaderRow'] : false;
    $stickyHeaderColumn = isset($attributes['stickyHeaderColumn']) ? $attributes['stickyHeaderColumn'] : false;

    // Define classes based on attributes
    $classes = array('caes-extended-core-table');
    if ($stickyHeaderRow) {
        $classes[] = 'caes-sticky-header-row';
    }
    if ($headerColumn) {
        $classes[] = 'caes-header-column';
    }
    if ($stickyHeaderColumn) {
        $classes[] = 'caes-sticky-header-column';
    }

    // Append classes to block
    $class_string = implode(' ', $classes);
    $block_content = str_replace('class="wp-block-table', 'class="wp-block-table ' . esc_attr($class_string), $block_content);

    // Convert first column cells to header cells if headerColumn is true
    if ($headerColumn) {
        // Split the block content into rows
        $rows = explode('</tr>', $block_content);
        foreach ($rows as &$row) {
            // Split each row into cells
            $cells = explode('</td>', $row);
            if (!empty($cells)) {
                // Replace first cell with th tag
                $cells[0] = str_replace('<td', '<th scope="row" class="header-cell header-cell-column"', $cells[0]);
            }
            // Join cells back into row
            $row = implode('</td>', $cells);
        }
        // Join rows back into block content
        $block_content = implode('</tr>', $rows);
    }

    return $block_content;
}

/**
 * Enqueue frontend JavaScript
 */

function enqueue_frontend_scripts_table()
{
    wp_enqueue_script('enqueue_frontend_scripts_table', get_template_directory_uri() . '/extend-core-blocks/build/table/frontend.js', array(), '0.1.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_frontend_scripts_table');

/**
 * Add CSS at the block level
 */

function enqueue_frontend_styles_table()
{
    wp_enqueue_block_style(
        'core/table',
        array (
            'handle' => 'enqueue_frontend_styles_table',
            'src' => get_template_directory_uri() . '/extend-core-blocks/build/table/table.css',
            'version' => '0.1.0',
        )
    );
};
add_action('init', 'enqueue_frontend_styles_table');

/** 
 * Enqueue editor assets
 * 
 */

 function enqueue_editor_assets_table()
 {
     $asset_file = include plugin_dir_path(__FILE__) . '/build/table/index.asset.php';
     wp_enqueue_script(
        'enqueue_editor_assets_table',
        get_template_directory_uri() . '/extend-core-blocks/build/table/index.js',
        $asset_file['dependencies'],
        $asset_file['version']
     );
 };
 add_action('enqueue_block_editor_assets', 'enqueue_editor_assets_table');

 ///////////////// END EXTEND TABLE BLOCK //////////////////