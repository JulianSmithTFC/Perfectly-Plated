<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( !class_exists( 'WooCommerce_PDF_IPS_Dropbox_Settings' ) ) {

	class WooCommerce_PDF_IPS_Dropbox_Settings {
		public function __construct() {
			add_action( 'admin_init', array( $this, 'init_settings' ) ); // Registers settings
			add_filter( 'plugin_action_links_'.WPO_WCPDF_Dropbox()->plugin_basename, array( $this, 'add_settings_link' ) );

			// hook into main pdf plugin settings
			add_filter( 'wpo_wcpdf_settings_tabs', array( $this, 'settings_tab' ) );

			// add unlink button
			add_action( 'wpo_wcpdf_after_settings_page', array( $this, 'unlink' ), 10, 1 );
		}

		/**
		 * Add settings link to plugins page
		 */
		public function add_settings_link( $links ) {
			$settings_link = '<a href="admin.php?page=wpo_wcpdf_options_page&tab=dropbox">'. __( 'Settings', 'woocommerce' ) . '</a>';
			array_push( $links, $settings_link );
		  	return $links;
		}

		/**
		 * add Dropbox settings tab to the PDF Invoice settings page
		 * @param  array $tabs slug => Title
		 * @return array $tabs with Dropbox
		 */
		public function settings_tab( $tabs ) {
			$tabs['dropbox'] = __('Dropbox','wpo_wcpdf_pro');

			return $tabs;
		}

		/**
		 * Button to unlink dropbox account
		 */
		public function unlink ($tab) {
			// check if enabled
			if ( WPO_WCPDF_Dropbox()->api->is_enabled() === false ) {
				return;
			}
			// remove API details if requested
			if (isset($_REQUEST['wpo_wcpdf_unlink_dropbox'])) {
				update_option( 'wpo_wcpdf_dropbox_api_v2', '' );
				wp_redirect( remove_query_arg( 'wpo_wcpdf_unlink_dropbox' ) );
				exit();
			}

			// display unlink button if we have an access token
			$dropbox_api = get_option( 'wpo_wcpdf_dropbox_api_v2' );
			if ( $tab =='dropbox' && isset($dropbox_api['access_token'])) {
				if (!empty($dropbox_api['account_info'])) {
					printf('<div>%s: %s</div>', __( 'Connected to', 'wpo_wcpdf_pro' ), $dropbox_api['account_info']);
				}
				$unlink_url = add_query_arg( 'wpo_wcpdf_unlink_dropbox', 'true' );
				printf('<a href="%s" class="button">%s</a>', $unlink_url, __('Unlink Dropbox account','wpo_wcpdf_pro') );
			}
		}

		/**
		 * User settings.
		 */
		public function init_settings() {
			$option = 'wpo_wcpdf_dropbox_settings';
		
			// Create option in wp_options.
			if ( false == get_option( $option ) ) {
				add_option( $option );
			}
		
			// Section.
			add_settings_section(
				'dropbox_settings',
				__( 'Dropbox settings', 'wpo_wcpdf_pro' ),
				array( &$this, 'section_options_callback' ),
				$option
			);

			add_settings_field(
				'enabled',
				__( 'Enable', 'wpo_wcpdf_pro' ),
				array( &$this, 'checkbox_element_callback' ),
				$option,
				'dropbox_settings',
				array(
					'menu'			=> $option,
					'id'			=> 'enabled',
				)
			);

			add_settings_field(
				'auto_upload',
				__( 'Upload all email attachments', 'wpo_wcpdf_pro' ),
				array( &$this, 'checkbox_element_callback' ),
				$option,
				'dropbox_settings',
				array(
					'menu'			=> $option,
					'id'			=> 'auto_upload',
				)
			);

			// prepare data for per status upload settings
			$order_statuses = array( '-' => '-' ) + $this->get_order_statuses();
			$documents = $this->get_pdf_documents();
			$per_status_upload_items = array();
			foreach ($documents as $template_type => $name) {
				$per_status_upload_items[$template_type] = array(
					'name'			=> $name,
					'options'		=> $order_statuses,
				);
			}

			add_settings_field(
				'per_status_upload',
				__( 'Upload by order status', 'wpo_wcpdf_pro' ),
				array( &$this, 'multiple_select_callback' ),
				$option,
				'dropbox_settings',
				array(
					'menu'			=> $option,
					'id'			=> 'per_status_upload',
					'items'			=> $per_status_upload_items,
					'description'	=> __( 'If you are already emailing the documents, leave these settings empty to avoid slowing down your site (use the setting above instead)', 'wpo_wcpdf_pro' ),
				)
			);			

			add_settings_field(
				'access_type',
				__( 'Destination folder', 'wpo_wcpdf_pro' ),
				array( &$this, 'select_element_callback' ),
				$option,
				'dropbox_settings',
				array(
					'menu'			=> $option,
					'id'			=> 'access_type',
					'options' 		=> array(
						'app_folder'	=> __( 'App folder (restricted access)' , 'wpo_wcpdf_pro' ),
						'dropbox'		=> __( 'Main Dropbox folder' , 'wpo_wcpdf_pro' ),
					),
					'description'	=> __( 'Note: Reauthorization is required after changing this setting!' , 'wpo_wcpdf_pro' ),
					'custom'		=> array(
						'type'			=> 'text_element_callback',
						'custom_option'	=> 'dropbox',
						'args'			=> array(
							'menu'			=> $option,
							'id'			=> 'destination_folder',
							'size'			=> '40',
							'description'	=> __( 'Enter a subfolder to use (optional)', 'wpo_wcpdf_pro' ),
						),
					),
				)
			);

			add_settings_field(
				'year_month_folders',
				__( 'Organize uploads in folders by year/month', 'wpo_wcpdf_pro' ),
				array( &$this, 'checkbox_element_callback' ),
				$option,
				'dropbox_settings',
				array(
					'menu'			=> $option,
					'id'			=> 'year_month_folders',
				)
			);

			add_settings_field(
				'api_log',
				__( 'Log all communication (debugging only!)', 'wpo_wcpdf_pro' ),
				array( &$this, 'checkbox_element_callback' ),
				$option,
				'dropbox_settings',
				array(
					'menu'			=> $option,
					'id'			=> 'api_log',
					'description'	=> '<a href="'.esc_url_raw( admin_url( 'admin.php?page=wc-status&tab=logs' ) ).'" target="_blank">'.__( 'View logs', 'wpo_wcpdf_pro' ).'</a>',
				)
			);

			// Register settings.
			register_setting( $option, $option, array( &$this, 'validate_options' ) );

			// Register defaults if settings empty (might not work in case there's only checkboxes and they're all disabled)
			$option_values = get_option($option);
			if ( empty( $option_values ) ) {
				// $this->default_settings( 'wpo_wcpdf_dropbox_settings' );
			}
		}

		/**
		 * Get list of WooCommerce order statuses (without the wc- prefix)
		 *
		 * @return  array status slug => status name
		 */
		public function get_order_statuses() {
			if ( version_compare( WOOCOMMERCE_VERSION, '2.2', '<' ) ) {
				$statuses = (array) get_terms( 'shop_order_status', array( 'hide_empty' => 0, 'orderby' => 'id' ) );
				foreach ( $statuses as $status ) {
					$order_statuses[esc_attr( $status->slug )] = esc_html__( $status->name, 'woocommerce' );
				}
			} else {
				$statuses = wc_get_order_statuses();
				foreach ( $statuses as $status_slug => $status ) {
					$status_slug   = 'wc-' === substr( $status_slug, 0, 3 ) ? substr( $status_slug, 3 ) : $status_slug;
					$order_statuses[$status_slug] = $status;
				}
			}

			return $order_statuses;
		}

		/**
		 * Get list of PDF documents
		 *
		 * @return  array document slug => document name
		 */
		public function get_pdf_documents() {
			$documents = WPO_WCPDF()->documents->get_documents();
			$document_list = array();
			foreach ($documents as $document) {
				$document_list[$document->get_type()] = $document->get_title();
			}

			return $document_list;
		}		
		
		/**
		 * Set default settings.
		 * 
		 * @return void.
		 */
		public function default_settings( $option ) {
			$default_settings = array(
				'auto_upload'		=> '1',
			);

			update_option( $option, $default_settings );
		}

		/**
		 * Checkbox field callback.
		 *
		 * @param  array $args Field arguments.
		 *
		 * @return string	  Checkbox field.
		 */
		public function checkbox_element_callback( $args ) {
			$menu = $args['menu'];
			$id = $args['id'];
		
			$options = get_option( $menu );
		
			if ( isset( $options[$id] ) ) {
				$current = $options[$id];
			} else {
				$current = isset( $args['default'] ) ? $args['default'] : '';
			}
		
			$disabled = (isset( $args['disabled'] )) ? ' disabled' : '';
			$html = sprintf( '<input type="checkbox" id="%1$s" name="%2$s[%1$s]" value="1"%3$s %4$s/>', $id, $menu, checked( 1, $current, false ), $disabled );
		
			// Displays option description.
			if ( isset( $args['description'] ) ) {
				$html .= sprintf( '<p class="description">%s</p>', $args['description'] );
			}
		
			echo $html;
		}

		/**
		 * Text element callback.
		 * @param  array $args Field arguments.
		 * @return string	   Text input field.
		 */
		public function text_element_callback( $args ) {
			$menu = $args['menu'];
			$id = $args['id'];
			$size = isset( $args['size'] ) ? $args['size'] : '25';
		
			$options = get_option( $menu );
		
			if ( isset( $options[$id] ) ) {
				$current = $options[$id];
			} else {
				$current = isset( $args['default'] ) ? $args['default'] : '';
			}
		
			$html = sprintf( '<input type="text" id="%1$s" name="%2$s[%1$s]" value="%3$s" size="%4$s"/>', $id, $menu, $current, $size );
		
			// Displays option description.
			if ( isset( $args['description'] ) ) {
				$html .= sprintf( '<p class="description">%s</p>', $args['description'] );
			}
		
			echo $html;
		}

		/**
		 * Select element callback.
		 *
		 * @param  array $args Field arguments.
		 *
		 * @return string	  Select field.
		 */
		public function select_element_callback( $args ) {
			$menu = $args['menu'];
			$id = $args['id'];
		
			$options = get_option( $menu );
		
			if ( isset( $options[$id] ) ) {
				$current = $options[$id];
			} else {
				$current = isset( $args['default'] ) ? $args['default'] : '';
			}
		
			printf( '<select id="%1$s" name="%2$s[%1$s]">', $id, $menu );
	
			foreach ( $args['options'] as $key => $label ) {
				printf( '<option value="%s"%s>%s</option>', $key, selected( $current, $key, false ), $label );
			}
	
			echo '</select>';

			if (isset($args['custom'])) {
				$custom = $args['custom'];

				?>
				<script type="text/javascript">
				jQuery(document).ready(function($) {
					$( '#<?php echo $id;?>' ).change(function() {
						var selection = $('#<?php echo $id;?>').val();
						// console.log(selection);
						if ( selection == '<?php echo $custom['custom_option'];?>' ) {
							$( '#<?php echo $id;?>_custom_wrapper' ).show();
						} else {
							$( '#<?php echo $id;?>_custom_wrapper' ).hide();
						}
					});
					$( '#<?php echo $id;?>' ).change();
				});
				</script>
				<div id="<?php echo $id;?>_custom_wrapper">
				<?php

				switch ($custom['type']) {
					case 'text_element_callback':
						$this->text_element_callback( $custom['args'] );
						break;		
					case 'multiple_text_element_callback':
						$this->multiple_text_element_callback( $custom['args'] );
						break;		
					default:
						break;
				}
				echo '</div>';
			}
		
			// Displays option description.
			if ( isset( $args['description'] ) ) {
				printf( '<p class="description">%s</p>', $args['description'] );
			}
		}

		public function multiple_select_callback ( $args ) {
			$menu = $args['menu'];
			$id = $args['id'];
		
			$options = get_option( $menu );
			// echo '<pre>';var_dump($options);echo '</pre>';die();
		
			if ( isset( $options[$id] ) ) {
				$current = $options[$id];
			} else {
				$current = isset( $args['default'] ) ? $args['default'] : '';
			}


			echo '<table>';
			foreach ($args['items'] as $template_type => $document_setting) {
				extract($document_setting); // name, options

				printf( '<tr><td style="padding:0;">%1$s:</td><td style="padding:0;"><select id="%2$s" name="%2$s[%3$s][%4$s]">', $name, $menu, $id, $template_type );
		
				foreach ( $options as $key => $label ) {
					$current_selected = isset($current[$template_type])?$current[$template_type]:'';
					printf( '<option value="%s"%s>%s</option>', $key, selected( $current_selected, $key, false ), $label );
				}
		
				echo '</select></td></tr>';
			}
			echo '</table>';
		
			// Displays option description.
			if ( isset( $args['description'] ) ) {
				printf( '<p class="description">%s</p>', $args['description'] );
			}
		}

		/**
		 * Section null callback.
		 *
		 * @return void.
		 */
		public function section_options_callback() {
		}
		
		/**
		 * Validate options.
		 *
		 * @param  array $input options to valid.
		 *
		 * @return array		validated options.
		 */
		public function validate_options( $input ) {
			// Create our array for storing the validated options.
			$output = array();
		
			// Loop through each of the incoming options.
			foreach ( $input as $key => $value ) {
		
				// Check to see if the current option has a value. If so, process it.
				if ( isset( $input[$key] ) ) {
					if ( is_array( $input[$key] ) ) {
						foreach ( $input[$key] as $sub_key => $sub_value ) {
							$output[$key][$sub_key] = $input[$key][$sub_key];
						}
					} else {
						$output[$key] = $input[$key];
					}
				}
			}

			// plugin specific validation
			$last_settings = get_option( 'wpo_wcpdf_dropbox_settings' );

			// unlink app if access_type changed
			if ( $last_settings['access_type'] != $input['access_type'] ) {
				delete_option( 'wpo_wcpdf_dropbox_api_v2' );
			}

		
			// Return the array processing any additional functions filtered by this action.
			return apply_filters( 'wpo_wcpdf_dropbox_validate_input', $output, $input );
		}

	} // end class
} // end class_exists

return new WooCommerce_PDF_IPS_Dropbox_Settings();