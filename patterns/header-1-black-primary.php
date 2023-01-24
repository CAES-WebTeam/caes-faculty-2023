<?php

/**
 * Title: Header with search, site title, and navigation.
 * Slug: uga-caes-fac-2023/header-1-black-primary
 * Categories: header
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

    <!-- wp:group {"align":"full","backgroundColor":"primary","textColor":"background","layout":{"inherit":true},"className":"caes-fac-header"} -->
    <div class="wp-block-group alignfull has-background-color has-primary-background-color has-text-color has-background caes-fac-header">
        <!-- wp:group {"layout":{"type":"flex","justifyContent":"space-between"}} -->
        <div class="wp-block-group">
            <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex"}} -->
            <div class="wp-block-group">
                <!-- wp:site-logo {"width":40} /-->

                <!-- wp:site-title {"level":0,"style":{"elements":{"link":{"color":{"text":"var:preset|color|background"}}}},"textColor":"background","className":"caes-fac-site-title"} /-->
            </div>
            <!-- /wp:group -->

            <!-- wp:navigation {"icon":"menu","className":"caes-fac-navigation-one","layout":{"type":"flex","justifyContent":"right"}} /-->
        </div>
        <!-- /wp:group -->
    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:group -->