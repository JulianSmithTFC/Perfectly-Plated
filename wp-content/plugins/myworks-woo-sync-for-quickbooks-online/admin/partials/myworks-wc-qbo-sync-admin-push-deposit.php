<?php
if ( ! defined( 'ABSPATH' ) )
exit;

$page_url = 'admin.php?page=myworks-wc-qbo-push&tab=deposit';

global $MWQS_OF;
global $MSQS_QL;
global $wpdb;

$_payment_method = 'stripe';
$_order_currency = 'USD';

$MSQS_QL->_p($_payment_method);	
$MSQS_QL->_p($_order_currency);


$pm_map_data = $MSQS_QL->get_mapped_payment_method_data($_payment_method,$_order_currency);
$enable_batch = (int) $MSQS_QL->get_array_isset($pm_map_data,'enable_batch',0);
$deposit_cron_utc = $MSQS_QL->get_array_isset($pm_map_data,'deposit_cron_utc','');

$wp_timezone = $MSQS_QL->get_sys_timezone();

$MSQS_QL->_p('UTC Deposit Cron Time: '.$deposit_cron_utc);
$MSQS_QL->_p('Wordpress TimeZone: '.$wp_timezone);

echo '<hr/>';

if($enable_batch && !empty($deposit_cron_utc) && !empty($wp_timezone)){
	$utc_now = new DateTime();
	$utc_now->setTimezone(new DateTimeZone('UTC'));
	$utc_date = $utc_now->format('Y-m-d');
	$utc_date_time = $utc_date.' '.$deposit_cron_utc.':00';
	
	$wp_date_time_c = $MSQS_QL->converToTz($utc_date_time,$wp_timezone,'UTC');
	$last_24_hour_dt = date('Y-m-d H:i:s', strtotime('-24 hours', strtotime($wp_date_time_c)));
	
	//$MSQS_QL->_p($wp_date_time_c);	
	//$MSQS_QL->_p($utc_date_time);
	
	/*
	$datetime1 = strtotime($wp_date_time_c);
	$datetime2 = strtotime($utc_date_time);
	$interval  = ($datetime2 - $datetime1);
	$minutes   = round($interval / 60);	
	*/
	
	$hours = date('G',strtotime($wp_date_time_c));
	$minutes = date('i',strtotime($wp_date_time_c));
	
	//$MSQS_QL->_p($hours);
	//$MSQS_QL->_p($minutes);
	
	$total_minutes = ($hours*60)+$minutes;
	
	$sql = "
		SELECT 
		DATE_ADD(DATE(p.post_date - INTERVAL ({$total_minutes}) minute), INTERVAL ({$total_minutes})  minute) as interval_start,
		DATE_ADD(DATE(p.post_date - INTERVAL ({$total_minutes}) minute), INTERVAL (24*60 + {$total_minutes})  minute) as interval_end,
		COUNT(*) as cnt,
		GROUP_CONCAT(ID) as order_ids
		FROM {$wpdb->posts} p
		INNER JOIN {$wpdb->postmeta} pm1 ON (p.ID=pm1.post_id AND pm1.meta_key = '_payment_method' AND pm1.meta_value = '{$_payment_method}')
		INNER JOIN {$wpdb->postmeta} pm2 ON (p.ID=pm2.post_id AND pm2.meta_key = '_order_currency' AND pm2.meta_value = '{$_order_currency}')
		WHERE p.post_type='shop_order'
		AND p.post_status NOT IN('auto_draft','trash','draft')
		GROUP BY DATE(p.post_date - interval ({$total_minutes}) minute)
		ORDER BY interval_start DESC;
	";
	
	//$MSQS_QL->_p($sql);
	
	$order_list = $MSQS_QL->get_data($sql);
	//$MSQS_QL->_p($order_list);
	if(is_array($order_list) && !empty($order_list)){
		foreach($order_list as $ol){
			$order_ids = $ol['order_ids'];
			$order_ids = explode(',',$order_ids);
			
			echo '<div style="background:white; padding:20px;">';
			$MSQS_QL->_p($ol['interval_start']);
			$MSQS_QL->_p($ol['interval_end']);
			$MSQS_QL->_p('Total Orders: '. $ol['cnt']);
			$MSQS_QL->_p('Order IDs:');
			$MSQS_QL->_p($order_ids);
			echo '</div>';
			echo '<br/>';
		}
	}
	
}