<?php 
	require_once('../others/core.php');

	$Panel::Session('disconnected', $result_panel_user['rank']);

    if ($result_panel_user['rank'] < $manager) {
		Redirect(URL_PANEL);
	}

	if (isset($_GET['user'])) {
        $user_result = $db->prepare("SELECT id, username, ip_register, ip_current, last_ip FROM players WHERE username = ?");
        $user_result->bindValue(1, $_GET['user']);
        $user_result->execute();
      	
      	$user_result = $user_result->rowCount() > 0 ? $user_result->fetch() : null;
      	
      	if ($user_result == null) {
          	echo '<script>alert("Usuário não encontrado.")</script>';
        }
    }

	$page_id = 'view-fakes';
	$page_name = 'viewfakes';
	$page_title = 'Painel: Contas Fakes - ' . HOTELNAME;

	include('../others/head.php');
?>
<?php 
	include('../others/sidebar.php');
?>
                <?php if(!isset($_GET['user'])) { ?>

			<div class="content flex-column">
				<div class="header-content flex">
					<div class="sideBar-controller">
						<span></span>
						<span></span>
						<span></span>
					</div>
					<label class="mr-auto-top-bottom">
						<h2 class="bold">Visualizar contas fakes de um usuário</h2>
					</label>
				</div>
				<div class="content-container">
					<div class="general-white-container create-article mr-auto-left-right">
						<form method="POST" class="form-view-fakes flex-column">

							<div class="form-warns"></div>
							<div class="col-input-separator flex-column mr-top-none">
								<label>
									<h5 class="fs-14">Usuário</h5>
								</label>
								<input type="text" name="username" placeholder="Digite aqui o usuário que deseja ver as fakes" autocomplete="off" >
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
            <?php } ?>
            
            <?php if (isset($_GET['user'])) { ?>
                <style>
                    td{
                        text-align: center;
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
						<h2 class="bold">Contas encontradas</h2>
					</label>
				</div>
				<div class="content-container">
                <div class="general-white-container create-article mr-auto-left-right">
							<div class="col-input-separator flex-column">
                                <table class="table table-responsive-sm table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">Usuário</th>
                                            <th scope="col">Membro desde</th>
                                            <th scope="col">Último login</th>
                                        </tr>
                                </thead>
                                <tbody>
                                <?php
                                                    $getClones = $db->prepare("SELECT id, reg_date, ip_current, last_ip, username, reg_timestamp, last_online FROM players WHERE 
																			(reg_date = :ip_reg OR
																			reg_date = :ip_last
                                                                             OR
                                                                             reg_date = :last_ip OR

																			ip_current = :ip_reg2 OR
																			ip_current = :ip_last2 OR
																			ip_current = :last_ip2 OR

																			last_ip = :ip_reg3 OR
																			last_ip = :ip_last3 OR
																			last_ip = :last_ip3) AND username != :username");
                                                    $getClones->bindParam(':username', $user_result['username']);
                                                    $getClones->bindParam(':ip_reg', $user_result['ip_reg']);
                                                    $getClones->bindParam(':ip_reg2', $user_result['ip_reg']);
                                                    $getClones->bindParam(':ip_reg3', $user_result['ip_reg']);
                                                    $getClones->bindParam(':ip_last', $user_result['ip_last']);
                                                    $getClones->bindParam(':ip_last2', $user_result['ip_last']);
                                                    $getClones->bindParam(':ip_last3', $user_result['ip_last']);
                                                    $getClones->bindParam(':last_ip', $user_result['last_ip']);
                                                    $getClones->bindParam(':last_ip2', $user_result['last_ip']);
                                                    $getClones->bindParam(':last_ip3', $user_result['last_ip']);
                                                    $getClones->execute();

                                                    while ($clone = $getClones->fetch()) {
                                                        echo '<tr>
                                                    	<td>' . $clone['username'] . '</td>
                                                    	<td>' . date('d/m/Y H:i', $clone['reg_date']) . '</td>
                                                    	<td>' . (User::settingsById('hide_last_online', $clone['id']) == '0' ? date('d/m/Y H:i', $clone['last_online']) : '--/--/----') . '</td>
                                                      </tr>';
                                                    }
                                                    ?>
                                </tbody>
							</div>
							<div class="col-input-separator flex-column mr-bottom-2"></div>
					</div>
				</div>
			</div>
            <?php } ?>
<?php 
	include('../others/bottom.php');
?>