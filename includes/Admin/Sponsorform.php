<?php

namespace Sponsor\Portal\Admin;

/**
 * Class BasePlugin
 */
class SponsorForm {

	/**
	 * Function menu_function
	 *
	 * @return void
	 */
	public function protocol_form() {
		$action = isset( $_GET['action'] ) ? $_GET['action'] : 'list';

		switch ( $action ) {
			case 'new':
				$template = __DIR__ . '/views/protocol-new.php';
				break;

			case 'edit':
				$template = __DIR__ . '/views/protocol-edit.php';
				break;

			case 'view':
				$template = __DIR__ . '/views/protocol-view.php';
				break;

			default:
				$template = __DIR__ . '/views/protocol-list.php';
				break;
		}

		if ( file_exists( $template ) ) {
			include $template;
		}
	}

	/**
	 * Function for form_handler
	 *
	 * @return void
	 */
	public function form_handler() {
		if ( ! isset( $_POST['submit_protocol'] ) ) {
			return;
		}

		if ( ! wp_verify_nonce( $_POST['_wpnonce'], 'new-protocol' ) ) {
			wp_die( 'Are you cheating?' );
		}

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( 'Are you cheating?' );
		}

		echo '<pre>';
		var_dump( sp_po_insert_protocol() );
		print_r( $_POST );
		echo '</pre>';
		die;
	}
}
