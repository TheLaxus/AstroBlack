<?php 
	require_once('../others/core.php');

	$Panel::Session('disconnected', $result_panel_user['rank']);

	if ($result_panel_user['rank'] < $administrator) {
		Redirect(URL_PANEL);
	}

	$page_id = 'administrator';
	$page_name = 'Host-Badge';
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
					<div class="general-white-container host-badge mr-auto-left-right">
						<form method="POST" class="form-host-badge flex-column">
							<input type="hidden" name="order" value="host-badge">
							<div class="form-warns"></div>
							<div class="col-input-separator flex-column mr-top-none">
								<label>
									<h5 class="fs-14">Título do emblema</h5>
								</label>
								<input type="text" name="badge-title">
								<div class="error-input-warn"></div>
							</div>
							<div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">Descrição do emblema</h5>
								</label>
								<input type="text" name="badge-description">
								<div class="error-input-warn"></div>
							</div>
							<div class="col-input-separator flex-column mr-bottom-2">
								<label>
									<h5 class="fs-14">Emblema</h5>
								</label>
								<input type="file" name="badge-file" id="badge-file">
								<div class="error-input-warn"></div>
							</div>
							<button class="green-button-1" type="submit" style="width: 100%;height: 50px">
								<label class="mr-auto color-1">
									<h5 class="fs-14">Hospedar emblema</h5>
								</label>
							</button>
						</form>
					</div>
				</div>
			</div>
<?php 
	include('../others/bottom.php');
?>