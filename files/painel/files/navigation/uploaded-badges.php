<?php 
	require_once('../others/core.php');

	$Panel::Session('disconnected', $result_panel_user['rank']);

	if ($result_panel_user['rank'] < $administrator) {
		Redirect(URL_PANEL);
	}

	$page_id = 'adm';
	$page_name = 'HospEmblemas';
	$page_title = 'Painel: Emblemas hospedados - ' . HOTELNAME;

	include('../others/head.php');
?>
<?php 
	include('../others/sidebar.php');
?>
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
						<h2 class="bold">Emblemas hospedados</h2>
					</label>
				</div>
				<div class="content-container">
                <div class="general-white-container create-article mr-auto-left-right">
							<div class="col-input-separator flex-column">
                                <table class="table table-responsive-sm table-bordered table-striped table-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">Código</th>
                                            <th scope="col">Imagem</th>
                                            <th scope="col">Título</th>
                                            <th scope="col">Descrição</th>
                                        </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $badges = array_reverse(Functions::getUploadedBadges());

                                    foreach ($badges as $badge) {
                                    ?>
                                        <tr>
                                            <td><?= $badge['code'] ?></td>
                                            <td><img src="<?= $badge['link'] ?>" style="max-width: 60px!important"></td>
                                            <td><?= $badge['name'] ?></td>
                                            <td><?= $badge['desc'] ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
							</div>
							<div class="col-input-separator flex-column mr-bottom-2"></div>
					</div>
				</div>
			</div>
<?php 
	include('../others/bottom.php');
?>