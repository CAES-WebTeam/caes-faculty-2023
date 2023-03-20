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
                <?php
                $commodityLink = $attributes['commodityLink'];
                switch ($commodityLink) {
                    case true: ?>
                        <p><a href="https://www.caes.uga.edu/extension-outreach/commodities.html">Commodities at CAES</a></p>
                        <?php break; ?>
                <?php } ?>
                <button aria-controls="preheaderSearchContainer" aria-expanded="false" aria-label="Reveal search bar" id="preheaderSearchToggle"><span aria-hidden="true">Search
                    </span>
                    <svg width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M10 5C7.23858 5 5 7.23858 5 10C5 12.7614 7.23858 15 10 15C11.381 15 12.6296 14.4415 13.5355 13.5355C14.4415 12.6296 15 11.381 15 10C15 7.23858 12.7614 5 10 5ZM3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10C17 11.5719 16.481 13.0239 15.6063 14.1921L20.7071 19.2929C21.0976 19.6834 21.0976 20.3166 20.7071 20.7071C20.3166 21.0976 19.6834 21.0976 19.2929 20.7071L14.1921 15.6063C13.0239 16.481 11.5719 17 10 17C6.13401 17 3 13.866 3 10Z" />
                </button>
                <div class="search-container" id="preheaderSearchContainer" aria-hidden="true">
                    <?php get_search_form(); ?>
                </div>
            </div>
        <?php break;
        case "extension": ?>
            <div class="caes-fac-preheader-brand">
                <span>A website from <a href="https://extension.uga.edu">UGA Cooperative Extension</a></span>
            </div>
            <div class="caes-fac-preheader-right">

                <?php
                $commodityLink = $attributes['commodityLink'];
                switch ($commodityLink) {
                    case true: ?>
                        <p><a href="https://www.caes.uga.edu/extension-outreach/commodities.html">Commodities at CAES</a></p>
                        <?php break; ?>
                <?php } ?>

                <button aria-controls="preheaderSearchContainer" aria-expanded="false" aria-label="Reveal search bar" id="preheaderSearchToggle"><span aria-hidden="true">Search</span></button>
                <div class="search-container" id="preheaderSearchContainer" aria-hidden="true">
                    <?php get_search_form(); ?>
                </div>
            </div>
        <?php break;
        case "uga": ?>
            <div class="caes-fac-preheader-brand">
                <a href="https://www.uga.edu" class="caes-fac-preheader-uga"><span>University of Georgia</span></a>
            </div>
            <div class="caes-fac-preheader-right">
                <button aria-controls="preheaderSearchContainer" aria-expanded="false" aria-label="Reveal search bar" id="preheaderSearchToggle"><span aria-hidden="true">Search</span></button>
                <div class="search-container" id="preheaderSearchContainer" aria-hidden="true">
                    <?php get_search_form(); ?>
                </div>
            </div>
            <?php break; ?>
    <?php } ?>
</div>