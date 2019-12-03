<?php
/**
 * Dropbox API logger
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( !class_exists( 'WooCommerce_PDF_IPS_Dropbox_API_Logger' ) ) :

class WooCommerce_PDF_IPS_Dropbox_API_Logger {
	
	public static function log( $message ) {
		$settings = get_option('wpo_wcpdf_dropbox_settings');
		if (isset($settings['api_log'])) {
			if( class_exists('WC_Logger') ) {
				$wc_logger = new WC_Logger();
				$wc_logger->add('wpo-wcpdf-dropbox', $message );
			} else {
				$current_date_time = date("Y-m-d H:i:s");
				$message = $current_date_time .' ' .$message ."\n";

				file_put_contents( plugin_dir_path(__FILE__) . '/wpo_wcpdf_dropbox_log.txt', $message, FILE_APPEND);
			}
		}
	}

} // class WooCommerce_PDF_IPS_Dropbox_API_Logger

endif; // class_exists

