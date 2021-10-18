<?php 
	require_once('../others/core.php');

	$Panel::Session('disconnected', $result_panel_user['rank']);

    if ($result_panel_user['rank'] < $manager) {
		Redirect(URL_PANEL);
	}
		
	$page_id = 'addpin';
	$page_name = 'Add-Pin';
	$page_title = 'Painel: Gerenciar pin - ' . HOTELNAME;

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
						<h2 class="bold">Gerenciar pin</h2>
					</label>
				</div>
				<div class="content-container">
					<div class="general-white-container add-pin mr-auto-left-right">
						<form method="POST" class="form-addpin">
                            <input type="hidden" name="order" value="add-pin">

							<div class="form-warns"></div>
							<div class="col-input-separator flex-column mr-top-none">
								<label>
									<h5 class="fs-14">Usuário</h5>
								</label>
								<input type="text" name="user-give-pin" autocomplete="off" placeholder="Nick do usuário que irá receber o pin">
								<div class="error-input-warn"></div>
							</div>
							<div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">Pin</h5>
								</label>
								<input type="text" name="user-pin" autocomplete="off" placeholder="Pin do usuário">
								<div class="error-input-warn"></div>
							</div>
							<div class="col-input-separator flex-column mr-bottom-2">

							</div>
							<button class="green-button-1" type="submit" name="pin" style="width: 100%;height: 50px">
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