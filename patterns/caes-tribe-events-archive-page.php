<?php

/**
 * Title: Alternate events archive layout for "The Events Calendar" archive and category pages.
 * Slug: uga-caes-fac-2023/caes-tribe-events-archive-page
 * Categories: tribe-events
 * Block Types: tec/archive-events
 * Viewport Width: 1100
 */
?>

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:columns -->
    <div class="wp-block-columns"><!-- wp:column {"width":"75%"} -->
        <div class="wp-block-column" style="flex-basis:75%"><!-- wp:query-title {"type":"archive","showPrefix":false} /-->

            <!-- wp:query {"query":{"perPage":10,"pages":0,"offset":0,"postType":"tribe_events","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true},"namespace":"uga-caes-fac-2023/caes-tribe-events-list","className":"caes-fac-query-loop-one"} -->
            <div class="wp-block-query caes-fac-query-loop-one"><!-- wp:post-template -->
                <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","orientation":"vertical"}} -->
                <div class="wp-block-group"><!-- wp:post-title {"level":3,"isLink":true} /-->

                    <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"flex","flexWrap":"nowrap"},"fontSize":"normal"} -->
                    <div class="wp-block-group has-normal-font-size"><!-- wp:uga-caes/tribe-events-display-date /--></div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:group -->

                <!-- wp:spacer {"height":"1rem"} -->
                <div style="height:1rem" aria-hidden="true" class="wp-block-spacer"></div>
                <!-- /wp:spacer -->

                <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","flexWrap":"wrap"},"className":"caes-fac-query-loop-img-exp"} -->
                <div class="wp-block-group caes-fac-query-loop-img-exp">

                    <!-- wp:post-featured-image {"aspectRatio":"auto","width":"","className":"caes-fac-query-loop-img-container"} /-->

                    <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"className":"caes-fac-query-loop-exp"} -->
                    <div class="wp-block-group caes-fac-query-loop-exp">
                        <!-- wp:post-excerpt /-->

                        <!-- wp:post-terms {"term":"category","prefix":"Posted in: ","fontSize":"small"} /-->
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:group -->
                <!-- /wp:post-template -->

                <!-- wp:query-pagination -->
                <!-- wp:query-pagination-previous /-->

                <!-- wp:query-pagination-numbers /-->

                <!-- wp:query-pagination-next /-->
                <!-- /wp:query-pagination -->

                <!-- wp:query-no-results -->
                <!-- wp:paragraph {"placeholder":"Add text or blocks that will display when a query returns no results."} -->
                <p>There are no currently scheduled upcoming events.</p>
                <!-- /wp:paragraph -->
                <!-- /wp:query-no-results -->
            </div>
            <!-- /wp:query -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"width":"25%"} -->
        <div class="wp-block-column" style="flex-basis:25%"><!-- wp:heading -->
            <h2 class="wp-block-heading">Event Categories</h2>
            <!-- /wp:heading -->

            <!-- wp:uga-caes/tribe-events-categories-list /-->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->

    <!-- wp:spacer {"height":"10px"} -->
    <div style="height:10px" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->
</div>
<!-- /wp:group -->