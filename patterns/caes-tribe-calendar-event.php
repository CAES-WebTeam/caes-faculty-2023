<?php

/**
 * Title: Default event layout for "The Events Calendar" plugin.
 * Slug: uga-caes-fac-2023/caes-tribe-calendar-event
 * Categories: tribe-events
 * Block Types: core/template-part/text
 * Viewport Width: 1100
 */
?>

<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:columns {"verticalAlignment":"center","align":"full","style":{"spacing":{"blockGap":{"top":"0","left":"0"}}},"backgroundColor":"base-two"} -->
    <div class="wp-block-columns alignfull are-vertically-aligned-center has-base-two-background-color has-background"><!-- wp:column {"verticalAlignment":"center"} -->
        <div class="wp-block-column is-vertically-aligned-center"><!-- wp:post-featured-image /--></div>
        <!-- /wp:column -->

        <!-- wp:column {"verticalAlignment":"center","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","right":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"var:preset|spacing|60"}}}} -->
        <div class="wp-block-column is-vertically-aligned-center" style="padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--60)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained"}} -->
            <div class="wp-block-group"><!-- wp:post-title {"level":1} /-->

                <!-- wp:tribe/event-datetime /-->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->
</div>
<!-- /wp:group -->

<!-- wp:columns -->
<div class="wp-block-columns"><!-- wp:column {"width":"70%"} -->
    <div class="wp-block-column" style="flex-basis:70%"><!-- wp:paragraph -->
        <p>Add description here.</p>
        <!-- /wp:paragraph -->

        <!-- wp:columns -->
        <div class="wp-block-columns"><!-- wp:column -->
            <div class="wp-block-column"><!-- wp:group {"style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained"}} -->
                <div class="wp-block-group" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:heading {"fontSize":"x-large"} -->
                    <h2 class="wp-block-heading has-x-large-font-size">Location</h2>
                    <!-- /wp:heading -->

                    <!-- wp:tribe/event-venue /-->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:column -->
        </div>
        <!-- /wp:columns -->
    </div>
    <!-- /wp:column -->

    <!-- wp:column {"width":"30%"} -->
    <div class="wp-block-column" style="flex-basis:30%"><!-- wp:group {"style":{"spacing":{"padding":{"top":"0","right":"0","bottom":"0","left":"0"},"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained"}} -->
        <div class="wp-block-group" style="padding-top:0;padding-right:0;padding-bottom:0;padding-left:0"><!-- wp:heading {"fontSize":"x-large"} -->
            <h2 class="wp-block-heading has-x-large-font-size">Contact</h2>
            <!-- /wp:heading -->

            <!-- wp:tribe/event-organizer /-->
        </div>
        <!-- /wp:group -->

        <!-- wp:tribe/event-links /-->
    </div>
    <!-- /wp:column -->
</div>
<!-- /wp:columns -->