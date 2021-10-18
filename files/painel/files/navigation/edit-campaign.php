<?php 
	require_once('../others/core.php');

	$Panel::Session('disconnected', $result_panel_user['rank']);

	if ($result_panel_user['rank'] < $administrator) {
		Redirect(URL_PANEL);
	}

	$article_id = $_GET['article_id'];

	if (isset($article_id) && is_numeric($article_id)) {
		$consult_edit_article = $db->prepare("SELECT * FROM cms_news WHERE id = ? LIMIT 1");
		$consult_edit_article->bindValue(1, $article_id);
		$consult_edit_article->execute();

        $consult_edit_campaign = $db->prepare("SELECT * FROM cms_weekly_columns WHERE news_id = ? LIMIT 1");
		$consult_edit_campaign->bindValue(1, $article_id);
		$consult_edit_campaign->execute();


		if ($consult_edit_article->rowCount() > 0 || $consult_edit_campaign->rowCount() > 0) {
			$result_edit_article = $consult_edit_article->fetch(PDO::FETCH_ASSOC);
            $result_edit_campaign = $consult_edit_campaign->fetch(PDO::FETCH_ASSOC);

			if ($result_panel_user['rank'] < $administrator || $result_panel_user['id'] != $result_edit_article['author']) {
				Redirect(URL_PANEL);
			}
		} else {
			Redirect(URL_PANEL);
		}
	} else {
		Redirect(URL_PANEL);
	}

	$page_id = 'administrator';
	$page_name = 'Article/Edit';
	$page_title = 'Painel | Editar noticia: ' . $result_edit_article['title'] . ' - ' . HOTELNAME;

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
						<h2 class="bold">Editar campanha: <span><?= $result_edit_article['title']; ?></span></h2>
					</label>
				</div>
				<div class="content-container">
					<div class="general-white-container create-article mr-auto-left-right">
						<form method="POST" class="form-edit-campaign flex-column" data-article-id="<?= $result_edit_article['id']; ?>">
	
						<div class="form-warns"></div>
							<div class="col-input-separator flex-column mr-top-none">
								<label>
									<h5 class="fs-14">Título da Campanha</h5>
								</label>
                                <?php if ($consult_edit_campaign->rowCount() > 0) { ?>
                                    <input type="text" name="title-campaign" value="<?= $result_edit_campaign['title'];?>" placeholder="Titulo que irá aparecer na /me">
                                <?php } else { ?>
                                    <input type="text" name="title-campaign" value="" placeholder="Titulo que irá aparecer na /me">
                                    <?php } ?>
                                    <div class="error-input-warn"></div>
							</div>
							<div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">Descrição da Campanha</h5>
								</label>
                                <?php if ($consult_edit_campaign->rowCount() > 0) { ?>
                                    <input type="text" name="description-campaign" value="<?= $result_edit_campaign['description'];?>" placeholder="Descrição que irá aparecer na /me">
                                    <?php } else { ?>
                                    <input type="text" name="description-campaign" placeholder="Descrição que irá aparecer na /me">
                                    <?php } ?>
								<div class="error-input-warn"></div>
							</div>
							<div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">Thumbnail da Campanha</h5>
								</label>
                                <?php if ($consult_edit_campaign->rowCount() > 0) { ?>
                                    <input type="text" name="thumbnail-campaign" value="<?= $result_edit_campaign['image'];?>" placeholder="Thumbnail que irá aparecer na /me (Máximo 166x66)">
                                <?php } else { ?>
								    <input type="text" name="thumbnail-campaign" placeholder="Thumbnail que irá aparecer na /me (Máximo 166x66)">
								<?php } ?>
                                    <div class="error-input-warn"></div>
							</div>
                            <div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">ID da Noticia:</h5>
								</label>
                                <?php if ($consult_edit_campaign->rowCount() > 0) { ?>
                                    <input type="number" name="id-campaign" value="<?= $result_edit_article['id'];?>" placeholder="Insira o id da sua notícia">
                                <?php } else { ?>
								    <input type="number" name="id-campaign" placeholder="Insira o id da sua notícia">
								<?php } ?>
                                    <div class="error-input-warn"></div>
							</div>
                            <div class="col-input-separator flex-column">
								<label>
									<h5 class="fs-14">Ativar campanha?</h5>
								</label>
								
                                <select class="form-control" name="activeCampaign" required>
									<option value="0" <?php if ($result_edit_article['active_campaign'] == '0') { ?> selected<?php } ?>>Não</option>
									<option value="1" <?php if ($result_edit_article['active_campaign'] == '1') { ?> selected<?php } ?>>Sim</option>
                                </select>
								<div class="error-input-warn"></div>
							</div>
							<div class="mr-top-2">
								<button class="green-button-1" type="submit" style="width: 100%;height: 50px;">
									<label class="mr-auto color-1">
										<h4 class="uppercase fs-14">Salvar campanha</h4>
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