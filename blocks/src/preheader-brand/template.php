<div <?php echo get_block_wrapper_attributes(); ?>>
    <?php
    $brand = $attributes['brandEntity'];
    switch ($brand) {
        case "caes": ?>
            <div class="caes-fac-preheader-brand">
                <a href="https://www.uga.edu" class="caes-fac-preheader-uga"><span>University of Georgia</span></a>
            </div>
            <div class="caes-fac-preheader-right">
                <p>A website from the <a href="https://www.caes.uga.edu">College of Agricultural and Environmental Sciences</a></p>
                <button aria-controls="preheaderSearchContainer" aria-expanded="false" aria-label="Reveal search bar" id="preheaderSearchToggle"><span aria-hidden="true">Search</span></button>
                <div class="search-container" id="preheaderSearchContainer" aria-hidden="true">
                    <?php get_search_form(); ?>
                </div>
            </div>
        <?php break;
        case "extension": ?>
            <div class="caes-fac-preheader-left">
                <p>A website from <a href="https://extension.uga.edu">UGA Cooperative Extension</a></p>
                <button aria-controls="preheaderSearchContainer" aria-expanded="false" aria-label="Reveal search bar" id="preheaderSearchToggle"><span aria-hidden="true">Search</span></button>
                <div class="search-container" id="preheaderSearchContainer" aria-hidden="true">
                    <?php get_search_form(); ?>
                </div>
            </div>
            <?php break; ?>
    <?php } ?>
</div>