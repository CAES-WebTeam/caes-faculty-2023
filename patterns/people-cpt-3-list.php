<?php

/**
 * Title: Display a list of people's profiles. Requires using the People Profiles plugin.
 * Slug: uga-caes-fac-2023/people-cpt-3-list
 * Categories: uga-caes-fac-2023-people
 * Block Types: core/template-part/query
 * Viewport Width: 1100
 */
?>
<!-- wp:query {"query":{"perPage":6,"pages":0,"offset":0,"postType":"caes-people","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":false,"lastname_az":"asc"},"displayLayout":{"type":"flex","columns":2},"namespace":"caes-people-profiles","className":"caes-people-profiles list"} -->
<div class="wp-block-query caes-people-profiles list"><!-- wp:post-template -->
    <!-- wp:columns -->
    <div class="wp-block-columns"><!-- wp:column {"width":"33.33%","className":"caes-people-profiles-group"} -->
        <div class="wp-block-column caes-people-profiles-group" style="flex-basis:33.33%"><!-- wp:post-featured-image {"width":"150px","height":"150px","style":{"border":{"radius":"100px"}}} /--></div>
        <!-- /wp:column -->

        <!-- wp:column {"verticalAlignment":"center","width":"66.66%"} -->
        <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:66.66%"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|20"}},"layout":{"type":"flex","orientation":"vertical"}} -->
            <div class="wp-block-group"><!-- wp:post-title {"isLink":true,"fontSize":"x-large"} /-->

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