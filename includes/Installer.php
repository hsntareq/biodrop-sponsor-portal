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
            `name` varchar(100) NOT NULL DEFAULT '',
            `address` text,
            `phone` varchar(30) DEFAULT NULL,
            `created_by` bigint unsigned NOT NULL,
            `created_at` datetime NOT NULL,
            PRIMARY KEY (`id`)
          ) $charset_collate";

		if ( ! function_exists( 'dbdelta' ) ) {
			require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		}
		dbDelta( $schema );
	}
}
