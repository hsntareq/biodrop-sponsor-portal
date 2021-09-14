<?php

namespace Sponsor\Portal\Admin;

if ( ! class_exists( 'WP_List_Table' ) ) {
	require_once ABSPATH . 'wp-admin/includes/class-wp-list-table.php';
}

class Protocol_List extends \WP_List_Table {

	public function __construct() {
		parent::__construct(
			array(
				'singular' => 'contact',
				'plural'   => 'contacts',
				'ajax'     => false,
			)
		);
	}

	public function get_columns() {
		return array(
			'cb'         => '<input type="checkbox">',
			'name'       => __( 'Name', 'sponsor-portal' ),
			'phone'      => __( 'Phone', 'sponsor-portal' ),
			'created_at' => __( 'Date', 'sponsor-portal' ),
		);

	}

	protected function column_default( $item, $column_name ) {

		switch ( $column_name ) {
			case 'value':
				break;

			default:
				return isset( $item->column_name ) ? $item->column_name : '';
		}
	}



	public function prepare_items() {
		$column   = $this->get_columns();
		$hidden   = array();
		$sortable = $this->get_sortable_columns();
		$per_page = 20;

		$this->_column_headers = array( $column, $hidden, $sortable );

		$this->items = sp_po_get_protocol();
		$this->set_pagination_args(
			array(
				'total_items' => sp_po_protocol_count(),
				'per_page'    => $per_page,
			)
		);
	}

}
