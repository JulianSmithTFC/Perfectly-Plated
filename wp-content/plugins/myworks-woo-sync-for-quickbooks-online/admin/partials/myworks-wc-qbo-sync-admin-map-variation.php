<?php
if ( ! defined( 'ABSPATH' ) )
exit;

global $MWQS_OF;
global $MSQS_QL;
global $wpdb;

$page_url_product = 'admin.php?page=myworks-wc-qbo-map&tab=product';
$page_url = 'admin.php?page=myworks-wc-qbo-map&tab=product&variation=1';

if ( ! empty( $_POST ) && check_admin_referer( 'myworks_wc_qbo_sync_map_wc_qbo_variation', 'map_wc_qbo_variation' ) ) {
	$item_ids = array();
	foreach ($_POST as $key=>$value){
		if ($MSQS_QL->start_with($key, "map_variation_")){
			$id = (int) str_replace("map_variation_", "", $key);
			if($id){ //&& (int) $value
				$item_ids[$id] = (int) $value;
			}
		}
	}
	
	$table = $wpdb->prefix.'mw_wc_qbo_sync_variation_pairs';
	
	if(count($item_ids)){
		foreach ($item_ids as $key=>$value){
			$save_data = array();			
			$save_data['quickbook_product_id'] = $value;
			$save_data['class_id'] = (isset($_POST['class_map_variation_'.$key]))?$_POST['class_map_variation_'.$key]:'';			
			
			if($MSQS_QL->get_field_by_val($table,'id','wc_variation_id',$key)){
				$wpdb->update($table,$save_data,array('wc_variation_id'=>$key),'',array('%d'));
			}else{
				$save_data['wc_variation_id'] = $key;
				$wpdb->insert($table, $save_data);
			}
		}
		$MSQS_QL->set_session_val('map_page_update_message',__('Variations mapped successfully.','mw_wc_qbo_sync'));
	}
	//
	$wpdb->query("DELETE FROM `".$table."` WHERE `quickbook_product_id` = 0 ");
	$MSQS_QL->redirect($page_url);
}

$MSQS_QL->set_per_page_from_url();
$items_per_page = $MSQS_QL->get_item_per_page();

$MSQS_QL->set_and_get('variation_map_search');
$variation_map_search = $MSQS_QL->get_session_val('variation_map_search');

$total_records = $MSQS_QL->count_woocommerce_variation_list($variation_map_search);

$offset = $MSQS_QL->get_offset($MSQS_QL->get_page_var(),$items_per_page);
$pagination_links = $MSQS_QL->get_paginate_links($total_records,$items_per_page);

$wc_variation_list = $MSQS_QL->get_woocommerce_variation_list($variation_map_search,false," $offset , $items_per_page");

$qbo_product_options = '';
if(!$MSQS_QL->option_checked('mw_wc_qbo_sync_select2_ajax')){
	$qbo_product_options.= $MSQS_QL->get_product_dropdown_list();
}

$qbo_class_options_value = $MSQS_QL->get_class_dropdown_list();
$qbo_class_options = '<option value=""></option>';
$qbo_class_options.= $qbo_class_options_value;

$selected_options_script = '';

$wc_currency_symbol = get_woocommerce_currency_symbol();
?>
<?php require_once plugin_dir_path( __FILE__ ) . 'myworks-wc-qbo-sync-admin-map-nav.php' ?>

<div class="container">	
	<?php //$MSQS_QL->_p($wc_variation_list);?>
	<div class="page_title"><h4><?php _e( 'Variation Mappings', 'mw_wc_qbo_sync' );?></h4></div>
	<div class="mw_wc_filter">
	 <span class="search_text">Search</span>
	  &nbsp;
	  <input type="text" id="variation_map_search" placeholder="NAME / SKU / ID" value="<?php echo $variation_map_search;?>">
	  &nbsp;		
	  <button onclick="javascript:search_item();" class="btn btn-info">Filter</button>
	  &nbsp;
	  <button onclick="javascript:reset_item();" class="btn btn-info">Reset</button>
	  &nbsp;
	  <span class="filter-right-sec">
		  <span class="entries">Show entries</span>
		  &nbsp;
		  <select style="width:50px;" onchange="javascript:window.location='<?php echo $page_url;?>&<?php echo $MSQS_QL->per_page_keyword;?>='+this.value;">
			<?php echo  $MSQS_QL->only_option($items_per_page,$MSQS_QL->show_per_page);?>
		 </select>
	 </span>
	 </div>
	 <br />
	<div class="card">
		<div class="card-content">
			<div class="row">
				<?php if(is_array($wc_variation_list) && count($wc_variation_list)):?>
				<form method="POST" class="col s12 m12 l12" action="<?php echo $page_url;?>">
					<div class="row">
						<div class="col s12 m12 l12">
							<div class="myworks-wc-qbo-sync-table-responsive">
								<table class="mw-qbo-sync-settings-table menu-blue-bg menu-bg-a new-table" width="100%">
									<thead>
										<tr>
											<th width="5%">&nbsp; ID</th>
											<th width="25%">
												WooCommerce Variation								    	
											</th>
											<th width="15%">
												Variation SKU						    	
											</th>
											<th width="15%">
												Parent Product						    	
											</th>
											<th width="<?php echo !empty($qbo_class_options_value)?'25%':'40%' ?>">
												QuickBooks Product								    	
											</th>
											<?php if(!empty($qbo_class_options_value)){ ?>
											<th width="15%">
												QuickBooks Class
											</th>
											<?php } ?>
										</tr>
									</thead>
									<?php foreach($wc_variation_list as $p_val):?>
									<tr>
										<td><?php echo $p_val['ID']?></td>
										<td title="<?php echo $p_val['post_name']?>">
										<a href="<?php echo admin_url('post.php?action=edit&post=').wp_get_post_parent_id( $p_val['ID'] ) ?>" target="_blank"><b><?php _e( $p_val['name'], 'mw_wc_qbo_sync' );?></b>
										
										<p>
										Price: <?php echo $wc_currency_symbol.$p_val['price'];?>
										<?php 
											if($p_val['attribute_names']!='' && $p_val['attribute_values']!=''){
												$attr_key_arr = explode(',',$p_val['attribute_names']);
												$attr_val_arr = explode(',',$p_val['attribute_values']);
												
												$attr_arr = @array_combine($attr_key_arr,$attr_val_arr);
												if(is_array($attr_arr) && count($attr_arr)){
													echo '<br />';
													foreach($attr_arr as $key=>$val){
														echo $key.': '.$val.'<br />';
													}
												}
											}
										?>
										</p></a>
										</td>
										
										<td><?php echo $p_val['sku']?></td>
										
										
										<td>
											<a title="<?php echo $p_val['parent_name']?>" target="_blank" href="post.php?post=<?php echo $p_val['parent_id']?>&action=edit">
												<?php echo $p_val['parent_id']?>
											</a>
										</td>
										<td>
											<?php
											$dd_options = '<option value=""></option>';
											$dd_ext_class = '';
											if($MSQS_QL->option_checked('mw_wc_qbo_sync_select2_ajax')){
												$dd_ext_class = 'mwqs_dynamic_select';
												if((int) $p_val['quickbook_product_id']){												
													$dd_options = '<option value="'.$p_val['quickbook_product_id'].'">'.stripslashes($p_val['qp_name']).'</option>';
												}
											}else{
												$dd_options.=$qbo_product_options;
												if((int) $p_val['quickbook_product_id']){
													$selected_options_script.='jQuery(\'#map_variation_'.$p_val['ID'].'\').val(\''.(int) $p_val['quickbook_product_id'].'\');';												
												}
											}																	
											?>
											
											<select class="mw_wc_qbo_sync_select2 <?php echo $dd_ext_class;?>" name="map_variation_<?php echo $p_val['ID']?>" id="map_variation_<?php echo $p_val['ID']?>">
												<?php echo $dd_options;?>
											</select>
										</td>
										<?php if(!empty($qbo_class_options_value)){ ?>
										<td>
											<select class="mw_wc_qbo_sync_select2" name="class_map_variation_<?php echo $p_val['ID']?>" id="class_map_variation_<?php echo $p_val['ID']?>">
												<?php echo $qbo_class_options;?>
											</select>
											<?php 
											if(!empty($p_val['class_id'])){
												$selected_options_script.='jQuery(\'#class_map_variation_'.$p_val['ID'].'\').val(\''. $p_val['class_id'].'\');';
											}
											?>	
										</td>
										<?php } ?>
									</tr>
									<?php endforeach;?>
								</table>
								<?php echo $pagination_links?>
							</div>
						</div>
					</div>
					<div class="row">
						<?php wp_nonce_field( 'myworks_wc_qbo_sync_map_wc_qbo_variation', 'map_wc_qbo_variation' ); ?>
						<div class="input-field col s12 m6 l4">
							<button class="waves-effect waves-light btn save-btn mw-qbo-sync-green">Save</button>
						</div>
					</div>
				</form>
				
				<br />
				<div class="col col-m">
				<h5><?php _e( 'Clear All Variations Mappings', 'mw_wc_qbo_sync' );?></h5>
				<?php wp_nonce_field( 'myworks_wc_qbo_sync_clear_all_mappings_variations', 'clear_all_mappings_variations' ); ?>
				<button id="mwqs_cavm_btn"><?php _e( 'Clear Mappings', 'mw_wc_qbo_sync' );?></button>
				&nbsp;
				<span id="mwqs_cavm_msg"></span>
				</div>
				
				<?php else:?>
				<p><?php _e( 'No variations found.', 'mw_wc_qbo_sync' );?></p>
				<?php endif;?>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	function search_item(){		
		var variation_map_search = jQuery('#variation_map_search').val();
		variation_map_search = jQuery.trim(variation_map_search);
		if(variation_map_search!=''){
			window.location = '<?php echo $page_url;?>&variation_map_search='+variation_map_search;
		}else{
			alert('<?php echo __('Please enter search keyword.','mw_wc_qbo_sync')?>');
		}
	}

	function reset_item(){		
		window.location = '<?php echo $page_url;?>&variation_map_search=';
	}
	<?php if($selected_options_script!=''):?>
	jQuery(document).ready(function(){
		<?php echo $selected_options_script;?>
	});
	<?php endif;?>
	
	jQuery(document).ready(function($){
		
		$('#mwqs_automap_variations_wf_qf').click(function(){
			var vam_wf = $('#vam_wf').val().trim();
			var vam_qf = $('#vam_qf').val().trim();
			
			var mo_um = '';
			if($('#vam_moum_chk').is(':checked')){
				mo_um = 'true';				
			}			
			
			if(vam_wf!='' && vam_qf!=''){
				$('#vam_wqf_e_msg').html('');
				if(confirm('<?php echo __('This will override any previous variation mappings, and scan your WooCommerce & QuickBooks Online variations by selected fields to automatically match them for you.')?>')){
					jQuery('#mwqs_automap_variations_msg').html('');
					var data = {
						"action": 'mw_wc_qbo_sync_automap_variations_wf_qf',
						"automap_variations_wf_qf": jQuery('#automap_variations_wf_qf').val(),
						"vam_wf": vam_wf,
						"vam_qf": vam_qf,
						"mo_um": mo_um,
					};
					var loading_msg = 'Loading...';
					jQuery('#mwqs_automap_variations_msg').html(loading_msg);
					jQuery.ajax({
					   type: "POST",
					   url: ajaxurl,
					   data: data,
					   cache:  false ,
					   //datatype: "json",
					   success: function(result){
						   if(result!=0 && result!=''){						
							jQuery('#mwqs_automap_variations_msg').html(result);						
							window.location='<?php echo admin_url($page_url)?>';
						   }else{
							jQuery('#mwqs_automap_variations_msg').html('Error!');						 
						   }				  
					   },
					   error: function(result) {						
							jQuery('#mwqs_automap_variations_msg').html('Error!');
					   }
					});
				}
			}else{
				$('#vam_wqf_e_msg').html('Please select automap fields.');
			}			
		});
		
		<?php if($js_section=false):?>
		$('#mwqs_automap_variations').click(function(){
			if(confirm('<?php echo __('Are you sure, you want to automap all variations?')?>')){
				jQuery('#mwqs_automap_variations_msg').html('');
				var data = {
					"action": 'mw_wc_qbo_sync_automap_variations',
					"automap_variations": jQuery('#automap_variations').val(),
				};
				var loading_msg = 'Loading...';
				jQuery('#mwqs_automap_variations_msg').html(loading_msg);
				jQuery.ajax({
				   type: "POST",
				   url: ajaxurl,
				   data: data,
				   cache:  false ,
				   //datatype: "json",
				   success: function(result){
					   if(result!=0 && result!=''){
						//alert(result);
						//jQuery('#mwqs_automap_variations_msg').html('Success');
						jQuery('#mwqs_automap_variations_msg').html(result);
						//alert('Success!');
						//location.reload();
						window.location='<?php echo admin_url($page_url)?>';
					   }else{
						 jQuery('#mwqs_automap_variations_msg').html('Error!');
						 //alert('Error!');			 
					   }				  
				   },
				   error: function(result) {  
						//alert('Error!');
						jQuery('#mwqs_automap_variations_msg').html('Error!');
				   }
				});
			}
		});
		
		<?php endif;?>
		
		$('#mwqs_cavm_btn').click(function(){
			if(confirm('<?php echo __('Are you sure, you want to clear all variation mappings?','mw_wc_qbo_sync')?>')){
				var loading_msg = 'Loading...';
				jQuery('#mwqs_cavm_msg').html(loading_msg);
				var data = {
					"action": 'mw_wc_qbo_sync_clear_all_mappings_variations',
					"clear_all_mappings_variations": jQuery('#clear_all_mappings_variations').val(),
				};
				jQuery.ajax({
				   type: "POST",
				   url: ajaxurl,
				   data: data,
				   cache:  false ,
				   //datatype: "json",
				   success: function(result){
					   if(result!=0 && result!=''){
						 //alert('Success');
						 jQuery('#mwqs_cavm_msg').html('Success!');
						 window.location='<?php echo admin_url($page_url)?>';
					   }else{
						 //alert('Error!');
						jQuery('#mwqs_cavm_msg').html('Error!');
					   }				  
				   },
				   error: function(result) {  
						//alert('Error!');
						jQuery('#mwqs_cavm_msg').html('Error!');
				   }
				});
			}
		});
		
		$('#mwqs_refresh_data_from_qbo').click(function(event){
			if(!confirm('<?php echo __('Are you sure, you want to refresh data from quickbooks?','mw_wc_qbo_sync')?>')){
				event.preventDefault();
			}
		});
		
	});
 </script>
 <?php echo $MWQS_OF->get_select2_js('.mw_wc_qbo_sync_select2','qbo_product');?>