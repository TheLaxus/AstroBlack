<?php 
	require_once('../others/core.php');

	$Panel::Session('disconnected', $result_panel_user['rank']);

	if ($result_panel_user['rank'] < $ceo) {
		Redirect(URL_PANEL);
	}

	$page_id = 'ceo';
	$page_name = 'Reset-Hall';
	$page_title = 'Painel: Hospedar emblema - ' . HOTELNAME;

	include('../others/head.php');
?>
<?php 
	include('../others/sidebar.php');
?>
			<div class="content flex-column">
				<div class="header-content flex">
					<div class="sideBar-controller">
						<span></span>
						<span></span>
						<span></span>
					</div>
					<label class="mr-auto-top-bottom">
						<h2 class="bold">Hospedar emblema</h2>
					</label>
				</div>
				<div class="content-container">
                <div class="general-white-container create-article mr-auto-left-right">
						<form method="POST" class="form-reset-hall flex-column">
							<input type="hidden" name="order" value="reset-hall">
							<div class="form-warns"></div>
							<div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">Reset Hall do Hotel.</h5>
								</label>
								
								<select class="form-control" name="reset-hall">
										<option value="reset-events" selected>Resetar Hall de Eventos</option>
										<option value="reset-promos" >Resetar Hall de Promoções</option>
										<option value="reset-all">Resetar ambos</option>
								</select>
								<div class="error-input-warn"></div>
							</div>
							<div class="col-input-separator flex-column mr-bottom-2"></div>
							<button class="green-button-1" type="submit" style="width: 100%;height: 50px">
								<label class="mr-auto color-1">
									<h5 class="fs-14">Resetar Hall</h5>
								</label>
							</button>
						</form>
					</div>
				</div>
			</div>
<?php 
	include('../others/bottom.php');
?>