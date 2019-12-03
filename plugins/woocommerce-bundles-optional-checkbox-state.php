<?php
/**
 * Plugin Name: WooCommerce Product Bundles - Optional Items Checked by Default
 * Plugin URI: http://woocommerce.com/products/product-bundles/
 * Description: Use this plugin to have optional bundled items checked/selected by default.
 * Version: 1.1
 * Author: SomewhereWarm
 * Author URI: http://somewherewarm.gr/
 * Developer: Manos Psychogyiopoulos
 *
 * Requires at least: 4.1
 * Tested up to: 4.9
 *
 * Copyright: © 2015 Manos Psychogyiopoulos (psyx@somewherewarm.gr).
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

add_filter( 'woocommerce_bundled_item_is_optional_checked', 'wc_pb_is_optional_item_checked', 10, 2 );
function wc_pb_is_optional_item_checked( $checked, $bundled_item ) {
    if ( ! isset( $_GET[ 'update-bundle' ] ) ) {
        $checked = true;
    }
    return $checked;
}