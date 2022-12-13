<div <?php echo get_block_wrapper_attributes(); ?>>

    <?php
    $brand = $attributes['brandEntity'];
    $year = date("Y"); 
    switch ($brand) {
        case "caes": ?>
            <p class="has-tiny-font-size">The University of Georgia <a href="https://www.caes.uga.edu/">College of Agricultural and Environmental Sciences</a> © 2012-<?php echo $year ?>. All Rights Reserved.<br>The <a href="https://www.uga.edu">University of Georgia</a> is an Equal Opportunity, Affirmative Action, Veteran, Disability Institution.<br><a href="https://eits.uga.edu/access_and_security/infosec/pols_regs/policies/privacy/">Privacy Policy</a> | <a href="https://www.caes.uga.edu/accessibility.html">Accessibility Policy</a></p>
        <?php break;
        case "extension": ?>
            <p class="has-tiny-font-size"><a href="https://extension.uga.edu">UGA Extension</a> © 2012-<?php echo $year ?>. All Rights Reserved.<br>The <a href="https://www.uga.edu">University of Georgia</a> is an Equal Opportunity, Affirmative Action, Veteran, Disability Institution.<br><a href="https://eits.uga.edu/access_and_security/infosec/pols_regs/policies/privacy/">Privacy Policy</a> | <a href="https://www.caes.uga.edu/accessibility.html">Accessibility Policy</a></p>
            <?php break; ?>
    <?php } ?>

</div>