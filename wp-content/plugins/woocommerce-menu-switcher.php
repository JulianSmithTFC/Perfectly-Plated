<?php
/**
 * Plugin Name: Custom Woocommerce Menu
 * Description: This Plugin is used to create the custom menu for the website
 * Version: 1.0
 * Author: Julian Smith - Tech Fusion
 * Author URI: https://techfusionconsulting.com/
 */

$week1Array = array(
    "startWeek" => "1",
    "endWeek" => "2",
    "weekCategory" => "3",
);
// Add Shortcode
function custom_woocommerce_menu_shortcode() {
    $currentDate =
    $currentMenu = 'Menu 1';
    if ($currentMenu == 'Menu 1') {
        if (has_category(array('category_name_1', 'category_name_2'))) {

        }
    }

}
add_shortcode( 'custom_Menu', 'custom_woocommerce_menu_shortcode' );

