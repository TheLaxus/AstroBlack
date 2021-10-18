<?php 
	require_once('../others/core.php');

	$Panel::Session('disconnected', $result_panel_user['rank']);

	if ($result_panel_user['rank'] < $ceo) {
		Redirect(URL_PANEL);
	}


	$page_id = 'ceo';
    $page_name = 'Logs-Nicknames';
    $page_title = 'Painel: Lgo Troca de nicks - ' . HOTELNAME;

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
						<h2 class="bold">Logs de mudança de nickname</h2>
					</label>
				</div>
				<div class="content-container">
					
				<div class="general-white-container">
				<div class="padding-none" id="general-white-card">
				
                <?php
                          $selectLogsNick = $db->prepare("SELECT * FROM logs_namechange ORDER BY timestamp DESC");
                          $selectLogsNick->execute();

                          if ($selectLogsNick->rowCount() > 0) {
                          while($resultLogsNick = $selectLogsNick->fetch(PDO::FETCH_ASSOC)) {
                      ?>
					
						<div class="flex">
						<div class="width-content padding-md color-16 flex">
                        <h4 class="margin-auto-top-bottom">USER ID</h4>
						</div>
						<h4 class="width-content padding-md color-10" style="background: #ecf0f1; text-align:center;"><?= $resultLogsNick['user_id'];?></h4>
                        <div class="width-content padding-md color-16 flex">
                        <h4 class="margin-auto-top-bottom">Nick antigo</h4>
						</div>
                        <h4 class="width-content padding-md color-10" style="background: #ecf0f1; text-align:center;"><?= $resultLogsNick['old_name'];?></h4>
                        <div class="width-content padding-md color-16 flex">
                        <h4 class="margin-auto-top-bottom">Nick novo</h4>
						</div>
                        <h4 class="width-content padding-md color-10" style="background: #ecf0f1; text-align:center;"><?= $resultLogsNick['new_name'];?></h4>
                        <div class="width-content padding-md color-16 flex">
                        <h4 class="margin-auto-top-bottom">Data</h4>
						</div>
                        <h4 class="width-content padding-md color-10" style="background: #ecf0f1; text-align:center;"><?= strftime('%d de %B de %Y às %H:%M', $resultLogsNick['timestamp']); ?></h4>

                    </div>
					<?php }} ?>
					<hr>
						
				</div>
			</div>
		</div>
<?php 
	include('../others/bottom.php');
?>
