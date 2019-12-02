<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php do_action( 'wpo_wcpdf_before_document', $this->type, $this->order );

$calender_yes_or_no = get_post_meta( $this->order->get_id(), 'are_you_following_calender_menu', true );
$dataPickup = get_post_meta( $this->order->get_id(), 'oz_order_oz_pickup', true );
$dataDelivery = get_post_meta( $this->order->get_id(), 'oz_order_oz_delivery', true );
 ?>

    <table class="head container">
        <tr>
            <td>
                <div align="center">
                    <div class="shop-name">
                        <h2><?php $this->shop_name(); ?></h2>
                        <hr style="max-width: 200px"/>
                    </div>
                    <div class="shop-address">
                        <h3>Phone: (847)-772-6931</h3>
                        <h3>E-mail: PerfectlyPlated18@gmail.com</h3>
                    </div>
                </div>
            </td>
            <td>

            </td>
            <td>
                <div align="center">
                    <div class="shop-name">
                        <h2><?php $this->shop_name(); ?></h2>
                        <hr style="max-width: 200px"/>
                    </div>
                    <div class="shop-address">
                        <h3>Phone: (847)-772-6931</h3>
                        <h3>E-mail: PerfectlyPlated18@gmail.com</h3>
                    </div>
                </div>
            </td>
        </tr>
    </table>

    <h1 class="document-type-label">
        <?php if( $this->has_header_logo() ) echo $this->get_title(); ?>
    </h1>

<?php do_action( 'wpo_wcpdf_after_document_label', $this->type, $this->order ); ?>

    <table class="" style="width:105%;margin-bottom:20px;">
        <tbody>
        <tr>
            <td style="width:100px;" class="">
                <?php _e( '<b>' . 'Shipping Address:' . '</b>', 'woocommerce-pdf-invoices-packing-slips' ); ?>
                <?php do_action( 'wpo_wcpdf_before_shipping_address', $this->type, $this->order ); ?>
                <?php $this->shipping_address(); ?>
                <?php do_action( 'wpo_wcpdf_after_shipping_address', $this->type, $this->order ); ?>
                <?php if ( isset($this->settings['display_email']) ) { ?>
                    <div class="billing-email"><?php $this->billing_email(); ?></div>
                <?php } ?>
                <?php if ( isset($this->settings['display_phone']) ) { ?>
                    <div class="billing-phone"><?php $this->billing_phone(); ?></div>
                <?php } ?>
            </td>
            <td style="width:144px;" class="order-data">
                <table>
                    <?php do_action( 'wpo_wcpdf_before_order_data', $this->type, $this->order ); ?>
                    <tr class="order-number">
                        <th><?php _e( '<b>' . 'Order Number:' . '</b>', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
                        <td><?php $this->order_number(); ?></td>
                    </tr>
                    <tr class="order-number">
                        <th><?php _e( '<b>' . 'Order Total:' . '</b>', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
                        <?php foreach( $this->get_woocommerce_totals() as $key => $total ) : ?>
                        <?php if ($total['label'] == 'Total'){ ?>
                                <td><?php  echo $total['value']; ?></td>
                        <?php } ?>
                        <?php endforeach; ?>
                    </tr>
                    <tr class="order-number">
                        <th><?php _e( '<b>' . 'Payment Method:' . '</b>', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
                        <?php foreach( $this->get_woocommerce_totals() as $key => $total ) : ?>
                            <?php if ($total['label'] == 'Payment method'){ ?>
                                <td><?php  echo $total['value']; ?></td>
                            <?php } ?>
                        <?php endforeach; ?>
                    </tr>
                    <tr class="order-date">
                        <th><?php _e( '<b>' . 'Order Date:' . '</b>', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
                        <td><?php $this->order_date(); ?></td>
                    </tr>
                    <tr class="shipping-method">
                        <th><?php _e( '<b>' . 'Shipping Method:' . '</b>', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
                        <td><?php $this->shipping_method(); ?></td>
                    </tr>
					<?php


					
					if(!empty($dataPickup)){
						?>
						<tr class="shipping-method">
							<th><?php _e( '<b>' . 'Pickup option:' . '</b>', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
							<td><?php echo implode(",<br/>",$dataPickup); ?></td>
						</tr>
						<?php
					}elseif(!empty($dataDelivery)){
						?>
						<tr class="shipping-method">
							<th><?php _e( '<b>' . 'Delivery option:' . '</b>', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
							<td><?php echo implode(",<br/>",$dataDelivery); ?></td>
						</tr>
						<?php
					}
                    if($calender_yes_or_no == 1){
                        ?>
                        <tr>
                            <th><?php echo ('<b>Are you following the calendar menu?:</b>'); ?></th>
                            <td><?php echo 'Yes'; ?></td>
                        </tr>
                        <?php
                    } ?>
                    <?php do_action( 'wpo_wcpdf_after_order_data', $this->type, $this->order ); ?>
                </table>
            </td>
            <td style="width:20px;"> </td>
            <td style="width:100px;" class="">
                <?php _e( '<b>' . 'Shipping Address:' . '</b>', 'woocommerce-pdf-invoices-packing-slips' ); ?>
                <?php do_action( 'wpo_wcpdf_before_shipping_address', $this->type, $this->order ); ?>
                <?php $this->shipping_address(); ?>
                <?php do_action( 'wpo_wcpdf_after_shipping_address', $this->type, $this->order ); ?>
                <?php if ( isset($this->settings['display_email']) ) { ?>
                    <div class="billing-email"><?php $this->billing_email(); ?></div>
                <?php } ?>
                <?php if ( isset($this->settings['display_phone']) ) { ?>
                    <div class="billing-phone"><?php $this->billing_phone(); ?></div>
                <?php } ?>
            </td>
            <td style="width:144px;" class="order-data">
                <table>
                    <?php do_action( 'wpo_wcpdf_before_order_data', $this->type, $this->order ); ?>
                    <tr class="order-number">
                        <th><?php _e( '<b>' . 'Order Number:' . '</b>', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
                        <td><?php $this->order_number(); ?></td>
                    </tr>
                    <tr class="order-number">
                        <th><?php _e( '<b>' . 'Order Total:' . '</b>', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
                        <?php foreach( $this->get_woocommerce_totals() as $key => $total ) : ?>
                            <?php if ($total['label'] == 'Total'){ ?>
                                <td><?php  echo $total['value']; ?></td>
                            <?php } ?>
                        <?php endforeach; ?>
                    </tr>
                    <tr class="order-number">
                        <th><?php _e( '<b>' . 'Payment Method:' . '</b>', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
                        <?php foreach( $this->get_woocommerce_totals() as $key => $total ) : ?>
                            <?php if ($total['label'] == 'Payment method'){ ?>
                                <td><?php  echo $total['value']; ?></td>
                            <?php } ?>
                        <?php endforeach; ?>
                    </tr>
                    <tr class="order-date">
                        <th><?php _e( '<b>' . 'Order Date:' . '</b>', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
                        <td><?php $this->order_date(); ?></td>
                    </tr>
                    <tr class="shipping-method">
                        <th><?php _e( '<b>' . 'Shipping Method:' . '</b>', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
                        <td><?php $this->shipping_method(); ?></td>
                    </tr>
					<?php
					
					if(!empty($dataPickup)){
						?>
						<tr class="shipping-method">
							<th><?php _e( '<b>' . 'Pickup option:' . '</b>', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
							<td><?php echo implode(",<br/>",$dataPickup); ?></td>
						</tr>
						<?php
					}elseif(!empty($dataDelivery)){
						?>
						<tr class="shipping-method">
							<th><?php _e( '<b>' . 'Delivery option:' . '</b>', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
							<td><?php echo implode(",<br/>",$dataDelivery); ?></td>
						</tr>
						<?php
					}
                    if($calender_yes_or_no == 1){
                        ?>
                        <tr>
                            <th><?php echo ('<b>Are you following the calendar menu?:</b>'); ?></th>
                            <td><?php echo 'Yes'; ?></td>
                        </tr>
                        <?php
                    } ?>

					
                    <?php do_action( 'wpo_wcpdf_after_order_data', $this->type, $this->order ); ?>
                </table>
            </td>
        </tr>
        </tbody>
    </table>
<?php do_action( 'wpo_wcpdf_before_order_details', $this->type, $this->order ); ?>

<?php
/* echo '<pre>';
print_r($this->order);
echo '<pre>';
die(); */

$items = $this->get_order_items();

function compareByName($a, $b) {
    return strcmp($a["name"], $b["name"]);
}

$arrayForOther = array();
$arrayForSunMon = array();
$arrayForWed = array();


$customerName = $this->order->get_billing_first_name().' '.$this->order->get_billing_last_name();
if(!empty($items)){
    foreach($items as $iid=>$item){

        $product_id = $item['product_id'];

        if ( has_term( 'sun-mon', 'product_cat', $product_id ) ) {
            $arrayForSunMon[] = $item;
        }
        if ( has_term( 'wed', 'product_cat', $product_id ) ) {
            $arrayForWed[] = $item;
        }

    }
    usort($arrayForSunMon, 'compareByName');
    usort($arrayForWed, 'compareByName');

}


if(!empty($arrayForSunMon) || !empty($arrayForWed)){

    $arrayForSunMonCOUNT = count($arrayForSunMon);
    $arrayForWedCOUNT = count($arrayForWed);
    $firstLoopCount = $arrayForSunMonCOUNT;
    if($arrayForSunMonCOUNT < $arrayForWedCOUNT){
        $firstLoopCount = $arrayForWedCOUNT;
    }

    ?>

    <style>
        .border{ border:1px solid #DDD; }
        .width-48{ width:48%; }
        .padding-5{ padding:5px; }
        .center-bold { text-align:center;font-weight:bold;}
        .bold { font-weight:bold;}
        .product-detail-col{ width:200px;}
        .wc-item-meta li:nth-child(2){
            display:none;
        }
    </style>

    <table style="width:100%;">
        <tbody>
        <tr>
            <td colspan="3" class="border width-48 padding-5 bold"><?php _e('Customer : '.$customerName, 'woocommerce-pdf-invoices-packing-slips' ); ?></td>
            <td style="width:20px;"> </td>
            <td colspan="3" class="border width-48 padding-5 bold"><?php _e('Customer : '.$customerName, 'woocommerce-pdf-invoices-packing-slips' ); ?></td>
        </tr>
        <tr>
            <td colspan="3" class="border width-48 padding-5 center-bold"><?php _e('Sunday & Monday', 'woocommerce-pdf-invoices-packing-slips' ); ?></td>
            <td></td>
            <td colspan="3" class="border width-48 padding-5 center-bold"><?php _e('Wednesday', 'woocommerce-pdf-invoices-packing-slips' ); ?></td>
        </tr>
        <tr>
            <td class="border padding-5 center-bold"><?php _e('Quantity', 'woocommerce-pdf-invoices-packing-slips' ); ?></td>
            <td class="border padding-5 center-bold product-detail-col"><?php _e('Meal', 'woocommerce-pdf-invoices-packing-slips' ); ?></td>
            <td class="border padding-5 center-bold"><?php _e('Ready', 'woocommerce-pdf-invoices-packing-slips' ); ?></td>
            <td></td>
            <td class="border padding-5 center-bold"><?php _e('Quantity', 'woocommerce-pdf-invoices-packing-slips' ); ?></td>
            <td class="border padding-5 center-bold product-detail-col"><?php _e('Meal', 'woocommerce-pdf-invoices-packing-slips' ); ?></td>
            <td class="border padding-5 center-bold"><?php _e('Ready', 'woocommerce-pdf-invoices-packing-slips' ); ?></td>
        </tr>
        <?php
        $xincrese = 0;
        while ( $xincrese < $firstLoopCount ) {
            $TAMPDATAPSM = '';
            $TAMPDATAPW = ''

            ?>
            <tr>
                <?php
                if(isset($arrayForSunMon[$xincrese]) && !empty($arrayForSunMon[$xincrese])){
                    $TAMPDATAPSM = $arrayForSunMon[$xincrese];
                }
                if(isset($arrayForWed[$xincrese]) && !empty($arrayForWed[$xincrese])){
                    $TAMPDATAPW = $arrayForWed[$xincrese];
                }

                if(!empty($TAMPDATAPSM)){
                    ?>
                    <td class="border padding-5"><?php echo $TAMPDATAPSM['quantity']; ?></td>
                    <td class="border padding-5"><?php $description_label = __( 'Description', 'woocommerce-pdf-invoices-packing-slips' ); // registering alternate label translation ?>
                        <span class="item-name"><?php echo $TAMPDATAPSM['name']; ?></span>
                        <?php do_action( 'wpo_wcpdf_before_item_meta', $this->type, $TAMPDATAPSM, $this->order  ); ?>
                        <span class="item-meta"><?php echo $TAMPDATAPSM['meta']; ?></span>
                        <dl class="meta">
                            <?php $description_label = __( 'SKU', 'woocommerce-pdf-invoices-packing-slips' ); // registering alternate label translation ?>
                            <?php if( !empty( $TAMPDATAPSM['sku'] ) ) : ?><dt class="sku"><?php _e( 'SKU:', 'woocommerce-pdf-invoices-packing-slips' ); ?></dt><dd class="sku"><?php echo $TAMPDATAPSM['sku']; ?></dd><?php endif; ?>
                            <?php if( !empty( $TAMPDATAPSM['weight'] ) ) : ?><dt class="weight"><?php _e( 'Weight:', 'woocommerce-pdf-invoices-packing-slips' ); ?></dt><dd class="weight"><?php echo $TAMPDATAPSM['weight']; ?><?php echo get_option('woocommerce_weight_unit'); ?></dd><?php endif; ?>
                        </dl>
                        <?php do_action( 'wpo_wcpdf_after_item_meta', $this->type, $TAMPDATAPSM, $this->order  ); ?></td>
                    <td class="border padding-5"> </td>
                    <?php
                }else{
                    ?>
                    <td colspan="3"></td>
                    <?php
                }
                ?>
                <td></td>
                <?php
                if(!empty($TAMPDATAPW)){
                    ?>
                    <td class="border padding-5"><?php echo $TAMPDATAPW['quantity']; ?></td>
                    <td class="border padding-5"><?php $description_label = __( 'Description', 'woocommerce-pdf-invoices-packing-slips' ); // registering alternate label translation ?>
                        <span class="item-name"><?php echo $TAMPDATAPW['name']; ?></span>
                        <?php do_action( 'wpo_wcpdf_before_item_meta', $this->type, $TAMPDATAPW, $this->order  ); ?>
                        <span class="item-meta"><?php echo $TAMPDATAPW['meta']; ?></span>
                        <dl class="meta">
                            <?php $description_label = __( 'SKU', 'woocommerce-pdf-invoices-packing-slips' ); // registering alternate label translation ?>
                            <?php if( !empty( $TAMPDATAPW['sku'] ) ) : ?><dt class="sku"><?php _e( 'SKU:', 'woocommerce-pdf-invoices-packing-slips' ); ?></dt><dd class="sku"><?php echo $TAMPDATAPW['sku']; ?></dd><?php endif; ?>
                            <?php if( !empty( $TAMPDATAPW['weight'] ) ) : ?><dt class="weight"><?php _e( 'Weight:', 'woocommerce-pdf-invoices-packing-slips' ); ?></dt><dd class="weight"><?php echo $TAMPDATAPW['weight']; ?><?php echo get_option('woocommerce_weight_unit'); ?></dd><?php endif; ?>
                        </dl>
                        <?php do_action( 'wpo_wcpdf_after_item_meta', $this->type, $TAMPDATAPW, $this->order  ); ?></td>
                    <td class="border padding-5"> </td>
                    <?php
                }else{
                    ?>
                    <td colspan="3"></td>
                    <?php
                }
                ?>
            </tr>
            <?php
            $xincrese++;
        }
        ?>
        </tbody>
    </table>

    <?php
}

?>

<?php
if(!empty($arrayForOther)){

    ?>
    <table class="order-details">
        <thead>
        <tr>
            <th class="product"><?php _e('Product', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
            <th class="quantity"><?php _e('Quantity', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
        </tr>
        </thead>
        <tbody>

        <?php $items = $arrayForOther; if( sizeof( $items ) > 0 ) : foreach( $items as $item_id => $item ) : ?>
            <tr class="<?php echo apply_filters( 'wpo_wcpdf_item_row_class', $item_id, $this->type, $this->order, $item_id ); ?>">
                <td class="product">
                    <?php $description_label = __( 'Description', 'woocommerce-pdf-invoices-packing-slips' ); // registering alternate label translation ?>
                    <span class="item-name"><?php echo $item['name']; ?></span>
                    <?php do_action( 'wpo_wcpdf_before_item_meta', $this->type, $item, $this->order  ); ?>
                    <span class="item-meta"><?php echo $item['meta']; ?></span>
                    <dl class="meta">
                        <?php $description_label = __( 'SKU', 'woocommerce-pdf-invoices-packing-slips' ); // registering alternate label translation ?>
                        <?php if( !empty( $item['sku'] ) ) : ?><dt class="sku"><?php _e( 'SKU:', 'woocommerce-pdf-invoices-packing-slips' ); ?></dt><dd class="sku"><?php echo $item['sku']; ?></dd><?php endif; ?>
                        <?php if( !empty( $item['weight'] ) ) : ?><dt class="weight"><?php _e( 'Weight:', 'woocommerce-pdf-invoices-packing-slips' ); ?></dt><dd class="weight"><?php echo $item['weight']; ?><?php echo get_option('woocommerce_weight_unit'); ?></dd><?php endif; ?>
                    </dl>
                    <?php do_action( 'wpo_wcpdf_after_item_meta', $this->type, $item, $this->order  ); ?>
                </td>
                <td class="quantity"><?php echo $item['quantity']; ?></td>
            </tr>
        <?php endforeach; endif; ?>
        </tbody>
    </table>
    <?php

}
?>

<?php do_action( 'wpo_wcpdf_after_order_details', $this->type, $this->order ); ?>

<?php do_action( 'wpo_wcpdf_before_customer_notes', $this->type, $this->order ); ?>
    <div class="customer-notes">
        <?php if ( $this->get_shipping_notes() ) : ?>
            <h3><?php _e( 'Customer Notes', 'woocommerce-pdf-invoices-packing-slips' ); ?></h3>
            <?php $this->shipping_notes(); ?>
        <?php endif; ?>
    </div>
<?php do_action( 'wpo_wcpdf_after_customer_notes', $this->type, $this->order ); ?>

<?php if ( $this->get_footer() ): ?>
    <div id="footer">
        <?php $this->footer(); ?>
    </div><!-- #letter-footer -->
<?php endif; ?>

<?php do_action( 'wpo_wcpdf_after_document', $this->type, $this->order ); ?>