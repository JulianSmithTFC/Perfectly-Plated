<?php
namespace WPO\WC\PDF_Invoices_Pro;

use WPO\WC\PDF_Invoices\Compatibility\WC_Core as WCX;
use WPO\WC\PDF_Invoices\Compatibility\Order as WCX_Order;
use WPO\WC\PDF_Invoices\Compatibility\Product as WCX_Product;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( !class_exists( '\\WPO\\WC\\PDF_Invoices_Pro\\Writepanels' ) ) :

class Writepanels {
	public function __construct() {
		// hide credit note button for non-refunded orders
		add_filter( 'wpo_wcpdf_meta_box_actions', array( $this, 'credit_note_button_visibility' ), 10, 1 );
		add_filter( 'wpo_wcpdf_listing_actions', array( $this, 'credit_note_button_visibility' ), 10, 2 );
		add_filter( 'wpo_wcpdf_myaccount_actions', array( $this, 'my_account_button_visibility' ), 10, 2 );

		add_action( 'wcpdf_invoice_number_column_end', array( $this, 'credit_note_number_column_data' ), 10, 1 );

		add_filter( 'woocommerce_resend_order_emails_available', array( $this, 'pro_email_order_actions' ), 90, 1 );
		add_action( 'wpo_wcpdf_meta_box_end', array( $this, 'edit_numbers_dates' ), 10, 1 );
		add_action( 'save_post', array( $this,'save_numbers_dates' ) );
	}

	/**
	 * Remove credit note button if order is not refunded
	 */
	public function credit_note_button_visibility ($actions, $order = '' ) {
		if (empty($order)) {
			global $post_id;
			$order = wc_get_order( $post_id );
		}

		if ($order) {
			$refunds = $order->get_refunds();

			if ( empty( $refunds ) ) {
				unset($actions['credit-note']);
			} else {
				// only show credit note button when there is also an invoice for this order
				$invoice = wcpdf_get_invoice( $order );
				if ( $invoice && $invoice->exists() === false ) {
					unset($actions['credit-note']);
				}
			}
		} else {
			unset($actions['credit-note']);
		}

		return $actions;
	}

	/**
	 * Display download buttons (Proforma & Credit Note) on My Account page
	 */
	public function my_account_button_visibility( $actions, $order ) {
		$proforma = wcpdf_get_document( 'proforma', $order );
		$order_id = WCX_Order::get_id( $order );

		if ( $proforma && $proforma->is_enabled() ) {
			// check my account button settings
			$button_setting = $proforma->get_setting('my_account_buttons', 'no_invoice');
			switch ($button_setting) {
				case 'no_invoice':
					$proforma_allowed = isset($actions['invoice']) ? false: true;
					break;
				case 'available':
					$proforma_allowed = $proforma->exists();
					break;
				case 'always':
					$proforma_allowed = true;
					break;
				case 'never':
					$proforma_allowed = false;
					break;
				case 'custom':
					$allowed_statuses = $button_setting = $proforma->get_setting('my_account_restrict', array());
					if ( !empty( $allowed_statuses ) && in_array( WCX_Order::get_status( $order ), array_keys( $allowed_statuses ) ) ) {
						$proforma_allowed = true;
					} else {
						$proforma_allowed = false;
					}
					break;
			}

			$document_title = array_filter( $proforma->get_setting( 'title', array() ) );
			if ( !empty($document_title) ) {
				$button_text = sprintf ( __( 'Download %s (PDF)', 'wpo_wcpdf_pro' ), $proforma->get_title() );
			} else {
				$button_text =  __( 'Download Proforma Invoice (PDF)', 'wpo_wcpdf_pro' );
			}

			if ($proforma_allowed) {
				$actions['proforma'] = array(
					'url'  => wp_nonce_url( admin_url( 'admin-ajax.php?action=generate_wpo_wcpdf&template_type=proforma&order_ids=' . $order_id . '&my-account' ), 'generate_wpo_wcpdf' ),
					'name' => apply_filters( 'wpo_wcpdf_myaccount_proforma_button', $button_text, $proforma ),
				);
			}
		}

		// show credit note button when credit note is available and invoice is too
		if ( version_compare( WOOCOMMERCE_VERSION, '2.2.7', '>=' ) ) {
			$refunds = $order->get_refunds();
			// if there's at least one credit note, we'll take them all...
			if ( !empty( $refunds ) && isset( $actions['invoice'] ) ) {
				$first_refund = current( $refunds );
				$credit_note = wcpdf_get_document( 'credit-note', $first_refund );
				if ( $credit_note && $credit_note->exists() && $credit_note->is_enabled() ) {
					$document_title = array_filter( $credit_note->get_setting( 'title', array() ) );
					if ( !empty($document_title) ) {
						$button_text = sprintf ( __( 'Download %s (PDF)', 'wpo_wcpdf_pro' ), $credit_note->get_title() );
					} else {
						$button_text =  __( 'Download Credit Note (PDF)', 'wpo_wcpdf_pro' );
					}
					$actions['credit-note'] = array(
						'url'  => wp_nonce_url( admin_url( 'admin-ajax.php?action=generate_wpo_wcpdf&template_type=credit-note&order_ids=' . $order_id . '&my-account' ), 'generate_wpo_wcpdf' ),
						'name' => apply_filters( 'wpo_wcpdf_myaccount_credit_note_button', $button_text, $credit_note ),
					);
				}
			}
		}

		return $actions;
	}

	/**
	 * Display Credit Note Number in Shop Order column (if available)
	 * @param  string $column column slug
	 */
	public function credit_note_number_column_data( $order ) {
		$refunds = $order->get_refunds();
		foreach ($refunds as $key => $refund) {
			$refund_id = WCX_Order::get_id( $refund );
			$credit_note = wcpdf_get_document( 'credit-note', $refund );
			if ( $credit_note && $credit_note_number = $credit_note->get_number( 'credit-note' ) ) {
				$credit_note_numbers[] = $credit_note_number;
			}
		}

		if ( isset($credit_note_numbers) ) {
			?>
			<br/><?php echo $credit_note->get_title(); ?>:<br/>
			<?php
			echo implode(', ', $credit_note_numbers);
		}
	}

	public function edit_numbers_dates ( $order_id ) {
		$order = wc_get_order( $order_id );

		// Credit note
		if ( version_compare( WOOCOMMERCE_VERSION, '2.2', '>=' ) ) {
			$refunds = $order->get_refunds();
			if ( !empty( $refunds ) ) {
				foreach ($refunds as $key => $refund) {
					$credit_note = wcpdf_get_document( 'credit-note', $refund );
					if ( $credit_note && $credit_note->exists() ) {
						$refund_id = WCX_Order::get_id( $refund );

						$titles = array(
							'number'				=> __( 'Credit Note Number:', 'wpo_wcpdf_pro' ),
							'number_unformatted'	=> __( 'Credit Note Number (unformatted!)', 'wpo_wcpdf_pro' ),
							'date'					=> __( 'Credit Note Date:', 'wpo_wcpdf_pro' ),
						);
						$fields = array(
							'number'	=> "_wcpdf_credit_note_number[{$refund_id}]",
							'date'		=> "_wcpdf_credit_note_date[{$refund_id}]",
							'hour'		=> "_wcpdf_credit_note_date_hour[{$refund_id}]",
							'minute'	=> "_wcpdf_credit_note_date_minute[{$refund_id}]",
						);
						$this->output_number_date_edit_fields( $credit_note, $titles, $fields );
					}
				}
			}
		}

		// Proforma invoice
		$proforma = wcpdf_get_document( 'proforma', $order );
		if ( $proforma && $proforma->exists() ) {
			$titles = array(
				'number'				=> __( 'Proforma Invoice Number:', 'wpo_wcpdf_pro' ),
				'number_unformatted'	=> __( 'Proforma Invoice Number (unformatted!)', 'wpo_wcpdf_pro' ),
				'date'					=> __( 'Proforma Invoice Date:', 'wpo_wcpdf_pro' ),
			);
			$fields = array(
				'number'	=> '_wcpdf_proforma_number',
				'date'		=> '_wcpdf_proforma_date',
				'hour'		=> '_wcpdf_proforma_date_hour',
				'minute'	=> '_wcpdf_proforma_date_minute',
			);
			$this->output_number_date_edit_fields( $proforma, $titles, $fields );
		}

		// Packing slip
		$packing_slip = wcpdf_get_document( 'packing-slip', $order );
		if ( $packing_slip && $packing_slip->exists() ) {
			$titles = array(
				'number'				=> __( 'Packing Slip Number:', 'wpo_wcpdf_pro' ),
				'number_unformatted'	=> __( 'Packing Slip Number (unformatted!)', 'wpo_wcpdf_pro' ),
				'date'					=> __( 'Packing Slip Date:', 'wpo_wcpdf_pro' ),
			);
			$fields = array(
				'number'	=> '_wcpdf_packing_slip_number',
				'date'		=> '_wcpdf_packing_slip_date',
				'hour'		=> '_wcpdf_packing_slip_date_hour',
				'minute'	=> '_wcpdf_packing_slip_date_minute',
			);
			$this->output_number_date_edit_fields( $packing_slip, $titles, $fields );
		}

	}

	public function output_number_date_edit_fields( $document, $titles, $fields ) {
		$number = $document->get_number();
		$date = $document->get_date();
		?>
		<div class="wcpdf-data-fields" data-document="<?php echo $document->get_type(); ?>" data-order_id="<?php echo WCX_Order::get_id( $document->order ); ?>">
			<h4><?php echo $document->get_title(); ?><?php if ($document->exists()) : ?><span class="wpo-wcpdf-edit-date-number dashicons dashicons-edit"></span><span class="wpo-wcpdf-delete-document dashicons dashicons-trash" data-nonce="<?php echo wp_create_nonce( "wpo_wcpdf_delete_document" ); ?>"></span><?php endif; ?></h4>

			<!-- Read only -->
			<div class="read-only">
				<div class="invoice-number">
					<p class="form-field _wcpdf_invoice_number_field ">	
						<p>
							<span><strong><?php echo $titles['number']; ?></strong></span>
							<span><?php if (!empty($number)) echo $number->get_formatted(); ?></span>
						</p>
					</p>
				</div>

				<div class="invoice-date">
					<p class="form-field form-field-wide">
						<p>
							<span><strong><?php echo $titles['date']; ?></strong></span>
							<span><?php if (!empty($date)) echo $date->date_i18n( wc_date_format().' @ '.wc_time_format() ); ?></span>
						</p>
					</p>
				</div>
			</div>

			<!-- Editable -->
			<div class="editable">
				<p class="form-field _wcpdf_<?php echo $document->slug; ?>_number_field ">
					<label for="<?php echo $fields['number']; ?>"><?php echo $titles['number_unformatted']; ?>:</label>
					<?php if ( $document->exists() && !empty($number) ) : ?>
					<input type="text" class="short" style="" name="<?php echo $fields['number']; ?>" id="<?php echo $fields['number']; ?>" value="<?php echo $number->get_plain(); ?>" disabled="disabled" >
					<?php else : ?>
					<input type="text" class="short" style="" name="<?php echo $fields['number']; ?>" id="<?php echo $fields['number']; ?>" value="" disabled="disabled" >
					<?php endif; ?>
				</p>
				<p class="form-field form-field-wide">
					<label for="<?php echo $fields['date']; ?>"><?php echo $titles['date']; ?></label>
					<?php
					if ( $document->exists() && !empty($date) ) {
						printf('<input type="text" class="date-picker-field" name="%1$s" id="%1$s" maxlength="10" value="%2$s" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" />@<input type="number" class="hour" placeholder="%3$s" name="%4$s" id="%4$s" min="0" max="23" size="2" value="%5$s" pattern="([01]?[0-9]{1}|2[0-3]{1})" />:<input type="number" class="minute" placeholder="%6$s" name="%7$s" id="%7$s" min="0" max="59" size="2" value="%8$s" pattern="[0-5]{1}[0-9]{1}" />', $fields['date'], $date->date_i18n( 'Y-m-d' ), __( 'h', 'woocommerce' ), $fields['hour'], $date->date_i18n( 'H' ), __( 'm', 'woocommerce' ), $fields['minute'], $date->date_i18n( 'i' ) );
					} else {
						printf('<input type="text" class="date-picker-field" name="%1$s" id="%1$s" maxlength="10" disabled="disabled" value="" pattern="[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])" />@<input type="number" class="hour" disabled="disabled" placeholder="%3$s" name="%4$s" id="%4$s" min="0" max="23" size="2" value="" pattern="([01]?[0-9]{1}|2[0-3]{1})" />:<input type="number" class="minute" placeholder="%6$s" name="%7$s" id="%7$s" min="0" max="59" size="2" value="" pattern="[0-5]{1}[0-9]{1}" disabled="disabled" />', $fields['date'], '', __( 'h', 'woocommerce' ), $fields['hour'], '', __( 'm', 'woocommerce' ), $fields['minute'], '' );
					}
					?>
				</p>
			</div>

		</div>
		<?php

	}


	/**
	 * Process numbers & dates from order edit screen
	 */
	public function save_numbers_dates ( $post_id ) {
		$post_type = get_post_type( $post_id );
		if( $post_type == 'shop_order' ) {
			// bail if this is not an actual 'Save order' action
			if (!isset($_POST['action']) || $_POST['action'] != 'editpost') {
				return;
			}
			
			$order = WCX::get_order( $post_id );

			/**
			 * PROFORMA
			 */
			if ( $proforma = wcpdf_get_document( 'proforma', $order ) ) {
				if ( isset( $_POST['_wcpdf_proforma_date'] ) ) {
					$date = $_POST['_wcpdf_proforma_date'];
					$hour = !empty( $_POST['_wcpdf_proforma_date_hour'] ) ? $_POST['_wcpdf_proforma_date_hour'] : '00';
					$minute = !empty( $_POST['_wcpdf_proforma_date_minute'] ) ? $_POST['_wcpdf_proforma_date_minute'] : '00';
					$proforma_date = "{$date} {$hour}:{$minute}:00";
					$proforma->set_date( $proforma_date );
				} elseif ( empty( $_POST['_wcpdf_proforma_date'] ) && isset( $_POST['_wcpdf_proforma_number'] ) ) {
					$proforma->set_date( current_time( 'timestamp', true ) );
				}

				if ( isset( $_POST['_wcpdf_proforma_number'] ) ) {
					$proforma->set_number( $_POST['_wcpdf_proforma_number'] );
				}

				$proforma->save();
			}

			/**
			 * PACKING SLIP
			 */
			if ( $packing_slip = wcpdf_get_document( 'packing-slip', $order ) ) {
				if ( isset( $_POST['_wcpdf_packing_slip_date'] ) ) {
					$date = $_POST['_wcpdf_packing_slip_date'];
					$hour = !empty( $_POST['_wcpdf_packing_slip_date_hour'] ) ? $_POST['_wcpdf_packing_slip_date_hour'] : '00';
					$minute = !empty( $_POST['_wcpdf_packing_slip_date_minute'] ) ? $_POST['_wcpdf_packing_slip_date_minute'] : '00';
					$packing_slip_date = "{$date} {$hour}:{$minute}:00";
					$packing_slip->set_date( $packing_slip_date );
				} elseif ( empty( $_POST['_wcpdf_packing_slip_date'] ) && isset( $_POST['_wcpdf_packing_slip_number'] ) ) {
					$packing_slip->set_date( current_time( 'timestamp', true ) );
				}

				if ( isset( $_POST['_wcpdf_packing_slip_number'] ) ) {
					$packing_slip->set_number( $_POST['_wcpdf_packing_slip_number'] );
				}

				$packing_slip->save();
			}

			/**
			 * CREDIT NOTES
			 */
			$credit_note_data_list = array();
			if ( isset($_POST['_wcpdf_credit_note_number'] ) ) {
				foreach ($_POST['_wcpdf_credit_note_number'] as $refund_id => $number) {
					$credit_note_data_list[$refund_id]['number'] = $number;
				}
			}
			if ( isset($_POST['_wcpdf_credit_note_date'] ) ) {
				foreach ($_POST['_wcpdf_credit_note_date'] as $refund_id => $date) {
						// echo '<pre>';var_dump($date);echo '</pre>';die();
					if (!empty($date)) {
						$hour = !empty( $_POST['_wcpdf_credit_note_date_hour'][$refund_id] ) ? $_POST['_wcpdf_credit_note_date_hour'][$refund_id] : '00';
						$minute = !empty( $_POST['_wcpdf_credit_note_date_minute'][$refund_id] ) ? $_POST['_wcpdf_credit_note_date_minute'][$refund_id] : '00';
						$credit_note_date = "{$date} {$hour}:{$minute}:00";
						$credit_note_data_list[$refund_id]['date'] = $credit_note_date;
					}
				}
			}

			foreach ($credit_note_data_list as $refund_id => $credit_note_data) {
				$refund = WCX::get_order( $refund_id );
				// prevent save actions on refund that has just been deleted
				if (empty($refund)) {
					continue;
				}
				if ( $credit_note = wcpdf_get_document( 'credit-note', $refund ) ) {
					if ( !empty ( $credit_note_data['date'] ) ) {
						$date = $credit_note_data['date'];
						$credit_note->set_date( $date );
					} elseif ( empty( $credit_note_data['date'] ) && !empty( $credit_note_data['number'] ) ) {
						$credit_note->set_date( current_time( 'timestamp', true ) );
					}

					if ( isset( $credit_note_data['number'] ) ) {
						$credit_note->set_number( $credit_note_data['number'] );
					}

					$credit_note->save();
				}
			}

		}
	}
	/**
	 * Add credit note email to order actions list
	 */
	public function pro_email_order_actions ( $available_emails ) {
		global $post_id;

		$order_notification_settings = get_option( 'woocommerce_pdf_order_notification_settings' );
		if ( isset($order_notification_settings['recipient']) && !empty($order_notification_settings['recipient']) ) {
			// only add order notification action when a recipient is set!
			$available_emails[] = 'pdf_order_notification';
		}

		if ( version_compare( WOOCOMMERCE_VERSION, '2.2', '>=' ) ) {
			if ( $order = wc_get_order( $post_id ) ) {
				$refunds = $order->get_refunds();
				if ( !empty( $refunds ) ) {
					$available_emails[] = 'customer_credit_note';
				}
			}
		}

		return $available_emails;
	}
} // end class

endif; // end class_exists

return new Writepanels();