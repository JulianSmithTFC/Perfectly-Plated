<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );

if ( !function_exists( 'chld_thm_cfg_parent_css' ) ):
    function chld_thm_cfg_parent_css() {
        wp_enqueue_style( 'chld_thm_cfg_parent', trailingslashit( get_template_directory_uri() ) . 'style.css', array( 'meteorite-bootstrap' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'chld_thm_cfg_parent_css', 10 );

// END ENQUEUE PARENT ACTION

function register_acf_options_pages() {

    if( function_exists('acf_add_options_page') ) {

        acf_add_options_page(array(
            'page_title' 	=> 'Theme General Settings',
            'menu_title'	=> 'Theme Settings',
            'menu_slug' 	=> 'theme-general-settings',
            'capability'	=> 'edit_posts',
            'redirect'		=> false
        ));

        acf_add_options_sub_page(array(
            'page_title' 	=> 'Thanksgiving Menu Settings',
            'menu_title'	=> 'Thanksgiving Menu Settings',
            'menu_slug' => 'thanksgiving-menu-options',
            'parent_slug'	=> 'theme-general-settings',
        ));

    }
}

// Hook into acf initialization.
add_action('acf/init', 'register_acf_options_pages');




//Font Awesome CDN
wp_register_style( 'Font_Awesome', 'https://use.fontawesome.com/releases/v5.8.1/css/all.css' );
wp_enqueue_style('Font_Awesome');



/**
 * Remove related products output
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );


/********************************Code for special instrucation*********************************/
/*
 * Display input on single product page
 */
function ozone_special_instruction(){
    $value = isset( $_POST['_special_instruction'] ) ? sanitize_text_field( $_POST['_special_instruction'] ) : '';
    printf( '<label>%s</label><textarea name="_special_instruction" />%s</textarea>', __( 'Special Instrucation', 'kia-plugin-textdomain' ), esc_attr( $value ) );
    echo '<div style="clear:both;"></div><br/>';
}
add_action( 'woocommerce_before_add_to_cart_button', 'ozone_special_instruction', 9 );

/*
* Add custom data to the cart item
*/
function ozone_special_instruction_add_cart_item_data( $cart_item, $product_id ){

    if( isset( $_POST['_special_instruction'] ) ) {
        $cart_item['Special Instruction'] = sanitize_text_field( $_POST['_special_instruction'] );
    }
    return $cart_item;
}
add_filter( 'woocommerce_add_cart_item_data', 'ozone_special_instruction_add_cart_item_data', 10, 2 );

/*
 * Load cart data from session
 */
function ozone_special_instruction_get_cart_item_from_session( $cart_item, $values ) {

    if ( isset( $values['Special Instruction'] ) ){
        $cart_item['Special Instruction'] = $values['Special Instruction'];
    }
    return $cart_item;
}
add_filter( 'woocommerce_get_cart_item_from_session', 'ozone_special_instruction_get_cart_item_from_session', 20, 2 );

/*
 * Add meta to order item
 */
function ozone_special_instruction_add_order_item_meta( $item_id, $values ) {

    if ( ! empty( $values['Special Instruction'] ) ) {
        wc_add_order_item_meta( $item_id, 'Special Instruction', $values['Special Instruction'] );
    }
}
add_action( 'woocommerce_add_order_item_meta', 'ozone_special_instruction_add_order_item_meta', 10, 2 );

/*
 * Get item data to display in cart
 */
function ozone_special_instruction_get_item_data( $other_data, $cart_item ) {

    if ( isset( $cart_item['Special Instruction'] ) ){
        $other_data[] = array(
            'name' => __( 'Special Instruction', 'kia-plugin-textdomain' ),
            'value' => sanitize_text_field( $cart_item['Special Instruction'] )
        );
    }
    return $other_data;

}
add_filter( 'woocommerce_get_item_data', 'ozone_special_instruction_get_item_data', 10, 2 );

/*
 * Show custom field in order overview
 */
function ozone_special_instruction_order_item_product( $cart_item, $order_item ){

    if( isset( $order_item['Special Instruction'] ) ){
        $cart_item_meta['Special Instruction'] = $order_item['Special Instruction'];
    }
    return $cart_item;

}
add_filter( 'woocommerce_order_item_product', 'ozone_special_instruction_order_item_product', 10, 2 );

/*
 * Add the field to order emails
 */
function ozone_special_instruction_email_order_meta_fields( $fields ) {
    $fields['custom_field'] = __( 'Special Instruction', 'ozone-special-instruction' );
    return $fields;
}
add_filter('woocommerce_email_order_meta_fields', 'ozone_special_instruction_email_order_meta_fields');

/*
 * Order Again
 */
function ozone_special_instruction_order_again_cart_item_data( $cart_item, $order_item, $order ){

    if( isset( $order_item['Special Instruction'] ) ){
        $cart_item_meta['Special Instruction'] = $order_item['Special Instruction'];
    }
    return $cart_item;

}
add_filter( 'woocommerce_order_again_cart_item_data', 'ozone_special_instruction_order_again_cart_item_data', 10, 3 );


/**
 * Notify admin when a new customer account is created
 */
add_action( 'woocommerce_created_customer', 'woocommerce_created_customer_admin_notification' );
function woocommerce_created_customer_admin_notification( $customer_id ) {
    wp_send_new_user_notifications( $customer_id, 'admin' );
}


/**
 * Prevent PO box shipping
 */
add_action('woocommerce_after_checkout_validation', 'deny_pobox_postcode');

function deny_pobox_postcode( $posted ) {
    global $woocommerce;

    $address  = ( isset( $posted['shipping_address_1'] ) ) ? $posted['shipping_address_1'] : $posted['billing_address_1'];
    $postcode = ( isset( $posted['shipping_postcode'] ) ) ? $posted['shipping_postcode'] : $posted['billing_postcode'];

    $replace  = array(" ", ".", ",");
    $address  = strtolower( str_replace( $replace, '', $address ) );
    $postcode = strtolower( str_replace( $replace, '', $postcode ) );

    if ( strstr( $address, 'pobox' ) || strstr( $postcode, 'pobox' ) ) {
        wc_add_notice( sprintf( __( "Sorry, we cannot ship to PO BOX addresses.") ) ,'error' );
    }
}




/************** Apply shipping rate based on production variation ***************/
function shipping_method_based_on_variation( $rates, $package ){
    global $woocommerce;
    $items = $woocommerce->cart->get_cart();

    foreach($items as $item => $values) {
        if($values['variation']){
            if($values['variation']['attribute_delivery-method'] == 'Delivery'){
                foreach($rates as $RK => $RV) {
                    if($RV->label != 'Delivery'){
                        unset( $rates[$RK] );
                    }
                }
                break;
            }
        }
    }
    return $rates;
}
add_filter( 'woocommerce_package_rates', 'shipping_method_based_on_variation', 10, 2 );

function action_woocommerce_after_shipping_rate( $method, $index ){
    global $woocommerce;
    $items = $woocommerce->cart->get_cart();
    foreach($items as $item => $values) {
        if($values['variation']){
            if($values['variation']['attribute_delivery-method'] == 'Delivery'){
                if($method->label == 'Delivery'){
                    echo '<br/><span style="font-weight:400;">The delivery charge has been automatically applied because you have selected to have one or more items in your cart delivered to you.</span>';
                }
                break;
            }
        }
    }
}
add_action( 'woocommerce_after_shipping_rate', 'action_woocommerce_after_shipping_rate', 10, 2 );


/************** Change the no shipping text ***************/
add_filter( 'woocommerce_cart_no_shipping_available_html', 'change_noship_message' );
add_filter( 'woocommerce_no_shipping_available_html', 'change_noship_message' );
function change_noship_message() {
    echo 'There is one or more items in your cart that hase the delivery method set to delivery and you are not in one of our delivey areas. Please change this item to pick-up and come to our store to pick-up your items  <br />';
}



/************** Change Product Description Tab Text on Product Pages ***************/
add_filter( 'woocommerce_product_tabs', 'woo_rename_tab', 98);
function woo_rename_tab($tabs) {
    $tabs['description']['title'] = 'Nutrition Info';
    return $tabs;
}

/************** Remove the Product Description Text Under the Product Description Tab ***************/
// Remove the product description Title
add_filter( 'woocommerce_product_description_heading', 'remove_product_description_heading' );
function remove_product_description_heading() {
    return '';
}

//Change the product description title
add_filter('woocommerce_product_description_heading', 'change_product_description_heading');
function change_product_description_heading() {
    return __('Nutrition Info', 'woocommerce');
}

/************** Remove Additional Information Tab on Products Pages ***************/
// Remove Additional Information Tab WooCommerce
add_filter( 'woocommerce_product_tabs', 'remove_info_tab', 98);
function remove_info_tab($tabs) {

    unset($tabs['additional_information']);

    return $tabs;
}

function custom_storefront_whitespace (){
    ?>
    <div>

    </div>
    <?php
}

///************** Remove Price Range on Product Pages ***************/
//add_filter( 'woocommerce_variable_sale_price_html', 'custom_storefront_whitespace', 10, 2 );
//add_filter( 'woocommerce_variable_price_html', 'custom_storefront_whitespace', 10, 2 );
//
///************** Remove Price Range on Product Loops ***************/
//remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );

/***Code of piyush***/
remove_action( 'woocommerce_bundled_item_details', 'wc_pb_template_bundled_item_description', 20, 2);
add_action( 'woocommerce_bundled_item_details', 'wc_pb_template_bundled_item_description2', 20, 2);
function wc_pb_template_bundled_item_description2( $bundled_item, $bundle ) {
	//echo '<pre>';
	//print_r($bundled_item->product->get_description());
	//echo '</pre>';
	$ProID = $bundled_item->product->get_id();
	$term_list = wp_get_post_terms($ProID, 'product_cat', array("fields" => "names"));
	$catg = array();
	if (in_array("Breakfast", $term_list)){ $catg[] = 'Breakfast'; }
	if (in_array("Lunch", $term_list)){ $catg[] = 'Lunch'; }
	if (in_array("Dinner", $term_list)){ $catg[] = 'Dinner'; } 
	if (in_array("Kids Meals", $term_list)){ $catg[] = 'Kids Meals'; }
	if (in_array("Snack", $term_list)){ $catg[] = 'Snack'; }
	
	$Dietcatname = array();
	if (in_array("Homestyle", $term_list)){$Dietcatname[]= 'Homestyle';}
	if (in_array("Keto", $term_list)){ $Dietcatname[]= 'Keto';}
	if (in_array("Paleo", $term_list)){ $Dietcatname[]= 'Paleo';}
	if (in_array("Whole 30", $term_list)){ $Dietcatname[]= 'Whole 30';}
	
	wc_get_template( 'single-product/bundled-item-description.php', array(
		'description' => $bundled_item->get_description(),'calories'=> $bundled_item->product->get_description(),'catg'=>$catg, 'Dietcatname'=> $Dietcatname
	), false, WC_PB()->plugin_path() . '/templates/' );
}
/***Code of piyush***/



/**
 * Add the field to the checkout
 **/
add_action( 'woocommerce_after_order_notes', 'wordimpress_custom_checkout_field' );

function wordimpress_custom_checkout_field( $checkout ) {

	$cat_check = false;
        
	// check each cart item for our category
	foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				
		$product = $cart_item['data'];
		
		// replace 'membership' with your category's slug
		if ( has_term( 'challenge-menu', 'product_cat', $product->id ) ) {
			$cat_check = true;
			// break because we only need one "true" to matter here
			break;
		}
	}
			
	// if a product in the cart is in our category, do something
	if ( $cat_check ) {
		echo '<div id="my_custom_checkout_field"><p style="margin: 0 0 8px;">Are you following the calendar menu?</p>';

		woocommerce_form_field( 'are_you_following_calender_menu', array(
			'type'  => 'checkbox',
			'class' => array( 'inscription-checkbox' ),
			'label' => __( 'Yes' ),
		), $checkout->get_value( 'are_you_following_calender_menu' ) );

		echo '</div>';
	}

}

 
//* Update the order meta with field value

add_action('woocommerce_checkout_update_order_meta', 'wps_select_checkout_field_update_order_meta');
function wps_select_checkout_field_update_order_meta( $order_id ) {
	
	if ($_POST['are_you_following_calender_menu']){
		update_post_meta( $order_id, 'are_you_following_calender_menu', esc_attr($_POST['are_you_following_calender_menu']));
	}
}


add_action( 'woocommerce_admin_order_data_after_billing_address', 'wps_select_checkout_field_display_admin_order_meta', 10, 1 );

function wps_select_checkout_field_display_admin_order_meta($order){
	$calender_yes_or_no = get_post_meta( $order->id, 'are_you_following_calender_menu', true );
	if($calender_yes_or_no == 1){
		echo '<p><strong>'.__('Are you following the calendar menu?').' </strong> Yes</p>';
	}
}

//* Add selection field value to emails
/* add_filter('woocommerce_email_order_meta_keys', 'wps_select_order_meta_keys');
function wps_select_order_meta_keys( $keys , $order ) {
	//$calender_yes_or_no = get_post_meta( $order->id, 'are_you_following_calender_menu', true );
	//if($calender_yes_or_no == 1){
		
	$keys['Are you following the calendar menu?'] = 'Yes';
	//}
	return $keys;
	
} */
add_filter( 'woocommerce_email_order_meta_fields', 'custom_woocommerce_email_order_meta_fields', 10, 3 );

function custom_woocommerce_email_order_meta_fields( $fields, $sent_to_admin, $order ) {
	$calender_yes_or_no = get_post_meta( $order->id, 'are_you_following_calender_menu', true );
	
	if($calender_yes_or_no == 1){
		$fields['meta_key'] = array(
			'label' => __( 'Are you following the calendar menu?' ),
			'value' => 'Yes',
		);
	}
    return $fields;
}


/***Code fo checkout page add checkbox**/

add_filter('woocommerce_checkout_posted_data','woocommerce_checkout_posted_data_oz',10,1);
function woocommerce_checkout_posted_data_oz($data){
	session_start(); 
	if(isset($_REQUEST['wc-oz-pickup-checkbox'])){
		$_SESSION['oz_order_oz_pickup'] = serialize($_REQUEST['wc-oz-pickup-checkbox']); 
		if(isset($_SESSION['oz_order_oz_delivery'])){ unset($_SESSION['oz_order_oz_delivery']); }
	}
	if(isset($_REQUEST['wc-oz-delivery-checkbox'])){
		$_SESSION['oz_order_oz_delivery'] = serialize($_REQUEST['wc-oz-delivery-checkbox']); 
		if(isset($_SESSION['oz_order_oz_pickup'])){ unset($_SESSION['oz_order_oz_pickup']); }
	}
	return $data;
}

add_action('woocommerce_checkout_update_order_meta', 'add_custom_data_for_order_for_pickup_and_delivery', 10, 1);
function add_custom_data_for_order_for_pickup_and_delivery( $order_id ) {
	if ( ! $order_id ){
        return;
	}
	session_start();
	if(isset($_SESSION['oz_order_oz_pickup']) && !empty($_SESSION['oz_order_oz_pickup'])){
		update_post_meta($order_id, 'oz_order_oz_pickup',unserialize($_SESSION['oz_order_oz_pickup']));
		unset($_SESSION['oz_order_oz_pickup']);
	}elseif(isset($_SESSION['oz_order_oz_delivery']) && !empty($_SESSION['oz_order_oz_delivery'])){
		update_post_meta($order_id, 'oz_order_oz_delivery',unserialize($_SESSION['oz_order_oz_delivery']));
		unset($_SESSION['oz_order_oz_delivery']);
	}
}


function oz_display_pickup_delivery($order){
	$dataPickup = get_post_meta( $order->id, 'oz_order_oz_pickup', true );
	if(!empty($dataPickup)){
		echo '<p><strong>'.__('Pickup option').':</strong> <br/>' . implode(",<br/>",$dataPickup) . '</p>';
	}
	$dataDelivery = get_post_meta( $order->id, 'oz_order_oz_delivery', true );
	if(!empty($dataDelivery)){
		echo '<p><strong>'.__('Delivery option').':</strong> <br/>' . implode(",<br/>",$dataDelivery) . '</p>';
	}
}
add_action( 'woocommerce_admin_order_data_after_billing_address', 'oz_display_pickup_delivery', 10, 1 );


  
function oz_woocommerce_available_payment_gateways_changes( $available_gateways ) {
     
   if ( ! is_admin() ) {
        
		$chosen_methods = WC()->session->get( 'chosen_shipping_methods' );
        
		$chosen_shipping = $chosen_methods[0];
		
		$rate_table = array();
		$shipping_methods = WC()->shipping->get_packages();
		
		if(isset($shipping_methods[0]['rates'][$chosen_shipping]->label) && $shipping_methods[0]['rates'][$chosen_shipping]->label == 'Delivery'){
			if ( isset( $available_gateways['cheque'] ) ) {
				unset( $available_gateways['cheque'] );
			} 
        }elseif(isset($shipping_methods[0]['rates'][$chosen_shipping]->label) && $shipping_methods[0]['rates'][$chosen_shipping]->label == 'Local pickup'){
			if ( isset( $available_gateways['cod'] ) ) {
				unset( $available_gateways['cod'] );
			} 
		}
   }
     
   return $available_gateways;
     
}
add_filter( 'woocommerce_available_payment_gateways', 'oz_woocommerce_available_payment_gateways_changes' );
/***Code fo checkout page add checkbox**/


//Disabling the shipping calculator on the cart page.
function disable_shipping_calc_on_cart( $show_shipping ) {
    if( is_cart() ) {
        return false;
    }
    return $show_shipping;
}
add_filter( 'woocommerce_cart_ready_to_calc_shipping', 'disable_shipping_calc_on_cart', 99 );