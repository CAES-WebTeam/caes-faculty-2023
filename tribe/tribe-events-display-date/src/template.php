<?php

global $post;
$eventStartDate = get_post_meta($post->ID, '_EventStartDate', true);
$eventEndDate = get_post_meta($post->ID, '_EventEndDate', true);
$align = $attributes['align'];

if (!empty($eventStartDate)) {
    $startDateTime = new DateTime($eventStartDate);
    $endDateTime = new DateTime($eventEndDate);

    $formattedDate = '';

    // Start year and end year
    $startYear = $startDateTime->format('Y');
    $endYear = $endDateTime->format('Y');

    // Start month and end month
    $startMonth = $startDateTime->format('m');
    $endMonth = $endDateTime->format('m');

    // Start day and end day
    $startDay = $startDateTime->format('j');
    $endDay = $endDateTime->format('j');

    // Current year
    $currentYear = date('Y');

    if ($startYear === $endYear && $startMonth === $endMonth && $startDay === $endDay) {
        $formattedDate = $startDateTime->format('M j, Y');
    }
    elseif ($startYear === $endYear && $startMonth !== $endMonth || $startYear === $endYear && $startDay !== $endDay) {
        $formattedDate = $startDateTime->format('M j') . ' - ' . $endDateTime->format('M j, Y');
    }
    else {
        $formattedDate = $startDateTime->format('M j, Y') . ' - ' . $endDateTime->format('M j, Y');
    }

    echo '<time class="wp-block-uga-caes-tribe-events-display-date">' . $formattedDate . '</time>';
}
