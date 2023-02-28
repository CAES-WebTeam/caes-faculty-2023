<?php

/**
 * Title: Feature a post.
 * Slug: uga-caes-fac-2023/query-featured
 * Categories: uga-caes-fac-2023-query
 * Block Types: core/template-part/query
 * Viewport Width: 1100
 */
?>

<!-- wp:query {"className":"caes-fac-query-loop-featured","query":{"perPage":"1","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false}} -->
<div class="wp-block-query caes-fac-query-loop-featured">
    <!-- wp:post-template -->
    <!-- wp:columns {"verticalAlignment":"center"} -->
    <div class="wp-block-columns are-vertically-aligned-center">

        <!-- wp:column {"verticalAlignment":"center","width":"60%"} -->
        <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:60%">
            <!-- wp:post-featured-image {"className":"caes-fac-query-loop-featured-img-container"} /-->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"className":"caes-fac-query-loop-featured-info","verticalAlignment":"center","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","right":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"var:preset|spacing|60"}}},"backgroundColor":"base-two"} -->
        <div class="wp-block-column is-vertically-aligned-center has-base-two-background-color has-background caes-fac-query-loop-featured-info" style="padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--60)">
            <!-- wp:post-title {"isLink":true} /-->

            <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between","verticalAlignment":"bottom"}} -->
            <div class="wp-block-group">
                <!-- wp:post-author {"showAvatar":false,"isLink":true,"byline":"Written by"} /-->

                <!-- wp:post-date /-->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
    <!-- /wp:post-template -->
</div>
<!-- /wp:query -->