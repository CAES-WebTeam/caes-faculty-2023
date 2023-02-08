<?php

/**
 * Title: Feature a post with full width cover background.
 * Slug: uga-caes-fac-2023/query-featured-cover
 * Categories: uga-caes-fac-2023-query
 * Block Types: core/template-part/query
 * Viewport Width: 1280
 */
?>


<!-- wp:cover {"overlayColor":"secondary","align":"full"} -->
<div class="wp-block-cover alignfull"><span aria-hidden="true" class="wp-block-cover__background has-secondary-background-color has-background-dim-100 has-background-dim"></span>
    <div class="wp-block-cover__inner-container">
        <!-- wp:query {"query":{"perPage":"1","pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"taxQuery":null,"parents":[]},"className":"caes-fac-query-loop-featured","layout":{"type":"constrained"}} -->
        <div class="wp-block-query caes-fac-query-loop-featured">
            <!-- wp:post-template -->
            <!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
            <div class="wp-block-columns are-vertically-aligned-center" style="margin-top:0;margin-bottom:0">
                <!-- wp:column {"verticalAlignment":"center","width":"60%"} -->
                <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:60%">
                    <!-- wp:post-featured-image {"className":"caes-fac-query-loop-featured-img-container"} /-->
                </div>
                <!-- /wp:column -->

                <!-- wp:column {"verticalAlignment":"center","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","right":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"var:preset|spacing|60"}}},"backgroundColor":"base","textColor":"primary","className":"caes-fac-query-loop-featured-info"} -->
                <div class="wp-block-column is-vertically-aligned-center caes-fac-query-loop-featured-info has-primary-color has-base-background-color has-text-color has-background" style="padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--60)">
                    <!-- wp:post-title {"isLink":true} /-->

                    <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between","verticalAlignment":"bottom"}} -->
                    <div class="wp-block-group">
                        <!-- wp:post-author {"showAvatar":false,"byline":"Written by","textColor":"contrast-two"} /-->

                        <!-- wp:post-date {"textColor":"contrast-two"} /-->
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:column -->
            </div>
            <!-- /wp:columns -->
            <!-- /wp:post-template -->
        </div>
        <!-- /wp:query -->
    </div>
</div>
<!-- /wp:cover -->