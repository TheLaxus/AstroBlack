<?php 
	require_once('../others/core.php');

	$Panel::Session('disconnected', $result_panel_user['rank']);

	$page_id = 'logs_changenick';
	$page_name = 'LogsChangeNick';
	$page_title = 'Painel: Mudança de Nomes Logs - ' . HOTELNAME;

	include('../others/head.php');
?>
<?php 
	include('../others/sidebar.php');
?>
<style>
table, th, td {
  border: 1px solid #c3c3c3;
  border-collapse: collapse;
}
td, th {
  padding:4px;
}
th {
  text-align: left;
}

</style>
			<div class="content flex-column">
				<div class="header-content flex">
					<div class="sideBar-controller">
						<span></span>
						<span></span>
						<span></span>
					</div>
					<label class="mr-auto-top-bottom">
						<h2 class="bold">Logs Mudança de Nomes</h2>
					</label>
        </div>
				<div class="content-container">
					<div class="general-white-container host-badge mr-auto-left-right" style="max-width: 1000px;">
                    <table style="width:100%">
                      <tr>
                        <th>ID</th>
                        <th>ID do Usuário</th>
                        <th>Nome Antigo</th>
                        <th>Novo Nome</th>
                        <th>Data</th>
                      </tr>
                      <!-- linha tabela -->
                      <?php
                          $selectLogsNick = $db->prepare("SELECT * FROM namechange_log ORDER BY id");
                          $selectLogsNick->execute();

                          while($resultLogsNick = $selectLogsNick->fetch(PDO::FETCH_ASSOC)) {
                      ?>
                      <tr>
                        <td><?= $resultLogsNick['user_id'];?></td>
                        <td><?= $resultLogsNick['old_name'];?></td>
                        <td><?= $resultLogsNick['new_name'];?></td>
                        <td><?= gmdate('Y/m/d', $resultLogsNick['timestamp']) . ' às ' . gmdate('H:i:s', $resultLogsNick['timestamp'])?></td>
                      </tr>
                      <?php } ?>
                    </table>
					</div>
				</div>
			</div>
<?php 
	include('../others/bottom.php');
?>