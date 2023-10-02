<?php

/**
 * Title: Default event layout for "The Events Calendar" plugin.
 * Slug: uga-caes-fac-2023/caes-tribe-events-list
 * Categories: tribe-events
 * Block Types: core/query/uga-caes-fac-2023/caes-tribe-events-list
 * Viewport Width: 1100
 */
?>

<!-- wp:heading {"textAlign":"center"} -->
<h2 class="wp-block-heading has-text-align-center">Upcoming Events</h2>
<!-- /wp:heading -->

<!-- wp:query {"query":{"perPage":"3","pages":0,"offset":0,"postType":"tribe_events","inherit":false},"displayLayout":{"type":"flex","columns":3},"namespace":"uga-caes-fac-2023/caes-tribe-events-list","className":"caes-fac-query-loop-grid","layout":{"type":"default"}} -->
<div class="wp-block-query caes-fac-query-loop-grid"><!-- wp:post-template -->
    <!-- wp:group {"className":"caes-fac-query-loop-grid-item","layout":{"type":"default"}} -->
    <div class="wp-block-group caes-fac-query-loop-grid-item"><!-- wp:post-featured-image {"className":"caes-fac-query-loop-img-container"} /-->

        <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"backgroundColor":"base","className":"caes-fac-query-loop-grid-info","layout":{"type":"default"}} -->
        <div class="wp-block-group caes-fac-query-loop-grid-info has-base-background-color has-background"><!-- wp:post-title {"level":3,"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|contrast"}}}}} /-->

            <!-- wp:uga-caes/tribe-events-display-date /-->
        </div>
        <!-- /wp:group -->
        
    </div>
    <!-- /wp:group -->
    <!-- /wp:post-template -->

    <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
    <div class="wp-block-buttons"><!-- wp:button -->
        <div class="wp-block-button"><a class="wp-block-button__link wp-element-button">See All Events</a></div>
        <!-- /wp:button -->
    </div>
    <!-- /wp:buttons -->

    <!-- wp:query-no-results -->
    <!-- wp:paragraph {"align":"center","placeholder":"Add text or blocks that will display when a query returns no results."} -->
    <p class="has-text-align-center">There are no upcoming events.</p>
    <!-- /wp:paragraph -->
    <!-- /wp:query-no-results -->
</div>
<!-- /wp:query -->