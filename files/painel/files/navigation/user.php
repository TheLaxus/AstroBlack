<?php 
	require_once('../others/core.php');

	$Panel::Session('disconnected', $result_panel_user['rank']);

	if ($result_panel_user['rank'] < $ceo) {
		Redirect(URL_PANEL);
	}

	$user = $_GET['user'];

	if (isset($user)) {
		$consult_edit_players = $db->prepare("SELECT * FROM players WHERE username = ?");
		$consult_edit_players->bindValue(1, $user);
		$consult_edit_players->execute();


		if ($consult_edit_players->rowCount() > 0 ) {
			$result_edit_players = $consult_edit_players->fetch(PDO::FETCH_ASSOC);

            if ($result_edit_players['rank'] > $result_panel_user['rank']) {
                Redirect(URL_PANEL);
            }
		} else {
			Redirect(URL_PANEL);
		}
	} else {
		Redirect(URL_PANEL);
	}

	$page_id = 'ceo';
	$page_name = 'info-user';
	$page_title = 'Painel | Editar usuário: ' . $result_edit_players['username'] . ' - ' . HOTELNAME;

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
						<h2 class="bold">Detalhes do usuário: <span><?= $result_edit_players['username']; ?></span></h2>
					</label>
				</div>
				<div class="content-container">
					<div class="general-white-container create-article mr-auto-left-right">
						<form method="POST" class="form-info-user flex-column">
	
						<div class="form-warns"></div>
							<div class="col-input-separator flex-column mr-top-none">
								<label>
									<h5 class="fs-14">ID</h5>
								</label>
                                    <input type="text" name="info-id" value="<?= $result_edit_players['id'];?>" readonly>
                                    <div class="error-input-warn"></div>
							</div>
							<div class="col-input-separator flex-column mr-top-none">
								<label>
									<h5 class="fs-14">Nome do usuário</h5>
								</label>
                                    <input type="text" name="info-username" value="<?= $result_edit_players['username'];?>">
                                    <div class="error-input-warn"></div>
							</div>
                            <div class="col-input-separator flex-column mr-top-none">
								<label>
									<h5 class="fs-14">E-mail</h5>
								</label>
                                    <input type="text" name="info-email" value="<?= $result_edit_players['email'];?>">
                                    <div class="error-input-warn"></div>
							</div>
                            <div class="col-input-separator flex-column mr-top-none">
								<label>
									<h5 class="fs-14">Missão</h5>
								</label>
                                    <input type="text" name="info-motto" value="<?= Functions::Filter('xss', $result_edit_players['motto']);?>">
                                    <div class="error-input-warn"></div>
							</div>
                            <div class="col-input-separator flex-column mr-top-none">
								<label>
									<h5 class="fs-14">Rank</h5>
								</label>
                            <select class="form-control" name="info-rank">
                                <?php
                                $ranks = $db->prepare("SELECT id,name FROM ranks");
                                $ranks->execute();
                                while ($rank = $ranks->fetch(PDO::FETCH_ASSOC)) { ?>
                                <option <?php if ($result_edit_players['rank'] == $rank['id']) { ?>selected <?php } ?>value="<?= $rank['id'] ?>"><?= $rank['name'];?></option>
                                <?php } ?>
                            </select>                                    
                                <div class="error-input-warn"></div>
							</div>
                            <div class="col-input-separator flex-column mr-top-none">
								<label>
									<h5 class="fs-14">Data de registro</h5>
								</label>
                                    <input type="text" name="info-date" value="<?= strftime('%d de %B de %Y às %H:%M', $result_edit_players['reg_date']); ?>" readonly>
                                    <div class="error-input-warn"></div>
							</div>
                            <div class="col-input-separator flex-column mr-top-none">
								<label>
									<h5 class="fs-14">Ultimo acesso</h5>
								</label>
                                    <input type="text" name="info-lastonline" value="<?= strftime('%d de %B de %Y às %H:%M', $result_edit_players['last_online']); ?>" readonly>
                                    <div class="error-input-warn"></div>
							</div>
                            <?php if (in_array(User::userData('username'), $allowed_view_ips)) { ?>
                                <div class="col-input-separator flex-column mr-top-none">
								<label>
									<h5 class="fs-14">IP de registro</h5>
								</label>
                                    <input type="text" name="info-ipreg" value="<?= $result_edit_players['ip_register']; ?>" readonly>
                                    <div class="error-input-warn"></div>
							</div>
                            <div class="col-input-separator flex-column mr-top-none">
								<label>
									<h5 class="fs-14">IP último acesso</h5>
								</label>
                                    <input type="text" name="info-iplast" value="<?= $result_edit_players['ip_current']; ?>" readonly>
                                    <div class="error-input-warn"></div>
							</div>
                            <div class="col-input-separator flex-column mr-top-none">
								<label>
									<h5 class="fs-14">IP último acesso (client)</h5>
								</label>
                                    <input type="text" name="info-lastip" value="<?= $result_edit_players['last_ip']; ?>" readonly>
                                    <div class="error-input-warn"></div>
							</div>
                            <?php } ?>
							<div class="mr-top-2">
								<button class="green-button-1" type="submit" style="width: 100%;height: 50px;">
									<label class="mr-auto color-1">
										<h4 class="uppercase fs-14">Salvar usuário</h4>
									</label>
								</button>
							</div>
						</form>
					</div>
				</div>
			</div>
<?php 
	include('../others/bottom.php');
?>