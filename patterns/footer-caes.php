<?php

/**
 * Title: Footer with widget areas and CAES branding.
 * Slug: uga-caes-fac-2023/footer-caes
 * Categories: footer
 * Block Types: core/template-part/footer
 * Viewport Width: 1100
 */
?>

<!-- wp:group {"align":"full","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group alignfull"><!-- wp:group {"lock":{"move":true,"remove":true},"align":"full","backgroundColor":"base-two","className":"caes-fac-footer","layout":{"inherit":true,"type":"constrained"}} -->
    <div class="wp-block-group alignfull caes-fac-footer has-base-two-background-color has-background"><!-- wp:columns -->
        <div class="wp-block-columns"><!-- wp:column -->
            <div class="wp-block-column"></div>
            <!-- /wp:column -->

            <!-- wp:column -->
            <div class="wp-block-column"></div>
            <!-- /wp:column -->

            <!-- wp:column -->
            <div class="wp-block-column"><!-- wp:uga-caes/caes-fac-footer-brand {"lock":{"move":true,"remove":true}} /--></div>
            <!-- /wp:column -->
        </div>
        <!-- /wp:columns -->
    </div>
    <!-- /wp:group -->

    <!-- wp:group {"templateLock":"all","lock":{"move":true,"remove":true},"align":"full","style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}}},"backgroundColor":"contrast","textColor":"base","className":"caes-fac-sub-footer","layout":{"inherit":true,"type":"constrained"}} -->
    <div class="wp-block-group alignfull caes-fac-sub-footer has-base-color has-contrast-background-color has-text-color has-background has-link-color"><!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
        <div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}}} -->
            <div class="wp-block-group"><!-- wp:paragraph {"fontSize":"normal"} -->
                <p class="has-normal-font-size">Administration</p>
                <!-- /wp:paragraph -->

                <!-- wp:loginout /-->
            </div>
            <!-- /wp:group -->

            <!-- wp:group -->
            <div class="wp-block-group"><!-- wp:uga-caes/caes-fac-footer-copyright {"lock":{"move":true,"remove":true}} /--></div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:group -->
    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:group -->