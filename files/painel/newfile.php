<?php
	require_once('core.php');
	require_once('session.php');

	$page_id = '';
	$page_name = 'Painel: Inicio - ' . $hotel['hotelname'] . '';

	include('./includes/head.php');
?>
	<body>
		<?php include('./includes/sidebar.php'); ?>
		<div class="content">
			<div class="flex" id="content-header">
				<div class="margin-auto-top-bottom">
					<h2 class="bold color-15">Nova página</h2>
				</div>
			</div>
			<div id="content-tool-bar">
				<div class="flex-wrap margin-auto">
					<li class="list-none flex-column padding-right-max padding-left-max" id="c-t-b-statistics">
						<h2 class="bold color-15 margin-auto-left-right"><?php echo number_format($conta_o); ?></h2>
						<h4 class="uppercase gray-clear margin-auto-left-right">Onlines</h4>
					</li>
					<li class="list-none flex-column padding-right-max padding-left-max" id="c-t-b-statistics">
						<h2 class="bold color-15 margin-auto-left-right"><?php echo number_format($conta_r); ?></h2>
						<h4 class="uppercase gray-clear margin-auto-left-right">Registrados</h4>
					</li>
					<li class="list-none flex-column padding-right-max padding-left-max" id="c-t-b-statistics">
						<h2 class="bold color-15 margin-auto-left-right"><?php echo number_format($conta_b); ?></h2>
						<h4 class="uppercase gray-clear margin-auto-left-right">Banidos</h4>
					</li>
					<li class="list-none flex-column padding-right-max padding-left-max" id="c-t-b-statistics">
						<h2 class="bold color-15 margin-auto-left-right"><?php echo number_format($conta_tk); ?></h2>
						<h4 class="uppercase gray-clear margin-auto-left-right">Tickets</h4>
					</li>
				</div>
			</div>
			<div id="content-container">
			</div>
		</div>
	</body>
	<script src="<?php echo $hotel['site']; ?>/general/assets/js/jquery-3.4.1.min.js?<?php echo time(); ?>"></script>
	<script src="<?php echo $hotel['site']; ?>/general/assets/js/hybbe.js?<?php echo time(); ?>"></script>
</html>