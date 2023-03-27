<?php

/**
 * Title: Display a grid of people's profiles. Requires using the People Profiles plugin.
 * Slug: uga-caes-fac-2023/people-cpt-2-grid
 * Categories: uga-caes-fac-2023-people
 * Block Types: core/template-part/query
 * Viewport Width: 1100
 */
?>

<!-- wp:query {"query":{"perPage":"6","pages":0,"offset":0,"postType":"caes-people","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"firstorlast":"asc","lastname_az":"asc"},"displayLayout":{"type":"flex","columns":3},"namespace":"caes-people-list","className":"caes-people-profiles grid"} -->
<div class="wp-block-query caes-people-profiles grid"><!-- wp:post-template -->
    <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained"}} -->
    <div class="wp-block-group"><!-- wp:post-featured-image {"width":"250px","height":"250px","style":{"border":{"radius":"20rem"}},"className":"caes-people-profiles-img-container"} /-->

        <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"constrained"}} -->
        <div class="wp-block-group"><!-- wp:post-title {"textAlign":"center","isLink":true,"fontSize":"x-large"} /-->

            <!-- wp:caes-people/position-title /-->
        </div>
        <!-- /wp:group -->
    </div>
    <!-- /wp:group -->
    <!-- /wp:post-template -->
</div>
<!-- /wp:query -->