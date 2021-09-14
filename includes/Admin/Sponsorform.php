<?php

namespace Sponsor\Portal\Admin;

/**
 * Class BasePlugin
 */
class SponsorForm {

	public $errors = array();
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

		$name    = isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : '';
		$address = isset( $_POST['address'] ) ? sanitize_textarea_field( $_POST['address'] ) : '';
		$phone   = isset( $_POST['phone'] ) ? sanitize_text_field( $_POST['phone'] ) : '';

		if ( empty( $name ) ) {
			$this->errors['name'] = __( 'Please provide a name', 'sponsor-portal' );
		}
		if ( empty( $phone ) ) {
			$this->errors['phone'] = __( 'Please provide a phone', 'sponsor-portal' );
		}
		if ( ! empty( $this->errors ) ) {
			return;
		}

		$insert_id = sp_po_insert_protocol(
			array(
				'name'    => $name,
				'address' => $address,
				'phone'   => $phone,
			)
		);

		if ( is_wp_error( $insert_id ) ) {
			wp_die( $insert_id->get_error_messages() );
		}

		$redirect_to = add_query_arg(
			array(
				'page'     => 'biodrop-portal',
				'inserted' => 'true',
			),
			admin_url( 'admin.php' )
		);

		wp_redirect( $redirect_to );

		exit;
	}
}
