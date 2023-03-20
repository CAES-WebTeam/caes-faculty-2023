<?php

/**
 * Title: Display people's profiles as cards. Requires using the People Profiles plugin.
 * Slug: uga-caes-fac-2023/people-cpt-1-cards
 * Categories: uga-caes-fac-2023-people
 * Block Types: core/template-part/query
 * Viewport Width: 1100
 */
?>

<!-- wp:query {"queryId":9,"query":{"perPage":"6","pages":0,"offset":0,"postType":"caes-people","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"firstorlast":"asc"},"displayLayout":{"type":"flex","columns":2},"namespace":"caes-people-list","className":"grid-items personnel"} -->
<div class="wp-block-query grid-items personnel"><!-- wp:post-template -->
    <!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"className":"grid-item","layout":{"type":"flex","flexWrap":"nowrap"}} -->
    <div class="wp-block-group grid-item"><!-- wp:post-featured-image {"className":"grid-item-img-container"} /-->

        <!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|40","right":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40"}}},"className":"grid-item-grid-info","layout":{"type":"default"}} -->
        <div class="wp-block-group grid-item-grid-info" style="padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","orientation":"vertical"}} -->
            <div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","orientation":"vertical"}} -->
                <div class="wp-block-group"><!-- wp:post-title {"isLink":true,"fontSize":"x-large"} /-->

                    <!-- wp:paragraph -->
                    <p><strong>Position Title</strong></p>
                    <!-- /wp:paragraph -->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:group -->
    </div>
    <!-- /wp:group -->
    <!-- /wp:post-template -->
</div>
<!-- /wp:query -->