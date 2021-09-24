<?php

namespace Sponsor\Classes;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Assets
 */
class Assets {

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
		add_action( 'admin_init', array( $this, 'admin_bootstrap_init' ) );

	}

	/**
	 * Function get_default_localized_data
	 *
	 * @return array
	 */
	private function get_default_localized_data() {
		return array(
			'ajaxurl'          => admin_url( 'admin-ajax.php' ),
			'home_url'         => get_home_url(),
			'base_path'        => sponsor()->basepath,
			'sponsor_url'      => sponsor()->url,
			'nonce_key'        => sponsor()->nonce,
			sponsor()->nonce   => wp_create_nonce( sponsor()->nonce_action ),
			'loading_icon_url' => get_admin_url() . 'images/wpspin_light.gif',
		);
	}

	/**
	 * Function to enqueue admin_scripts
	 *
	 * @return void
	 */
	public function admin_bootstrap_init() {

		if ( in_array( get_request( 'page' ), sponsor()->alowed_bootstrap_pages ) ) {
			add_action( 'admin_enqueue_scripts', array( $this, 'admin_bootstrap_style' ) );
		}
	}

	public function admin_bootstrap_style() {
		wp_enqueue_style( 'sponsor-bootstrap', sponsor()->url . 'assets/css/bootstrap.min.css', array(), sponsor()->version );
	}

	public function admin_scripts() {
		wp_enqueue_style( 'sponsor-admin', sponsor()->url . 'assets/css/sponsor-admin.css', array(), sponsor()->version );
		wp_enqueue_style( 'sponsor-fontawesome', sponsor()->url . 'assets/css/fontawesome/all.css', array(), sponsor()->version );
		wp_enqueue_script( 'sponsor-admin', sponsor()->url . 'assets/js/sponsor-admin.js', array(), sponsor()->version, true );
		// wp_enqueue_media();

		/*
		 wp_enqueue_script( 'sponsor-admin', sponsor()->url . 'assets/js/sponsor-admin.js', array(), sponsor()->version, true );

		$sponsor_localize_data = $this->get_default_localized_data();

		$sponsor_localize_data = apply_filters( 'sponsor_localize_data', $sponsor_localize_data );
		wp_localize_script( 'sponsor-admin', '_sponsorobject', $sponsor_localize_data ); */

	}


}
