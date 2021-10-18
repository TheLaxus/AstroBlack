<?php 
	require_once('../others/core.php');

	$Panel::Session('disconnected', $result_panel_user['rank']);

	if ($result_panel_user['rank'] < $administrator) {
		Redirect(URL_PANEL);
	}

	$article_id = $_GET['article_id'];

	if (isset($article_id) && is_numeric($article_id)) {
		$consult_article_forms = $db->prepare("SELECT * FROM cms_post_forms WHERE post_id = ? LIMIT 1");
		$consult_article_forms->bindValue(1, $article_id);
		$consult_article_forms->execute();

	
		if ($consult_article_forms->rowCount() > 0) {
			$result_article_forms = $consult_article_forms->fetch(PDO::FETCH_ASSOC);

			$get_author_article = $db->prepare("SELECT title, author FROM cms_news WHERE id = ?");
			$get_author_article->bindValue(1, $result_article_forms['post_id']);
			$get_author_article->execute();

			if ($get_author_article->rowCount() > 0) {
				$result_author = $get_author_article->fetch(PDO::FETCH_ASSOC);

				if ($result_panel_user['rank'] < $administrator || $result_panel_user['id'] != $result_author['author']) {
					Redirect(URL_PANEL);
				}
			}
	
		} else {
			Redirect(URL_PANEL);
		}
	} else {
		Redirect(URL_PANEL);
	} 

	$page_id = 'administrator';
	if ($username == $result_panel_user['username']) {
		$page_name = 'My-Articles';
		$page_title = 'Painel: Formulários - ' . HOTELNAME;
	} else {
		$page_name = 'User-Articles';
		$page_title = 'Painel | Noticias - Formulários: ' . $username . ' - ' . HOTELNAME;
	}

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
						<h2 class="bold">Formulários - <?= $result_author['title'];?></h2>
					</label>
				</div>
				<div class="content-container">
					
				<div class="general-white-container">
				<div class="padding-none" id="general-white-card">
				
				<?php 
					$select_answer_forms = $db->prepare("SELECT * FROM cms_post_forms WHERE post_id = ? ORDER BY timestamp DESC");
					$select_answer_forms->bindValue(1, $article_id);
					$select_answer_forms->execute();

					while ($result_answer_forms = $select_answer_forms->fetch(PDO::FETCH_ASSOC)) {
				?>

				<?php 
					$get_article_info = $db->prepare("SELECT title, author FROM cms_news WHERE id = ?");
					$get_article_info->bindValue(1, $result_answer_forms['post_id']);
					$get_article_info->execute();



					if ($get_article_info->rowCount() > 0) {
						
						while ($result_article_info = $get_article_info->fetch(PDO::FETCH_ASSOC)) {
							$get_author_name = $db->prepare("SELECT username FROM players WHERE id = ?");
							$get_author_name->bindValue(1, $result_answer_forms['user_id']);
							$get_author_name->execute();
							$result_name = $get_author_name->fetch(PDO::FETCH_ASSOC);
				?>
					
						<div class="flex">
						<div class="width-content padding-md color-16 flex">
							<h4><?= $result_article_info['title'];?></h4>
							<h6 class="margin-auto-left margin-auto-top-bottom">Enviado por: <?= $result_name['username'];?></h6>
						</div>
						<h4 class="width-content padding-md color-10" style="background: #ecf0f1; text-align:center;"><?= $result_answer_forms['label']; ?></h4>
						
						<div class="width-content padding-md color-16 flex">
							<h4><?= strftime('%d de %B de %Y às %H:%M', $result_answer_forms['timestamp']); ?></h4>
						</div>
					</div>
					<?php } ?>
					<?php }} ?>
					<hr>
						
				</div>
			</div>
		</div>
<?php 
	include('../others/bottom.php');
?>
