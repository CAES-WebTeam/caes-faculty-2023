<?php
/**
 * Title: Footer with CAES branding and widget areas.
 * Slug: uga-caes-fac-2023/footer-caes-extension
 * Categories: uga-caes-fac-2023-footer
 * Block Types: core/template-part/footer
 * Viewport Width: 1280
 */
?>
<!-- wp:group {"align":"full","backgroundColor":"background-two","layout":{"inherit":true}} -->
<div class="wp-block-group alignfull has-background-two-background-color has-background">
    <!-- wp:columns {"align":"wide"} -->
    <div class="wp-block-columns alignwide">
        <!-- wp:column -->
        <div class="wp-block-column"></div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column"></div>
        <!-- /wp:column -->

        <!-- wp:column -->
        <div class="wp-block-column">
            <!-- wp:uga-caes/caes-fac-footer-brand /-->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","style":{"elements":{"link":{"color":{"text":"var:preset|color|background"}}}},"backgroundColor":"foreground","textColor":"background","layout":{"inherit":true}} -->
<div class="wp-block-group alignfull has-background-color has-foreground-background-color has-text-color has-background has-link-color">
    <!-- wp:group {"align":"wide","layout":{"type":"flex","flexWrap":"wrap","justifyContent":"space-between"}} -->
    <div class="wp-block-group alignwide">
        <!-- wp:group -->
        <div class="wp-block-group">
            <!-- wp:paragraph {"fontSize":"small"} -->
            <p class="has-small-font-size">Administration</p>
            <!-- /wp:paragraph -->

            <!-- wp:paragraph {"fontSize":"tiny"} -->
            <p class="has-tiny-font-size">Login here.</p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:group -->

        <!-- wp:group -->
        <div class="wp-block-group">
            <!-- wp:uga-caes/caes-fac-footer-copyright /-->
        </div>
        <!-- /wp:group -->
    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:group -->