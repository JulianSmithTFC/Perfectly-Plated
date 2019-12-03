<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( !class_exists( 'WooCommerce_PDF_IPS_Dropbox' ) ) :

class WooCommerce_PDF_IPS_Dropbox {

	public $plugin_basename;
	protected static $_instance = null;

	/**
	 * Main Plugin Instance
	 *
	 * Ensures only one instance of plugin is loaded or can be loaded.
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public $writepanels;
	public $settings;
	public $api;
	public $hooks;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->plugin_basename = plugin_basename(__FILE__);
		$this->define( 'WPO_WCPDF_DROPBOX_VERSION', WPO_WCPDF_Pro()->version );

		add_action( 'init', array( $this, 'load_classes' ) );
		add_action( 'admin_init', array( $this, 'old_plugin_listing_actions' ) );
	}

	/**
	 * Define constant if not already set
	 * @param  string $name
	 * @param  string|bool $value
	 */
	private function define( $name, $value ) {
		if ( ! defined( $name ) ) {
			define( $name, $value );
		}
	}

	/**
	 * Load the main plugin classes and functions
	 */
	public function includes() {
		include_once( $this->plugin_path().'/includes/wcpdf-dropbox-api-logger.php' );

		$this->api			= include_once( $this->plugin_path().'/includes/wcpdf-dropbox-api.php' );
		$this->hooks		= include_once( $this->plugin_path().'/includes/wcpdf-dropbox-hooks.php' );
		$this->settings		= include_once( $this->plugin_path().'/includes/wcpdf-dropbox-settings.php' );
		$this->writepanels	= include_once( $this->plugin_path().'/includes/wcpdf-dropbox-writepanels.php' );
	}

	/**
	 * Instantiate classes when woocommerce is activated
	 */
	public function load_classes() {
		if ( $this->is_base_plugin_activated() === false ) {
			return;
		}

		if ( $this->is_woocommerce_activated() === false ) {
			add_action( 'admin_notices', array ( $this, 'need_woocommerce' ) );
			return;
		}

		if ( version_compare( PHP_VERSION, '5.6', '<' ) ) {
			add_action( 'admin_notices', array ( $this, 'required_php_version' ) );
			return;
		}

		// all systems ready - GO!
		$this->includes();
	}

	/**
	 * Check if base plugin is activated and 2.0+
	 */
	public function is_base_plugin_activated() {
		if (class_exists('WooCommerce_PDF_Invoices') && version_compare( WooCommerce_PDF_Invoices::$version, '2.0-beta-2', '<' ) ) {
			return false;
		} elseif ( function_exists('WPO_WCPDF') && version_compare( WPO_WCPDF()->version, '2.0-beta-2', '>=' ) ) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * Check if woocommerce is activated
	 */
	public function is_woocommerce_activated() {
		$blog_plugins = get_option( 'active_plugins', array() );
		$site_plugins = get_site_option( 'active_sitewide_plugins', array() );

		if ( in_array( 'woocommerce/woocommerce.php', $blog_plugins ) || isset( $site_plugins['woocommerce/woocommerce.php'] ) ) {
			return true;
		} else {
			return false;
		}
	}
	
	/**
	 * WooCommerce not active notice.
	 *
	 * @return string Fallack notice.
	 */
	public function need_woocommerce() {
		$error = sprintf( __( 'WooCommerce PDF Invoices & Packing Slips to Dropbox requires %sWooCommerce%s to be installed & activated!' , 'wpo_wcpdf_pro' ), '<a href="http://wordpress.org/extend/plugins/woocommerce/">', '</a>' );

		$message = '<div class="error"><p>' . $error . '</p></div>';
	
		echo $message;
	}

	/**
	 * Add notice to old dropbox plugin and only leave 'delete' option (and deactivate if it wasn't automatically deactivated already)
	 */
	public function old_plugin_listing_actions() {
		if ( ! function_exists( 'get_plugins' ) ) {
			require_once ABSPATH . 'wp-admin/includes/plugin.php';
		}
		$all_plugins = get_plugins();
		foreach ($all_plugins as $plugin_basename => $plugin_data) {
			if ( strpos($plugin_basename, 'woocommerce-pdf-ips-dropbox') !== false) {
				add_filter( 'plugin_action_links_'.$plugin_basename, array( $this, 'plugin_actions_discontinued') );
			}
		}
	}

	public function plugin_actions_discontinued( $links ) {
		if ( array_key_exists('delete', $links) ) {
			$new_links = array();
			$notice = __( 'Dropbox is now part of the Professional extension' , 'wpo_wcpdf_pro' );
			$new_links['delete'] = sprintf('<span style="color:black !important;"><b>%s =></b> %s</span>', $notice, $links['delete']);
			if (array_key_exists('deactivate', $links)) {
				$new_links['deactivate'] = $links['deactivate'];
			}
			return $new_links;
		}

		return $links;
	}

	/**
	 * PHP version requirement notice
	 */
	
	public function required_php_version() {
		$error = __( 'WooCommerce PDF Invoices & Packing Slips to Dropbox requires PHP 5.6 or higher.', 'wpo_wcpdf_pro' );
		$how_to_update = __( 'How to update your PHP version', 'wpo_wcpdf_pro' );
		$message = sprintf('<div class="error"><p>%s</p><p><a href="%s">%s</a></p></div>', $error, 'http://docs.wpovernight.com/general/how-to-update-your-php-version/', $how_to_update);
	
		echo $message;
	}

	/**
	 * Get the plugin url.
	 * @return string
	 */
	public function plugin_url() {
		return untrailingslashit( plugins_url( '/', __FILE__ ) );
	}

	/**
	 * Get the plugin path.
	 * @return string
	 */
	public function plugin_path() {
		return untrailingslashit( plugin_dir_path( __FILE__ ) );
	}

} // class WooCommerce_PDF_IPS_Dropbox

endif; // class_exists

/**
 * Returns the main instance of the plugin to prevent the need to use globals.
 *
 * @since  2.0.0
 */
if (!function_exists('WPO_WCPDF_Dropbox')) {
	function WPO_WCPDF_Dropbox() {
		// double check to prevent doing this on classes of old versions
		if ( method_exists( 'WooCommerce_PDF_IPS_Dropbox', 'instance' ) ) {
			return WooCommerce_PDF_IPS_Dropbox::instance();
		}
	}
}

/**
 * Automatically deactivate old versions of separate Dropbox plugin
 */

if ( is_admin() && ! defined( 'DOING_AJAX' ) ) {
	add_action( 'admin_init', 'wpo_wcpdf_pro_deactivate_old_dropbox' );
}
function wpo_wcpdf_pro_deactivate_old_dropbox() {
	// get all active plugins
	$active_plugins = (array) apply_filters( 'active_plugins', get_option( 'active_plugins' ) );
	if (is_multisite()) {
		// get_site_option( 'active_sitewide_plugins', array() ) returns a 'reversed list'
		// like [hello-dolly/hello.php] => 1369572703 so we do array_keys to make the array
		// compatible with $active_plugins
		$active_sitewide_plugins = (array) array_keys( get_site_option( 'active_sitewide_plugins', array() ) );
		// merge arrays and remove doubles
		$active_plugins = (array) array_unique( array_merge( $active_plugins, $active_sitewide_plugins ) );
	}

	foreach ($active_plugins as $active_plugin) {
		if ( strpos($active_plugin, 'woocommerce-pdf-ips-dropbox') !== false ) {
			deactivate_plugins( $active_plugin );
		}
	}
}

WPO_WCPDF_Dropbox();
