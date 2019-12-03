<?php
/**
 * Dropbox plugin hooks
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( !class_exists( 'WooCommerce_PDF_IPS_Dropbox_Hooks' ) ) :

class WooCommerce_PDF_IPS_Dropbox_Hooks {
	
	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'wpo_wcpdf_email_attachment', array( $this, 'upload_attachment'), 10, 3 );
		add_action( 'woocommerce_order_status_changed', array( $this, 'upload_by_status'), 10, 3 );
		add_action( 'load-edit.php', array($this, 'bulk_export') );
		add_action( 'load-edit.php', array($this, 'export_queue') );
	}

	/**
	 * Upload PDF to dropbox during/after email attachment
	 */
	public function upload_attachment( $file, $document_type = '', $document = null ) {
		$dropbox_settings = get_option( 'wpo_wcpdf_dropbox_settings' );
		// check if upload enabled
		if ( !isset($dropbox_settings['auto_upload']) || $dropbox_settings['auto_upload'] == 0 || WPO_WCPDF_Dropbox()->api->is_enabled() === false ) {
			return;
		}

		if ( !empty($document) && !empty($document->order) ) {
			$this->upload_to_dropbox( $file, 'attachment', $document->order, $document->get_type() );
		} else {
			$this->upload_to_dropbox( $file, 'attachment', null, null );			
		}
	}

	/**
	 * Upload PDF to dropbox during/after email attachment
	 */
	public function upload_by_status( $order_id, $old_status, $new_status ) {
		$dropbox_settings = get_option( 'wpo_wcpdf_dropbox_settings' );
		// check if upload enabled
		if ( empty($dropbox_settings['per_status_upload']) || WPO_WCPDF_Dropbox()->api->is_enabled() === false ) {
			return;
		}

		$order = wc_get_order( $order_id );

		foreach ($dropbox_settings['per_status_upload'] as $template_type => $upload_status) {
			// check if new status matches upload status for document
			if ( $new_status == $upload_status ) {
				// check if free order + free invoice disabled
				if (function_exists('wcpdf_get_document')) { // 2.0+
					$document_settings = WPO_WCPDF()->settings->get_document_settings( $template_type );
					$free_disabled = isset( $document_settings['disable_free'] );
				} else { // 1.X
					$main_general_settings = get_option('wpo_wcpdf_general_settings');
					$free_disabled = isset( $main_general_settings['disable_free'] );
				}

				if ( $free_disabled ) {
					$order_total = $order->get_total();
					if ( $order_total == 0 ) {
						continue;
					}
				}

				// prevent creation of credit note for orders without an invoice
				// 2.0+ only
				if ( function_exists('wcpdf_get_invoice') && $template_type == 'credit-note' ) {
					$invoice = wcpdf_get_invoice( $order );
					if ( $invoice && $invoice->exists() === false ) {
						continue;
					}
				}

				$pdf_path = $this->create_pdf_file( $order_id, $template_type );
				// upload file to dropbox
				$upload_response = $this->upload_to_dropbox( $pdf_path, 'status', $order, $template_type );					
			}
		}
	}

	/**
	 * Upload PDF to dropbox
	 */		
	public function upload_to_dropbox( $file, $context = 'attachment', $order = null, $document_type = null ) {
		// check if enabled
		if ( WPO_WCPDF_Dropbox()->api->is_enabled() === false ) {
			return;
		}
		WooCommerce_PDF_IPS_Dropbox_API_Logger::log("Upload to dropbox initiated");

		// get settings
		$destination_folder = $this->get_destination_folder( $order, $document_type );

		// check if authorized
		if ( !empty( WPO_WCPDF_Dropbox()->api->get_access_token() ) ) {
			if (!empty($file) && file_exists($file)) {
				$result = WPO_WCPDF_Dropbox()->api->upload( $file, $destination_folder );

				if (empty($result['success'])) {
					// there was an error uploading the file, copy file to queue
					$this->queue_file( $file, $order, $document_type );
				}
				
				return $result;
			} else {
				WooCommerce_PDF_IPS_Dropbox_API_Logger::log("file does not exist: {$file}");
			}
		} else {
			WooCommerce_PDF_IPS_Dropbox_API_Logger::log("no access token");
			// we don't have credentials, so we're storing the file in the queue
			$this->queue_file( $file, $order, $document_type );
			
			return array( 'error' => __( 'Dropbox credentials not set', 'wpo_wcpdf_pro' ) );
		}
	}

	/**
	 * Export PDFs in bulk from the order actions drop down
	 * @return void
	 */
	public function bulk_export() {
		// check if enabled
		if ( WPO_WCPDF_Dropbox()->api->is_enabled() === false ) {
			return;
		}
	 	global $typenow;
		if( $typenow == 'shop_order' ) {
			// Check if all parameters are set
			if( ( empty( $_GET['order_ids'] ) && empty($_REQUEST['post']) ) || empty( $_GET['action'] ) ) {
				return;
			}

			// Check the user privileges
			if( !current_user_can( 'manage_woocommerce_orders' ) && !current_user_can( 'edit_shop_orders' ) && !isset( $_GET['my-account'] ) ) {
				return;
			}
			
			// convert order_ids to array if set
			if ( isset( $_GET['order_ids'] ) ) {
				$order_ids = (array) explode('x',$_GET['order_ids']);
			} else {
				$order_ids = (array) $_REQUEST['post'];
			}
			
			if(empty($order_ids)) {
				return;
			}

			// Process oldest first: reverse $order_ids array
			$order_ids = array_reverse($order_ids);
			
			// get the action
			$wp_list_table = _get_list_table( 'WP_Posts_List_Table' );
			$action = $wp_list_table->current_action();

			switch ( $action ) {
				case 'dropbox_export_invoices':
					$this->bulk_export_page( $order_ids, 'invoice' );
					break;
				case 'dropbox_export_packing_slips':
					$this->bulk_export_page( $order_ids, 'packing-slip' );
					break;
				case 'dropbox_export_process':
					$template_type = $_GET['template'];
					$this->bulk_export_process( $order_ids, $template_type );
					break;
				default:
					return;
			}

			exit();
		}
	}

	/**
	 * Process export queue
	 * @return void
	 */
	public function export_queue() {
		// check if enabled
		if ( WPO_WCPDF_Dropbox()->api->is_enabled() === false ) {
			return;
		}
	 	global $typenow;
		if( $typenow == 'shop_order' ) {
			$action = isset($_GET['action'])?$_GET['action']:'';

			// Check action
			if( $action != 'dropbox_upload_queue' &&  $action != 'dropbox_clear_queue' && $action != 'dropbox_queue_process' ) {
				return;
			}

			// Check the user privileges
			if( !current_user_can( 'manage_woocommerce_orders' ) && !current_user_can( 'edit_shop_orders' ) && !isset( $_GET['my-account'] ) ) {
				return;
			}
			
			switch ( $action ) {
				case 'dropbox_upload_queue':
					$this->queue_page( 'upload' );
					break;
				case 'dropbox_clear_queue':
					$this->queue_page( 'clear' );
					break;
				case 'dropbox_queue_process':
					$do = $_GET['do'];
					$this->dropbox_queue_process( $do );
					break;
				default:
					return;
			}

			exit();
		}
	}

	public function bulk_export_page ( $order_ids, $template_type ) {
		// create url/path to process page
		$action_args = array (
			'action'	=> 'dropbox_export_process',
			'template'	=> $template_type,
			);
		$new_page = add_query_arg( $action_args, remove_query_arg( 'action' ) );

		// render pre-export page (waiting page with spinner)
		if ($template_type == 'invoice') {
			$message = __( 'Please wait while your PDF invoices are being uploaded to Dropbox...', 'wpo_wcpdf_pro' );
		} else {
			$message = __( 'Please wait while your PDF packing slips are being uploaded to Dropbox...', 'wpo_wcpdf_pro' );
		}

		include(WPO_WCPDF_Dropbox()->plugin_path().'/includes/bulk-export-page.html');
	}

	public function queue_page ( $do ) {
		// create url/path to process page
		$action_args = array (
			'action'	=> 'dropbox_queue_process',
			'do'		=> $do,
			);
		$new_page = add_query_arg( $action_args, remove_query_arg( 'action' ) );

		// render pre-export page (waiting page with spinner)
		if ($do == 'upload') {
			$message = __( 'Please wait while your queued PDF documents are being uploaded to Dropbox...', 'wpo_wcpdf_pro' );
		} else {
			$message = __( 'Please wait while the upload queue is being cleared', 'wpo_wcpdf_pro' );
		}
		include(WPO_WCPDF_Dropbox()->plugin_path().'/includes/bulk-export-page.html');
	}		

	public function bulk_export_process ( $order_ids, $template_type ) {

		foreach ($order_ids as $order_id) {
			$order = wc_get_order( $order_id );
			// create pdf
			$pdf_path = $this->create_pdf_file( $order_id, $template_type );
			// upload file to dropbox
			$upload_response = $this->upload_to_dropbox( $pdf_path, 'export', $order, $template_type );

			if ( !empty( $upload_response['error'] ) ) {
				// Houston, we have a problem
				$errors[$order_id] = $upload_response['error'];
			}
		}

		// render export done page
		if ( isset($errors) ) {
			$view_log = '<a href="'.esc_url_raw( admin_url( 'admin.php?page=wc-status&tab=logs' ) ).'" target="_blank">'.__( 'View logs', 'wpo_wcpdf_pro' ).'</a>';
			$message = __( 'There were errors when trying to upload to Dropbox, check the error log for details:', 'wpo_wcpdf_pro' ) .'<br>'. $view_log;
		} else {
			switch ($template_type) {
				case 'invoice':
					$message = __( 'PDF invoices successfully uploaded to Dropbox!', 'wpo_wcpdf_pro' );
					break;
				case 'packing-slip':
					$message = __( 'PDF packing slips successfully uploaded to Dropbox!', 'wpo_wcpdf_pro' );
					break;
				default:
					$message = __( 'PDF documents successfully uploaded to Dropbox!', 'wpo_wcpdf_pro' );
					break;
			}
		}

		include(WPO_WCPDF_Dropbox()->plugin_path().'/includes/bulk-export-process.html');		
	}

	public function queue_file( $file, $order = null, $document_type = null ) {
		$queue_folder = $this->get_queue_path();
		$filename = basename($file);
		$queue_file = $queue_folder . $filename;
		copy( $file, $queue_file );

		// store order reference in db if available
		if (!empty($order) && is_object($order)) {
			$dropbox_queue = get_option( 'wpo_wcpdf_dropbox_queue', array() );
			if (!isset($dropbox_queue[$queue_file])) {
				$order_id = method_exists($order, 'get_id') ? $order->get_id(): $order->id;
				$dropbox_queue[$queue_file] = array(
					'order_id'		=> $order_id,
					'document_type'	=> $document_type,
				);
				update_option( 'wpo_wcpdf_dropbox_queue', $dropbox_queue );
			}
		}

		WooCommerce_PDF_IPS_Dropbox_API_Logger::log("file placed in queue: {$queue_file}");
	}

	/**
	 * Get queue path
	 */
	public function get_queue_path () {
		if ( function_exists('WPO_WCPDF') && !empty( WPO_WCPDF()->main ) ) {
			// wcpdf 2.0+
			$queue_path = trailingslashit( WPO_WCPDF()->main->get_tmp_path('dropbox') );
		} else {
			// wcpdf 1.6.5 or older
			global $wpo_wcpdf;
			// first get main PDF tmp setting
			$old_tmp = isset($wpo_wcpdf->export->debug_settings['old_tmp']);

			if ( $old_tmp || !method_exists( $wpo_wcpdf->export, 'tmp_path' ) ) {
				return WPO_WCPDF_Dropbox()->plugin_path() . '/queue/';
			} else {
				$queue_path = trailingslashit( $wpo_wcpdf->export->tmp_path('dropbox') );
			}
		}

		// make sure the queue path is protected!
		// create .htaccess file and empty index.php to protect in case an open webfolder is used!
		if ( !file_exists($queue_path . '.htaccess') || !file_exists($queue_path . 'index.php') ) {
			@file_put_contents( $queue_path . '.htaccess', 'deny from all' );
			@touch( $queue_path . 'index.php' );
		}
		return $queue_path;
	}

	/**
	 * Get queued files
	 */
	public function get_queued_files ($value='') {
		// get list of all files in the queue folder
		$queue_folder = $this->get_queue_path();
		$queued_files = scandir($queue_folder);
		// remove . & ..
		$queued_files = array_diff($queued_files, array('.', '..', '.htaccess', 'index.php'));

		if (!count($queued_files) > 0) {
			// no files in queue;
			return false;
		} else {
			return $queued_files;
		}
	}

	public function get_destination_folder ( $order, $document_type ) {
		$dropbox_settings = get_option( 'wpo_wcpdf_dropbox_settings' );

		// get destination folder setting
		if ( isset($dropbox_settings['access_type']) && $dropbox_settings['access_type'] == 'dropbox' && !empty($dropbox_settings['destination_folder']) ) {
			// format folder name
			$destination_folder = '/'.trim( $dropbox_settings['destination_folder'], '\/').'/';
		} else {
			$destination_folder = '/';
		}

		// append year/month according to setting
		if ( isset($dropbox_settings['year_month_folders']) ) {
			$year = date("Y");
			$month = date("m");
			$destination_folder = "{$destination_folder}{$year}/{$month}/";
		}

		return apply_filters( 'wpo_wcpdf_dropbox_destination_folder', $destination_folder, $order, $document_type );
	}

	public function create_pdf_file ( $order_id, $template_type ) {
		if ( function_exists('WPO_WCPDF') && !empty( WPO_WCPDF()->main ) ) {
			// wcpdf 2.0+
			// turn off deprecation notices during upload
			add_filter( 'wcpdf_disable_deprecation_notices', '__return_true' );

			$tmp_path = trailingslashit( WPO_WCPDF()->main->get_tmp_path('attachments') );

			$document = wcpdf_get_document( $template_type, (array) $order_id, true );
			if ( !$document ) {
				return false;
			}

			// get pdf data & filename
			$pdf_data = $document->get_pdf();
			$pdf_filename = $document->get_filename();

			// re-enable deprecation notices
			remove_filter( 'wcpdf_disable_deprecation_notices', '__return_true' );
		} else {
			// wcpdf 1.6.5 or older
			global $wpo_wcpdf;
			$pdf_data = $wpo_wcpdf->export->get_pdf( $template_type, (array) $order_id );

			// get temp path - 1.4 backwards compatibility
			$old_tmp = isset($wpo_wcpdf->export->debug_settings['old_tmp']);
			if ( $old_tmp || !method_exists( $wpo_wcpdf->export, 'tmp_path' ) ) {
				$tmp_path = WooCommerce_PDF_Invoices::$plugin_path . 'tmp/';
			} else {
				$tmp_path = $wpo_wcpdf->export->tmp_path('attachments'); // reserving the 'dropbox' folder for the queue
			}

			// generate filename & path
			if ( method_exists( $wpo_wcpdf->export, 'build_filename' ) ) {
				$pdf_filename = $wpo_wcpdf->export->build_filename( $template_type, (array) $order_id, 'download' );
			} else {
				$display_number = $wpo_wcpdf->export->get_display_number( $order_id );
				$pdf_filename_prefix = __( $template_type, 'wpo_wcpdf' );
				$pdf_filename = $pdf_filename_prefix . '-' . $display_number . '.pdf';
				$pdf_filename = apply_filters( 'wpo_wcpdf_attachment_filename', $pdf_filename, $display_number, $order_id );
			}
		}

		$pdf_path = $tmp_path . $pdf_filename;

		// save file
		file_put_contents ( $pdf_path, $pdf_data );

		return $pdf_path;
	}

	public function dropbox_queue_process ( $do ) {
		// check if enabled
		if ( WPO_WCPDF_Dropbox()->api->is_enabled() === false ) {
			return;
		}
	 	switch ($do) {
	 		case 'upload':
				
				if ($queued_files = $this->get_queued_files()) {
					$dropbox_queue = get_option( 'wpo_wcpdf_dropbox_queue', array() );
					foreach ($queued_files as $queued_file) {
						$file_path = $this->get_queue_path() . $queued_file;

						// load order if we have stored it
						if (!empty($dropbox_queue[$file_path]) && is_array($dropbox_queue[$file_path])) {
							$document_type = $dropbox_queue[$file_path]['document_type'];
							$order_id = $dropbox_queue[$file_path]['order_id'];
							$order = wc_get_order( $order_id );
						} else {
							$document_type = null;
							$order = null;
						}
						// upload file to dropbox
						$upload_response = $this->upload_to_dropbox( $file_path, 'export', $order, $document_type );

						if ( !empty( $upload_response['error'] ) ) {
							// Houston, we have a problem
							$errors[] = $upload_response['error'];
						} else {
							// remove file
							unlink($file_path);
							// and from queue reference
							if (isset($dropbox_queue[$file_path])) {
								unset($dropbox_queue[$file_path]);
								update_option( 'wpo_wcpdf_dropbox_queue', $dropbox_queue );
							}
						}
					}						
				}
	 			
	 			break;
	 		case 'clear':
	 			// delete all pdf files from queue folder
	 			$queue_path = $this->get_queue_path();
				array_map('unlink', ( glob( $queue_path.'*.pdf' ) ? glob( $queue_path.'*.pdf' ) : array() ) );
	 			break;
	 	}

		// render export done page
		if (isset($errors)) {
			$view_log = '<a href="'.esc_url_raw( admin_url( 'admin.php?page=wc-status&tab=logs' ) ).'" target="_blank">'.__( 'View logs', 'wpo_wcpdf_pro' ).'</a>';
			$message = __( 'There were errors when trying to upload to Dropbox, check the error log for details:', 'wpo_wcpdf_pro' ) .'<br>'. $view_log;
		} elseif ($do == 'upload') {
			$message = __( 'PDF documents successfully uploaded to Dropbox!', 'wpo_wcpdf_pro' );
		} else {
			$message = __( 'Upload queue successfully cleared!', 'wpo_wcpdf_pro' );
		}
		include(WPO_WCPDF_Dropbox()->plugin_path().'/includes/bulk-export-process.html');		
	}

} // class WooCommerce_PDF_IPS_Dropbox_Hooks

endif; // class_exists

return new WooCommerce_PDF_IPS_Dropbox_Hooks();
