<?php

/**
 * Title: Header with search, site title, and navigation.
 * Slug: uga-caes-fac-2023/header-3-black-white
 * Categories:header
 * Block Types: core/template-part/header
 * Viewport Width: 1280
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull">
    <!-- wp:group {"templateLock":"all","lock":{"move":true,"remove":true},"align":"full","backgroundColor":"foreground","textColor":"background","layout":{"inherit":true},"className":"caes-fac-preheader"} -->
    <div class="wp-block-group alignfull has-background-color has-foreground-background-color has-text-color has-background caes-fac-preheader">
        <!-- wp:uga-caes/caes-fac-preheader-brand /-->
    </div>
    <!-- /wp:group -->

    <!-- wp:group {"align":"full","style":{"elements":{"link":{"color":{"text":"var:preset|color|foreground"}}}},"backgroundColor":"background","textColor":"foreground","className":"caes-fac-header","layout":{"inherit":true,"type":"constrained"}} -->
    <div class="wp-block-group alignfull caes-fac-header has-foreground-color has-background-background-color has-text-color has-background has-link-color">
        <!-- wp:group {"align":"wide","layout":{"type":"flex","justifyContent":"space-between"}} -->
        <div class="wp-block-group alignwide">
            <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex"}} -->
            <div class="wp-block-group">
                <!-- wp:site-logo {"width":40} /-->

                <!-- wp:site-title {"level":0,"className":"caes-fac-site-title"} /-->
            </div>
            <!-- /wp:group -->

            <!-- wp:navigation {"ref":34,"icon":"menu","overlayBackgroundColor":"foreground-two","overlayTextColor":"background","className":"caes-fac-navigation-one","layout":{"type":"flex","setCascadingProperties":true,"justifyContent":"right"}} /-->
        </div>
        <!-- /wp:group -->
    </div>
    <!-- /wp:group -->

</div>
<!-- /wp:group -->