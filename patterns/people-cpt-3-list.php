<?php

/**
 * Title: Display a list of people's profiles. Requires using the People Profiles plugin.
 * Slug: uga-caes-fac-2023/people-cpt-3-list
 * Categories: uga-caes-fac-2023-people
 * Block Types: core/template-part/query
 * Viewport Width: 1100
 */
?>
<!-- wp:query {"query":{"perPage":"6","pages":0,"offset":0,"postType":"caes-people","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"firstorlast":"asc"},"displayLayout":{"type":"flex","columns":2},"namespace":"caes-people-list","className":"caes-people-profiles"} -->
<div class="wp-block-query caes-people-profiles"><!-- wp:post-template -->
    <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
    <div class="wp-block-group"><!-- wp:post-featured-image {"width":"150px","height":"150px","style":{"border":{"radius":"20rem"}},"className":"caes-people-profiles-img-container"} /-->

        <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","orientation":"vertical"}} -->
        <div class="wp-block-group"><!-- wp:post-title {"isLink":true,"fontSize":"x-large"} /-->

            <!-- wp:paragraph -->
            <p>Position Title</p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:group -->
    </div>
    <!-- /wp:group -->
    <!-- /wp:post-template -->
</div>
<!-- /wp:query -->