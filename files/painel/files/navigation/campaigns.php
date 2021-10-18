<?php 
	require_once('../others/core.php');

	$Panel::Session('disconnected', $result_panel_user['rank']);

	if ($result_panel_user['rank'] < $administrator) {
		Redirect(URL_PANEL);
	}

    $username = $_GET['user'];

	if (isset($username)) {
		$consult_articles_by_name = $db->prepare("SELECT id FROM players WHERE username = ? LIMIT 1");
		$consult_articles_by_name->bindValue(1, $username);
		$consult_articles_by_name->execute();

		if ($consult_articles_by_name->rowCount() > 0) {
			$result_articles_by_name = $consult_articles_by_name->fetch(PDO::FETCH_ASSOC);

			$consult_my_articles = $db->prepare("SELECT * FROM cms_news WHERE author = ? AND category = ?");
			$consult_my_articles->bindValue(1, $result_articles_by_name['id']);
            $consult_my_articles->bindValue(2, 'Campanhas');
			$consult_my_articles->execute();
		} else {
			Redirect(URL_PANEL);
		}
	} else {
		Redirect(URL_PANEL);
	}

	$page_id = 'administrator';
	$page_name = 'Create-Campaign';
	$page_title = 'Painel: Criar campanha - ' . HOTELNAME;

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
						<h2 class="bold">Minhas campanhas</h2>
					</label>
				</div>
                <div class="content-container">
					<div class="card-columns my-articles <?php if ($consult_my_articles->rowCount() == 0) { ?>flex<?php } ?>">
					<?php
						if ($consult_my_articles->rowCount() > 0) {
							while ($result_my_articles = $consult_my_articles->fetch(PDO::FETCH_ASSOC)) {
								$consult_article_likes = $db->prepare("SELECT * FROM cms_post_reaction WHERE post_id = ? AND type = ?");
								$consult_article_likes->bindValue(1, $result_my_articles['id']);
								$consult_article_likes->bindValue(2, 'article');
								$consult_article_likes->execute();

                                $consult_articles_views = $db->prepare("SELECT * FROM cms_post_views WHERE post_id = ?");
                                $consult_articles_views->bindValue(1, $result_my_articles['id']);
                                $consult_articles_views->execute();
					?>

                    <div class="my-article-box card" data-article-id="<?= $result_my_articles['id']; ?>">
							<div class="my-article-box-header flex" style="background-image: url('<?= $result_my_articles['image']; ?>');">
								<label class="color-1 flex-column mr-auto-top">
									<h4 class="bold"><?= $result_my_articles['title']; ?></h4>
									<h6><?= $result_my_articles['subtitle']; ?></h6>
								</label>
							</div>
							<div class="my-article-box-label">
								<label class="flex-column color-5">
									<h4 class="bold">Estatísticas:</h4>
									<div class="flex-column">
										<h5><span class="bold"><?= $consult_article_likes->rowCount(); ?></span> curtida<?php if ($consult_article_likes->rowCount() > 1 || $consult_article_likes->rowCount() == 0) { ?>s<?php } ?></h5>
                                        <h5><span class="bold"><?= $consult_articles_views->rowCount(); ?></span> view<?php if ($consult_articles_views->rowCount() > 1 || $consult_articles_views->rowCount() == 0) { ?>s<?php } ?></h5>

									</div>
								</label>
							</div>
							<div class="my-article-box-actions flex">
							
								<div class="mr-auto-left flex">
									<a href="<?= URL_PANEL . '/campaign/' . $result_my_articles['id'] . '/edit'; ?>" class="my-article-action-shelve mr-right-2 no-link">Editar</a>
									<a href="javascript:void(0);" class="my-article-action-delete">Apagar</a>
								</div>
							</div>
						</div>
					<?php 
							}
						} else { 
					?>
						<?php if ($username == $result_panel_user['username']) { ?>
							<label class="text-center pd-2 flex width-content">
								<h4 class="mr-auto">Você ainda não publicou nenhuma noticia!</h4>
							</label>
						<?php } else { ?>
							<label class="text-center pd-2 flex width-content">
								<h4 class="mr-auto">Parece que <b><?= $username; ?></b> não publicou nenhuma noticia!</h4>
							</label>
						<?php } ?>
					<?php } ?>
					</div>
				</div>
			</div>
<?php 
	include('../others/bottom.php');
?>