<?php
/**
 * Variable Bundled Product template
 *
 * Override this template by copying it to 'yourtheme/woocommerce/single-product/bundled-product-variable.php'.
 *
 * On occasion, this template file may need to be updated and you (the theme developer) will need to copy the new files to your theme to maintain compatibility.
 * We try to do this as little as possible, but it does happen.
 * When this occurs the version of the template file will be bumped and the readme will list any important changes.
 *
 * @version 5.8.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
/**
 * 'woocommerce_bundled_product_add_to_cart' hook.
 *
 * Used to output content normally hooked to 'woocommerce_before_add_to_cart_button'.
 *
 * @param  int              $bundled_product_id
 * @param  WC_Bundled_Item  $bundled_item
 */
do_action( 'woocommerce_bundled_product_add_to_cart', $bundled_product_id, $bundled_item );

?><div class="single_variation_wrap bundled_item_wrap"><?php

    /**
     * 'woocommerce_bundled_single_variation' hook.
     *
     * Used to output variation data.
     *
     * @since  4.12.0
     *
     * @param  int              $bundled_product_id
     * @param  WC_Bundled_Item  $bundled_item
     *
     * @hooked wc_bundles_single_variation          - 10
     * @hooked wc_bundles_single_variation_template - 20
     */
    do_action( 'woocommerce_bundled_single_variation', $bundled_product_id, $bundled_item );

    ?></div>
