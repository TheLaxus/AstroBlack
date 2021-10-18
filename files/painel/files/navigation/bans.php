<?php 
	require_once('../others/core.php');

	$Panel::Session('disconnected', $result_panel_user['rank']);

	$page_id = 'baniments';
	$page_name = 'Bans';
	$page_title = 'Painel: Banimentos - ' . HOTELNAME;

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
						<h2 class="bold">Banimentos</h2>
					</label>
        </div>
				<div class="content-container">
					<div class="general-white-container host-badge mr-auto-left-right" style="max-width: 1000px;">
                    <table style="width:100%">
                      <tr>
                        <th>ID</th>
                        <th>Tipo Ban</th>
                        <th>User/IP/Máquina</th>
                        <th>Banido por</th>
                        <th>Motivo</th>
                        <th>Expira em</th>
                        <th>Ações</th>
                      </tr>
                      <!-- linha tabela -->
                  <?php
                    $selectedBans = $db->prepare("SELECT * FROM bans ORDER BY id DESC");
                    $selectedBans->execute();
                    
                    while($resultBans = $selectedBans->fetch(PDO::FETCH_ASSOC)) {
                  ?>
                  <?php
                    $data = $resultBans['data'];
                    if($resultBans['type'] == 'user') {
                      $data = $db->prepare("SELECT username FROM players WHERE id = ?");
                      $data->bindValue(1, $resultBans['data']);
                      $data->execute();
                      $data = $data->fetch()['username'];
                    }

                  ?>
                    <?php
                        $reason = $resultBans['reason'] != '' ? $resultBans['reason'] : '<i>Não especificado</i>'
                    ?>

                    <?php
                      $selectStaff = $db->prepare("SELECT id,username FROM players WHERE id = ?");
                      $selectStaff->bindValue(1, $resultBans['added_by']);
                      $selectStaff->execute();
                      $fetchStaff = $selectStaff->fetch(PDO::FETCH_ASSOC);
                    ?>
                      <tr>
                        <td><?= $resultBans['id'];?></td>
                        <td><?= $resultBans['type'];?></td>
                        <td><?= $data;?></td>
                        <td><?= $fetchStaff['username'];?></td>
                        <td><?= $reason;?></td>
                        <td><?=$resultBans['expire'] == 0 ? 'Nunca' : gmdate('d/m/Y', $resultBans['expire']) . ' às ' . gmdate('H:i:s', $resultBans['expire']);?></td>

                        <?php if($user['rank'] >= 9) {?>
                        <td><a href="javascript:void(0)" title="Apagar este banimento" onclick="deleteBan(<?= $resultBans['id'];?>)">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="float: right;margin-top: 4px;color: red;margin-right: 25px;">
											  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
											  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
											  </svg>
                        </a>
                        <?php } ?>
                        </td>
                      </tr>
                    <?php } ?>
                    </table>
					</div>
				</div>
			</div>
<?php 
	include('../others/bottom.php');
?>