<?php
$url = add_query_arg(
	array(
		'page'   => 'biodrop-portal',
		'action' => 'new',
	),
	admin_url( 'admin.php' )
);
echo '<pre>';
var_dump( $this->errors );
echo '</pre>';
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

						<?php if ( $this->has_error( 'name' ) ) : ?>
							<p class="description error"><?php echo $this->get_error( 'name' ); ?></p>
						<?php endif; ?>
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
