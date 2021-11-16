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

	if ($consult_edit_article->rowCount() > 0) {
		$result_edit_article = $consult_edit_article->fetch(PDO::FETCH_ASSOC);

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
			<h2 class="bold">Editar noticia: <span><?= $result_edit_article['title']; ?></span></h2>
		</label>
	</div>
	<div class="content-container">
		<div class="general-white-container create-article mr-auto-left-right">
			<form method="POST" class="form-edit-article flex-column" data-article-id="<?= $result_edit_article['id']; ?>">
				<div class="form-warns"></div>
				<div class="col-input-separator flex-column mr-top-none">
					<label>
						<h5 class="fs-14">Título da Noticia</h5>
					</label>
					<input type="text" name="title" value="<?= $result_edit_article['title']; ?>">
					<div class="error-input-warn"></div>
				</div>
				<div class="col-input-separator flex-column">
					<label>
						<h5 class="fs-14">Subtítulo da Noticia</h5>
					</label>
					<input type="text" name="subtitle" value="<?= $result_edit_article['subtitle']; ?>">
					<div class="error-input-warn"></div>
				</div>
				<div class="col-input-separator flex-column">
					<label>
						<h5 class="fs-14">URL da thumbnail da noticia</h5>
					</label>
					<input type="text" name="thumbnail" value="<?= $result_edit_article['image']; ?>">
					<div class="error-input-warn"></div>
				</div>
				<div class="col-input-separator flex-column">
					<label>
						<h5 class="fs-14">Categoria da Noticia</h5>
					</label>
					<select name="category" data-category="<?= $result_edit_article['category']; ?>">
						<option value="Nenhuma" disabled="disabled" <?php if (empty($result_edit_article['category'])) { ?> selected="selected" <?php } ?>>Escolha uma categoria</option>
						<?php
						$consult_categories = $db->prepare("SHOW COLUMNS FROM cms_news LIKE 'category'");
						$consult_categories->execute();

						if ($consult_categories) {
							$result_categories = $consult_categories->fetchAll();
							$categories_type = $result_categories[0]['Type'];

							$categories_a = preg_replace("/(enum|set)\('(.+?)'\)/", "\\2", $categories_type);
							$categories_b = explode("','", $categories_a);

							for ($i = 0; $i < count($categories_b); $i++) {
						?>
								<option value="<?= $categories_b[$i]; ?>"><?= $categories_b[$i]; ?></option>
						<?php
							}
						}
						?>
					</select>
					<div class="error-input-warn"></div>
				</div>
				<div class="col-input-separator flex-column">
					<label>
						<h5 class="fs-14">Corpo na notícia</h5>
					</label>
					<div class="article-create-textarea">
						<textarea name="body" style="display: none;"><?= $result_edit_article['body']; ?></textarea>
						<script>
							CKEDITOR.replace('body');
						</script>
					</div>
					<div class="error-input-warn"></div>
				</div>
				<div class="another-options flex-column mr-top-3 flex-column">
					<label class="color-4">
						<h4 class="bold uppercase">Outras opções</h4>
					</label>
					<div class="promotions-date-expire flex-column mr-top-2" <?php if ($result_edit_article['category'] != 'Promoções') { ?>style="display: none;" <?php } ?>>
						<div class="flex">
							<div class="col-input-separator flex-column mr-top-none width-content mr-right-2">
								<label>
									<h5 class="fs-14">Data de expiração</h5>
								</label>
								<input type="text" name="date-expire" data-toggle="datepicker" placeholder="DD/MM/AAAA" class="expiretime" <?php if ($result_edit_article['category'] == 'Promoções') { ?>value="<?= date('d/m/Y', $result_edit_article['timestamp_expire']); ?>" <?php } ?>>
							</div>
							<div class="col-input-separator flex-column mr-top-none width-content">
								<label>
									<h5 class="fs-14">Hora de expiração</h5>
								</label>
								<input type="text" name="hour-expire" placeholder="HH:MM" class="expiretime" <?php if ($result_edit_article['category'] == 'Promoções') { ?>value="<?= date('H:i', $result_edit_article['timestamp_expire']); ?>" <?php } ?>>
							</div>
							<div class="col-input-separator flex-column mr-top-none width-content mr-right-2">
								<label>
									<h5 class="fs-14 bold">Usar emblema</h5>
								</label>
								<select name="use_badge">
									<option value="0" <?php if ($result_edit_article['use_badge'] == '0') { ?> selected<?php } ?>>Não</option>
									<option value="1" <?php if ($result_edit_article['use_badge'] == '1') { ?> selected<?php } ?>>Sim</option>
								</select>
								<div class="error-input-warn"></div>
							</div>
						</div>
						<div class="error-input-warn"></div>
						<div class="badge-code-promo flex-column mr-top-2" style="display: none;">
							<div class="flex">
								<div class="col-input-separator flex-column mr-top-none width-content mr-right-2">
									<label>
										<h5 class="fs-14">Código do emblema (SEM .GIF)</h5>
									</label>
									<input type="text" name="badgeCod" placeholder="Exemplo: LAXUS123" class="expiretime">
								</div>
							</div>
							<div class="error-input-warn"></div>
						</div>
						<div class="col-input-separator flex-column">
									<label>
										<h5 class="fs-14 bold">Formulário</h5>
										<h6 class="fs-12">Deseja ativar o formulário para esta notícia?.</h6>
									</label>
									<select name="form">
										<option value="0" <?php if ($result_edit_article['form'] == '0') { ?> selected<?php } ?>>Não</option>
										<option value="1" <?php if ($result_edit_article['form'] == '1') { ?> selected<?php } ?>>Sim</option>
									</select>
									<div class="error-input-warn"></div>
								</div>
					</div>
					<div class="col-input-separator flex-column">
						<label>
							<h5 class="fs-14 bold">Rascunho</h5>
							<h6 class="fs-12">Sua noticia é apenas um rascunho ou um teste? Agora você pode fazer isso! Escolha abaixo se é ou não uma noticia rascunho.</h6>
						</label>
						<select name="draft">
							<option value="0" <?php if ($result_edit_article['is_draft'] == '0') { ?> selected<?php } ?>>Não</option>
							<option value="1" <?php if ($result_edit_article['is_draft'] == '1') { ?> selected<?php } ?>>Sim</option>
						</select>
						<div class="error-input-warn"></div>
					</div>


				</div>
				<div class="mr-top-2">
					<button class="green-button-1" type="submit" style="width: 100%;height: 50px;">
						<label class="mr-auto color-1">
							<h4 class="uppercase fs-14">Editar noticia</h4>
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