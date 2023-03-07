<?php

/**
 * Title: A list of posts.
 * Slug: uga-caes-fac-2023/query-list
 * Categories: uga-caes-fac-2023-query
 * Block Types: core/template-part/query
 * Viewport Width: 1100
 */
?>

<!-- wp:heading {"level":2} -->
<h2>Recent Posts</h2>
<!-- /wp:heading -->

<!-- wp:query {"query":{"perPage":"10","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false},"className":"caes-fac-query-loop-one"} -->
<div class="wp-block-query caes-fac-query-loop-one">
    <!-- wp:post-template -->

    <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","orientation":"vertical"}} -->
    <div class="wp-block-group">
        <!-- wp:post-title {"level":3,"isLink":true} /-->

        <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"flex","flexWrap":"nowrap"},"fontSize":"small"} -->
        <div class="wp-block-group has-small-font-size">
            <!-- wp:post-author {"showAvatar":false,"isLink":true} /-->

            <!-- wp:post-date /-->
        </div>
        <!-- /wp:group -->
    </div>
    <!-- /wp:group -->

    <!-- wp:spacer {"height":"1rem"} -->
    <div style="height:1rem" aria-hidden="true" class="wp-block-spacer"></div>
    <!-- /wp:spacer -->

    <!-- wp:group {"style":{"spacing":{"blockGap":"0px"}},"layout":{"type":"flex","flexWrap":"wrap"},"className":"caes-fac-query-loop-img-exp"} -->
    <div class="wp-block-group caes-fac-query-loop-img-exp">

        <!-- wp:post-featured-image {"className":"caes-fac-query-loop-img-container"} /-->

        <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"className":"caes-fac-query-loop-exp"} -->
        <div class="wp-block-group caes-fac-query-loop-exp">
            <!-- wp:post-excerpt /-->

            <!-- wp:post-terms {"term":"category","prefix":"Posted in: ","fontSize":"small"} /-->
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
</div>
<!-- /wp:query -->