<?php 
	require_once('../others/core.php');

	$Panel::Session('disconnected', $result_panel_user['rank']);

	$page_id = 'searchuser';
	$page_name = 'search-user';
	$page_title = 'Painel: Gerenciar rank - ' . HOTELNAME;

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
						<h2 class="bold">Procurar usuário</h2>
					</label>
				</div>
				<div class="content-container">
					<div class="general-white-container create-article mr-auto-left-right">
						<form method="POST" class="form-search-user flex-column">
                        <input type="hidden" name="order" value="edit-user">

							<div class="form-warns"></div>
							<div class="col-input-separator flex-column mr-top-none">
								<label>
									<h5 class="fs-14">Usuário</h5>
								</label>
								<input type="text" name="username" placeholder="Digite aqui o usuário que queira editar" autocomplete="off" >
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