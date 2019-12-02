<?php
/**
 * Shipping Methods Display
 *
 * In 2.1 we show methods per package. This allows for multiple methods per order if so desired.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-shipping.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

$formatted_destination    = isset( $formatted_destination ) ? $formatted_destination : WC()->countries->get_formatted_address( $package['destination'], ', ' );
$has_calculated_shipping  = ! empty( $has_calculated_shipping );
$show_shipping_calculator = ! empty( $show_shipping_calculator );
$calculator_text          = '';
?>
<tr class="woocommerce-shipping-totals shipping">
	<th><?php echo wp_kses_post( $package_name ); ?></th>
	<td data-title="<?php echo esc_attr( $package_name ); ?>">
		<?php if ( $available_methods ) : ?>
			<ul id="shipping_method" class="woocommerce-shipping-methods">
				<?php
				/* echo '<pre>';
				print_r($available_methods);
				var_dump($chosen_method);
				echo '</pre>'; */
				?>
				<?php foreach ( $available_methods as $method ) : ?>
					<li>
						<?php
						if ( 1 < count( $available_methods ) ) {
							printf( '<input type="radio" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method" %4$s />', $index, esc_attr( sanitize_title( $method->id ) ), esc_attr( $method->id ), checked( $method->id, $chosen_method, false ) ); // WPCS: XSS ok.
						} else {
							printf( '<input type="hidden" name="shipping_method[%1$d]" data-index="%1$d" id="shipping_method_%1$d_%2$s" value="%3$s" class="shipping_method" />', $index, esc_attr( sanitize_title( $method->id ) ), esc_attr( $method->id ) ); // WPCS: XSS ok.
						}
						printf( '<label for="shipping_method_%1$s_%2$s">%3$s</label>', $index, esc_attr( sanitize_title( $method->id ) ), wc_cart_totals_shipping_method_label( $method ) ); // WPCS: XSS ok.
						do_action( 'woocommerce_after_shipping_rate', $method, $index );
						
							/******************/
							global $woocommerce;
							$items = $woocommerce->cart->get_cart();
							
							$ozone_condition_array = array();
							
							foreach($items as $item => $values) {
								
								$ProID = $values['product_id'];
								$term_list = wp_get_post_terms($ProID, 'product_cat', array("fields" => "names"));
								
								if (in_array("Sun/Mon", $term_list)){
									$ozone_condition_array['Sun/Mon'] = "Sun/Mon";
								}
								if (in_array("Wed", $term_list)){
									$ozone_condition_array['Wed'] = "Wed"; 
								}
							}
							
							$oz_cat_A = 0;
							if(in_array("Sun/Mon", $ozone_condition_array) && in_array("Wed", $ozone_condition_array)){
								$oz_cat_A = 1;
							}elseif(in_array("Sun/Mon", $ozone_condition_array)){
								$oz_cat_A = 2;
							}elseif(in_array("Wed", $ozone_condition_array)){
								$oz_cat_A = 3;
							}
						
							if($method->label == 'Delivery'){
								if($method->id == $chosen_method){
									if($oz_cat_A > 0){
										if($oz_cat_A == 1){
											?>
											<div style="margin-left: 30px;">
												<input id="wc-oz-delivery-checkbox1" name="wc-oz-delivery-checkbox[]" type="checkbox" value="Sunday 5:00 p.m. - 7:00 p.m." style="width:auto;opacity: 0.5;" checked="checked"  >
												<label for="wc-oz-delivery-checkbox1" style="display:inline;">Sunday 5:00 p.m. - 7:00 p.m.</label>
											</div>
											<div style="margin-left: 30px;">
												<input id="wc-oz-delivery-checkbox2" name="wc-oz-delivery-checkbox[]" type="checkbox" value="Wednesday 5:00 p.m. - 7:00 p.m." style="width:auto;opacity: 0.5;" checked="checked" >
												<label for="wc-oz-delivery-checkbox2" style="display:inline;">Wednesday 5:00 p.m. - 7:00 p.m.</label>
											</div>
											<script>
											jQuery( document ).ready(function() {
												jQuery('#wc-oz-delivery-checkbox1').change(function () {
													jQuery('#wc-oz-delivery-checkbox1').prop('checked', true);
												});
												jQuery('#wc-oz-delivery-checkbox2').change(function () {
													jQuery('#wc-oz-delivery-checkbox2').prop('checked', true);
												});
											});
											</script>
											<?php
										}elseif($oz_cat_A == 2){
											?>
											<div style="margin-left: 30px;">
												<input id="wc-oz-delivery-checkbox1" name="wc-oz-delivery-checkbox[]" type="checkbox" value="Sunday 5:00 p.m. - 7:00 p.m." style="width:auto;opacity: 0.5;" checked="checked"  >
												<label for="wc-oz-delivery-checkbox1" style="display:inline;">Sunday 5:00 p.m. - 7:00 p.m.</label>
											</div>
											<script>
											jQuery( document ).ready(function() {
												jQuery('#wc-oz-delivery-checkbox1').change(function () {
													jQuery('#wc-oz-delivery-checkbox1').prop('checked', true);
												});
											});
											</script>
											<?php
										}elseif($oz_cat_A == 3){
											?>
											<div style="margin-left: 30px;">
												<input id="wc-oz-delivery-checkbox2" name="wc-oz-delivery-checkbox[]" type="checkbox" value="Wednesday 5:00 p.m. - 7:00 p.m" style="width:auto;opacity: 0.5;" checked="checked"  >
												<label for="wc-oz-delivery-checkbox2" style="display:inline;">Wednesday 5:00 p.m. - 7:00 p.m</label>
											</div>
											<script>
											jQuery( document ).ready(function() {
												jQuery('#wc-oz-delivery-checkbox2').change(function () {
													jQuery('#wc-oz-delivery-checkbox2').prop('checked', true);
												});
											});
											</script>
											<?php
										}
									}
								}
							}elseif($method->label == 'Local pickup'){
								if($method->id == $chosen_method){
									if($oz_cat_A > 0){
										if($oz_cat_A == 1){
											?>
											<div style="margin-left: 30px;">
												<input id="wc-oz-pickup-checkbox3" name="wc-oz-pickup-checkbox[]" type="radio" value="Monday 4:30 p.m. - 7:00 p.m." style="width:auto;" >
												<label for="wc-oz-pickup-checkbox3" style="display:inline;">Monday 4:30 p.m. - 7:00 p.m.</label>
											</div>
											<div style="margin-left: 30px;">
												<input id="wc-oz-pickup-checkbox1" name="wc-oz-pickup-checkbox[]" type="radio" value="Sunday 4:30 p.m. - 7:00 p.m." style="width:auto;" checked="checked">
												<label for="wc-oz-pickup-checkbox1" style="display:inline;">Sunday 4:30 p.m. - 7:00 p.m.</label>
											</div>
											<div style="margin-left: 30px;">
												<input id="wc-oz-pickup-checkbox2" name="wc-oz-pickup-checkbox[]" type="checkbox" value="Wednesday 4:30 p.m. - 7:00 p.m." style="width:auto;opacity: 0.5;" checked="checked" >
												<label for="wc-oz-pickup-checkbox2" style="display:inline;">Wednesday 4:30 p.m. - 7:00 p.m.</label>
											</div>
											<script>
											jQuery( document ).ready(function() {
												jQuery('#wc-oz-pickup-checkbox2').change(function () {
													jQuery('#wc-oz-pickup-checkbox2').prop('checked', true);
												});
											});
											</script>
											<?php
										}elseif($oz_cat_A == 2){
											?>
											<div style="margin-left: 30px;">
												<input id="wc-oz-pickup-checkbox3" name="wc-oz-pickup-checkbox[]" type="radio" value="Monday 4:30 p.m. - 7:00 p.m." style="width:auto;" checked="checked">
												<label for="wc-oz-pickup-checkbox3" style="display:inline;">Monday 4:30 p.m. - 7:00 p.m.</label>
											</div>
											<div style="margin-left: 30px;">
												<input id="wc-oz-pickup-checkbox1" name="wc-oz-pickup-checkbox[]" type="radio" value="Sunday 4:30 p.m. - 7:00 p.m." style="width:auto;" >
												<label for="wc-oz-pickup-checkbox1" style="display:inline;">Sunday 4:30 p.m. - 7:00 p.m.</label>
											</div>
											<?php
										}elseif($oz_cat_A == 3){
											?>
											<div style="margin-left: 30px;">
												<input id="wc-oz-pickup-checkbox2" name="wc-oz-pickup-checkbox[]" type="checkbox" value="Wednesday 4:30 p.m. - 7:00 p.m." style="width:auto;opacity: 0.5;" checked="checked" >
												<label for="wc-oz-pickup-checkbox2" style="display:inline;">Wednesday 4:30 p.m. - 7:00 p.m.</label>
											</div>
											<script>
											jQuery( document ).ready(function() {
												jQuery('#wc-oz-pickup-checkbox2').change(function () {
													jQuery('#wc-oz-pickup-checkbox2').prop('checked', true);
												});
											});
											</script>
											<?php
										}
									}
								}
							}
						?>
					</li>
				<?php endforeach; ?>
			</ul>
			<?php if ( is_cart() ) : ?>
				<p class="woocommerce-shipping-destination">
					<?php
					if ( $formatted_destination ) {
						// Translators: $s shipping destination.
						printf( esc_html__( 'Shipping to %s.', 'woocommerce' ) . ' ', '<strong>' . esc_html( $formatted_destination ) . '</strong>' );
						$calculator_text = esc_html__( 'Change address', 'woocommerce' );
					} else {
						echo wp_kses_post( apply_filters( 'woocommerce_shipping_estimate_html', __( 'Shipping options will be updated during checkout.', 'woocommerce' ) ) );
					}
					?>
				</p>
			<?php endif; ?>
			<?php
		elseif ( ! $has_calculated_shipping || ! $formatted_destination ) :
			echo wp_kses_post( apply_filters( 'woocommerce_shipping_may_be_available_html', __( 'Enter your address to view shipping options.', 'woocommerce' ) ) );
		elseif ( ! is_cart() ) :
			echo wp_kses_post( apply_filters( 'woocommerce_no_shipping_available_html', __( 'There are no shipping options available. Please ensure that your address has been entered correctly, or contact us if you need any help.', 'woocommerce' ) ) );
		else :
			// Translators: $s shipping destination.
			echo wp_kses_post( apply_filters( 'woocommerce_cart_no_shipping_available_html', sprintf( esc_html__( 'No shipping options were found for %s.', 'woocommerce' ) . ' ', '<strong>' . esc_html( $formatted_destination ) . '</strong>' ) ) );
			$calculator_text = esc_html__( 'Enter a different address', 'woocommerce' );
		endif;
		?>

		<?php if ( $show_package_details ) : ?>
			<?php echo '<p class="woocommerce-shipping-contents"><small>' . esc_html( $package_details ) . '</small></p>'; ?>
		<?php endif; ?>

		<?php if ( $show_shipping_calculator ) : ?>
			<?php woocommerce_shipping_calculator( $calculator_text ); ?>
		<?php endif; ?>
	</td>
</tr>