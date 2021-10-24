<?php
require_once('../../../global.php');

$Hotel::Manutention($user['rank']);
$Functions::Session('disconnected');

$Template->SetParam('page_id', 'me');
$Template->SetParam('page_name', 'Principal');
$Template->SetParam('page_title', 'Me: ' . USERNAME . ' - ' . HOTELNAME);
$Template->SetParam('page_description', '');
$Template->SetParam('page_image', URL . '/image.png');

$Template->AddTemplate('others', 'head');
?>        


<div class="container">
		<div class="row">
			<div class="col-8">
            <div id="content-box" class="profile">
                <div class="bg"></div>
                <div class="overlay">
                    <div class="avatar-image" style="background-image:url(<?= AVATARIMAGE . $user['figure']; ?>&size=l&head_direction=3&gesture=sml)"></div>

                    <div class="username"><?= USERNAME; ?> <img src="https://habbo.st/public/assets/pix/img/icons/checkmark_blue.png" alt=""></div>
                    <div class="motto"><?= Functions::Filter('XSS', $user['motto']); ?></div>

                    <div class="last-online">Último acesso: <?= strftime('%d de %B de %Y às %H:%M', $user['last_online']); ?></div>
                
                <div class="btn-select">
                <a href="client" class="btn purple client" target="_blank">Entrar no BETA⠀⠀<img src="<?= CDN; ?>/assets/img/hotel-button-medium-icon.png" style="position:absolute;margin-top:-3px;margin-left:0px;z-index:1"></a><br><br></p>
                <a href="client" class="btn purple client" target="_blank">Entrar no Flash⠀<img src="<?= CDN; ?>/assets/img/hotel-button-medium-icon.png" style="position:absolute;margin-top:-3px;margin-left:0px;z-index:1"></a>
                </div> 
                </div>
                <div style="clear:both"></div>
            </div>

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
				<div id="content-box">
					<div class="title-box png20">
                        <div class="title">Minhas Tags</div>
						<div class="desc">Adicione tags ao seu perfil do jogo</div>
					</div>
                    <div class="png10">
					<?php
						
						$getTagsFromUser = $db->prepare("SELECT id,tag FROM player_tags WHERE player_id = ?");
						$getTagsFromUser->bindValue(1, User::userData('id'));
						$getTagsFromUser->execute();

						if ($getTagsFromUser->rowCount() > 0) {
							while ($resultTagsFromUser = $getTagsFromUser->fetch(PDO::FETCH_ASSOC)) {
					?>
						<?= $resultTagsFromUser['tag']; ?> <i class="far fa-minus" style="color:red;font-size:10px"></i>

					<?php } } ?>
					</div>
			<div class="png20">
			<form method="POST" class="form-addtag">
				
                    <label for="old-mail" class="">Adicione uma tag:</label></p>
				<div class="col-input-separator flex-column mr-top-none flex margin-bottom-minm">
                    <input type="text" name="tag-add" id="add-tag-input" maxlength="20">
					<div class="error-input-warn"></div>
				</div>

                    <button type="submit" class="btn purple save" style="float:right;position:relative;margin-top:-34px;right:4px;padding:10px;">Adicionar</button>
					<br>
					<div class="form-warns"></div>

			</form>
            </div>
            
            </div>
            </div>
			
			<div class="col-7">
				<div id="content-box">
					<div class="title-box png20">
						<div class="title">Campanhas</div>
						<div class="desc">Saiba o que esta acontecendo no Lella Hotel!</div>
					</div>
					<div class="png20">
                    <?php
                        $consult_active_campaign = $db->prepare("SELECT * FROM cms_weekly_columns ORDER BY id DESC LIMIT 5");
                        $consult_active_campaign->execute();

                        if ($consult_active_campaign->rowCount() > 0) {
                            while ($result_active_campaign = $consult_active_campaign->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                        <?php 
                            $verifyCampaignActive = $db->prepare("SELECT active_campaign FROM cms_news WHERE id = ?");
                            $verifyCampaignActive->bindValue(1, $result_active_campaign['news_id']);
                            $verifyCampaignActive->execute();
                            $resultActiveCampaign = $verifyCampaignActive->fetch(PDO::FETCH_ASSOC);

                            if ($resultActiveCampaign['active_campaign'] == 1) { ?>
						<div class="campaigns">
							<a href="/article/<?= $result_active_campaign['news_id']; ?>">
								<div class="img" style="background-image:url(<?= $result_active_campaign['image']; ?>)"></div>
								<div class="details">
									<div class="title"><?= Functions::Filter('xss', $result_active_campaign['title']); ?></div>
									<div class="desc"><?= Functions::Filter('xss', $result_active_campaign['description']); ?> </div>

                                </div>
							</a>
						</div>
                        <?php } ?>
                            <?php
                            }
                        } else {
                            ?>
                            <h4 class="bold">Sem campanhas</h4>
                            <h5>Vish, parece que não á nenhuma campanha ativa neste momento.</h5>
                        <?php } ?>
					</div>
				</div>
			</div>
					
			<div class="col-5">
				<div id="content-box" style="max-height:300px">
					<div class="title-box png20">
						<div class="title">Quartos populares</div>
						<div class="desc">Aqui encontra os quartos mais famosos de todo o hotel</div>
					</div>
					<div class="png20">
					<?php
                        $consult_featured_rooms = $db->prepare("SELECT id,owner,name,score FROM rooms ORDER BY score DESC LIMIT 3");
                        $consult_featured_rooms->execute();

                        while ($result_featured_rooms = $consult_featured_rooms->fetch(PDO::FETCH_ASSOC)) {
                    ?>
								<div class="event">
									<div class="icon" style="width:12%">
                                    <img src="<?= URL;?>/cdn/web-gallery/v2/images/rooms/room_icon_4.gif" style="position:relative;left:-10px;top:-2px"></div>
									<div class="info" style="width:88%">
										<div class="event_title"><?= $result_featured_rooms['name']; ?></div>
										<div style="clear: both"></div>
										<div class="event_desc">Dono: <?= $result_featured_rooms['owner']; ?>
										<div style="clear: both"></div>
										Curtidas: <?= $result_featured_rooms['score']; ?></div>
										

										<a href="<?= URL . '/client/' . $result_featured_rooms['id']; ?>" class="btn purple check-in-header" style="position:absolute;top:-10px;float:right;" target="_blank">Entrar</a>

										<div style="clear: both"></div>
										</div>
										<div style="clear: both"></div>
								
								<div style="clear: both"></div>
								<div style="clear: both"></div>
								<?php } ?>
								</div>
					</div>
				</div>
								
					</div>
					
				</div>
			</div>


<?php
$Template->AddTemplate('others', 'bottom');
?>
