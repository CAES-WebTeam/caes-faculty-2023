<?php
// Get the event categories terms from The Events Calendar plugin.
$event_categories = get_terms(array(
    'taxonomy' => 'tribe_events_cat',
    'hide_empty' => true,
    'parent' => 0, // Only top-level categories.
));

// Displays a nested list of event categories.
function display_nested_event_categories($categories) {
    echo '<ul ' . get_block_wrapper_attributes() .'>';
    foreach ($categories as $category) {
        $category_link = get_term_link($category);
        echo '<li><a href="' . esc_url($category_link) . '">' . esc_html($category->name) . '</a>';
        
        // Get child categories (if any) and recursively call the function.
        $child_categories = get_terms(array(
            'taxonomy' => 'tribe_events_cat',
            'hide_empty' => true,
            'parent' => $category->term_id,
        ));

        if (!empty($child_categories)) {
            display_nested_event_categories($child_categories);
        }

        echo '</li>';
    }
    echo '</ul>';
}

if (!empty($event_categories)) {
    display_nested_event_categories($event_categories);
} else {
    echo 'No event categories found.';
}