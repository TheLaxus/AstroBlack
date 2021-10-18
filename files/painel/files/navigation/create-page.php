<?php 
	require_once('../others/core.php');

	$Panel::Session('disconnected', $result_panel_user['rank']);

	if ($result_panel_user['rank'] < $manager) {
		Redirect(URL_PANEL);
	}

	$page_id = 'ger';
    $page_name = 'CreatePage';
    $page_title = 'Painel: Criar Página - ' . HOTELNAME;
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
						<h2 class="bold">Adicionar página no catálogo (aba "New")</h2>
					</label>
				</div>
				<div class="content-container">
                <div class="general-white-container create-page mr-auto-left-right">
						<form method="POST" class="form-create-page flex-column">
							<input type="hidden" name="order" value="create-page">
							<div class="form-warns"></div>
							<div class="col-input-separator flex-column mr-top-none">
								<label>
									<h5 class="fs-14">Nome da página</h5>
								</label>
								<input type="text" name="titlePage" placeholder="Exemplo: Mobis 2021">
								<div class="error-input-warn"></div>
							</div>
                            <div class="col-input-separator flex-column mr-top-none">
								<label>
									<h5 class="fs-14">Link da página</h5>
								</label>
								<input type="text" name="linkPage" placeholder="Exemplo: batatafrita">
								<div class="error-input-warn"></div>
							</div>
							<button class="green-button-1" type="submit" style="width: 100%;height: 50px">
								<label class="mr-auto color-1">
									<h5 class="fs-14">Criar Página</h5>
								</label>
							</button>
						</form>
					</div>
				</div>
		</header>
        <div class="content-container">
					<div class="general-white-container host-badge mr-auto-left-right">
                    <label class="mr-auto-top-bottom">
						<h4 class="bold">Paginas já existentes:</h4>
					</label>
                    <table style="width:100%">
                      <tr>
                        <td><b>ID</b></td>
                        <td><b>Título da Página</b></td>
                        <td><b>Ações</b></td>
                      </tr>
                      <!-- linha tabela -->
                      <tbody>
								<?php
									$categorias = $db->prepare('SELECT id, caption FROM catalog_pages WHERE parent_id = 423423581 AND enabled = \'1\' ORDER BY caption');
									$categorias->execute();
									while($cat = $categorias->fetch()) { ?>
										<tr>
											<td><?= $cat['id'] ?></td>
											<td><?= $cat['caption'] ?></td>
											<td><a href="create-page/delete/<?= $cat['id'];?>" title="Apagar esta página">
                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-trash" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="float: right;margin-top: 4px;color: red;margin-right: 20px; right: 21px;">
											  <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"></path>
											  <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4L4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"></path>
											  </svg>
                        </a>
										</tr>
                      <?php } ?>
                    </table>
					</div>
				</div>
            <?php 
	            include('../others/bottom.php');
            ?>