<?php

namespace Sponsor\Admin;

use Sponsor\Traits\Form_Error;

/**
 * Class BasePlugin
 */
class SponsorForm {

	use Form_Error;

	public $errors = array();
	/**
	 * Function menu_function
	 *
	 * @return void
	 */
	public function protocol_form() {

		$template = __DIR__ . '/views/protocol-main.php';

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

		$id      = isset( $_POST['id'] ) ? intval( $_POST['id'] ) : 0;
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

		$args = array(
			'name'    => $name,
			'address' => $address,
			'phone'   => $phone,
		);

		if ( $id ) {
			$args['id']  = $id;
			$redirect_to = add_query_arg(
				array(
					'page'    => 'biodrop-portal',
					'action'  => 'edit',
					'updated' => 'true',
					'id'      => $id,
				),
				admin_url( 'admin.php' )
			);
		} else {
			$redirect_to = add_query_arg(
				array(
					'page'     => 'biodrop-portal',
					'inserted' => 'true',
				),
				admin_url( 'admin.php' )
			);
		}

		$insert_id = sp_po_insert_protocol( $args );

		if ( is_wp_error( $insert_id ) ) {
			wp_die( $insert_id->get_error_messages() );
		}

		wp_redirect( $redirect_to );

		exit;
	}

	public function delete_protocol() {
		if ( ! wp_verify_nonce( $_REQUEST['_wpnonce'], 'sp-po-delete-action' ) ) {
			wp_die( 'Are you cheating2?' );
		}

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( 'Are you cheating1?' );
		}
		$id = isset( $_REQUEST['id'] ) ? intval( $_REQUEST['id'] ) : 0;

		if ( sp_po_delete_protocol( $id ) ) {
			$redirect_to = add_query_arg(
				array(
					'page'    => 'biodrop-portal',
					'deleted' => 'true',
				),
				admin_url( 'admin.php' )
			);
		} else {
			$redirect_to = add_query_arg(
				array(
					'page'    => 'biodrop-portal',
					'deleted' => 'true',
				),
				admin_url( 'admin.php' )
			);
		}
		wp_redirect( $redirect_to );
		exit;
	}
}
