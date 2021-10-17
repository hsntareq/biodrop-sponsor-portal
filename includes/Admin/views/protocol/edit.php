<div class="sp-heading d-flex justify-content-between align-items-end">
	<div>
		<h2 class="page-heading">Protocol Settings</h2>
		<p class="m-0">Set entry protocol requirements and thresholds</p>
	</div>
	<h6 class="m-0">Your Protocol: <span class="text-success fw-bold">UF 243.Arts&Science</span></h6>
</div>

<?php
$edit_id        = get_request( 'edit' );
$protocols      = $this->get_protocols();
$edit_protocol  = $this->get_edit_protocol( $edit_id );
$user_protocols = $this->get_protocol_by_current_user();
if ( ! isset( $_GET['edit'] ) ) {
	$protocol_edit = $user_protocols[ array_key_first( $user_protocols ) ];
	// pr( $user_protocols );
}
?>

<hr>

<div class="sp-block mb-4">
	<div class="d-flex justify-content-between align-items-center">
		<div class="d-flex align-items-center">
			<h4 class="m-0 text-nowrap">Select your Protocol:</h4>
			<select class="form-select select2 ms-2" id="select_protocol">
				<?php foreach ( $user_protocols as $key => $protocol ) { ?>
					<option <?php echo $protocol->id == $edit_id ? 'selected' : null; ?> value="<?php echo $protocol->name; ?>"><?php echo $protocol->name; ?></option>
				<?php } ?>
			</select>
		</div>


		<a href="<?php echo esc_url( get_url( 'protocol-new' ) ); ?>"
			class="btn btn-success">
			<i class="fa fa-plus me-2"></i>
			<?php echo esc_html( 'New Protocol' ); ?>
		</a>
	</div>
</div>

<div class="sp-blocks">
	<form id="protocol_form">
		<?php
		$protocol_options = $this->protocol_options();
		foreach ( $protocol_options as $option_key => $options ) :
			?>
			<div class="sp-block" id="option_ <?php echo esc_attr( $option_key ); ?>">
				<div class="sp-block-heading d-flex mt-4 align-items-center">
					<i class="fad fa-users me-3 fa-2x"></i>
					<div>
						<h5 class="mb-0 text-dark"><?php echo esc_html( get_result( $options['label'] ) ); ?></h5>
						<p class="text-secondary mb-0"><?php echo esc_html( get_result( $options['desc'] ) ); ?></p>
					</div>
				</div>

				<div class="form-data-row">
					<?php

					if ( isset( $options['blocks'] ) ) :
						foreach ( $options['blocks'] as $block_key => $block ) :
							?>
							<div class="card p-0 mw-100">
							<div class="card-header">
								<h5 class="m-0"><?php echo esc_html( $block['heading'] ); ?></h5>
							</div>
							<div class="card-body">

							<?php
							if ( isset( $block['fields'] ) ) :
								foreach ( $block['fields'] as $field_key => $field ) :
									  $field_key = $block_key . '_' . $field_key;
									// pr( $field );
									?>
									<div class="sp-row d-flex align-items-center mb-4 justify-content-between">
										<!-- <label class="form-toggle mr-1">
											<input type="hidden" value="off">
											<input type="checkbox" value="on" class="form-toggle-input" <?php // echo ( 'off' === $field['switch'] ) ? '' : 'checked'; ?>>
											<span class="form-toggle-control"></span>
											<span class="label-before text-nowrap ms-3"><?php // echo esc_attr( get_result( $field['label'] ) ); ?></span>
										</label> -->

										<label><?php echo esc_attr( get_result( $field['label'] ) ); ?></label>										<div class="d-flex align-items-center justify-content-end">
										<i class="far me-2 fa-info-circle" data-bs-toggle="tooltip" title="<?php echo esc_attr( get_result( $field['label'] ) ); ?>"></i>
										<?php if ( $field['type'] == 'group' ) { ?>
											<div class="input-group">
												<input type="number" class="form-control border change-field input-mw" name="<?php echo esc_attr( get_result( $block_key ) ) . '_' . esc_attr( get_result( $field_key ) ); ?>" value="<?php echo $field['default']; ?>">
												<span class="input-group-text"> Within Hour</span>
											</div>
											<?php
										} else {
											?>
										<input type="number" class="form-control input-mw change-field text-right" placeholder="<?php echo esc_attr( 'input...' ); ?>" name="<?php echo esc_attr( get_result( $block_key ) ) . '_' . esc_attr( get_result( $field_key ) ); ?>" value="<?php echo esc_attr( $protocol_edit->$field_key ); ?>">
										<?php } ?>

										</div>
										<?php // endif; ?>
									</div>
									<?php
								endforeach;

							endif;
							echo '</div>';
							echo '</div>';
						endforeach;
					endif;

					?>

			</div>
		<?php endforeach; ?>
	</form>
</div>
