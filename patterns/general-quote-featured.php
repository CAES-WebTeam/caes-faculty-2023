<?php

/**
 * Title: Featured quote with headshot.
 * Slug: uga-caes-fac-2023/general-quote-featured
 * Categories: uga-caes-fac-2023-general
 * Block Types: core/template-part/text
 * Viewport Width: 1100
 */
?>

<!-- wp:media-text {"align":"wide","mediaType":"image","backgroundColor":"primary","textColor":"background"} -->
<div class="wp-block-media-text alignwide is-stacked-on-mobile has-base-color has-primary-background-color has-text-color has-background">
    <figure class="wp-block-media-text__media"><img src="<?php echo esc_url(get_template_directory_uri()) . '/assets/images/person2.png' ?>" alt="Person's Name" /></figure>
    <div class="wp-block-media-text__content">
        <!-- wp:group {"layout":{"type":"constrained"}} -->
        <div class="wp-block-group">
            <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group">
                <!-- wp:paragraph {"style":{"typography":{"lineHeight":"1.5"}},"fontSize":"x-large"} -->
                <p class="has-x-large-font-size" style="line-height:1.5"><em><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna.</strong></em></p>
                <!-- /wp:paragraph -->

                <!-- wp:paragraph {"fontSize":"medium"} -->
                <p class="has-medium-font-size">- Person's Name</p>
                <!-- /wp:paragraph -->
            </div>
            <!-- /wp:group -->

            <!-- wp:buttons -->
            <div class="wp-block-buttons">
                <!-- wp:button {"backgroundColor":"base","textColor":"contrast"} -->
                <div class="wp-block-button"><a class="wp-block-button__link has-contrast-color has-base-background-color has-text-color has-background wp-element-button" href="#">Call to action</a></div>
                <!-- /wp:button -->
            </div>
            <!-- /wp:buttons -->
        </div>
        <!-- /wp:group -->
    </div>
</div>
<!-- /wp:media-text -->