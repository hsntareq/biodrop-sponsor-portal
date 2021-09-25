<div class="sp-wrap">
	<header class="bg-secondary bg-gradient">
		<div class="sp-header d-flex justify-content-between align-items-center w-75">
			<div class="d-flex align-items-center h-100">
				<img class="p-3" height="100%" src="<?php echo sponsor()->assets . '/images/logo.png'; ?>" alt="logo">
				<h1 class="ms-2 fs-3 mb-0 text-white fw-bold"><?php esc_html_e( 'Administrative Portal', 'sponsor' ); ?>
				</h1>
			</div>
			<div class="hidden">
				<button class="btn btn-secondary btn-lg"><?php esc_html_e( 'Save Sponsor', 'sponsor' ); ?></button>
			</div>
		</div>
	</header>

	<div class="sp-main p-5 row g-0">
		<div class="sp-nav col-lg-2 col-3">
			<div class="list-group list-group-flush">
				<a href="<?php echo esc_url( get_url( 'entry-status' ) ); ?>"
					class="list-group-item list-group-item-action<?php echo esc_attr( get_active( 'entry-status' ) ) . ( ! get_request( 'nav' ) ? ' active' : '' ); ?>">
					<i class="fas fa-door-open"></i>
					<?php echo esc_html( 'Entry Status' ); ?>
				</a>
				<a href="<?php echo esc_url( get_url( 'protocols' ) ); ?>"
					class="list-group-item list-group-item-action<?php echo esc_attr( get_active( 'protocols' ) ); ?>">
					<i class="far fa-shield-check"></i>
					<?php echo esc_html( 'Protocols' ); ?>
				</a>
				<a href="<?php echo esc_url( get_url( 'settings' ) ); ?>"
					class="list-group-item list-group-item-action<?php echo esc_attr( get_active( 'settings' ) ); ?>">
					<i class="far fa-cog"></i>
					<?php echo esc_html( 'Settings' ); ?>
				</a>
				<a href="<?php echo esc_url( wp_logout_url() ); ?>"
					class="list-group-item list-group-item-action<?php echo esc_attr( get_active( 'logout' ) ); ?>">
					<i class="fas fa-sign-out-alt"></i>
					<?php echo esc_html( 'Logout' ); ?>
				</a>
			</div>
		</div>
		<div class="sp-body col-lg-7 col-9 ps-4 pt-3">
			<?php
			switch ( get_request( 'nav' ) ) {
				case null:
					include __DIR__ . '/entry-status.php';
					break;
				case 'entry-status':
					include __DIR__ . '/entry-status.php';
					break;
				case 'protocols':
					include __DIR__ . '/protocols.php';
					break;
				case 'settings':
					include __DIR__ . '/settings.php';
					break;

				default:
					include __DIR__ . '/404.php';
					break;
			}
			?>
		</div>
	</div>
</div>
