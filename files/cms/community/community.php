<?php 
	require_once('../../../global.php');

	$Hotel::Manutention($user['rank']);
	$Functions::Session('disconnected');

	$Template->SetParam('page_id', 'community');
	$Template->SetParam('page_name', 'Comunidade');
	$Template->SetParam('page_title', 'Comunidade - ' . HOTELNAME);
	$Template->SetParam('page_description', '');
	$Template->SetParam('page_image', URL . '/image.png');

	$Template->AddTemplate('others', 'head');
?>
<div class="container">
		<div class="row">
			<div class="col-8">
<div id="news-content">
            <?php
            $consult_last_slide_articles = $db->prepare("SELECT id,title,image,subtitle FROM cms_news WHERE category != ? ORDER BY timestamp DESC LIMIT 6");
            $consult_last_slide_articles->bindValue(1, 'Campanhas');
            $consult_last_slide_articles->execute();

            while ($result_last_slide_articles = $consult_last_slide_articles->fetch(PDO::FETCH_ASSOC)) {
            ?>
					<div class="news-article show" style="background-image:url(<?= $result_last_slide_articles['image']; ?>)">
						<div class="shadow"></div>

						<div class="news-content">
							<div class="news-title"><?= $result_last_slide_articles['title']; ?></div>
							<div class="news-short-text"><?= $result_last_slide_articles['subtitle']; ?></div>
						</div>

						<div class="details-box">
							<div class="back-news"><i class="fal fa-angle-left"></i></div>

							
							<div class="next-news"><i class="fal fa-angle-right"></i></div>
						</div>
                        <a href="/article/<?= $result_last_slide_articles['id']; ?>" class="btn purple check-in-header next-register news-slider-btn">Saber mais »</a>
					</div>
                    <?php } ?>
				</div>
			</div>

			<div class="col-4">
	<iframe src="https://discord.com/widget?id=886671813176864838&theme=dark" width="300" height="280" allowtransparency="true" frameborder="0" sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe>				
</div>			
									
        
<?php 
	$Template->AddTemplate('others', 'bottom'); 
?>
