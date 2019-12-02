<?php
use Kunnu\Dropbox\Dropbox;
use Kunnu\Dropbox\DropboxApp;
use Kunnu\Dropbox\DropboxFile;
use Kunnu\Dropbox\DropboxClient;
use Kunnu\Dropbox\Http\Clients\DropboxHttpClientFactory;

/**
 * Dropbox api
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( !class_exists( 'WooCommerce_PDF_IPS_Dropbox_API' ) ) :

class WooCommerce_PDF_IPS_Dropbox_API {
	public function __construct() {
		$this->dropbox_settings = get_option( 'wpo_wcpdf_dropbox_settings' );
		$this->api_settings = get_option( 'wpo_wcpdf_dropbox_api_v2' );
		$this->enabled = isset($this->dropbox_settings['enabled']);

		if ( $this->is_enabled() === false ) {
			return;
		}

		require( WPO_WCPDF_Dropbox()->plugin_path().'/vendor/autoload.php' );

		$this->access_type = isset( $this->dropbox_settings['access_type'] ) ? $this->dropbox_settings['access_type'] : 'app_folder';
		switch ($this->access_type) {
			case 'app_folder':
				$this->key = "p40abi3fysjr6o9";
				$this->secret = "6abfjn0ddlal3oc";
				break;
			case 'dropbox':
				$this->key = "wtra5psb2pszzqb";
				$this->secret = "ne8j2qo1rtefekr";			
				// old V1 key & secret - permission type not supported for API V1
				// $this->key = "68to2s87mwwkbjm";
				// $this->secret = "p3obc6pv3n5ph7e";
				break;
		}

		$this->access_token = $this->get_access_token();
		$this->callback_url	= ''; // can't use dynamic callback urls

		// Configure Dropbox Application
		if ( empty($this->access_token) ) {
			$this->app	= new DropboxApp($this->key, $this->secret );
		} else {
			$this->app	= new DropboxApp($this->key, $this->secret, $this->access_token );
		}

		// Configure Dropbox service
		$this->dropbox = new Dropbox($this->app);

		// authorization message
		if ( empty($this->access_token) && $this->is_enabled() ) {
			add_action( 'admin_notices', array( $this, 'auth_message' ) );
		}

		if ( !empty($_REQUEST['wpo_wcpdf_dropbox_code']) ) {
			$this->finish_auth();
		}

		if ( isset($_REQUEST['wpo_wcpdf_dropbox_success']) ) {
			add_action( 'admin_notices', array( $this, 'auth_success' ) );
		}

		if ( isset($_REQUEST['wpo_wcpdf_dropbox_fail']) ) {
			add_action( 'admin_notices', array( $this, 'auth_fail' ) );
		}
	}

	public function is_enabled() {
		return !empty($this->enabled);
	}

	/**
	 * Get Access token from plugin settings
	 * @return mixed string when available, false when not set
	 */
	public function get_access_token() {
		// return token if it's saved in the settings
		if (!empty($this->api_settings['access_token'])) {
			return $this->api_settings['access_token'];
		}

		// if we don't have a token, check if we can migrate a V1 token
		$v1_api_settings = get_option( 'wpo_wcpdf_dropbox_api' );
		// $v1_api_settings = unserialize('a:1:{s:12:"access_token";a:3:{s:18:"oauth_token_secret";s:15:"uhh9tw69ni56jz4";s:11:"oauth_token";s:16:"u9sd5tnexknds4n0";s:3:"uid";s:9:"165700802";}}');
		if ( $this->access_type == 'app_folder' && isset($v1_api_settings['access_token']) && isset($v1_api_settings['access_token']['oauth_token']) && isset($v1_api_settings['access_token']['oauth_token_secret']) ) {
			$oauth_token = $v1_api_settings['access_token']['oauth_token'];
			$oauth_secret = $v1_api_settings['access_token']['oauth_token_secret'];
			$v2_token = $this->migrate_v1_token( $oauth_token, $oauth_secret );
			if ( !empty($v2_token) ) {
				$this->set_access_token( $v2_token );
				// destroy after reading
				delete_option( 'wpo_wcpdf_dropbox_api' );
			}
		}

		if ( !empty($v2_token) ) {
			return $v2_token;
		}
		else {
			return false;
		}
	}

	public function set_access_token( $access_token ) {
		$api_settings = get_option( 'wpo_wcpdf_api_settings' );
		$api_settings['access_token'] = $access_token;
		if (!empty($access_token)) {
			$api_settings['account_info'] = $this->get_account_info( $access_token );
		} else {
			unset($api_settings['account_info']);
		}
		update_option( 'wpo_wcpdf_dropbox_api_v2', $api_settings );
		return;
	}

	public function get_account_info( $access_token ) {
		// reconnect with $access_token
		try {
			$this->app = new DropboxApp($this->key, $this->secret, $access_token  );
			$this->dropbox = new Dropbox($this->app);
			$account = $this->dropbox->getCurrentAccount();

			$id = $account->getAccountId();
			$name = $account->getDisplayName();
			$email = $account->getEmail();
			
			return "{$name} / {$email}";
		} catch (Exception $e) {
			WooCommerce_PDF_IPS_Dropbox_API_Logger::log("fetching account info failed");
		}
	}

	public function migrate_v1_token( $oauth1_token, $oauth1_secret ) {
		WooCommerce_PDF_IPS_Dropbox_API_Logger::log("api v1 token migration started");
		// let's try to migrate
		try {
			$this->app	= new DropboxApp($this->key, $this->secret );
			$this->dropbox = new Dropbox($this->app);

			$uri = 'https://api.dropboxapi.com/2/auth/token/from_oauth1';
			// $endpoint = '/auth/token/from_oauth1';
			$headers = array(
				'Authorization' => 'Basic '.base64_encode($this->key.':'.$this->secret),
				'Content-Type'	=> 'application/json',
			);
			$data = array(
				"oauth1_token"			=> $oauth1_token,
				"oauth1_token_secret"	=> $oauth1_secret,
			);

			$response = $this->dropbox->getClient()->getHttpClient()
				->send( $uri, "POST", json_encode( $data ), $headers );

			// decode response
			$response = json_decode( $response->getBody(), true );

			if (isset($response['oauth2_token'])) {
				WooCommerce_PDF_IPS_Dropbox_API_Logger::log("oauth1 token converted to oauth 2 token: {$response['oauth2_token']}");
				return $response['oauth2_token'];
			} else {
				WooCommerce_PDF_IPS_Dropbox_API_Logger::log("received response from dropbox but no token: ".json_encode($response));
				return false;
			}
		} catch (Exception $e) {
			// echo '<pre>';var_dump($e);echo '</pre>';die();
			WooCommerce_PDF_IPS_Dropbox_API_Logger::log($e->getMessage());
		}

	}

	public function auth_message() {
		//DropboxAuthHelper
		$authHelper = $this->dropbox->getAuthHelper();
		//Fetch the Authorization/Login URL
		$authUrl = remove_query_arg( 'redirect_uri', $authHelper->getAuthUrl($this->callback_url) );
		$formUrl = admin_url( '?wcdal_authorize' );
		$returnUrl = ((!empty($_SERVER["HTTPS"])) ? "https" : "http") . "://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		?>
		<div class="notice notice-warning">
			<p><?php _e( 'Authorize the dropbox extension!', 'wpo_wcpdf_pro' ); ?></p>
			<p><?php printf( __( 'Visit dropbox via %sthis link%s to get an access code and enter this below:' , 'wpo_wcpdf_pro' ), '<a href="'.$authUrl.'" target="_blank">', '</a>' ); ?></p>
			<form action="<?php echo $formUrl; ?>">
				<input type="hidden" id="wpo_wcpdf_dropbox_return_url" name="wpo_wcpdf_dropbox_return_url" value="<?php echo $returnUrl; ?>">
				<input type="text" id="wpo_wcpdf_dropbox_code" name="wpo_wcpdf_dropbox_code" size="50"/></p>
				<?php submit_button( __( 'Authorize', 'wpo_wcpdf_pro' ) ); ?>
			</form>
		</div>
		<?php
	}

	public function auth_success() {
		$token = isset($_REQUEST['wpo_wcpdf_dropbox_success']) ? $_REQUEST['wpo_wcpdf_dropbox_success'] : '';
		?>
		<div class="notice notice-success">
			<p><?php _e( 'Dropbox connection established! Access token:', 'wpo_wcpdf_pro' ); ?> <?php echo $token; ?></p>
		</div>
		<?php
	}

	public function auth_fail() {
		$view_log_link = '<a href="'.esc_url_raw( admin_url( 'admin.php?page=wc-status&tab=logs' ) ).'" target="_blank">'.__( 'View logs', 'wpo_wcpdf_pro' ).'</a>';
		$message = sprintf( __( 'Dropbox authentication failed. Please try again or check the logs for details: %s', 'wpo_wcpdf_pro' ), $view_log_link );
		
		print_r('<div class="notice notice-error"><p>%s</p></div>', $message);
	}

	public function finish_auth() {
		$code = sanitize_text_field( $_REQUEST['wpo_wcpdf_dropbox_code'] );

		WooCommerce_PDF_IPS_Dropbox_API_Logger::log("authentication code entered: {$code}");

		//Fetch the AccessToken
		try {
			$authHelper = $this->dropbox->getAuthHelper();
			$accessToken = $authHelper->getAccessToken($code, null, null);

			// save token to settings;
			$token = $accessToken->getToken();
			$this->set_access_token($token);
			WooCommerce_PDF_IPS_Dropbox_API_Logger::log("access token successfully created from code: {$token}");

			// redirect back to where we came from
			if (!empty($_REQUEST['wpo_wcpdf_dropbox_return_url'])) {
				$url = $_REQUEST['wpo_wcpdf_dropbox_return_url'];
			} else {
				$url = admin_url();
			}

			$url = add_query_arg( 'wpo_wcpdf_dropbox_success', $token, $url);
			wp_redirect( $url );
		} catch (Exception $e) {
			WooCommerce_PDF_IPS_Dropbox_API_Logger::log("failed to create access token: ".$e->getMessage());
			$url = add_query_arg( 'wpo_wcpdf_dropbox_fail', 'true' );
			wp_redirect( $url );
		}
	}

	public function upload( $file = null, $folder = '/' ) {
		if ( empty($file) ) {
			return false;
		}

		try {
			$dropboxFile = new DropboxFile( $file );
			$filename = basename($file);
			$uploaded_file = $this->dropbox->simpleUpload($dropboxFile, "{$folder}{$filename}", ['mode' => 'overwrite'] );

			$message = "successfully uploaded {$filename}";
			WooCommerce_PDF_IPS_Dropbox_API_Logger::log($message);
			// echo '<div class="notice notice-success"><pre>';var_dump($uploaded_file);echo '</pre></div>';
			return array( 'success' => $uploaded_file );
		}
		catch (Exception $e) {
			$error_response = $e->getMessage();
			$error_message = "ERROR trying to upload: " . $error_response;
			WooCommerce_PDF_IPS_Dropbox_API_Logger::log($error_message);
			
			// check for JSON
			if ( is_string( $error_response ) && $decoded_response = $this->maybe_json_decode( $error_response ) ) {
				if (isset($decoded_response['error'])) {
					$error = $decoded_response['error'];
					$unlink_on = array( 'invalid_access_token' );
					if ( in_array( $error['.tag'], $unlink_on ) ) {
						$this->set_access_token('');
					}
				}
			}

			return array( 'error' => $error_message );
		}

	}

	public function maybe_json_decode( $string ) {
		$decoded = json_decode( $string, true );
		if ( json_last_error() == JSON_ERROR_NONE ) {
			return $decoded;
		} else {
			return false;
		}
	}

} // class WooCommerce_PDF_IPS_Dropbox_API

endif; // class_exists

return new WooCommerce_PDF_IPS_Dropbox_API();

