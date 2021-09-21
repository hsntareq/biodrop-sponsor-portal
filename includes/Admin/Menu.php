<?php

namespace Sponsor\Admin;

/**
 * Menu
 */
class Menu {

	public $protocol;
	/**
	 * Function __construct
	 *
	 * @return void
	 */
	public function __construct( $protocol ) {
		$this->protocol = $protocol;
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
	}

	/**
	 * Function admin_menu
	 *
	 * @return void
	 */
	public function admin_menu() {
		$parent_slug = 'sponsor';
		$capability  = 'manage_options';
		$callable    = 'plugin_main_page';
		add_menu_page( __( 'Sponsor Portal', 'sponsor' ), __( 'Sponsor Portal', 'sponsor' ), $capability, $parent_slug, array( $this->protocol, $callable ), 'dashicons-art', 2 );
		add_submenu_page( $parent_slug, __( 'Sponsor Portal', 'sponsor' ), __( 'Sponsor Portal', 'sponsor' ), $capability, $parent_slug, array( $this->protocol, $callable ) );
		add_submenu_page( $parent_slug, __( 'Settings', 'sponsor' ), __( 'Settings', 'sponsor' ), $capability, 'biodrop-settings', array( $this, 'plugin_subpage' ) );

	}

	/**
	 * Function plugin_page
	 *
	 * @return void
	 */
	public function plugin_page() {
		$main_nav = new SponsorForm();
		$main_nav->protocol_form();
	}

	/**
	 * Function plugin_page
	 *
	 * @return void
	 */
	public function plugin_subpage() {
		echo 'Base sub Plugin';
	}
}
