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
	<h1 class="wp-heading-inline"><?php esc_html_e( 'Sponsor Protocol', 'sponsor-protocol' ); ?></h1>
	<a class="page-title-action" href="<?php esc_url_raw( $url ); ?>"><?php echo esc_html__( 'Add new', 'sponsor-protocol' ); ?></a>

	<form action="" method="POST">
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row">
						<label for="name"><?php esc_html_e( 'Name', 'sponsor-protocol' ); ?></label>
					</th>
					<td>
						<input type="text" name="name" id="name" class="regular-text" value="">
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="address"><?php esc_html_e( 'Address', 'sponsor-protocol' ); ?></label>
					</th>
					<td>
						<textarea name="address" id="address" class="regular-text"></textarea>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<label for="phone"><?php esc_html_e( 'Phone', 'sponsor-protocol' ); ?></label>
					</th>
					<td>
						<input type="text" name="phone" id="phone" class="regular-text" value="">
					</td>
				</tr>
			</tbody>
		</table>
		<?php wp_nonce_field( 'new-protocol' ); ?>
		<?php submit_button( __( 'Add Protocol', 'sponsor-protocol' ), 'primary', 'submit_protocol' ); ?>
	</form>
</div>
