<?php
	require_once('../others/core.php');

	$Panel::Session('connected');

	if ($user['rank'] < 5) {
		Redirect(URL);
	}

	$page_id = 'index';
	$page_name = 'Index';
	$page_title = 'Painel: Faça seu login - ' . HOTELNAME;

	include('../others/head.php');
?>
			<div class="col-1 mr-auto">
				<div class="general-box login-area flex-column">
					<div class="logo"></div>
					<label class="color-5 flex-column mr-bottom-3 pd-1">
						<h5 class="mr-bottom-2 text-center">O seu pin é muito importante para que ninguém possa invadir o seu acesso ao painel, você nunca deve passar seu pin para nenhum usuário ou membros da equipe!</h5>
						<h6>Caso você o perca, contate a um membro <b>desenvolvedor</b> para que o seu pin possa ser recuperado!</h6>
					</label>
					<form method="POST" class="form-login-panel">
						<div class="flex-column mr-bottom-2">
							<label class="color-5 mr-bottom-1">
								<h5 class="bold">Pin:</h5>
							</label>
							<input type="password" name="pin" placeholder="Insira seu pin...">
						</div>
						<button class="green-button-1 login-panel" type="submit" style="width: 100%;height: 45px;">
							<label class="mr-auto color-1">
								<h5 class="fs-14 uppercase bold">Login</h5>
							</label>
						</button>
					</form>
				</div>
			</div>
<?php 
	include('../others/bottom.php');
?>