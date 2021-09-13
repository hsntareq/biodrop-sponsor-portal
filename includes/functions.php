<?php

/**
 * Function sp_po_insert_protocol
 *
 * @param  mixed $args
 * @return int|WP_Error
 */
function sp_po_insert_protocol( $args = array() ) {
	global $wpdb;

	if ( empty( $data['name'] ) ) {
		return new \WP_Error( 'no-name', __( 'You must provide a name', 'sponsor-portal' ) );
	}

	$defaults = array(
		'name'       => '',
		'address'    => '',
		'phone'      => '',
		'created_by' => get_current_user_id(),
		'created_at' => current_time( 'mysql' ),
	);
	$format   = array( '%s', '%s', '%s', '%d', '%s' );
	$data     = wp_parse_args( $args, $defaults );

	$inserted = $wpdb->insert(
		"{$wpdb->prefix}sponsor_protocol",
		$data,
		$format
	);

	if ( ! $inserted ) {
		return new \WP_Error( 'failed-to-insert', __( 'Failed to insert data', 'sponsor-portal' ) );
	}

	return $wpdb->insert_id;
}
