<?php

/**
 * Title: Grid style post feed with full width cover background.
 * Slug: uga-caes-fac-2023/query-grid
 * Categories: uga-caes-fac-2023-query
 * Block Types: core/template-part/query
 * Viewport Width: 1280
 */
?>

<!-- wp:heading {"textAlign":"center"} -->
<h2 class="has-text-align-center">Latest Posts</h2>
<!-- /wp:heading -->

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group">
    <!-- wp:query {"query":{"perPage":"6","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"displayLayout":{"type":"flex","columns":3},"className":"caes-fac-query-loop-grid"} -->
    <div class="wp-block-query caes-fac-query-loop-grid">
        <!-- wp:post-template -->
        <!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"className":"caes-fac-query-loop-grid-item","layout":{"type":"constrained"}} -->
        <div class="wp-block-group caes-fac-query-loop-grid-item">
            <!-- wp:post-featured-image {"className":"caes-fac-query-loop-img-container"} /-->

            <!-- wp:group {"backgroundColor":"base","className":"caes-fac-query-loop-grid-info","layout":{"type":"constrained"}} -->
            <div class="wp-block-group caes-fac-query-loop-grid-info has-base-background-color has-background">
                <!-- wp:post-title {"level":3,"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|contrast-two"}}}}} /-->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:group -->
        <!-- /wp:post-template -->

        <!-- wp:buttons {"layout":{"type":"flex","justifyContent":"center"}} -->
        <div class="wp-block-buttons">
            <!-- wp:button -->
            <div class="wp-block-button"><a class="wp-block-button__link wp-element-button">See All Posts</a></div>
            <!-- /wp:button -->
        </div>
        <!-- /wp:buttons -->

        <!-- wp:query-no-results -->
        <!-- wp:paragraph {"align":"center","placeholder":"Add text or blocks that will display when a query returns no results."} -->
        <p class="has-text-align-center">There are no recent posts.</p>
        <!-- /wp:paragraph -->
        <!-- /wp:query-no-results -->
    </div>
    <!-- /wp:query -->
</div>
<!-- /wp:group -->