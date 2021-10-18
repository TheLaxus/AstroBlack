<?php 
	require_once('../others/core.php');

	$Panel::Session('disconnected', $result_panel_user['rank']);

	$page_id = 'send-vip';
	$page_name = 'send-vip';
	$page_title = 'Painel: Enviar VIP - ' . HOTELNAME;

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
						<h2 class="bold">Enviar VIP</h2>
					</label>
				</div>
				<div class="content-container">
					<div class="general-white-container create-article mr-auto-left-right">
						<form method="POST" class="form-send-vip flex-column">
                        <input type="hidden" name="order" value="send-vip">

							<div class="form-warns"></div>
							<div class="col-input-separator flex-column mr-top-none">
								<label>
									<h5 class="fs-14">Usuário</h5>
								</label>
								<input type="text" name="username" placeholder="Digite o usuário que deseja enviar o VIP" autocomplete="off" >
								<div class="error-input-warn"></div>
							</div>
                            <div class="col-input-separator flex-column">
									<label>
										<h5 class="fs-14 bold">Plano <b>VIP</b></h5>
										<h6 class="fs-12">Escolha o tipo de plano que você deseja enviar.</h6>
									</label>
									<select name="plans">
										<option value="15" selected>15 dias</option>
										<option value="30">1 Mes</option>
                                        <option value="60">2 Meses</option>
                                        <option value="90">3 Meses</option>
									</select>
									<div class="error-input-warn"></div>
								</div>
							<div class="col-input-separator flex-column mr-bottom-2">

							</div>
							<button class="green-button-1" type="submit" style="width: 100%;height: 50px">
								<label class="mr-auto color-1">
									<h5 class="fs-14">Pronto</h5>
								</label>
							</button>
						</form>
					</div>
				</div>
			</div>
<?php 
	include('../others/bottom.php');
?>