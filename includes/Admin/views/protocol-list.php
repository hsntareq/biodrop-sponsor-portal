<?php
$url = add_query_arg(
	array(
		'page'   => 'biodrop-portal',
		'action' => 'new',
	),
	admin_url( 'admin.php' )
);
?>
<div class="wrap">
	<h1 class="wp-heading-inline"><?php esc_html_e( 'Sponsor Protocol', 'sponsor' ); ?></h1>
	<a class="page-title-action" href="<?php echo esc_url_raw( $url ); ?>"><?php echo esc_html__( 'Add new', 'sponsor' ); ?></a>

	<form action="" method="POST">
		<?php
		$table = new \Sponsor\Portal\Admin\Protocol_List();
		$table->prepare_items();
		$table->display();
		?>
	</form>
</div>
