<?php

namespace Sponsor\Portal;

/**
 * Admin
 */
class Admin {

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct() {
		$this->dispatch_actions();
		new Admin\Menu();
	}

	/**
	 * Function to dispatch_actions
	 *
	 * @return void
	 */
	public function dispatch_actions() {
		$protocol = new Admin\SponsorForm();
		add_action( 'admin_init', array( $protocol, 'form_handler' ) );
	}
}
