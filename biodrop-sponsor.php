<?php
/**
Plugin name: Sponsor Portal
Plugin URI: https://www.biodrop.life
Description: Biodrop Sponsor is a sponsor registration form for biodrop.life. Here, sponsors will join following any existing protocol or will create a new one.
Author: Hasan Tareq
Author URI: https://hsntareq.github.io
Version: 1.4.0
Text Domain: sponsor-portal
Domain Path: /languages
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/vendor/autoload.php';

/**
 * The main plugin class
 */
final class SponsorPortal {

	/**
	 * Plugin version
	 *
	 * @var string
	 */
	const version = '1.0';
	private $assets;
	private $utils;

	/**
	 * Class __construct.
	 */
	private function __construct() {
		$this->define_constants();
		$this->assets = new Sponsor\Classes\Assets();
		// $this->utils  = new Sponsor\Classes\Utils();

		register_activation_hook( __FILE__, array( $this, 'activate' ) );

		add_action( 'plugins_loaded', array( $this, 'init_plugin' ) );
		add_action( 'init', array( $this, 'update_anyone_can_register' ) );
		add_filter( 'login_init', array( $this, 'sponsor_registration_redirect' ) );
	}


	function sponsor_registration_redirect() {
		if ( ! is_user_logged_in() ) {
			wp_redirect( '/sponsor-registration' );
			exit;
		}
	}
	/**
	 * Update_anyone_can_register
	 *
	 * @return void
	 */
	function update_anyone_can_register() {
		if ( ! get_option( 'users_can_register' ) ) {
			update_option( 'users_can_register', true );
		}
	}
	/**
	 * Initializes a singleton instance
	 *
	 * @return \SponsorPortal
	 */
	public static function init() {

		static $instance = false;
		if ( ! $instance ) {
			$instance = new self();
		}
		return $instance;

	}

	/**
	 * Define the required constants.
	 *
	 * @return void
	 */
	public function define_constants() {
		define( 'SPONSOR_VERSION', self::version );
		define( 'SPONSOR_FILE', __FILE__ );
		define( 'SPONSOR_PATH', __DIR__ );
		define( 'SPONSOR_URL', plugins_url( '', SPONSOR_FILE ) );
		define( 'SPONSOR_ASSETS', SPONSOR_URL . '/assets' );
	}

	/**
	 * Initialize the plugin
	 *
	 * @return void
	 */
	public function init_plugin() {
		if ( is_admin() ) {
			new \Sponsor\Admin();
		} else {
			new \Sponsor\Frontend();
		}
	}
	/**
	 * Do stuff upon plugin activation
	 *
	 * @return void
	 */
	public function activate() {
		$installer = new \Sponsor\Installer();
		$installer->run();
	}

}

/**
 * Initializing the main plugin
 *
 * @return \SponsorPortal
 */
function sponsor_portal() {
	return SponsorPortal::init();
}

// kick-off the plugin.
sponsor_portal();

if ( ! function_exists( 'sponsor' ) ) {
	/**
	 * Function sponsor
	 *
	 * @return object
	 */
	function sponsor() {
		$path = plugin_dir_path( SPONSOR_FILE );

		// Prepare the basepath.
		$home_url              = get_home_url();
		$parsed                = wp_parse_url( $home_url );
		$base_path             = ( is_array( $parsed ) && isset( $parsed['path'] ) ) ? $parsed['path'] : '/';
		$base_path             = rtrim( $base_path, '/' ) . '/';
		$bootstrap_admin_pages = array( 'sponsor', 'biodrop-settings' );

		// Get current URL.
		$current_url = $home_url . '/' . substr( get_server( 'REQUEST_URI' ), strlen( $base_path ) );

		$info = array(
			'path'                   => $path,
			'url'                    => plugin_dir_url( SPONSOR_FILE ),
			'current_url'            => $current_url,
			'assets'                 => SPONSOR_ASSETS,
			'basename'               => plugin_basename( SPONSOR_FILE ),
			'basepath'               => $base_path,
			'alowed_bootstrap_pages' => $bootstrap_admin_pages,
			'version'                => SPONSOR_VERSION,
			'nonce_action'           => 'sponsor_nonce_action',
			'nonce'                  => '_sponsor_nonce',
			'template_path'          => apply_filters( 'sponsor_template_path', 'sponsor/' ),
		);

		return (object) $info;
	}
}


/*
 if ( ! get_option( 'users_can_register' ) ) {
	update_option( 'users_can_register', true );
} */
