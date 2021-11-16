<?php 
	require_once('../others/core.php');

	$Panel::Session('disconnected', $result_panel_user['rank']);

	if ($result_panel_user['rank'] < $manager) {
		Redirect(URL_PANEL);
	}


	$page_id = 'giverank';
	$page_name = 'give-rank';
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
						<h2 class="bold">Gerenciar rank</h2>
					</label>
				</div>
				<div class="content-container">
					<div class="general-white-container give-rank mr-auto-left-right">
						<form method="POST" class="form-give-rank flex-column">
                        <input type="hidden" name="order" value="give-rank">

							<div class="form-warns"></div>
							<div class="col-input-separator flex-column mr-top-none">
								<label>
									<h5 class="fs-14">Usuário</h5>
								</label>
								<input type="text" name="user-give-rank" autocomplete="off" >
								<div class="error-input-warn"></div>
							</div>
							<div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">Cargo</h5>
								</label>
								
								<select class="form-control" name="user-rank">
										<option value="Nenhum" selected>Nenhum</option>
										<?php 
											$consultRanks2 = $db->prepare("SELECT * FROM server_permissions_ranks");
											$consultRanks2->execute();
											while($ranks = $consultRanks2->fetch(PDO::FETCH_ASSOC)) {
										?>
											<option id="option" value="<?php echo $ranks['id']; ?>" <?php if (isset($_POST['rank']) && $rank != 'Nenhum' && $rank == '' . $ranks['id'] . '') { ?>selected <?php } ?>><?php echo $ranks['name']; ?></option>

										<?php } ?>
								</select>
								<div class="error-input-warn"></div>
							</div>							
							<div class="col-input-separator flex-column mr-top-none">
								<label>
									<h5 class="fs-14">Defina uma função especifica</h5>
								</label>
								<input type="text" name="function_staff" autocomplete="off" placeholder="(não é obrigatório preencher.)">
								<div class="error-input-warn"></div>
							</div>
							<div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">Ocultar</h5>
								</label>
								
								<select class="form-control" name="occult-rank">
										<option value="0" selected>Não</option>
										<option value="1">Sim</option>
		
								</select>
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