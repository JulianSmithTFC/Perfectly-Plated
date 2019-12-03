<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( !class_exists( 'WooCommerce_PDF_IPS_Dropbox_Writepanels' ) ) {

	class WooCommerce_PDF_IPS_Dropbox_Writepanels {
		public function __construct() {
			add_action(	'admin_footer', array( &$this, 'export_actions' ) );
			add_action( 'admin_enqueue_scripts', array( &$this, 'bulk_action_scripts' ) );
			add_action( 'admin_enqueue_scripts', array( &$this, 'queue_scripts' ) );

			add_action( 'admin_notices', array( &$this, 'upload_queue' ) );
		}

		/**
		 * Add dropbox actions to bulk action drop down menu
		 *
		 * Using Javascript until WordPress core fixes: http://core.trac.wordpress.org/ticket/16031
		 *
		 * @access public
		 * @return void
		 */
		public function export_actions() {
			global $post_type;
			
			if ( WPO_WCPDF_Dropbox()->api->is_enabled() !== false && 'shop_order' == $post_type ) {
				?>
				<script type="text/javascript">
				jQuery(document).ready(function() {
					jQuery('<option>').val('dropbox_export_invoices').text('<?php _e( 'PDF Invoices to Dropbox', 'wpo_wcpdf_pro' )?>').appendTo("select[name='action']");
					jQuery('<option>').val('dropbox_export_invoices').text('<?php _e( 'PDF Invoices to Dropbox', 'wpo_wcpdf_pro' )?>').appendTo("select[name='action2']");
					jQuery('<option>').val('dropbox_export_packing_slips').text('<?php _e( 'PDF Packing Slips to Dropbox', 'wpo_wcpdf_pro' )?>').appendTo("select[name='action']");
					jQuery('<option>').val('dropbox_export_packing_slips').text('<?php _e( 'PDF Packing Slips to Dropbox', 'wpo_wcpdf_pro' )?>').appendTo("select[name='action2']");
				});
				</script>
				<?php
			}
		}

		/**
		 * JS for export action
		 */
		public function bulk_action_scripts() {
		 	global $post_type;
			if( $post_type == 'shop_order' ) {
				wp_register_script(
					'dropbox-export',
					plugins_url( 'js/dropbox-export.js' , dirname(__FILE__) ),
					array( 'jquery', 'thickbox' )
				);
				wp_enqueue_script( 'dropbox-export' );
				wp_enqueue_style( 'thickbox' );
			}

		}

		/**
		 * JS for upload queue
		 */
		public function queue_scripts() {
			if ( $queue = WPO_WCPDF_Dropbox()->hooks->get_queued_files() ) {
				wp_register_script(
					'dropbox-queue',
					plugins_url( 'js/dropbox-queue.js' , dirname(__FILE__) ),
					array( 'jquery', 'thickbox' )
				);
				wp_enqueue_script( 'dropbox-queue' );
				wp_enqueue_style( 'thickbox' );
			}
		}	

		/**
		 * Display notification about upload queue with link to process queue
		 * @return void
		 */
		public function upload_queue() {
			$queue = WPO_WCPDF_Dropbox()->hooks->get_queued_files();
			if ( !empty($queue) && WPO_WCPDF_Dropbox()->api->is_enabled() && !empty(WPO_WCPDF_Dropbox()->api->get_access_token())) {
				$files_count = count($queue);

				$upload_button	= '<a href="edit.php?post_type=shop_order&action=dropbox_upload_queue" class="button-primary" id="dropbox_upload_queue">'.__( 'Upload files', 'wpo_wcpdf_pro' ).'</a>';
				$clear_button	= '<a href="edit.php?post_type=shop_order&action=dropbox_clear_queue"  class="button-primary" id="dropbox_clear_queue" >'.__( 'Clear queue', 'wpo_wcpdf_pro' ).'</a>';

				// display message
				?>
				<div class="updated">
				<p><?php printf( __( 'There are %s unfinished uploads in your the upload queue from WooCommerce PDF Invoices & Packing Slips to Dropbox.', 'wpo_wcpdf_pro' ), $files_count ); ?></p>
				<p><?php echo $upload_button . ' ' . $clear_button; ?></p>
				</div>
				<?php			

			}

		}

	} // end class
} // end class_exists

return new WooCommerce_PDF_IPS_Dropbox_Writepanels();