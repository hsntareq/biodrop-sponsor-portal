<?php

namespace Sponsor\Admin;

use Sponsor\Traits\Form_Error;

/**
 * SponsorForm
 */
class SponsorForm {

	use Form_Error;

	public $errors            = array();
	public $options_within    = array();
	public $options_result    = array();
	public $protocol_options  = array();
	public $options_recovered = array();

	public function __construct() {
		// if(get_request('entry-status'))
		$this->options_within    = array(
			'1_hour'                    => '1 hour',
			'2_hours'                   => '2 hours',
			'4_hours'                   => '4 hours',
			'6_hours'                   => '6 hours',
			'8_hours'                   => '8 hours',
			'12_hours'                  => '12 hours',
			'16_hours'                  => '16 hours',
			'24_hours'                  => '24 hours',
			'36_hours'                  => '36 hours',
			'2_hours_and_prior_2_days'  => '2 hours and prior 2 days',
			'4_hours_and_prior_2_days'  => '4 hours and prior 2 days',
			'12_hours_and_prior_2_days' => '12 hours and prior 2 days',
			'2_hours_and_prior_3_days'  => '2 hours and prior 3 days',
			'4_hours_and_prior_3_days'  => '4 hours and prior 3 days',
			'12_hours_and_prior_3_days' => '12 hours and prior 3 days',
			'2_hours_and_prior_5_days'  => '2 hours and prior 5 days',
			'4_hours_and_prior_5_days'  => '4 hours and prior 5 days',
			'12_hours_and_prior_5_days' => '12 hours and prior 5 days',
		);
		$this->options_result    = array(
			'1_hour'   => '1 hour',
			'2_hours'  => '2 hours',
			'4_hours'  => '4 hours',
			'6_hours'  => '6 hours',
			'12_hours' => '12 hours',
			'18_hours' => '18 hours',
			'24_hours' => '24 hours',
			'36_hours' => '36 hours',
			'48_hours' => '48 hours',
			'72_hours' => '72 hours',
			'1_week'   => '1 week',
			'2_weeks'  => '2 weeks',
			'1_month'  => '1 month',
		);
		$this->options_recovered = array(
			'within_0_10_months'  => 'within 0 – 10 months',
			'within_11_14_months' => 'within 11 – 14 months',
		);

		add_action( 'admin_init', array( $this, 'add_capability' ) );
		// add_action( 'admin_init', array( $this, 'sponsor_user_settings' ) );
		add_action( 'wp_ajax_save_protocols', array( $this, 'save_protocols' ) );

	}

	public function get_protocols() {
		global $wpdb;

	}

	public function save_protocols() {

		wp_send_json_success( $_REQUEST );
	}
	/**
	 * Add_capability
	 *
	 * @return void
	 */
	public function add_capability() {
		remove_role( 'sponsor_role' );
		$role = get_role( 'sponsor' );
		 $role->add_cap( 'manage_sponsor' );

		 $role2 = get_role( 'administrator' );
		 $role2->add_cap( 'manage_sponsor' );
	}


	public function array_block( $label, $switch, $option ) {
		return array(
			'label'  => $label,
			'switch' => $switch,
			'value'  => array(
				'type'    => 'switch',
				'options' => $option,
			),
		);
	}
	/**
	 * Function protocol_options
	 *
	 * @return array
	 */
	public function protocol_options() {
		$options_within    = $this->options_within;
		$options_result    = $this->options_result;
		$options_recovered = $this->options_recovered;
		$attr              = array(
			'sections' => array(
				'immunity_scale'  => array(
					'label'  => 'Immunity Scale',
					'blocks' => array(
						'mrna'        => array(
							'slug'        => 'mrna',
							'heading'     => 'mRNA Vaccinated',
							'sub_heading' => __( 'Negative PCR test result after positive PCR test result', 'sponsor' ),
							'fields'      => array(
								'first_injection'  => array(
									'label'   => 'First injection',
									'type'    => 'number',
									'default' => 0,
									'remark'  => 1,
								),
								'second_injection' => array(
									'label'   => 'Second injection',
									'type'    => 'number',
									'default' => 0,
									'remark'  => 2,
								),
								'twentyone_days_since_second_injection' => array(
									'label'   => 'Twentyone days since second injection',
									'type'    => 'number',
									'default' => 0,
									'remark'  => 6,
								),
								'three_months_since_second_injection' => array(
									'label'   => 'Three months since second injection',
									'type'    => 'number',
									'default' => 0,
									'remark'  => 5,
								),
								'five_months_since_second_injection' => array(
									'label'   => 'Five months since second injection',
									'type'    => 'number',
									'default' => 0,
									'remark'  => 4,
								),
								'eight_months_since_second_injection' => array(
									'label'   => 'Eight months since second injection',
									'type'    => 'number',
									'default' => 0,
									'remark'  => 3,
								),

							),
						),
						'single_dose' => array(
							'slug'        => 'single_dose',
							'heading'     => 'Single Dose Vaccinated',
							'sub_heading' => __( 'Negative PCR test result after positive PCR test result', 'sponsor' ),
							'fields'      => array(
								'injection' => array(
									'label'   => 'Injection',
									'type'    => 'number',
									'default' => 0,
									'remark'  => 1,
								),
								'twentyone_days_since_injection' => array(
									'label'   => 'Twentyone days since injection',
									'type'    => 'number',
									'default' => 0,
									'remark'  => 6,
								),
								'three_months_since_injection' => array(
									'label'   => 'Three months since injection',
									'type'    => 'number',
									'default' => 0,
									'remark'  => 5,
								),
								'five_months_since_injection' => array(
									'label'   => 'Five months since injection',
									'type'    => 'number',
									'default' => 0,
									'remark'  => 4,
								),
								'eight_months_since_injection' => array(
									'label'   => 'Eight months since injection',
									'type'    => 'number',
									'default' => 0,
									'remark'  => 3,
								),

							),
						),
						'booster'     => array(
							'slug'        => 'booster',
							'heading'     => 'Booster Vaccinated',
							'sub_heading' => __( 'Negative PCR test result after positive PCR test result', 'sponsor' ),
							'fields'      => array(
								'injection' => array(
									'label'   => 'Injection',
									'type'    => 'number',
									'default' => 0,
									'remark'  => 1,
								),
								'twentyone_days_since_injection' => array(
									'label'   => 'Twentyone days since injection',
									'type'    => 'number',
									'default' => 0,
									'remark'  => 6,
								),
								'three_months_since_injection' => array(
									'label'   => 'Three months since injection',
									'type'    => 'number',
									'default' => 0,
									'remark'  => 5,
								),
								'five_months_since_injection' => array(
									'label'   => 'Five months since injection',
									'type'    => 'number',
									'default' => 0,
									'remark'  => 4,
								),
								'eight_months_since_injection' => array(
									'label'   => 'Eight months since injection',
									'type'    => 'number',
									'default' => 0,
									'remark'  => 3,
								),

							),
						),
						'recovery'    => array(
							'slug'        => 'recovery',
							'heading'     => 'Recovery from COVID-19 positive test',
							'sub_heading' => __( 'Negative PCR test result after positive PCR test result', 'sponsor' ),
							'fields'      => array(
								'negative_test_after_positive_test' => array(
									'label'   => 'Negative test after positive test',
									'type'    => 'number',
									'default' => 0,
									'remark'  => 7,
								),
								'six_months_after_negative_test' => array(
									'label'   => 'Six months after negative test',
									'type'    => 'number',
									'default' => 0,
									'remark'  => 6,
								),
								'ten_months_after_negative_test' => array(
									'label'   => 'Ten months after negative test',
									'type'    => 'number',
									'default' => 0,
									'remark'  => 5,
								),
								'fourteen_months_since_negative_test' => array(
									'label'   => 'Fourteen months since negative test',
									'type'    => 'number',
									'default' => 0,
									'remark'  => 4,
								),
								'eighteen_months_since_negative_test' => array(
									'label'   => 'Eighteen months since negative test',
									'type'    => 'number',
									'default' => 0,
									'remark'  => 3,
								),

							),
						),
					),
				),
				'immunity_result' => array(
					'label'  => 'Immunity Result',
					'blocks' => array(
						'pcr'        => array(
							'slug'        => 'pcr ',
							'heading'     => 'Negative PCR Test',
							'sub_heading' => __( 'Negative PCR test result after positive PCR test result', 'sponsor' ),
							'fields'      => array(
								'smell_test' => array(
									'label'   => 'Voice Test',
									'type'    => 'number',
									'default' => array( '36', 'hr' ),
									'remark'  => array( '36', 'hr' ),
								),
								'smell_test' => array(
									'label'   => 'Smell Test',
									'type'    => 'number',
									'default' => array( '4', 'hr' ),
									'remark'  => array( '4', 'hr' ),
								),

							),
						),
						'antigen'    => array(
							'slug'        => 'Antigen',
							'heading'     => 'Negative Antigen Test',
							'sub_heading' => __( 'Negative Antigen test result after positive PCR test result', 'sponsor' ),
							'fields'      => array(
								'smell_test' => array(
									'label'   => 'Voice Test',
									'type'    => 'number',
									'default' => array( '24', 'hr' ),
									'remark'  => array( '24', 'hr' ),
								),
								'smell_test' => array(
									'label'   => 'Smell Test',
									'type'    => 'number',
									'default' => array( '4', 'hr' ),
									'remark'  => array( '4', 'hr' ),
								),

							),
						),
						'home_rapid' => array(
							'slug'        => 'home_rapid',
							'heading'     => 'Negative Home Rapid Test',
							'sub_heading' => __( 'Negative Home Rapid test result after positive PCR test result', 'sponsor' ),
							'fields'      => array(
								'smell_test' => array(
									'label'   => 'Voice Test',
									'type'    => 'number',
									'default' => array( '3', 'day' ),
									'remark'  => array( '3', 'day' ),
								),
								'smell_test' => array(
									'label'   => 'Smell Test',
									'type'    => 'number',
									'default' => array( '4', 'hr' ),
									'remark'  => array( '4', 'hr' ),
								),

							),
						),
					),
				),
			),
		);
		return $attr;
	}
	/**
	 * Function select_options
	 *
	 * @param  mixed $options
	 * @return string
	 */
	public function select_options( $options = array() ) {
		$output = '';
		if ( $options ) {
			foreach ( $options as $key => $option ) {
				$output .= "<option value='{$key}'>{$option}</option>";
			}
		}
		return $output;
	}
	/**
	 * Function menu_function
	 *
	 * @return void
	 */
	public function protocol_formmmmmm() {

		switch ( get_request( 'nav' ) ) {
			case 'entry-status':
				$template = __DIR__ . '/views/entry-status.php';
				break;
			case 'protocols':
				$template = __DIR__ . '/views/protocols.php';
				break;

			default:
				$template = __DIR__ . '/views/entry-status.php';
				break;
		}

		if ( file_exists( $template ) ) {

			include $template;
		}
	}

	public function generate() {

	}

	public function plugin_main_page() {
		// ob_start();
		include __DIR__ . '/views/protocol-main.php';
		// include tutor()->path . 'views/options/options_generator.php';.
		// return ob_get_clean();
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

		if ( ! wp_verify_nonce( get_request( '_wpnonce' ), 'new-protocol' ) ) {
			wp_die( 'Are you cheating?' );
		}

		if ( ! current_user_can( 'manage_options' ) ) {
			wp_die( 'Are you cheating?' );
		}

		$id      = isset( $_POST['id'] ) ? intval( get_request( 'id' ) ) : 0;
		$name    = isset( $_POST['name'] ) ? sanitize_text_field( get_request( 'name' ) ) : '';
		$address = isset( $_POST['address'] ) ? sanitize_textarea_field( get_request( 'address' ) ) : '';
		$phone   = isset( $_POST['phone'] ) ? sanitize_text_field( get_request( 'phone' ) ) : '';

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
