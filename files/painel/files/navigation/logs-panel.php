<?php 
	require_once('../others/core.php');

	$Panel::Session('disconnected', $result_panel_user['rank']);

	if ($result_panel_user['rank'] < $developer) {
		Redirect(URL_PANEL);
	}


	$page_id = 'developer';
    $page_name = 'Logs-Painel';
    $page_title = 'Painel: Logs do Painel - ' . HOTELNAME;

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
						<h2 class="bold">Logs do Painel</h2>
					</label>
				</div>
				<div class="content-container">
					
				<div class="general-white-container">
				<div class="padding-none" id="general-white-card">
				
				<?php 
					$consult_logs_panel = $db->prepare("SELECT * FROM cms_panel_logs ORDER BY id DESC");
					$consult_logs_panel->execute();

                    if ($consult_logs_panel->rowCount() > 0) {
					while ($result_logs_panel = $consult_logs_panel->fetch(PDO::FETCH_ASSOC)) {
				?>
					
						<div class="flex">
						<div class="width-content padding-md color-16 flex">
                        <h4 class="margin-auto-top-bottom">ID</h4>

							<h4 class="margin-auto-left"><?= $result_logs_panel['id'];?></h4>
						</div>
						<h4 class="width-content padding-md color-10" style="background: #ecf0f1; text-align:center;"><?= $result_logs_panel['label']; ?></h4>
					</div>
					<?php }} ?>
					<hr>
						
				</div>
			</div>
		</div>
<?php 
	include('../others/bottom.php');
?>
