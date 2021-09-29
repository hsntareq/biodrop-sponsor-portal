<?php

namespace Sponsor;

class Installer {

	public function run() {
		$this->add_version();
		$this->create_tables();
		$this->add_roles();
	}

	public function add_roles() {
		add_role(
			'sponsor',
			'Sponsor',
			array(
				'read'           => true,
				'delete_posts'   => false,
				'manage_options' => true,
				'manage_sponsor' => true,
			),
		);
	}
	public function add_version() {
		$installed = get_option( 'sp_installed' );
		if ( ! $installed ) {
			update_option( 'sp_installed', time() );
		}
		update_option( 'sp_version', SPONSOR_VERSION );
	}

	public function create_tables() {
		global $wpdb;

		$charset_collate = $wpdb->get_charset_collate();

		  $schema = "CREATE TABLE `{$wpdb->prefix}sponsor_protocol` (
			`id` int unsigned NOT NULL AUTO_INCREMENT,
			`user_id` bigint DEFAULT NULL,
			`DoNotReportData` int DEFAULT NULL,
			`mRNAvaxFirstInjectionRate` int DEFAULT NULL,
			`mRNAvaxSecondIncetionRate` int DEFAULT NULL,
			`mRNAvax21DaysRate` int DEFAULT NULL,
			`mRNAvax3MonthsRate` int DEFAULT NULL,
			`mRNAvax5MonthsRate` int DEFAULT NULL,
			`mRNAvax8MonthsRate` int DEFAULT NULL,
			`SingleVaxInjectionRate` int DEFAULT NULL,
			`SingleVax21DaysRate` int DEFAULT NULL,
			`SingleVax3MonthsRate` int DEFAULT NULL,
			`SingleVax5MonthsRate` int DEFAULT NULL,
			`SingleVax8MonthsRate` int DEFAULT NULL,
			`BoosterVaxInjectionRate` int DEFAULT NULL,
			`BoosterVax21DaysRate` int DEFAULT NULL,
			`BoosterVax3MonthsRate` int DEFAULT NULL,
			`BoosterVax5MonthsRate` int DEFAULT NULL,
			`BoosterVax8MonthsRate` int DEFAULT NULL,
			`COVIDRecoveryNegTestRate` int DEFAULT NULL,
			`COVIDRecoveryNegTest6MonthsRate` int DEFAULT NULL,
			`COVIDRecoveryNegTest10MonthsRate` int DEFAULT NULL,
			`COVIDRecoveryNegTest14MonthsRate` int DEFAULT NULL,
			`COVIDRecoveryNegTest18MonthsRate` int DEFAULT NULL,
			`Age60Rate` int DEFAULT NULL,
			`Age80Rate` int DEFAULT NULL,
			`HighImmunityVoiceWithinHours` int DEFAULT NULL,
			`HighImmunityVoiceConsecutiveDays` int DEFAULT NULL,
			`HighImmunitySmellWithinHours` int DEFAULT NULL,
			`HighImmunitySmellConsecutiveDays` int DEFAULT NULL,
			`HighImmunitySymptomsWithinHours` int DEFAULT NULL,
			`HighImmunitySymptomsConsecutiveDays` int DEFAULT NULL,
			`ModerateImmunityVoiceWithinHours` int DEFAULT NULL,
			`ModerateImmunityVoiceConsecutiveDays` int DEFAULT NULL,
			`ModerateImmunitySmellWithinHours` int DEFAULT NULL,
			`ModerateImmunitySmellConsecutiveDays` int DEFAULT NULL,
			`ModerateImmunitySymptomsWithinHours` int DEFAULT NULL,
			`ModerateImmunitySymptomsConsecutiveDays` int DEFAULT NULL,
			`LowImmunityVoiceWithinHours` int DEFAULT NULL,
			`LowImmunityVoiceConsecutiveDays` int DEFAULT NULL,
			`LowImmunitySmellWithinHours` int DEFAULT NULL,
			`LowImmunitySmellConsecutiveDays` int DEFAULT NULL,
			`LowImmunitySymptomsWithinHours` int DEFAULT NULL,
			`LowImmunitySymptomsConsecutiveDays` int DEFAULT NULL,
			`PCRTestVoiceWithinHours` int DEFAULT NULL,
			`PRCTestVoiceConsecutiveDays` int DEFAULT NULL,
			`PCRTestSmellWithinHours` int DEFAULT NULL,
			`PCRTestSmellConsecutiveDays` int DEFAULT NULL,
			`PCRTestSymptomsWithinHours` int DEFAULT NULL,
			`PCRTestSymptomsConsecutiveDays` int DEFAULT NULL,
			`AntigenTestVoiceWithinHours` int DEFAULT NULL,
			`AntigenTestVoiceConsecutiveDays` int DEFAULT NULL,
			`AntigenTestSmellWithinHours` int DEFAULT NULL,
			`AntigenTestSmellConsecutiveDays` int DEFAULT NULL,
			`AntigenTestSymptomsWithinHours` int DEFAULT NULL,
			`AntigenTestSymptomsConsecutiveDays` int DEFAULT NULL,
			`RapidHomeTestVoiceWithinHours` int DEFAULT NULL,
			`RapidHomeTestVoiceConsecutiveDays` int DEFAULT NULL,
			`RapidHomeTestSmellWithinHours` int DEFAULT NULL,
			`RapidHomeTestSmellConsecutiveDays` int DEFAULT NULL,
			`RapidHomeTestSymptomsWithinHours` int DEFAULT NULL,
			`RapidHomeTestSymptomsConsecutiveDays` int DEFAULT NULL,
			PRIMARY KEY (`id`)
		  ) $charset_collate";

		if ( ! function_exists( 'dbdelta' ) ) {
			require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		}
		dbDelta( $schema );
	}
}
