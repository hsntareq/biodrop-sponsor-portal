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

	/**
	 * Class __construct.
	 */
	private function __construct() {
		$this->define_constants();
		$this->assets = new Sponsor\Classes\Assets();

		register_activation_hook( __FILE__, array( $this, 'activate' ) );

		add_action( 'plugins_loaded', array( $this, 'init_plugin' ) );
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
		$path    = plugin_dir_path( SPONSOR_FILE );
		$has_pro = defined( 'SPONSOR_PRO_VERSION' );

		// Prepare the basepath.
		$home_url  = get_home_url();
		$parsed    = wp_parse_url( $home_url );
		$base_path = ( is_array( $parsed ) && isset( $parsed['path'] ) ) ? $parsed['path'] : '/';
		$base_path = rtrim( $base_path, '/' ) . '/';

		// Get current URL.
		$current_url = $home_url . '/' . substr( $_SERVER['REQUEST_URI'], strlen( $base_path ) );

		$info = array(
			'path'                 => $path,
			'url'                  => plugin_dir_url( SPONSOR_FILE ),
			'current_url'          => $current_url,
			'assets'               => SPONSOR_ASSETS,
			'basename'             => plugin_basename( SPONSOR_FILE ),
			'basepath'             => $base_path,
			'version'              => SPONSOR_VERSION,
			'nonce_action'         => 'sponsor_nonce_action',
			'nonce'                => '_sponsor_nonce',
			'course_post_type'     => apply_filters( 'sponsor_course_post_type', 'courses' ),
			'lesson_post_type'     => apply_filters( 'sponsor_lesson_post_type', 'lesson' ),
			'instructor_role'      => apply_filters( 'sponsor_instructor_role', 'sponsor_instructor' ),
			'instructor_role_name' => apply_filters( 'sponsor_instructor_role_name', __( 'Tutor Instructor', 'sponsor' ) ),
			'template_path'        => apply_filters( 'sponsor_template_path', 'sponsor/' ),
			'has_pro'              => apply_filters( 'sponsor_has_pro', $has_pro ),
		);

		return (object) $info;
	}
}
