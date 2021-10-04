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
				'm_rna_vaccinated'        => array(
					'heading'     => 'mRNA Vaccinated',
					'sub_heading' => __( 'Negative PCR test result after positive PCR test result', 'sponsor' ),
					'blocks'      => array(
						array(
							'label'  => __( 'Fully Vaccinated' ),
							'switch' => false,
							'fields' => array(
								'voice_test'    => $this->array_block( 'Voice Test', 'on', $options_result ),
								'smell_test'    => $this->array_block( 'Smell Test', 'on', $options_result ),
								'symptom_track' => $this->array_block( 'Symptom Track', 'off', $options_result ),
								'saliva_direct' => $this->array_block( 'Saliva Direct', 'off', $options_result ),
							),
						),
						array(
							'label'  => __( '8+ Months Since Vaccination' ),
							'switch' => false,
							'fields' => array(
								'voice_test'    => $this->array_block( 'Voice Test', 'on', $options_result ),
								'smell_test'    => $this->array_block( 'Smell Test', 'on', $options_result ),
								'symptom_track' => $this->array_block( 'Symptom Track', 'off', $options_result ),
								'saliva_direct' => $this->array_block( 'Saliva Direct', 'off', $options_result ),
							),
						),
					),
				),
				'unvaccinated'            => array(
					'heading'     => __( 'Unvaccinated' ),
					'sub_heading' => '',
					'fields'      => array(
						'voice_test'    => $this->array_block( 'Voice Test', 'on', $options_within ),
						'smell_test'    => $this->array_block( 'Smell Test', 'on', $options_within ),
						'symptom_track' => $this->array_block( 'Symptom Track', 'off', $options_within ),
						'saliva_direct' => $this->array_block( 'Saliva Direct', 'off', $options_within ),
						'do_not_admit'  => array(
							'label'  => 'Do not admit',
							'switch' => 'off',
							'value'  => false,
						),
					),
				),
				'recovered_from_covid_19' => array(
					'heading'     => __( 'Recovered from COVID-19' ),
					'sub_heading' => __( 'Negative PCR test result after positive PCR test result', 'sponsor' ),
					'blocks'      => array(
						array(
							'label'  => __( 'Recovered:' ),
							'switch' => false,
							'value'  => array(
								'type'    => 'switch',
								'options' => $options_recovered,
							),
							'fields' => array(
								'voice_test'    => $this->array_block( 'Voice Test', 'on', $options_result ),
								'smell_test'    => $this->array_block( 'Smell Test', 'on', $options_result ),
								'symptom_track' => $this->array_block( 'Symptom Track', 'off', $options_result ),
								'saliva_direct' => $this->array_block( 'Saliva Direct', 'off', $options_result ),
							),
						),
						array(
							'label'  => __( 'Recovered:' ),
							'switch' => false,
							'value'  => array(
								'type'    => 'switch',
								'options' => $options_recovered,
							),
							'fields' => array(
								'voice_test'    => $this->array_block( 'Voice Test', 'on', $options_result ),
								'smell_test'    => $this->array_block( 'Smell Test', 'on', $options_result ),
								'symptom_track' => $this->array_block( 'Symptom Track', 'off', $options_result ),
								'saliva_direct' => $this->array_block( 'Saliva Direct', 'off', $options_result ),
							),
						),
					),
				),
				'single_dose_vaccination' => array(
					'heading'     => 'Single Dose Vaccination',
					'sub_heading' => __( '21+ days since vaccination or booster', 'sponsor' ),
					'blocks'      => array(
						array(
							'label'  => __( 'Fully Vaccinated' ),
							'switch' => false,
							'fields' => array(
								'voice_test'    => $this->array_block( 'Voice Test', 'on', $options_result ),
								'smell_test'    => $this->array_block( 'Smell Test', 'on', $options_result ),
								'symptom_track' => $this->array_block( 'Symptom Track', 'off', $options_result ),
								'saliva_direct' => $this->array_block( 'Saliva Direct', 'off', $options_result ),
							),
						),
						array(
							'label'  => __( '8+ Months Since Vaccination' ),
							'switch' => false,
							'fields' => array(
								'voice_test'    => $this->array_block( 'Voice Test', 'on', $options_result ),
								'smell_test'    => $this->array_block( 'Smell Test', 'on', $options_result ),
								'symptom_track' => $this->array_block( 'Symptom Track', 'off', $options_result ),
								'saliva_direct' => $this->array_block( 'Saliva Direct', 'off', $options_result ),
							),
						),
					),
				),
				'neg_pcr_test'            => array(
					'heading'     => __( 'Neg. PCR Test' ),
					'sub_heading' => '',
					'fields'      => array(
						'voice_test'    => $this->array_block( 'Voice Test', 'on', $options_result ),
						'smell_test'    => $this->array_block( 'Smell Test', 'on', $options_result ),
						'symptom_track' => $this->array_block( 'Symptom Track', 'off', $options_result ),
						'saliva_direct' => $this->array_block( 'Saliva Direct', 'off', $options_result ),
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
