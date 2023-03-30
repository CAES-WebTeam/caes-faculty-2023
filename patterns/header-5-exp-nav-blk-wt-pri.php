<?php

/**
 * Title: Header with search, site title, and navigation. Nav is on its own row for desktop.
 * Slug: uga-caes-fac-2023/header-5-exp-nav-blk-wt-pri
 * Categories: header
 * Block Types: core/template-part/header
 * Viewport Width: 1100
 */
?>
<!-- wp:group {"align":"full","style":{"spacing":{"blockGap":"0"}},"layout":{"type":"default"}} -->
<div class="wp-block-group alignfull"><!-- wp:group {"lock":{"move":true,"remove":true},"align":"full","backgroundColor":"contrast","className":"has-base-color has-text-color caes-fac-preheader","layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignfull has-base-color has-text-color caes-fac-preheader has-contrast-background-color has-background"><!-- wp:uga-caes/caes-fac-preheader-brand /--></div>
    <!-- /wp:group -->

    <!-- wp:group {"templateLock":"all","lock":{"move":true,"remove":true},"align":"full","style":{"elements":{"link":{"color":{"text":"var:preset|color|contrast"}}},"spacing":{"padding":{"top":"var:preset|spacing|50","right":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50"}}},"backgroundColor":"base","textColor":"contrast","className":"caes-fac-header","layout":{"inherit":true,"type":"constrained"}} -->
    <div class="wp-block-group alignfull caes-fac-header has-contrast-color has-base-background-color has-text-color has-background has-link-color" style="padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)"><!-- wp:group {"templateLock":false,"lock":{"move":false,"remove":false},"layout":{"type":"flex","justifyContent":"space-between"}} -->
        <div class="wp-block-group"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex"}} -->
            <div class="wp-block-group"><!-- wp:site-logo {"width":40} /-->

                <!-- wp:group {"style":{"spacing":{"blockGap":"0"}},"layout":{"type":"flex","orientation":"vertical"}} -->
                <div class="wp-block-group"><!-- wp:site-title {"level":0,"className":"caes-fac-site-title"} /-->

                    <!-- wp:site-tagline /-->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:group -->
    </div>
    <!-- /wp:group -->

    <!-- wp:group {"lock":{"move":true,"remove":true},"align":"full","backgroundColor":"primary","className":"caes-fac-navigation-two has-base-color has-text-color","layout":{"type":"constrained"}} -->
    <div class="wp-block-group alignfull caes-fac-navigation-two has-base-color has-text-color has-primary-background-color has-background"><!-- wp:group {"layout":{"type":"flex","justifyContent":"space-between"}} -->
        <div class="wp-block-group"><!-- wp:navigation {"icon":"menu","className":"caes-fac-navigation-one","layout":{"type":"flex","justifyContent":"left"},"style":{"spacing":{"blockGap":"var:preset|spacing|50"}}} /--></div>
        <!-- /wp:group -->
    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:group -->