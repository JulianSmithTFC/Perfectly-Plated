<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php do_action( 'wpo_wcpdf_before_document', $this->type, $this->order ); ?>

    <table class="head container">
        <tr>
            <td class="header">
                <?php
                if( $this->has_header_logo() ) {
                    $this->header_logo();
                } else {
                    echo $this->get_title();
                }
                ?>
            </td>
            <td class="shop-info">
                <div class="shop-name"><h3><?php $this->shop_name(); ?></h3></div>
                <div class="shop-address"><?php $this->shop_address(); ?></div>
            </td>
        </tr>
    </table>

    <h1 class="document-type-label">
        <?php if( $this->has_header_logo() ) echo $this->get_title(); ?>
    </h1>

<?php do_action( 'wpo_wcpdf_after_document_label', $this->type, $this->order ); ?>

    <table class="order-data-addresses">
        <tr>
            <td class="address shipping-address">
                <!-- <h3><?php _e( 'Shipping Address:', 'woocommerce-pdf-invoices-packing-slips' ); ?></h3> -->
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
            <td class="address billing-address">
                <?php if ( isset($this->settings['display_billing_address']) && $this->ships_to_different_address()) { ?>
                    <h3><?php _e( 'Billing Address:', 'woocommerce-pdf-invoices-packing-slips' ); ?></h3>
                    <?php do_action( 'wpo_wcpdf_before_billing_address', $this->type, $this->order ); ?>
                    <?php $this->billing_address(); ?>
                    <?php do_action( 'wpo_wcpdf_after_billing_address', $this->type, $this->order ); ?>
                <?php } ?>
            </td>
            <td class="order-data">
                <table>
                    <?php do_action( 'wpo_wcpdf_before_order_data', $this->type, $this->order ); ?>
                    <tr class="order-number">
                        <th><?php _e( 'Order Number:', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
                        <td><?php $this->order_number(); ?></td>
                    </tr>
                    <tr class="order-date">
                        <th><?php _e( 'Order Date:', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
                        <td><?php $this->order_date(); ?></td>
                    </tr>
                    <tr class="shipping-method">
                        <th><?php _e( 'Shipping Method:', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
                        <td><?php $this->shipping_method(); ?></td>
                    </tr>
                    <?php do_action( 'wpo_wcpdf_after_order_data', $this->type, $this->order ); ?>
                </table>
            </td>
        </tr>
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
$arrayForSunMonD = array();
$arrayForSunMonP = array();
$arrayForSunD = array();
$arrayForSunP = array();
$arrayForMonD = array();
$arrayForMonP = array();
$arrayForWedD = array();
$arrayForWedP = array();
$customerName = $this->order->get_billing_first_name().' '.$this->order->get_billing_last_name();
if(!empty($items)){
    foreach($items as $iid=>$item){
        $day = wc_get_order_item_meta( $item['item_id'],'dates-and-times', true);
        $dmath = wc_get_order_item_meta( $item['item_id'],'delivery-method', true);
        if($day == 'Monday'){
            if($dmath == 'Delivery'){
                $arrayForMonD[$iid] = $item;
            }elseif($dmath == 'Pick-up'){
                $arrayForMonP[$iid] = $item;
            }else{
                $arrayForOther[$iid] = $item;
            }
        }elseif($day == 'Sunday'){
            if($dmath == 'Delivery'){
                $arrayForSunD[$iid] = $item;
            }elseif($dmath == 'Pick-up'){
                $arrayForSunP[$iid] = $item;
            }else{
                $arrayForOther[$iid] = $item;
            }
        }elseif($day == 'Wednesday'){
            if($dmath == 'Delivery'){
                $arrayForWedD[$iid] = $item;
            }elseif($dmath == 'Pick-up'){
                $arrayForWedP[$iid] = $item;
            }else{
                $arrayForOther[$iid] = $item;
            }
        }else{
            $arrayForOther[$iid] = $item;
        }
    }
    usort($arrayForSunD, 'compareByName');
    usort($arrayForSunP, 'compareByName');
    usort($arrayForMonD, 'compareByName');
    usort($arrayForMonP, 'compareByName');
    usort($arrayForWedD, 'compareByName');
    usort($arrayForWedP, 'compareByName');
    $arrayForSunMonD = array_merge($arrayForSunD, $arrayForMonD);
    $arrayForSunMonP = array_merge($arrayForSunP, $arrayForMonP);

}

if(!empty($arrayForSunMonD) || !empty($arrayForSunMonP) || !empty($arrayForWedD) || !empty($arrayForWedP)){
    ?>
    <table>
        <tbody>
        <tr >
            <td>
                <?php if(!empty($arrayForSunMonD)){ ?>
                    <table cellspacing="100" style="margin-bottom:30px;width:100%">
                        <thead>
                        <tr style="border:1px solid #DDD;background:none;">
                            <th style="text-align:left;border:1px solid #DDD;padding:5px;" colspan="3"><?php _e('Customer : '.$customerName, 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
                        </tr>
                        <tr style="border:1px solid #DDD;background:none;">
                            <th style="text-align:center;border:1px solid #DDD;padding:5px;" colspan="3"><?php _e('Sunday & Monday Delivery', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
                        </tr>

                        <tr>
                            <th class="quantity" style="text-align:center;border:1px solid #DDD;padding:5px;"><?php _e('Quantity', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
                            <th class="product" style="text-align:center;border:1px solid #DDD;padding:5px;"><?php _e('Meal', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
                            <th class="quantity" style="text-align:center;border:1px solid #DDD;padding:5px;"><?php _e('Ready', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
                        </tr>
                        </thead>
                        <tbody style="page-break-inside: avoid">
                        <?php

                        foreach($arrayForSunMonD as $item_id=>$item){
                            ?>
                            <tr class="<?php echo apply_filters( 'wpo_wcpdf_item_row_class', $item_id, $this->type, $this->order, $item_id ); ?>">
                                <td class="quantity" style="border:1px solid #DDD;padding:5px;"><?php echo $item['quantity']; ?></td>
                                <td class="product" style="border:1px solid #DDD;padding:5px;">
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
                                <td class="quantity" style="border:1px solid #DDD;padding:5px;"></td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                    <?php
                } ?>
            </td>
            <td style="width:20px;">

            </td>
            <td>
                <?php
                if(!empty($arrayForWedD)){
                    ?>
                    <table style="margin-bottom:30px;width:100%">
                        <thead>
                        <tr style="border:1px solid #DDD;background:none;">
                            <th style="text-align:left;border:1px solid #DDD;padding:5px;" colspan="3"><?php _e('Customer : '.$customerName, 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
                        </tr>
                        <tr style="border:5px solid #DDD;">
                            <th style="text-align:center;border:1px solid #DDD;padding:5px;" colspan="3" ><?php _e('Wednesday Delivery', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
                        </tr>
                        <tr >
                            <th class="quantity" style="text-align:center;border:1px solid #DDD;padding:5px;"><?php _e('Quantity', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
                            <th class="product" style="text-align:center;border:1px solid #DDD;padding:5px;"><?php _e('Meal', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
                            <th class="quantity" style="text-align:center;border:1px solid #DDD;padding:5px;"><?php _e('Ready', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
                        </tr>
                        </thead>
                        <tbody style="page-break-inside: avoid">
                        <?php
                        foreach($arrayForWedD as $item_id=>$item){
                            ?>
                            <tr class="<?php echo apply_filters( 'wpo_wcpdf_item_row_class', $item_id, $this->type, $this->order, $item_id ); ?>">
                                <td class="quantity" style="border:1px solid #DDD;padding:5px;"><?php echo $item['quantity']; ?></td>
                                <td class="product" style="border:1px solid #DDD;padding:5px;">
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
                                <td class="quantity" style="border:1px solid #DDD;padding:5px;"></td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                    <?php
                } ?>
            </td>
        </tr>
        </tbody>
    </table>
    <table >

        <tbody>
        <tr >
            <td>
                <?php  if(!empty($arrayForSunMonP)){ ?>
                    <table cellspacing="100" style="width:100%;margin-bottom:30px;">
                        <thead>
                        <tr style="border:1px solid #DDD;background:none;">
                            <th style="text-align:left;border:1px solid #DDD;padding:5px;" colspan="3"><?php _e('Customer : '.$customerName, 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
                        </tr>
                        <tr style="border:1px solid #DDD;background:none;">
                            <th style="text-align:center;border:1px solid #DDD;padding:5px;" colspan="3"><?php _e('Sunday & Monday Pick-Up', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
                        </tr>

                        <tr>
                            <th class="quantity" style="text-align:center;border:1px solid #DDD;padding:5px;"><?php _e('Quantity', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
                            <th class="product" style="text-align:center;border:1px solid #DDD;padding:5px;"><?php _e('Meal', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
                            <th class="quantity" style="text-align:center;border:1px solid #DDD;padding:5px;"><?php _e('Ready', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
                        </tr>
                        </thead>
                        <tbody style="page-break-inside: avoid">
                        <?php

                        foreach($arrayForSunMonP as $item_id=>$item){
                            ?>
                            <tr class="<?php echo apply_filters( 'wpo_wcpdf_item_row_class', $item_id, $this->type, $this->order, $item_id ); ?>">
                                <td class="quantity" style="border:1px solid #DDD;padding:5px;"><?php echo $item['quantity']; ?></td>
                                <td class="product" style="border:1px solid #DDD;padding:5px;">
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
                                <td class="quantity" style="border:1px solid #DDD;padding:5px;"></td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                    <?php
                }
                ?>
            </td>
            <td style="width:20px;">

            </td>
            <td>
                <?php if(!empty($arrayForWedP)){
                    ?>
                    <table style="margin-bottom:30px;width:100%">
                        <thead>
                        <tr style="border:1px solid #DDD;background:none;">
                            <th style="text-align:left;border:1px solid #DDD;padding:5px;" colspan="3"><?php _e('Customer : '.$customerName, 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
                        </tr>
                        <tr style="border:5px solid #DDD;">
                            <th style="text-align:center;border:1px solid #DDD;padding:5px;" colspan="3" ><?php _e('Wednesday Pick-Up', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
                        </tr>
                        <tr >
                            <th class="quantity" style="text-align:center;border:1px solid #DDD;padding:5px;"><?php _e('Quantity', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
                            <th class="product" style="text-align:center;border:1px solid #DDD;padding:5px;"><?php _e('Meal', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
                            <th class="quantity" style="text-align:center;border:1px solid #DDD;padding:5px;"><?php _e('Ready', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
                        </tr>
                        </thead>
                        <tbody style="page-break-inside: avoid">
                        <?php

                        foreach($arrayForWedP as $item_id=>$item){
                            ?>
                            <tr class="<?php echo apply_filters( 'wpo_wcpdf_item_row_class', $item_id, $this->type, $this->order, $item_id ); ?>">
                                <td class="quantity" style="border:1px solid #DDD;padding:5px;"><?php echo $item['quantity']; ?></td>
                                <td class="product" style="border:1px solid #DDD;padding:5px;">
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
                                <td class="quantity" style="border:1px solid #DDD;padding:5px;"></td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>
                    <?php
                }
                ?>
            </td>
        </tr>
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