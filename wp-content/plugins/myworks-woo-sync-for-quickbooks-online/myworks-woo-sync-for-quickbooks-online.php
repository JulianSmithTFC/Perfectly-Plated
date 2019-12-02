<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://myworks.software/integrations/sync-woocommerce-quickbooks-online
 * @since             1.0.0
 * @package           MyWorks_WC_QBO_Sync
 *
 * @wordpress-plugin
 * Plugin Name:       WooCommerce Sync for QuickBooks Online - by MyWorks Software
 * Plugin URI:        https://myworks.software/integrations/sync-woocommerce-quickbooks-online
 * Description:       Automatically sync your WooCommerce store with QuickBooks Online - in real-time! Easily sync customers, orders, payments, producs, inventory and more between your WooCommerce store and QuickBooks Online. Your complete solution to streamline your accounting workflow - with no limits.
 * Version:           1.7.6
 * Author:            MyWorks Software
 * Author URI:        https://myworks.software/
 * Developer: 		  MyWorks Software
 * Developer URI:     https://myworks.software/
 * Text Domain:       quickbooks-sync-for-woocommerce
 * Domain Path:       /languages
 *
 * WC requires at least: 2.0.0
 * WC tested up to: 3.6.5
 *
 * Copyright: © 2011-2019 MyWorks Software.
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! defined( 'MW_QBO_SYNC_EXT_DOMAIN' ) ) {
	define('MW_QBO_SYNC_EXT_DOMAIN','mw_wc_qbo_sync');
}

if ( ! defined( 'MW_QBO_SYNC_LOG' ) ) {
	define('MW_QBO_SYNC_LOG_DIR', plugin_dir_path(__FILE__) . 'log/');
}

// Define QB_ADMIN_SETUP_PLUGIN_FILE.
if ( ! defined( 'QB_ADMIN_SETUP_PLUGIN_FILE' ) ) {
	define( 'QB_ADMIN_SETUP_PLUGIN_FILE', __FILE__ );
}

/**/
require_once trailingslashit(dirname(__FILE__)).'includes/class-myworks-wc-qbo-sync-admin-pointers.php';
require_once trailingslashit(dirname(__FILE__)).'includes/class-myworks-wc-qbo-sync-admin-deactivation-popup.php';

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
function activate_myworks_woo_sync_for_quickbooks_online() {
	/**/
	$active_plugins = apply_filters( 'active_plugins', get_option( 'active_plugins' ) );
	if(is_array($active_plugins) && in_array('myworks-wc-qbo-sync/myworks-wc-qbo-sync.php',$active_plugins)){
		$op_k = array_search ('myworks-wc-qbo-sync/myworks-wc-qbo-sync.php', $active_plugins);
		if(isset($active_plugins[$op_k])){
			unset($active_plugins[$op_k]);
			if(!empty($active_plugins)){
				$active_plugins = array_values($active_plugins);
				update_option('active_plugins',$active_plugins);
			}
		}
	}
	
	/**/
	global $wp_filesystem;
	$old_plugin = 'myworks-wc-qbo-sync/myworks-wc-qbo-sync.php';
	$old_plugin_path = WP_PLUGIN_DIR.'/'.$old_plugin;
	if(file_exists($old_plugin_path)){
		if($wp_filesystem->delete( $old_plugin_path , true )){
			//Old Plugin Directory Deleted
		}
	}	
	
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-myworks-wc-qbo-sync-activator.php';
	MyWorks_WC_QBO_Sync_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function deactivate_myworks_woo_sync_for_quickbooks_online() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-myworks-wc-qbo-sync-deactivator.php';
	MyWorks_WC_QBO_Sync_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_myworks_woo_sync_for_quickbooks_online' );
register_deactivation_hook( __FILE__, 'deactivate_myworks_woo_sync_for_quickbooks_online' );

/**
* Admin action links
*/

function add_myworks_woo_sync_for_quickbooks_action_links($links) {
		$adminlinks = array(
			'<a href="' . admin_url( 'admin.php?page=myworks-wc-qbo-sync-settings' ) . '">Settings</a>',
			'<a target="_blank" href="https://docs.myworks.software/woocommerce-sync-for-quickbooks-online">Docs</a>',
			'<a target="_blank" href="https://myworks.software/account/submitticket.php?step=2&deptid=2">Support</a>',
			'<a target="_blank" href="https://myworks.software/changelogs/myworks-woo-sync-for-quickbooks-online/changelog.txt">Changelog</a>',
		 );
		$adminlinks[] = '';
		return array_merge( $links, $adminlinks );
}

add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'add_myworks_woo_sync_for_quickbooks_action_links' );

/**
 * QuickBooks online plugin setup
 */
 
//require plugin_dir_path( __FILE__ ) . 'includes/class-myworks-wc-qbo-admin-setup.php';

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-myworks-wc-qbo-sync.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_myworks_woo_sync_for_quickbooks_online() {
	$myworks_wc_qbo_sync = new MyWorks_WC_QBO_Sync();	
	$myworks_wc_qbo_sync->run();
}

run_myworks_woo_sync_for_quickbooks_online();