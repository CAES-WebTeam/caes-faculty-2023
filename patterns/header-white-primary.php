<?php

/**
 * Title: Header with search, site title, and navigation.
 * Slug: uga-caes-fac-2023/header-white-primary
 * Categories: uga-caes-fac-2023-header
 * Block Types: core/template-part/header
 * Viewport Width: 1280
 */
?>

<!-- wp:group {"align":"full","backgroundColor":"background","textColor":"foreground","layout":{"inherit":true},"className":"caes-fac-preheader"} -->
<div class="wp-block-group alignfull has-background-color has-background-background-color has-foreground-color has-text-color has-background caes-fac-preheader">
    <!-- wp:group {"align":"wide","layout":{"type":"flex","justifyContent":"space-between"}} -->
    <div class="wp-block-group alignwide">
        <!-- wp:group -->
        <div class="wp-block-group">
            <!-- wp:image {"width":148,"height":8,"linkDestination":"custom", "className":"caes-fac-preheader-uga-logo"} -->
            <figure class="wp-block-image caes-fac-preheader-uga-logo"><a href="https://www.uga.edu"><img src="<?php echo esc_url(get_template_directory_uri()) . '/assets/images/GEORGIA-HW-1CB.svg'; ?>" alt="<?php echo esc_attr__('University of Georgia', 'caes-faculty-2023'); ?>" width="148" height="8" /></a></figure>
            <!-- /wp:image -->
        </div>
        <!-- /wp:group -->

        <!-- wp:group {"layout":{"type":"flex","flexWrap":"nowrap"}} -->
        <div class="wp-block-group">
            <!-- wp:paragraph {"fontSize":"tiny"} -->
            <p class="has-tiny-font-size">A website from the College of Agricultural and Environmental Sciences</p>
            <!-- /wp:paragraph -->

            <!-- wp:paragraph {"fontSize":"tiny"} -->
            <p class="has-tiny-font-size">Search goes here</p>
            <!-- /wp:paragraph -->
        </div>
        <!-- /wp:group -->
    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:group -->

<!-- wp:group {"align":"full","backgroundColor":"primary","textColor":"background","layout":{"inherit":true},"className":"caes-fac-header"} -->
<div class="wp-block-group alignfull has-background-color has-primary-background-color has-text-color has-background caes-fac-header">
    <!-- wp:group {"align":"wide","layout":{"type":"flex","justifyContent":"space-between"}} -->
    <div class="wp-block-group alignwide">
        <!-- wp:group {"layout":{"type":"flex"}} -->
        <div class="wp-block-group">
            <!-- wp:site-logo {"width":40} /-->

            <!-- wp:site-title {"level":0,"style":{"elements":{"link":{"color":{"text":"var:preset|color|background"}}}},"textColor":"background","fontSize":"medium","className":"caes-fac-site-title"} /-->
        </div>
        <!-- /wp:group -->

        <!-- wp:navigation /-->
    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:group -->