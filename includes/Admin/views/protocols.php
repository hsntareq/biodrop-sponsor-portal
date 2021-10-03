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
		$protocol_options = $this->protocol_options()['sections'];
		foreach ( $protocol_options as $secKey => $options ) :
			?>
			<div class="sp-block">
				<div class="sp-block-heading d-flex mb-4">
					<i class="fad fa-users me-3 fa-2x mt-1"></i>
					<div>
						<h5 class="mb-0 text-dark"><?php echo esc_html( $options['heading'] ) ?? null; ?></h5>
						<p class="text-secondary"><?php echo esc_html( $options['sub_heading'] ) ?? null; ?></p>
					</div>
				</div>

				<div class="form-row ms-auto w-lg-75">
					<?php
					if ( isset( $options['blocks'] ) ) :
						foreach ( $options['blocks'] as $key => $blocks ) :
							if ( isset( $blocks['fields'] ) ) :
								// pr( $blocks );
								?>
								<div class="d-flex justify-content-between align-items-center mb-4">
									<div><strong><?php echo $blocks['label']; ?></strong></div>
									<?php if ( isset( $blocks['value'] ) ) : ?>
										<div class="d-flex">
											<div class="input-group">
												<select class="form-select" id="inputGroupSelect04" aria-label="Example select with button addon">
												<?php echo $this->select_options( $blocks['value']['options'] ); ?>
												</select>
											</div>
										</div>
									<?php endif; ?>
								</div>
								<?php
								foreach ( $blocks['fields'] as $key => $fields ) :
									?>
									<div class="sp-row d-flex align-items-center mb-4 justify-content-between">
										<label class="form-toggle mr-1">
											<input type="hidden" name="radio_<?php echo $secKey . '_' . $key; ?>" value="off">
											<input type="checkbox" value="on" class="form-toggle-input" <?php echo ( 'off' === $fields['switch'] ) ? '' : 'checked'; ?>>
											<span class="form-toggle-control"></span>
											<span class="label-before text-nowrap ms-3"><?php echo $fields['label']; ?></span>
										</label>
										<?php if ( false !== $fields['value'] ) : ?>
										<div class="d-flex align-items-center">
											<label class="mx-3">within</label>
											<select class="form-control" name="select_<?php echo $secKey . '_' . $key; ?>" id="<?php echo $secKey . '_' . $key; ?>">
											<?php echo $this->select_options( $fields['value']['options'] ); ?>
											</select>
										</div>
										<?php endif; ?>
									</div>
									<?php
							endforeach;
						endif;
					endforeach;
					endif;
					if ( isset( $options['fields'] ) ) :
						foreach ( $options['fields'] as $key => $fields ) :
							?>
							<div class="sp-row d-flex align-items-center mb-4 justify-content-between">
								<label class="form-toggle mr-1">
									<input type="hidden" name="radio_<?php echo $secKey . '_' . $key; ?>" value="off">
									<input type="checkbox" class="form-toggle-input" <?php echo ( 'off' === $fields['switch'] ) ? '' : 'checked'; ?>>
									<span class="form-toggle-control"></span>
									<span class="label-before text-nowrap ms-3"><?php echo $fields['label']; ?></span>
								</label>
								<?php
								if ( false !== $fields['value'] ) :
									?>
								<div class="d-flex align-items-center">
									<label class="mx-3">within</label>
									<select class="form-control" name="select_<?php echo $secKey . '_' . $key; ?>" id="<?php echo $secKey . '_' . $key; ?>">
											<?php echo $this->select_options( $fields['value']['options'] ); ?>
									</select>
								</div>
								<?php endif; ?>
							</div>
							<?php
						endforeach;
					endif;
					?>

				<hr>
			</div>
		<?php endforeach; ?>
	</form>
</div>
