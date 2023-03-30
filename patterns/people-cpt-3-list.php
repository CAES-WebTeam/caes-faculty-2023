<?php

/**
 * Title: Display a list of people's profiles. Requires using the People Profiles plugin.
 * Slug: uga-caes-fac-2023/people-cpt-3-list
 * Categories: uga-caes-fac-2023-people
 * Block Types: core/template-part/query
 * Viewport Width: 1100
 */
?>
<!-- wp:query {"query":{"perPage":"6","pages":0,"offset":0,"postType":"caes-people","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"firstorlast":"asc","lastname_az":"asc"},"displayLayout":{"type":"flex","columns":3},"namespace":"caes-people-list","className":"caes-people-profiles grid"} -->
<div class="wp-block-query caes-people-profiles grid"><!-- wp:post-template -->
    <!-- wp:columns {"verticalAlignment":"center","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|40","left":"var:preset|spacing|40"}}}} -->
    <div class="wp-block-columns are-vertically-aligned-center"><!-- wp:column {"verticalAlignment":"center","style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"},"blockGap":"0"}}} -->
        <div class="wp-block-column is-vertically-aligned-center" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:post-featured-image {"width":"150px","height":"150px","style":{"border":{"radius":"20rem"}},"className":"caes-people-profiles-img-container"} /--></div>
        <!-- /wp:column -->

        <!-- wp:column {"verticalAlignment":"center"} -->
        <div class="wp-block-column is-vertically-aligned-center"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group"><!-- wp:post-title {"textAlign":"left","isLink":true,"fontSize":"x-large"} /-->

                <!-- wp:caes-people/position-title {"align":"left"} /-->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
    <!-- /wp:post-template -->
</div>
<!-- /wp:query -->