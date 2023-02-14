<?php

/**
 * Title: Grid list of pages on your site.
 * Slug: uga-caes-fac-2023/general-grid-pages
 * Categories: uga-caes-fac-2023-general
 * Block Types: core/template-part/cover
 * Viewport Width: 1280
 */
?>

<!-- wp:group {"align":"wide","layout":{"type":"default"}} -->
<div class="wp-block-group alignwide"><!-- wp:query {"query":{"perPage":"3","pages":0,"offset":0,"postType":"page","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"displayLayout":{"type":"flex","columns":3},"className":"caes-fac-query-loop-grid"} -->
    <div class="wp-block-query caes-fac-query-loop-grid"><!-- wp:post-template -->
        <!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"className":"caes-fac-query-loop-grid-item","layout":{"type":"constrained"}} -->
        <div class="wp-block-group caes-fac-query-loop-grid-item"><!-- wp:post-featured-image {"className":"caes-fac-query-loop-img-container"} /-->

            <!-- wp:group {"backgroundColor":"base","className":"caes-fac-query-loop-grid-info","layout":{"type":"constrained"}} -->
            <div class="wp-block-group caes-fac-query-loop-grid-info has-base-background-color has-background"><!-- wp:post-title {"level":3,"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|contrast-two"}}}}} /--></div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:group -->
        <!-- /wp:post-template -->
    </div>
    <!-- /wp:query -->
</div>
<!-- /wp:group -->