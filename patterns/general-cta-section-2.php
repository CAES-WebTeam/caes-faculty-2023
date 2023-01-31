<?php

/**
 * Title: Call to action section (alternate).
 * Slug: uga-caes-fac-2023/general-cta-section-2
 * Categories: uga-caes-fac-2023-general
 * Block Types: core/template-part/cover
 * Viewport Width: 1280
 */
?>

<!-- wp:cover {"overlayColor":"base","minHeight":450,"isDark":false,"align":"full"} -->
<div class="wp-block-cover alignfull is-light" style="min-height:450px"><span aria-hidden="true" class="wp-block-cover__background has-base-background-color has-background-dim-100 has-background-dim"></span>
    <div class="wp-block-cover__inner-container">
        <!-- wp:group {"layout":{"type":"constrained"}} -->
        <div class="wp-block-group">
            <!-- wp:columns {"verticalAlignment":"center"} -->
            <div class="wp-block-columns are-vertically-aligned-center">
                <!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
                <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%">
                    <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
                    <div class="wp-block-group">
                        <!-- wp:heading {"style":{"elements":{"link":{"color":{"text":"var:preset|color|base"}}}}} -->
                        <h2 class="has-link-color" id="protecting-our-food-crops">Title goes here</h2>
                        <!-- /wp:heading -->

                        <!-- wp:paragraph -->
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        <!-- /wp:paragraph -->

                        <!-- wp:buttons -->
                        <div class="wp-block-buttons">
                            <!-- wp:button {"backgroundColor":"primary","textColor":"base"} -->
                            <div class="wp-block-button"><a class="wp-block-button__link has-base-color has-primary-background-color has-text-color has-background wp-element-button" href="" target="_blank" rel="noreferrer noopener">Call to action</a></div>
                            <!-- /wp:button -->
                        </div>
                        <!-- /wp:buttons -->
                    </div>
                    <!-- /wp:group -->
                </div>
                <!-- /wp:column -->

                <!-- wp:column {"verticalAlignment":"center","width":"50%"} -->
                <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:50%">
                    <!-- wp:image {"id":261,"sizeSlug":"large","linkDestination":"none","className":"size-large"} -->
                    <figure class="wp-block-image size-large"><img src="<?php echo esc_url(get_template_directory_uri()) . '/assets/images/photo-placeholder.jpg' ?>" alt="" class="wp-image-261" /></figure>
                    <!-- /wp:image -->
                </div>
                <!-- /wp:column -->
            </div>
            <!-- /wp:columns -->
        </div>
        <!-- /wp:group -->
    </div>
</div>
<!-- /wp:cover -->