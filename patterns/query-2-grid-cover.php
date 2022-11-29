<?php

/**
 * Title: Grid style post feed with full width cover background.
 * Slug: uga-caes-fac-2023/query-grid-cover
 * Categories: uga-caes-fac-2023-query
 * Block Types: core/template-part/query
 * Viewport Width: 1280
 */
?>

<!-- wp:cover {"overlayColor":"primary","align":"full"} -->
<div class="wp-block-cover alignfull"><span aria-hidden="true" class="wp-block-cover__background has-primary-background-color has-background-dim-100 has-background-dim"></span>
    <div class="wp-block-cover__inner-container">
        <!-- wp:heading {"textAlign":"center"} -->
        <h2 class="has-text-align-center">Latest Posts</h2>
        <!-- /wp:heading -->

        <!-- wp:group {"layout":{"type":"constrained"}} -->
        <div class="wp-block-group">
            <!-- wp:query {"query":{"perPage":"6","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"displayLayout":{"type":"flex","columns":3},"align":"wide","className":"caes-fac-query-loop-grid"} -->
            <div class="wp-block-query alignwide caes-fac-query-loop-grid">
                <!-- wp:post-template -->
                <!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"className":"caes-fac-query-loop-grid-item","layout":{"type":"constrained"}} -->
                <div class="wp-block-group caes-fac-query-loop-grid-item">
                    <!-- wp:post-featured-image {"isLink":true,"className":"caes-fac-query-loop-img-container"} /-->

                    <!-- wp:group {"backgroundColor":"background","className":"caes-fac-query-loop-grid-info","layout":{"type":"constrained"}} -->
                    <div class="wp-block-group caes-fac-query-loop-grid-info has-background-background-color has-background">
                        <!-- wp:post-title {"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|foreground-two"}}}}} /-->
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:group -->
                <!-- /wp:post-template -->

                <!-- wp:query-pagination {"paginationArrow":"chevron","layout":{"type":"flex","justifyContent":"center"}} -->
                <!-- wp:query-pagination-previous /-->

                <!-- wp:query-pagination-numbers /-->

                <!-- wp:query-pagination-next /-->
                <!-- /wp:query-pagination -->

                <!-- wp:query-no-results -->
                <!-- wp:paragraph {"align":"center","placeholder":"Add text or blocks that will display when a query returns no results."} -->
                <p class="has-text-align-center">There are no recent posts.</p>
                <!-- /wp:paragraph -->
                <!-- /wp:query-no-results -->
            </div>
            <!-- /wp:query -->
        </div>
        <!-- /wp:group -->
    </div>
</div>
<!-- /wp:cover -->