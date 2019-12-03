<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}



class MyWorks_WC_QBO_Sync_QBO_Lib_Frontend {

	public function __construct() {
		if(get_option('mw_wc_qbo_sync_wam_mng_inv_ed') == 'true'){ 
			add_shortcode( 'myworks_quickbooks_manage_invoice', array($this, 'mw_qbo_invoice_user_management'));
			add_action( 'init', array($this,'invoice_user_management_account_endpoints' ) );
			add_filter( 'woocommerce_account_menu_items', array($this, 'invoice_user_management_account_menu_items'));
			add_action( 'woocommerce_account_invoices_endpoint', array($this,'invoice_user_management_endpoint_content' ));
		}


	}
	
	public function invoice_user_management_account_endpoints() {
	    add_rewrite_endpoint( 'invoices', EP_PAGES );
	    if(get_option('mw_wc_qbo_sync_acc_inv_shortcode') != 'true') {
	    	flush_rewrite_rules();
	    	update_option('mw_wc_qbo_sync_acc_inv_shortcode','true',true);
	    }
	}

	public function invoice_user_management_account_menu_items( $items ) {
	    $items['invoices'] = __( 'Invoices' );
	    return $items;
	}
	
	public function invoice_user_management_endpoint_content() {
	    echo do_shortcode('[myworks_quickbooks_manage_invoice]');
	}
	
	
	public function mw_qbo_invoice_user_management( $attr ) {

		
		$attr = shortcode_atts(
			array(
				"per_page" => 10,
				"order" => "Id",
				"order_by" => "DESC"
			),
			$attr
		);
		ob_start();
		include plugin_dir_path(__DIR__ ) . 'public/partials/myworks-wc-qbo-sync-public-shortcode-user-manage-invoice.php';
		return ob_get_clean();
	}


}

new MyWorks_WC_QBO_Sync_QBO_Lib_Frontend();


	
	