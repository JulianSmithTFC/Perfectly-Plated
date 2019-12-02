<?php
/**
 * Product Bundle single-product template
 *
 * Override this template by copying it to 'yourtheme/woocommerce/single-product/add-to-cart/bundle.php'.
 *
 * On occasion, this template file may need to be updated and you (the theme developer) will need to copy the new files to your theme to maintain compatibility.
 * We try to do this as little as possible, but it does happen.
 * When this occurs the version of the template file will be bumped and the readme will list any important changes.
 *
 * @version 5.5.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** WC Core action. */
do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form method="post" enctype="multipart/form-data" class="cart cart_group bundle_form <?php echo esc_attr( $classes ); ?>"><?php

	/**
	 * 'woocommerce_before_bundled_items' action.
	 *
	 * @param WC_Product_Bundle $product
	 */
	do_action( 'woocommerce_before_bundled_items', $product );

    ?>

    <div class="container-fluid">
        <div class="container menu-blockTwo-container">
            <div class="row">
                <br/>
                <br/>
                <br/>
                <div class="col-md-6">
                    <h2 class="menu-blockTwo-titles">
                        <?php echo 'Sunday & Monday'; ?>
                    </h2>
                    <hr class="menu-blockTwo-hrLines"/>
                    <?php
                    foreach ( $bundled_items as $bundled_item ) {
                        $categories = $bundled_item->product->get_categories();
                        if ((strpos($categories, 'sun-mon') !== false) && (strpos($categories, 'wed') == false)) {
                            if (strpos($categories, 'breakfast') !== false) {
                                /**
                                 * 'woocommerce_bundled_item_details' action.
                                 *
                                 * @hooked wc_pb_template_bundled_item_details_wrapper_open  -   0
                                 * @hooked wc_pb_template_bundled_item_thumbnail             -   5
                                 * @hooked wc_pb_template_bundled_item_details_open          -  10
                                 * @hooked wc_pb_template_bundled_item_title                 -  15
                                 * @hooked wc_pb_template_bundled_item_description           -  20
                                 * @hooked wc_pb_template_bundled_item_product_details       -  25
                                 * @hooked wc_pb_template_bundled_item_details_close         -  30
                                 * @hooked wc_pb_template_bundled_item_details_wrapper_close - 100
                                 */
                                do_action( 'woocommerce_bundled_item_details', $bundled_item, $product );
                            }
                            if (strpos($categories, 'lunch') !== false) {
                                /**
                                 * 'woocommerce_bundled_item_details' action.
                                 *
                                 * @hooked wc_pb_template_bundled_item_details_wrapper_open  -   0
                                 * @hooked wc_pb_template_bundled_item_thumbnail             -   5
                                 * @hooked wc_pb_template_bundled_item_details_open          -  10
                                 * @hooked wc_pb_template_bundled_item_title                 -  15
                                 * @hooked wc_pb_template_bundled_item_description           -  20
                                 * @hooked wc_pb_template_bundled_item_product_details       -  25
                                 * @hooked wc_pb_template_bundled_item_details_close         -  30
                                 * @hooked wc_pb_template_bundled_item_details_wrapper_close - 100
                                 */
                                do_action( 'woocommerce_bundled_item_details', $bundled_item, $product );
                            }
                            if (strpos($categories, 'dinner') !== false) {
                                /**
                                 * 'woocommerce_bundled_item_details' action.
                                 *
                                 * @hooked wc_pb_template_bundled_item_details_wrapper_open  -   0
                                 * @hooked wc_pb_template_bundled_item_thumbnail             -   5
                                 * @hooked wc_pb_template_bundled_item_details_open          -  10
                                 * @hooked wc_pb_template_bundled_item_title                 -  15
                                 * @hooked wc_pb_template_bundled_item_description           -  20
                                 * @hooked wc_pb_template_bundled_item_product_details       -  25
                                 * @hooked wc_pb_template_bundled_item_details_close         -  30
                                 * @hooked wc_pb_template_bundled_item_details_wrapper_close - 100
                                 */
                                do_action( 'woocommerce_bundled_item_details', $bundled_item, $product );
                            }
                            if (strpos($categories, 'kids-meals') !== false) {
                                /**
                                 * 'woocommerce_bundled_item_details' action.
                                 *
                                 * @hooked wc_pb_template_bundled_item_details_wrapper_open  -   0
                                 * @hooked wc_pb_template_bundled_item_thumbnail             -   5
                                 * @hooked wc_pb_template_bundled_item_details_open          -  10
                                 * @hooked wc_pb_template_bundled_item_title                 -  15
                                 * @hooked wc_pb_template_bundled_item_description           -  20
                                 * @hooked wc_pb_template_bundled_item_product_details       -  25
                                 * @hooked wc_pb_template_bundled_item_details_close         -  30
                                 * @hooked wc_pb_template_bundled_item_details_wrapper_close - 100
                                 */
                                do_action( 'woocommerce_bundled_item_details', $bundled_item, $product );
                            }
                            if (strpos($categories, 'snack') !== false) {
                                /**
                                 * 'woocommerce_bundled_item_details' action.
                                 *
                                 * @hooked wc_pb_template_bundled_item_details_wrapper_open  -   0
                                 * @hooked wc_pb_template_bundled_item_thumbnail             -   5
                                 * @hooked wc_pb_template_bundled_item_details_open          -  10
                                 * @hooked wc_pb_template_bundled_item_title                 -  15
                                 * @hooked wc_pb_template_bundled_item_description           -  20
                                 * @hooked wc_pb_template_bundled_item_product_details       -  25
                                 * @hooked wc_pb_template_bundled_item_details_close         -  30
                                 * @hooked wc_pb_template_bundled_item_details_wrapper_close - 100
                                 */
                                do_action( 'woocommerce_bundled_item_details', $bundled_item, $product );
                            }
                            if (strpos($categories, 'protein-box') !== false) {
                                /**
                                 * 'woocommerce_bundled_item_details' action.
                                 *
                                 * @hooked wc_pb_template_bundled_item_details_wrapper_open  -   0
                                 * @hooked wc_pb_template_bundled_item_thumbnail             -   5
                                 * @hooked wc_pb_template_bundled_item_details_open          -  10
                                 * @hooked wc_pb_template_bundled_item_title                 -  15
                                 * @hooked wc_pb_template_bundled_item_description           -  20
                                 * @hooked wc_pb_template_bundled_item_product_details       -  25
                                 * @hooked wc_pb_template_bundled_item_details_close         -  30
                                 * @hooked wc_pb_template_bundled_item_details_wrapper_close - 100
                                 */
                                do_action( 'woocommerce_bundled_item_details', $bundled_item, $product );
                            }
                        }
                    }
                    ?>
                </div>
                <div class="col-md-6 " >
                    <h2 class="menu-blockTwo-titles">
                        <?php echo 'Wednesday'; ?>
                    </h2>
                    <hr class="menu-blockTwo-hrLines"/>
                    <?php
                    foreach ( $bundled_items as $bundled_item ) {
                        $categories = $bundled_item->product->get_categories();
                        if ((strpos($categories, 'wed') !== false) && (strpos($categories, 'sun-mon') == false)) {
                            if (strpos($categories, 'breakfast') !== false) {
                                /**
                                 * 'woocommerce_bundled_item_details' action.
                                 *
                                 * @hooked wc_pb_template_bundled_item_details_wrapper_open  -   0
                                 * @hooked wc_pb_template_bundled_item_thumbnail             -   5
                                 * @hooked wc_pb_template_bundled_item_details_open          -  10
                                 * @hooked wc_pb_template_bundled_item_title                 -  15
                                 * @hooked wc_pb_template_bundled_item_description           -  20
                                 * @hooked wc_pb_template_bundled_item_product_details       -  25
                                 * @hooked wc_pb_template_bundled_item_details_close         -  30
                                 * @hooked wc_pb_template_bundled_item_details_wrapper_close - 100
                                 */
                                do_action( 'woocommerce_bundled_item_details', $bundled_item, $product );
                            }
                            if (strpos($categories, 'lunch') !== false) {
                                /**
                                 * 'woocommerce_bundled_item_details' action.
                                 *
                                 * @hooked wc_pb_template_bundled_item_details_wrapper_open  -   0
                                 * @hooked wc_pb_template_bundled_item_thumbnail             -   5
                                 * @hooked wc_pb_template_bundled_item_details_open          -  10
                                 * @hooked wc_pb_template_bundled_item_title                 -  15
                                 * @hooked wc_pb_template_bundled_item_description           -  20
                                 * @hooked wc_pb_template_bundled_item_product_details       -  25
                                 * @hooked wc_pb_template_bundled_item_details_close         -  30
                                 * @hooked wc_pb_template_bundled_item_details_wrapper_close - 100
                                 */
                                do_action( 'woocommerce_bundled_item_details', $bundled_item, $product );
                            }
                            if (strpos($categories, 'dinner') !== false) {
                                /**
                                 * 'woocommerce_bundled_item_details' action.
                                 *
                                 * @hooked wc_pb_template_bundled_item_details_wrapper_open  -   0
                                 * @hooked wc_pb_template_bundled_item_thumbnail             -   5
                                 * @hooked wc_pb_template_bundled_item_details_open          -  10
                                 * @hooked wc_pb_template_bundled_item_title                 -  15
                                 * @hooked wc_pb_template_bundled_item_description           -  20
                                 * @hooked wc_pb_template_bundled_item_product_details       -  25
                                 * @hooked wc_pb_template_bundled_item_details_close         -  30
                                 * @hooked wc_pb_template_bundled_item_details_wrapper_close - 100
                                 */
                                do_action( 'woocommerce_bundled_item_details', $bundled_item, $product );
                            }
                            if (strpos($categories, 'kids-meals') !== false) {
                                /**
                                 * 'woocommerce_bundled_item_details' action.
                                 *
                                 * @hooked wc_pb_template_bundled_item_details_wrapper_open  -   0
                                 * @hooked wc_pb_template_bundled_item_thumbnail             -   5
                                 * @hooked wc_pb_template_bundled_item_details_open          -  10
                                 * @hooked wc_pb_template_bundled_item_title                 -  15
                                 * @hooked wc_pb_template_bundled_item_description           -  20
                                 * @hooked wc_pb_template_bundled_item_product_details       -  25
                                 * @hooked wc_pb_template_bundled_item_details_close         -  30
                                 * @hooked wc_pb_template_bundled_item_details_wrapper_close - 100
                                 */
                                do_action( 'woocommerce_bundled_item_details', $bundled_item, $product );
                            }
                            if (strpos($categories, 'snack') !== false) {
                                /**
                                 * 'woocommerce_bundled_item_details' action.
                                 *
                                 * @hooked wc_pb_template_bundled_item_details_wrapper_open  -   0
                                 * @hooked wc_pb_template_bundled_item_thumbnail             -   5
                                 * @hooked wc_pb_template_bundled_item_details_open          -  10
                                 * @hooked wc_pb_template_bundled_item_title                 -  15
                                 * @hooked wc_pb_template_bundled_item_description           -  20
                                 * @hooked wc_pb_template_bundled_item_product_details       -  25
                                 * @hooked wc_pb_template_bundled_item_details_close         -  30
                                 * @hooked wc_pb_template_bundled_item_details_wrapper_close - 100
                                 */
                                do_action( 'woocommerce_bundled_item_details', $bundled_item, $product );
                            }
                            if (strpos($categories, 'protein-box') !== false) {
                                /**
                                 * 'woocommerce_bundled_item_details' action.
                                 *
                                 * @hooked wc_pb_template_bundled_item_details_wrapper_open  -   0
                                 * @hooked wc_pb_template_bundled_item_thumbnail             -   5
                                 * @hooked wc_pb_template_bundled_item_details_open          -  10
                                 * @hooked wc_pb_template_bundled_item_title                 -  15
                                 * @hooked wc_pb_template_bundled_item_description           -  20
                                 * @hooked wc_pb_template_bundled_item_product_details       -  25
                                 * @hooked wc_pb_template_bundled_item_details_close         -  30
                                 * @hooked wc_pb_template_bundled_item_details_wrapper_close - 100
                                 */
                                do_action( 'woocommerce_bundled_item_details', $bundled_item, $product );
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php

	/**
	 * 'woocommerce_after_bundled_items' action.
	 *
	 * @param  WC_Product_Bundle  $product
	 */
	do_action( 'woocommerce_after_bundled_items', $product );


    /**
     * 'woocommerce_bundles_add_to_cart_wrap' action.
     *
     * @since  5.5.0
     *
     * @param  WC_Product_Bundle  $product
     */
    do_action( 'woocommerce_bundles_add_to_cart_wrap', $product );

?></form><?php
	/** WC Core action. */
	do_action( 'woocommerce_after_add_to_cart_form' );
?>
<style>
	.product-type-bundle .price{
		width: 300px;
		border-bottom: 3px solid #81d742;
		margin: 0 auto;
	}
	.product-type-bundle .entry-summary{
		width:100% !important;
		text-align:center;
	}
	.product-type-bundle .wc-image-wrapper{
		display:none;
	}
	.product-type-bundle .woocommerce-tabs{
		display:none;
	}

</style>