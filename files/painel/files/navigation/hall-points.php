<?php 
	require_once('../others/core.php');

	$Panel::Session('disconnected', $result_panel_user['rank']);

	if ($result_panel_user['rank'] < $administrator) {
		Redirect(URL_PANEL);
	}

	$page_id = 'administrator';
	$page_name = 'Hall-Points';
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
						<h2 class="bold">Manusear pontos do Hall da Fama</h2>
					</label>
				</div>
				<div class="content-container">
					<div class="general-white-container hall-points mr-auto-left-right">
						<form method="POST" class="form-hall-points flex-column">
						<input type="hidden" name="order" value="hall-points">

							<div class="form-warns"></div>
							<div class="col-input-separator flex-column mr-top-none">
								<label>
									<h5 class="fs-14">Nome de usuário</h5>
								</label>
								<input type="text" name="username">
								<div class="error-input-warn"></div>
							</div>
							<div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">Tipo</h5>
								</label>
								<select name="points-type">
									<option value="events" selected="selected">Eventos</option>
									<option value="promotions">Promoções</option>
								</select>
								<div class="error-input-warn"></div>
							</div>
							<div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">Quantidade</h5>
								</label>
								<input type="number" name="points-amount" minlength="0" value="0" maxlength="1000">
								<div class="error-input-warn"></div>
							</div>
							<div class="col-input-separator flex-column mr-bottom-2">
								<label>
									<h5 class="fs-14">Ação</h5>
								</label>
								<select name="points-action">
									<option value="add-points" selected="selected">Adicionar</option>
									<option value="remove-points">Remover</option>
								</select>
								<div class="error-input-warn"></div>
							</div>
							<button class="green-button-1" type="submit" style="width: 100%;height: 50px">
								<label class="mr-auto color-1">
									<h5 class="fs-14"><span>Adicionar</span> pontos</h5>
								</label>
							</button>
						</form>
					</div>
				</div>
			</div>
<?php 
	include('../others/bottom.php');
?>