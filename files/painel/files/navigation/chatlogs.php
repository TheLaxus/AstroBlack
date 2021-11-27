<?php 
	require_once('../others/core.php');

	$Panel::Session('disconnected', $result_panel_user['rank']);

	$page_id = 'logschat';
	$page_name = 'ChatLogs';
	$page_title = 'Painel: ChatLogs - ' . HOTELNAME;

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
						<h2 class="bold">ChatLogs</h2>
					</label>
        </div>
				<div class="content-container">

        <div class="general-white-container">
				<div class="padding-none" id="general-white-card">
        <div class="flex">
            <h4 class="width-content padding-md color-15">ID</h4>
						
						<h4 class="width-content padding-md color-15">Usuário</h4>
						
						<h4 class="width-content padding-md color-15">Comando/Texto</h4>
            <h4 class="width-content padding-md color-15">Quarto executado</h4>
            <h4 class="width-content padding-md color-15">Horário</h4>
          </div>
				    <hr>
                      <?php 
                        $selectLogs = $db->prepare("SELECT * FROM logs ORDER BY id DESC LIMIT 150");
                        $selectLogs->execute();

                        while($resultLogs = $selectLogs->fetch(PDO::FETCH_ASSOC)) {
                      ?>

                      <?php
                        $selectStaff = $db->prepare("SELECT id,username FROM players WHERE id = ?");
                        $selectStaff->bindValue(1, $resultLogs['user_id']);
                        $selectStaff->execute();
                        $fetchStaff = $selectStaff->fetch(PDO::FETCH_ASSOC);
                      ?>

                      <?php 
                        $selectRoomName = $db->prepare("SELECT id,name FROM rooms WHERE id = ?");
                        $selectRoomName->bindValue(1, $resultLogs['room_id']);
                        $selectRoomName->execute();
                        $resultRoomName = $selectRoomName->fetch(PDO::FETCH_ASSOC);
                      ?>
            <div class="flex">
            <h4 class="width-content padding-md color-15" style="background: #e6e6e6;"><?= $resultLogs['id']?></h4>
						<h4 class="width-content padding-md color-5" style="background: #f5f5f5;"><?= $fetchStaff['username'];?></h4>
						<h4 class="width-content padding-md color-15" style="background: #e6e6e6;"><?= $resultLogs['data'];?></h4>
						<h4 class="width-content padding-md color-5" style="background: #f5f5f5;"><?= $resultRoomName['name'];?></h4>
            <h4 class="width-content padding-md color-15" style="background: #e6e6e6;"><?= gmdate('d/m/Y', $resultLogs['timestamp']) . ' às ' . gmdate('H:i:s', $resultLogs['timestamp']);?></h4>
          </div>
				    <hr>
              <?php } ?>
					</div>
				</div>
			</div>
<?php 
	include('../others/bottom.php');
?>
