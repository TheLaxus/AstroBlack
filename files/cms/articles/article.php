<?php 
	require_once('../../../global.php');

	if(isset($user)) {
		$Hotel::Manutention($user['rank']);
	} else {
		$Hotel::Manutention();
	}

	$article_id = $_GET['article_id'];

	$consult_has_articles = $db->prepare("SELECT * FROM cms_news");
	$consult_has_articles->execute();

	if ($consult_has_articles->rowCount() > 0) {
		if (isset($_GET['article_id']) && is_numeric($_GET['article_id'])) {
			$consult_articles = $db->prepare("SELECT id,title,subtitle,category,image,body,timestamp,author,is_draft,active_campaign,form,use_badge,badge FROM cms_news WHERE id = ? LIMIT 1");
			$consult_articles->bindValue(1, $article_id);
			$consult_articles->execute();

			if ($consult_articles->rowCount() > 0) {
				$result_article = $consult_articles->fetch(PDO::FETCH_ASSOC);

				if ($result_article['is_draft'] == 1 && $user['rank'] < 7) {
					$consult_last_no_draft = $db->prepare("SELECT id FROM cms_news WHERE is_draft != 1 ORDER BY timestamp DESC LIMIT 1");
					$consult_last_no_draft->execute();

					$result_last_no_draft = $consult_last_no_draft->fetch(PDO::FETCH_ASSOC);
					Redirect(URL . '/article/' . $result_last_no_draft['id']);
				}

				#-----------------------------------------------------------------------------------#

				$consult_author = $db->prepare("SELECT username,figure,motto FROM players WHERE id = ?");
				$consult_author->bindValue(1, $result_article['author']);
				$consult_author->execute();
				$result_author = $consult_author->fetch(PDO::FETCH_ASSOC);

				#-----------------------------------------------------------------------------------------------------------#

				if(isset($user)) {
					$consult_viewed_in_article = $db->prepare("SELECT * FROM cms_post_views WHERE post_id = ? AND user_id = ?");
					$consult_viewed_in_article->bindValue(1, $result_article['id']);
					$consult_viewed_in_article->bindValue(2, $user['id']);
					$consult_viewed_in_article->execute();
				}


				if(isset($user)) {
					if ($consult_viewed_in_article->rowCount() == 0) {
						$insert_view_in_article = $db->prepare("INSERT INTO cms_post_views (post_id,user_id) VALUES (?,?)");
						$insert_view_in_article->bindValue(1, $result_article['id']);
						$insert_view_in_article->bindValue(2, $user['id']);
						$insert_view_in_article->execute();
					}
				}

				#-----------------------------------------------------------------------------------------------------------#

				$consult_views_in_article = $db->prepare("SELECT * FROM cms_post_views WHERE post_id = ?");
				$consult_views_in_article->bindValue(1, $result_article['id']);
				$consult_views_in_article->execute();

				#-----------------------------------------------------------------------------------------------------------#

				$consult_likes_articles = $db->prepare("SELECT state,user_id FROM cms_post_reaction WHERE post_id = ? AND state != ?");
				$consult_likes_articles->bindValue(1, $article_id);
				$consult_likes_articles->bindValue(2, 'undefined');
				$consult_likes_articles->execute();

				#-------------------------------------------------------------#

				if(isset($user)) {
					$consult_liked_article = $db->prepare("SELECT state,user_id FROM cms_post_reaction WHERE post_id = ? AND user_id = ?");
					$consult_liked_article->bindValue(1, $article_id);
					$consult_liked_article->bindValue(2, $user['id']);
					$consult_liked_article->execute();
	
					$result_liked_article = $consult_liked_article->fetch(PDO::FETCH_ASSOC);

					if (!empty($result_article['badge'])) {
						$consult_if_has_article_badge = $db->prepare("SELECT badge_code FROM player_badges WHERE badge_code = ?");
						$consult_if_has_article_badge->bindValue(1, $result_article['badge']);
						$consult_if_has_article_badge->execute();

					}
				}

			} else {
				$consult_last_article = $db->prepare("SELECT id FROM cms_news ORDER BY timestamp DESC LIMIT 1");
				$consult_lats_article->execute();

				$result_last_article =  $consult_last_article->fetch(PDO::FETCH_ASSOC);
				Redirect(URL . '/article/' . $result_last_article['id']);
			}
		} else {
			$consult_last_article = $db->prepare("SELECT id FROM cms_news ORDER BY timestamp DESC LIMIT 1");
			$consult_last_article->execute();

			$result_last_article = $consult_last_article->fetch(PDO::FETCH_ASSOC);
			Redirect(URL . '/article/' . $result_last_article['id']);
		}
	} else {
		Redirect(URL . '/me');
	}

	$Template->SetParam('page_id', 'article');
	$Template->SetParam('page_name', 'Article');
	$Template->SetParam('page_title', 'Noticia: '. $result_article['title'] . ' - ' . HOTELNAME);
	$Template->SetParam('page_description', '');
	$Template->SetParam('page_image', URL . '/image.png');

	$Template->AddTemplate('others', 'head');

?>

<div class="container">
		<div class="row">
        <div class="col-4">
            <div id="content-box">
                <div class="title-box png20">
                    <div class="title">Últimas noticias</div>
                </div>
                <div class="png20">
                    <ul class="news-list">

					<?php 
							$sections = 6;
							for ($i = 0; $i < $sections; $i++) {
								$section_name = "";
								$section_time_max = 0;
								$section_time_min = 0;

								switch ($i) {
									case 0:
										$section_name = 'Hoje';
										$section_time_max = time();
										$section_time_min = time() - 86400;
										break;
									case 1:
										$section_name = 'Ontem';
										$section_time_max = time() - 86400;
										$section_time_min = time() - 172800;
										break;
									case 2:
										$section_name = '<h4>Esta semana</h4>';
										$section_time_max = time() - 172800;
										$section_time_min = time() - 604800;
										break;
									case 3:
										$section_name = '<h4>Semana anterior</h4>';
										$section_time_max = time() - 604800;
										$section_time_min = time() - 1209600;
										break;
									case 4:
										$section_name = '<h4>Este mês</h4>';
										$section_time_max = time() - 1209600;
										$section_time_min = time() - 2592000;
										break;
									case 5:
										$section_name = '<h4>Último mês</h4>';
										$section_time_max = time() - 2592000;
										$section_time_min = time() - 5184000;
										break;
									case 6:
										$section_name = '<h4>Último meses</h4>';
										$section_time_max = time() - 5184000;
										$section_time_min = time() - 269298000;
									break;
								}

								$consult_others_articles = $db->prepare("SELECT * FROM cms_news WHERE timestamp >= ? AND timestamp <= ? ORDER BY timestamp DESC LIMIT 10");
								$consult_others_articles->bindValue(1, $section_time_min);
								$consult_others_articles->bindValue(2, $section_time_max);
								$consult_others_articles->execute();

								if ($consult_others_articles->rowCount() > 0) {
						?>
						
					<?= $section_name; ?>
					<?php 
		while ($result_others_articles = $consult_others_articles->fetch(PDO::FETCH_ASSOC)) {
			if ($result_others_articles['id'] == $_GET['article_id']) {
		?>

<?php if ($result_others_articles['timestamp_expire'] > TIME) { ?>
	<span class='fas fa-circle' style="position:absolute; color: #4CAF50;font-size: 8px;margin-top: 6px;left:22px" title="Promoção ativa"></span>
	<?php } ?>
	<li><a class="selected" href='<?= URL . '/article/' . $result_others_articles['id']; ?>'><?= $result_others_articles['title']; ?></a> <br><br></li>
<?php } else { ?>
	<?php if ($result_others_articles['timestamp_expire'] > TIME) { ?>
	<span class='fas fa-circle' style="position:absolute; color: #4CAF50;font-size: 8px;margin-top: 6px;left:22px" title="Promoção ativa"></span>
	<?php } ?>
	<li><a href='<?= URL . '/article/' . $result_others_articles['id']; ?>' style="margin-left: 12px;"><?= $result_others_articles['title']; ?></a> <br><br></li>
<?php 
}		
								}}}
							?>	
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div id="content-box">
                <div class="title-box png20">
                    <div class="title"><?= $result_article['title']; ?></div>
                    <div class="desc">Publicado em <?= utf8_encode(strftime('%d de %B de %Y', $result_article['timestamp'])); ?></b> às <b><?= utf8_encode(strftime('%H:%M', $result_article['timestamp'])); ?></b> na categoria <a href=""><b><?= $result_article['category']; ?></b></a>.<p>
					<?= $result_article['subtitle']; ?></div>
                </div>
                <div class="png20">
				<?= $result_article['body']; ?><p><br>

				
				<?php if (!empty($result_article['badge']) && $result_article['use_badge'] == 1 && file_exists(PATH_BADGEIMAGE . '/' . $result_article['badge'] . '.gif')) { ?>
					<a class="btn purple big check-in-header next-register" id="modal-open-badge" data-modal="article-badge-free" style="position:relative; z-index:999; top:0px;float:right; box-shadow: 5px 5px 5px 0px rgba(0, 0, 0, 0.2);">Pegar emblema</a>
	
					<img class="mr-auto-left mr-auto-bottom" style="position:relative; z-index:999; top:-10px;float:right;left: -120px;" src="<?= str_replace(['%badge%'], [$result_article['badge']], BADGEIMAGE); ?>">
					
			<?php } ?>
		<?php if ($result_article['form'] == 1) { ?>
	<a class="btn purple big check-in-header next-register" id="news-open-form" data-modal="form-article-modal" style="position:relative; z-index:999; top:0px;float:left; box-shadow: 5px 5px 5px 0px rgba(0, 0, 0, 0.2);">Formulário</a>
	
	<?php } ?>
	<br>
	<div class="png10">
	<div class="article-content-author flex-column">
							<div class="flex">

							<div class="article-content-author-about flex mr-right-4">
									<div class="article-content-author-about-imager">
										<img alt="<?= $result_author['username']; ?> - <?= HOTELNAME; ?>" src="<?= AVATARIMAGE . $result_author['figure']; ?>&head_direction=3&direction=2&gesture=sml">
									</div>
									<label class="mr-auto-top-bottom">
										<h5>Autor: <b class="underline"><?= $result_author['username']; ?></b></h5>
									</label>
								</div>
									<div class="top-separator"></div>
								<div class="article-content-author-statistcs flex-column pd-right-3 mr-left-4 width-content">
									<div class="flex mr-auto-top-bottom">
										<div class="flex-column mr-auto-top-bottom mr-right-5">
											<label class="flex">
												<icon name="personal-mini" class="mr-auto-top-bottom"></icon>
												<h5 class="bold mr-left-1"><?= $consult_views_in_article->rowCount(); ?> visualizaç<?php if ($consult_views_in_article->rowCount() > 1 || $consult_views_in_article->rowCount() == 0) { ?>ões<?php } else { ?>ão<?php } ?></h5>
											</label>
										</div>
										<?php if(isset($user)) { ?>
											<div class="article-content-react mr-auto-top-bottom flex mr-auto-left" data-article-id="<?= $result_article['id']; ?>">
												<button class="like <?php if ($result_liked_article['state'] == 'like') { ?>active <?php } ?>mr-right-2" data-state="like"></button>
												<button class="deslike<?php if ($result_liked_article['state'] == 'deslike') { ?> active<?php } ?>" data-state="deslike"></button>
											</div>
										<?php } ?>
									</div>
								</div>
							</div>
							<div class="article-content-reactions" <?php if ($consult_likes_articles->rowCount() == 0) { ?>style="display: none;"<?php } ?>>
							<?php 
								while ($result_likes_articles = $consult_likes_articles->fetch(PDO::FETCH_ASSOC)) {
									$consult_liked_user = $db->prepare("SELECT username,figure FROM players WHERE id = ? ORDER BY id");
									$consult_liked_user->bindValue(1, $result_likes_articles['user_id']);
									$consult_liked_user->execute();

									$result_liked_user = $consult_liked_user->fetch(PDO::FETCH_ASSOC);
							?>
								<div class="article-content-reaction" state="<?= $result_likes_articles['state']; ?>" title="<?= $result_liked_user['username']; ?>">
									<div class="article-content-reaction-imager">
										<img src="<?= AVATARIMAGE . $result_liked_user['figure']; ?>&head_direction=3&direction=3&gesture=<?php if ($result_likes_articles['state'] == 'like') { ?>sml<?php } else { ?>arg<?php } ?>">
									</div>
								</div>
							<?php } ?>
					</div>
	</div>
</div>
</div>
		</div>

                </div>
            </div>
        </div>











	







	<?php if ($result_article['form'] == 1) { ?>
	<div class="modal-container" data-modal="form-article-modal">
	
<div id="modal-content">
<div id="news-modal">

<div class="col-12">
            <div id="content-box" style="width:500px">
                <div class="title-box png20">
                    <div class="title">	Formulário: <?= $result_article['title']; ?></div>
                    <div class="desc">Publicado em <?= utf8_encode(strftime('%d de %B de %Y', $result_article['timestamp'])); ?></b> às <b><?= utf8_encode(strftime('%H:%M', $result_article['timestamp'])); ?></b>.<p>
					<?= $result_article['subtitle']; ?></div>
					
					<button type="ok" class="close close-modal" style="position:relative;top:-80px;float:right;right:14px"></button>
                </div>
                <div class="png20">
					
    <h4 style="text-align: center;">Envio:</h4>

	<form class="flex-column margin-top-min form-send" method="POST">

						<input type="hidden" name="id_news" value="<?= $article_id ?>">
						<input type="hidden" name="form_username" value="<?= $user['username'] ?>">
							<div class="col-input-separator flex-column mr-top-none flex margin-bottom-minm">
								<input type="text" id="message-modal-news" class="input" name="form_message" autocomplete="off" placeholder="Mensagem"></textarea>
								<div class="error-input-warn"></div>
							</div>
							<small style="float: left; margin-top: 4px;">Máximo 85 caracteres.</small>
							<br>
							<div class="form-warns"></div>

							<div class="margin-top-min">
								<button class="btn purple big next-register" type="submit" class="button" name="send_form" style="width: 100%; height: 45px;">
									Enviar formulário
								</button>
							</div>
						</form>
					</div>
             </div>
        </div>
</div>
</div>

<div id="column3" class="column">
</div>
</div>
</div>
</div>
<?php } ?>

<?php if (!empty($result_article['badge']) && $result_article['use_badge'] == 1 && file_exists(PATH_BADGEIMAGE . '/' . $result_article['badge'] . '.gif') && isset($user)) { ?>
<div class="modal-container" data-modal="article-badge-free">
	
	<div id="modal-content">
	<div id="news-modal">
	
	<div class="col-12">
            <div id="content-box" style="width:500px">
                <div class="title-box png20">
                    <div class="title">	Receber emblema</div>
                    
								<button type="ok" class="close close-modal" style="position:relative;top:-27px;float:right;right:14px"></button>
								</span>
							</h2>
							<br>
		<div class="notitle ">
		<div id="article-wrapper">

		<form class="flex-column margin-top-min form-send-badge" method="POST">
			<div class="col-input-separator flex-column mr-top-none flex margin-bottom-minm">
				<h4 class="f-12" style="text-align: center;">Clique no botão para ganhar este emblema:</h4>
			</div>
			<input type="hidden" name="articleBadgeId" value="<?= $article_id; ?>">
			<input type="hidden" name="usernameWin" value="<?= $user['username']?>">

			<img class="mr-auto" src="<?= str_replace(['%badge%'], [$result_article['badge']], BADGEIMAGE); ?>"><br>	
			<div class="col-input-separator flex-column mr-top-none flex margin-bottom-minm">
				<input type="hidden" name="badgeCode" value="<?= $result_article['badge']?>">
				<div class="error-input-warn" style="text-align: center;"></div>
			</div>
			<div class="col-input-separator flex-column mr-top-none flex margin-bottom-minm">
				<div class="form-warns"></div>
			</div>
			<div class="margin-top-min">
									<button class="btn purple big next-register" type="submit" class="button" name="send_form" style="width: 100%; height: 45px;">
										Receber emblema
									</button>

								</div>

							</form>
						</div>
				 </div>
			</div>
	</div>
	</div>
	
	<div id="column3" class="column">
	</div>
	</div>
	</div>
	</div>
<?php } ?>
<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script>
<script type="text/javascript" src="<?= CDN; ?>/assets/js/jquery.js?<?= TIME; ?>"></script>
<script type="text/javascript" src="<?= CDN; ?>/assets/js/main.js?<?= TIME; ?>"></script>
<script type="text/javascript" src="<?= CDN; ?>/assets/js/ajax.js?<?= TIME; ?>"></script>	
				
<?php 
	$Template->AddTemplate('others', 'bottom'); 
?>
