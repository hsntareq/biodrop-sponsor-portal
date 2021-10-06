<div class="sp-heading d-flex justify-content-between align-items-end">
	<div>
		<h2 class="page-heading">Protocol Settings</h2>
		<p class="m-0">Set entry protocol requirements and thresholds</p>
	</div>
	<h6 class="m-0">Your Protocol: <span class="text-success fw-bold">UF 243.Arts&Science</span></h6>
</div>




<hr>

<div class="sp-block mb-4">
	<div class="d-flex justify-content-start align-items-center">
		<h4 class="m-0">Current Protocol:</h4>

		<div class="d-flex ms-3">
			<div class="input-group">
				<select class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
					<?php echo $this->select_options( $this->options_within ); ?>
				</select>
				<button class="btn btn-success" type="button"><i class="fas fa-plus me-2"></i> New
					Protocol</button>
			</div>
		</div>
	</div>
</div>

<div class="sp-block bg-secondary p-3 rounded-3 mb-4 shadow-sm">
	<h5 class="text-white">Protocol Presets</h5>
	<div class="sp-preset">
		<div class="row">
			<div class="col">
				<span class="d-block present-item active">
					<img src="<?php echo sponsor()->assets; ?>/images/protocol_incl_button_unchecked@2x.png"
						alt="preset1">
				</span>
			</div>
			<div class="col">
				<span class="d-block present-item">
					<img src="<?php echo sponsor()->assets; ?>/images/protocol_mod_button_unchecked@2x.png"
						alt="preset1">
				</span>
			</div>
			<div class="col">
				<span class="d-block present-item">
					<img src="<?php echo sponsor()->assets; ?>/images/protocol_vig_button_unchecked@2x.png"
						alt="preset1">
				</span>
			</div>
			<div class="col">
				<span class="d-block present-item">
					<img src="<?php echo sponsor()->assets; ?>/images/protocol_cust_button_unchecked@2x.png"
						alt="preset1">
				</span>
			</div>
		</div>
	</div>
</div>

<div class="sp-blocks">
	<form id="protocol_form">
		<?php
		$protocol_options = $this->protocol_options();
		foreach ( $protocol_options as $option_key => $options ) :
			?>
			<div class="sp-block" id="option_ <?php echo esc_attr( $option_key ); ?>">
				<div class="sp-block-heading d-flex mt-4">
					<i class="fad fa-users me-3 fa-2x mt-1"></i>
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
									// pr( $field );
									?>
									<div class="sp-row d-flex align-items-center mb-4 justify-content-between">
										<label class="form-toggle mr-1">
											<input type="hidden" name="radio_<?php echo esc_attr( get_result( $block_key ) ) . '_' . esc_attr( get_result( $field_key ) ); ?>" value="off">
											<input type="checkbox" value="on" class="form-toggle-input" <?php echo ( 'off' === $field['switch'] ) ? '' : 'checked'; ?>>
											<span class="form-toggle-control"></span>
											<span class="label-before text-nowrap ms-3"><?php echo esc_attr( get_result( $field['label'] ) ); ?></span>
										</label>
										<?php // if ( false !== $field['value'] ) : ?>
										<div class="d-flex align-items-center justify-content-end">
										<i class="far me-2 fa-info-circle" data-bs-toggle="tooltip" title="<?php echo esc_attr( get_result( $field['label'] ) ); ?>"></i>

										<?php if ( $field['type'] == 'group' ) { ?>
											<div class="input-group input-gr-mw">
												<input type="number" class="form-control" value="<?php echo $field['default'][0]; ?>">
												<select class="form-select" id="inputGroupSelect02">
													<option <?php echo $field['default'][1] == 'hour' ? 'selected' : ''; ?> value="hour">Hour</option>
													<option <?php echo $field['default'][1] == 'day' ? 'selected' : ''; ?> value="day">Day</option>
												</select>
											</div>
											<?php
										} else {
											?>
										<input type="number" class="form-control input-mw text-right" placeholder="<?php echo esc_attr( 'input...' ); ?>" name="<?php echo esc_attr( get_result( $block_key ) ) . '_' . esc_attr( get_result( $field_key ) ); ?>" value="<?php echo esc_attr( get_result( $field['default'] ) ); ?>">
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
