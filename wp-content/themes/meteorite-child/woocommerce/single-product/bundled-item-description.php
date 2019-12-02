<?php
/**
 * Bundled Item Short Description template
 *
 * Override this template by copying it to 'yourtheme/woocommerce/single-product/bundled-item-description.php'.
 *
 * On occasion, this template file may need to be updated and you (the theme developer) will need to copy the new files to your theme to maintain compatibility.
 * We try to do this as little as possible, but it does happen.
 * When this occurs the version of the template file will be bumped and the readme will list any important changes.
 *
 * @version 4.2.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $description === '' ){
	return;
}

?>
<div class="bundled_product_excerpt product_excerpt" style="font-size: 18px;" align="left">
    <?php echo $description; ?>

    <p style="font-size: 14px;"><?php echo strip_tags($calories); ?></p>
    <p style="font-size: 14px;"><?php
        if(!empty($catg)){
            echo '<strong style="display: inline;">Category :</strong> '.implode(', ',$catg);
        }
        ?></p>
    <p style="font-size: 14px;"><?php
        if(!empty($Dietcatname)){
            echo '<strong style="display: inline;">Diet :</strong> '.implode(', ',$Dietcatname);
        }
        ?></p>
</div>
