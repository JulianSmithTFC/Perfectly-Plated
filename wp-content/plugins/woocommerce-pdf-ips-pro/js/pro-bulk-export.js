jQuery(document).ready(function($) {
	var options = {
		dateFormat: 'yy-mm-dd'
	};

	$('#date-from').datepicker(options);
	$('#date-to').datepicker(options);

	$(function () {
		$('.checkall').on('click', function () {
			$(this).closest('fieldset').find(':checkbox').prop('checked', this.checked);
		});
	});

	$('.button.bulk-export').click(function (event) {
		event.preventDefault();
		if ( $(this).hasClass('disabled') ) {
			return;
		}
		var export_mode = ( $(this).hasClass('wpo_wcpdf_dropbox_bulk_export') ) ? 'dropbox' : 'zip';

		$('.button.bulk-export').addClass('disabled');
		$('.bulk-export-waiting').show();

		var status_filters = [];
		$( '#wcpdf-pro-bulk-export .status-filters' ).each(function() {
			if ($(this).is(":checked")) {
				status_filters.push( $(this).val() );
			}
		});
		var data = {
			action:			'wpo_wcpdf_export_get_order_ids',
			security:		woocommerce_pdf_pro_bulk.nonce,
			date_from:		$( '#wcpdf-pro-bulk-export #date-from' ).val(),
			hour_from:		$( '#wcpdf-pro-bulk-export #hour-from' ).val(),
			minute_from:	$( '#wcpdf-pro-bulk-export #minute-from' ).val(),
			date_to:		$( '#wcpdf-pro-bulk-export #date-to' ).val(),
			hour_to:		$( '#wcpdf-pro-bulk-export #hour-to' ).val(),
			minute_to:		$( '#wcpdf-pro-bulk-export #minute-to' ).val(),
			status_filter:	status_filters,
		};

		// Allow 3rd parties to alter the arguments sent with the Ajax request
		// @author Aelia
		$(document).trigger('wpo_wcpdf_export_get_order_ids_args', data);

		$.post( woocommerce_pdf_pro_bulk.ajax_url, data, function( response ) {
			response = $.parseJSON(response);
			if ( response !== null && typeof response === 'object' && 'error' in response) {
				wpo_wcpdf_bulk_admin_notice( response.error, 'error' );
				$('.button.bulk-export').removeClass('disabled');
				$('.bulk-export-waiting').hide();
			} else if (response !== null && typeof response === 'object') {
				// we have order_ids!
				woocommerce_pdf_pro_bulk.saved_files = [];
				woocommerce_pdf_pro_bulk.succescount = 0;
				wpo_wcpdf_save_pdf_bulk( response, 5, 0, export_mode );
			}
		});

		function wpo_wcpdf_save_pdf_bulk( order_ids, chunksize, offset, export_mode ) {
			var order_ids_chunk = order_ids.slice(offset,offset+chunksize);

			var data = {
				action:			'wpo_wcpdf_export_bulk',
				security:		woocommerce_pdf_pro_bulk.nonce,
				template_type:	$( '#wcpdf-pro-bulk-export #template_type' ).val(),
				skip_free:		$( '#wcpdf-pro-bulk-export #skip_free' ).is(':checked'),
				only_existing:	$( '#wcpdf-pro-bulk-export #only_existing' ).is(':checked'),
				order_ids:		order_ids_chunk,
				export_mode:	export_mode,
			};

			$.ajax({
				async:    true,
				url:      woocommerce_pdf_pro_bulk.ajax_url,
				data:     data,
				type:     'POST',
				success:  function( response ) {
					response = $.parseJSON(response);
					if ( response !== null && typeof response === 'object' && 'error' in response) {
						wpo_wcpdf_bulk_admin_notice( response.error, 'error' );
					} else if (response !== null && typeof response === 'object' && 'success' in response) {
						// success!
						// console.log(response.success.length);
						$.each(response.success, function (order_id, filename) {
							woocommerce_pdf_pro_bulk.succescount++;
							woocommerce_pdf_pro_bulk.saved_files.push(filename);
						});

						var message = woocommerce_pdf_pro_bulk.succescount+' PDF documents saved'
						wpo_wcpdf_bulk_admin_notice( message, 'success', 'replace' );
					}
					// calc make new offset
					offset = offset + chunksize;
					// continue if we have order_ids left
					if ( offset < order_ids.length ) {
						wpo_wcpdf_save_pdf_bulk( order_ids, chunksize, offset, export_mode );
					} else {
						$('.button.bulk-export').removeClass('disabled');
						$('.bulk-export-waiting').hide();

						if (export_mode == 'zip') {
							// console.log(woocommerce_pdf_pro_bulk.saved_files);
							// create form to initiate zip creation + download
							$('body').append('<form action="'+woocommerce_pdf_pro_bulk.ajax_url+'" method="post" target="_blank" id="zip_post_data"></form>');
							$('#zip_post_data').append('<input type="hidden" name="security" value="'+woocommerce_pdf_pro_bulk.nonce+'"/>');
							$('#zip_post_data').append('<input type="hidden" name="action" value="wpo_wcpdf_zip_bulk"/>');
							$('#zip_post_data').append('<input type="hidden" name="template_type" value="'+$('#wcpdf-pro-bulk-export #template_type').val()+'"/>');
							$('#zip_post_data').append('<input type="hidden" name="files" class="files"/>');
							$('#zip_post_data input.files').val( JSON.stringify( woocommerce_pdf_pro_bulk.saved_files ) );

							// submit data to download zip
							$('#zip_post_data').submit();
						}
					}
				}
			});
		}

		function wpo_wcpdf_bulk_admin_notice( message, type, replace ) {
			var notice = '<div class="wpo_wcpdf_bulk_notice notice notice-'+type+'"><p>'+message+'</p></div>';

			$prev_notices = $('.wpo_wcpdf_bulk_notice.notice-'+type);
			if (typeof replace === 'undefined' || $prev_notices.length == 0) {
				$main_header = $( '#wpbody-content > .wrap > h2:first' );
				$main_header.after( notice );
				$('html, body').animate({ scrollTop: 0 }, 'slow');
			} else {
				$('.wpo_wcpdf_bulk_notice.notice-'+type).first().replaceWith( notice );
			}

		}
	});
});
