<div class="sp-heading d-flex justify-content-between align-items-end">
	<div>
		<h2 class="page-heading"><?php echo esc_html( 'Welcome, Worthington University' ); ?></h2>
		<p class="m-0">This is the main entry page.</p>
	</div>
</div>
<div class="sp-body">
	<div class="row align-items-center">
		<div class="col">
			<svg width="100%" height="100%" viewBox="0 0 42 42">
				<circle class="donut-hole" cx="21" cy="21" r="12" fill="#fff"></circle>
				<circle class="donut-ring" cx="21" cy="21" r="12" fill="transparent" stroke="#f00" stroke-width="5">
				</circle>

				<circle class="donut-segment" cx="21" cy="21" r="12" fill="transparent" stroke="#8dd320"
					stroke-width="5" stroke-dasharray="50 20" stroke-dashoffset="25"></circle>
			</svg>
			<!-- <div class="donut instalment1">
				<div class="donut-default"></div>
				<div class="donut-line"></div>
				<div class="donut-text">
					<span>check</span>
				</div>
				<div class="donut-case"></div>
			</div> -->
		</div>
		<div class="col">
			<div class="bg-success rounded-3 p-4 text-white ">
				<h5>ACTIVE PROTOCOLS:</h5>
				<ul class="list-group list-group-flush">
					<a href="#" class="list-group-item list-group-item-success">1. On-Campus Students</a>
					<a href="#" class="list-group-item list-group-item-danger">2. Front-line Faculty</a>
					<a href="#" class="list-group-item list-group-item-warning">3. Administrative Staff</a>
					<a href="#" class="list-group-item list-group-item-info">4. Athletic Department</a>
					<a href="#" class="list-group-item list-group-item-light">5. Science Students</a>
				</ul>
			</div>
		</div>
	</div>
	<div class="d-flex justify-content-end mt-5">
		<img width="300" src="<?php echo esc_url	( sponsor()->assets ); ?>/images/good_to_go_icon.svg" alt="good to go">
	</div>
</div>
