<?php 
	require_once('../others/core.php');

	$Panel::Session('disconnected', $result_panel_user['rank']);

	$page_id = 'home';
	$page_name = 'Home';
	$page_title = 'Painel: Inicio - ' . HOTELNAME;

	$consult_users_online = $db->prepare("SELECT online FROM players WHERE online = ?");
	$consult_users_online->bindValue(1, '1');
	$consult_users_online->execute();

	#---------------------------------#

	$consult_users_register = $db->prepare("SELECT id FROM players");
	$consult_users_register->execute();
	
	#---------------------------------#

	$consult_bans = $db->prepare("SELECT id FROM bans");
	$consult_bans->execute();

	#---------------------------------#

	$consult_articles = $db->prepare("SELECT id FROM cms_news");
	$consult_articles->execute();

	#---------------------------------#

	$consult_staffs_online = $db->prepare("SELECT id FROM players WHERE rank > 6 AND online = ?");
	$consult_staffs_online->bindValue(1, '1');
	$consult_staffs_online->execute();

	#---------------------------------#

	$consult_vips = $db->prepare("SELECT id FROM players WHERE vip = ?");
	$consult_vips->bindValue(1, '1');
	$consult_vips->execute();

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
						<h2 class="bold">Inicio</h2>
					</label>
				</div>
				<div class="content-container">

				<div id="content-tool-bar">
				<div class="flex-wrap margin-auto">
				<li class="list-none flex-column padding-right-max padding-left-max" id="c-t-b-statistics">
						<h2 class="bold color-15 margin-auto-left-right"><?= number_format($consult_users_online->rowCount());?></h2>
						<h4 class="uppercase gray-clear margin-auto-left-right">Online</h4>
					</li>
					<li class="list-none flex-column padding-right-max padding-left-max" id="c-t-b-statistics">
						<h2 class="bold color-15 margin-auto-left-right"><?= number_format($consult_users_register->rowCount());?></h2>
						<h4 class="uppercase gray-clear margin-auto-left-right">Registrados</h4>
					</li>
					<li class="list-none flex-column padding-right-max padding-left-max" id="c-t-b-statistics">
						<h2 class="bold color-15 margin-auto-left-right"><?= number_format($consult_bans->rowCount()); ?></h2>
						<h4 class="uppercase gray-clear margin-auto-left-right">Banidos</h4>
					</li>
					<li class="list-none flex-column padding-right-max padding-left-max" id="c-t-b-statistics">
						<h2 class="bold color-15 margin-auto-left-right"><?= number_format($consult_articles->rowCount()); ?></h2>
						<h4 class="uppercase gray-clear margin-auto-left-right">Noticias</h4>
					</li>
					<li class="list-none flex-column padding-right-max padding-left-max" id="c-t-b-statistics">
						<h2 class="bold color-15 margin-auto-left-right"><?= number_format($consult_staffs_online->rowCount()); ?></h2>
						<h4 class="uppercase gray-clear margin-auto-left-right">STAFFs Online</h4>
					</li>
					<li class="list-none flex-column padding-right-max padding-left-max" id="c-t-b-statistics">
						<h2 class="bold color-15 margin-auto-left-right"><?= number_format($consult_vips->rowCount()); ?></h2>
						<h4 class="uppercase gray-clear margin-auto-left-right">VIPS</h4>
					</li>
				</div>
			</div>
			<div id="content-tool-bar" style="margin-top:10px;">
					<div class="margin-right-md flex" id="general-white-card">
						<label class="color-15" style="margin: 0 110px 0 0;">
							<h3>Seja bem-vind<?php if ($user['gender'] == 'F') { ?>a<?php } else { ?>o<?php } ?> ao painel <b><?php echo $user['username']; ?></b>!</h3>
							<h4 class="margin-top-minm margin-bottom-min">Aqui você pode encontrar as ferramentas necessárias para você gerenciar tudo o que a sua função do seu cargo permite, cada ação que você faz aqui no painel é salva, ou seja, nós estamos sempre de olho no que você anda fazendo por aqui.</h4>
							<h5>Então tome muito cuidado quando você for fazer algo por aqui!</h5>
							<br>
							<span title="só coisas relevantes por favor">
                                 <h5>Se algo não funcionar como deveria, chama no Discord: <b>Laxus#6541</b> que o pai resolve.</h5>
                            </span>
						</label>
						<img src="/cdn/assets/img/asset_namechange2.png" style="position: absolute;right: -0px;bottom: -18px;">
					</div>
				</div>
		
				
				<div class="staff-box card" style="margin-top:10px;width:353px;">
							<div class="my-article-box-header flex" style="background-image: url('https://3.bp.blogspot.com/-b2Vqz5G4oLk/WWQF91PjqAI/AAAAAAAA6yU/tMBW7I-siGYACiVOFpkDHALBnCxaXwy7gCKgBGAs/s1600/P8Tma8h.png');">
								<label class="color-1 flex-column mr-auto-top">
									<h4 class="bold">Desenvolvedores</h4>
									<h6>Responsáveis pela programação do hotel</h6>
								</label>
							</div>

						<?php
							 $consult_devs = $db->prepare("SELECT username, figure, last_online, online FROM players WHERE rank = ?");
							 $consult_devs->bindValue(1, '11');
							 $consult_devs->execute();
						 ?>
						 <?php if ($consult_devs->rowCount() > 0) {
							  while($result_devs = $consult_devs->fetch(PDO::FETCH_ASSOC)) {
						 ?>
						 
						 <div class="staff-box-actions flex" style="">
							<img src="<?= AVATARIMAGE . $result_devs['figure'];?>&action=wav&direction=2&head_direction=2&gesture=std&size=n&img_format=png&frame=0&headonly=1https://habbo.city/habbo-imaging/avatarimage?figure=figure=sh-290-62.hd-205-1383.ch-215-82.lg-275-110.ha-1015-62&action=wav&direction=2&head_direction=2&gesture=std&size=n&img_format=png&frame=0&headonly=1" style="position: absolute;left:6px;bottom: -1px;">
							<h4 class="bold" style="left: 60px"><?= $result_devs['username'];?></h4>
							<div class="mr-auto-left" style="position:absolute;top:41px;left:80px;float:left;text-align:left;">
								<h5><b>Ultimo login:</b></br> 
								<?= strftime('%d de %B de %Y às %H:%M', $result_devs['last_online']); ?></h5>
							</div>
							<?php if ($result_devs['online'] == 1) { ?>
							<div class="mr-auto-left">
								<img style="float: right;" src="http://localhost/cdn/web-gallery/v2/images/online.gif" padding="5px">
							</div>
							<?php } else { ?>
							<div class="mr-auto-left">
								<img style="float: right;" src="http://localhost/cdn/web-gallery/v2/images/offline.gif" padding="5px">
							</div>
							<?php } ?>
							</div>
							<?php } } else { ?>
								<h4 style="background-color:#bf6060;color:#fff;font-size:14px;margin:8px;border-radius:4px;text-align:center;padding:3px">Sem staff nesta categoria.</h4>
								<?php } ?>
							</div>
							

							<div class="staff-box card" style="width:353px;">
							<div class="my-article-box-header flex" style="background-image: url('https://1.bp.blogspot.com/-u5v_9SCPNjE/WzQNMalgk6I/AAAAAAABIHQ/Dmzsxq5j3bASmDLv7tbXW2ptfP1Oa_qFACKgBGAs/s1600/GbgGpSA.png');">
								<label class="color-1 flex-column mr-auto-top">
									<h4 class="bold">CEO</h4>
									<h6>Responsáveis pelo hotel</h6>
								</label>
							</div>
						<?php
							 $consult_ceo = $db->prepare("SELECT username, figure, last_online, online FROM players WHERE rank = ?");
							 $consult_ceo->bindValue(1, '9');
							 $consult_ceo->execute();
						 ?>
						 <?php if ($consult_ceo->rowCount() > 0) {
							  while($result_ceo = $consult_ceo->fetch(PDO::FETCH_ASSOC)) {
						 ?>
							<div class="staff-box-actions flex" style="">
							<img src="<?= AVATARIMAGE . $result_ceo['figure'];?>&action=wav&direction=2&head_direction=2&gesture=std&size=n&img_format=png&frame=0&headonly=1https://habbo.city/habbo-imaging/avatarimage?figure=figure=sh-290-62.hd-205-1383.ch-215-82.lg-275-110.ha-1015-62&action=wav&direction=2&head_direction=2&gesture=std&size=n&img_format=png&frame=0&headonly=1" style="position: absolute;left:6px;bottom: -1px;">
							<h4 class="bold" style="left: 60px"><?= $result_ceo['username'];?></h4>
							<div class="mr-auto-left" style="position:absolute;top:41px;left:80px;float:left;text-align:left;">
								<h5><b>Ultimo login:</b></br> 
								<?= strftime('%d de %B de %Y às %H:%M', $result_ceo['last_online']); ?></h5>
							</div>
							<?php if ($result_ceo['online'] == 1) { ?>
							<div class="mr-auto-left">
								<img style="float: right;" src="http://localhost/cdn/web-gallery/v2/images/online.gif" padding="5px">
							</div>
							<?php } else { ?>
							<div class="mr-auto-left">
								<img style="float: right;" src="http://localhost/cdn/web-gallery/v2/images/offline.gif" padding="5px">
							</div>
							<?php } ?>							
							</div>
							<?php } } else { ?>
								<h4 style="background-color:#bf6060;color:#fff;font-size:14px;margin:8px;border-radius:4px;text-align:center;padding:3px">Sem staff nesta categoria.</h4>
							<?php } ?>
						</div>

						<div class="staff-box card" style="margin-top:0px;width:353px;">
							<div class="my-article-box-header flex" style="background-image: url('https://1.bp.blogspot.com/-K-QDsCk5voI/WJUsu8qAPbI/AAAAAAAA0HQ/MOPshxSsL9s4zHy1T3ekwXP9UIAGQac2wCPcB/s1600/exe_dragonsden.gif');">
								<label class="color-1 flex-column mr-auto-top">
									<h4 class="bold">Gerentes</h4>
									<h6>Responsáveis pela gestao do hotel</h6>
								</label>
							</div>
							<?php
							 $consult_ger = $db->prepare("SELECT username, figure, last_online, online FROM players WHERE rank = ?");
							 $consult_ger->bindValue(1, '8');
							 $consult_ger->execute();
						 ?>
						 <?php if ($consult_ger->rowCount() > 0) {
							  while($result_ger = $consult_ger->fetch(PDO::FETCH_ASSOC)) {
						 ?>						
							<div class="staff-box-actions flex" style="">
							<img src="<?= AVATARIMAGE . $result_ger['figure'];?>&action=wav&direction=2&head_direction=2&gesture=std&size=n&img_format=png&frame=0&headonly=1https://habbo.city/habbo-imaging/avatarimage?figure=figure=sh-290-62.hd-205-1383.ch-215-82.lg-275-110.ha-1015-62&action=wav&direction=2&head_direction=2&gesture=std&size=n&img_format=png&frame=0&headonly=1" style="position: absolute;left:6px;bottom: -1px;">
							<h4 class="bold" style="left: 60px"><?= $result_ger['username'];?></h4>
							<div class="mr-auto-left" style="position:absolute;top:41px;left:80px;float:left;text-align:left;">
								<h5><b>Ultimo login:</b></br> 
								<?= strftime('%d de %B de %Y às %H:%M', $result_ger['last_online']); ?></h5>
							</div>
							<?php if ($result_ger['online'] == 1) { ?>
							<div class="mr-auto-left">
								<img style="float: right;" src="http://localhost/cdn/web-gallery/v2/images/online.gif" padding="5px">
							</div>
							<?php } else { ?>
								<div class="mr-auto-left">
									<img style="float: right;" src="http://localhost/cdn/web-gallery/v2/images/offline.gif" padding="5px">
								</div>		
							<?php } ?>						
							</div>
							<?php } } else { ?>
								<h4 style="background-color:#bf6060;color:#fff;font-size:14px;margin:8px;border-radius:4px;text-align:center;padding:3px">Sem staff nesta categoria.</h4>
							<?php } ?>
						</div>

						<div class="staff-box card" style="margin-top:0px;width:353px">
							<div class="my-article-box-header flex" style="background-image: url('https://2.bp.blogspot.com/-uaXwOpq0qfc/WZYjK6fbMlI/AAAAAAAA76w/T1Wn6u8YJP8A_ku-jUkigy8waCOtAGOrQCKgBGAs/s1600/never_ending.gif');">
								<label class="color-1 flex-column mr-auto-top">
									<h4 class="bold">Administradores</h4>
									<h6>Responsáveis pelo entretenimento do hotel</h6>
								</label>
							</div>
							<?php
							 $consult_adm = $db->prepare("SELECT username, figure, last_online, online FROM players WHERE rank = ?");
							 $consult_adm->bindValue(1, '7');
							 $consult_adm->execute();
						 ?>
						 <?php if ($consult_adm->rowCount() > 0) {
							  while($result_adm = $consult_adm->fetch(PDO::FETCH_ASSOC)) {
						 ?>	
							 <div class="staff-box-actions flex" style="">
							 <img src="<?= AVATARIMAGE . $result_adm['figure'];?>&action=wav&direction=2&head_direction=2&gesture=std&size=n&img_format=png&frame=0&headonly=1https://habbo.city/habbo-imaging/avatarimage?figure=figure=sh-290-62.hd-205-1383.ch-215-82.lg-275-110.ha-1015-62&action=wav&direction=2&head_direction=2&gesture=std&size=n&img_format=png&frame=0&headonly=1" style="position: absolute;left:6px;bottom: -1px;">
							<h4 class="bold" style="left: 60px"><?= $result_adm['username'];?></h4>
							<div class="mr-auto-left" style="position:absolute;top:41px;left:80px;float:left;text-align:left;">
								<h5><b>Ultimo login:</b></br> 
								<?= strftime('%d de %B de %Y às %H:%M', $result_adm['last_online']); ?></h5>
							</div>
							<?php if ($result_adm['online'] == 1) { ?>
							<div class="mr-auto-left">
								<img style="float: right;" src="http://localhost/cdn/web-gallery/v2/images/online.gif" padding="5px">
							</div>
							<?php } else { ?>
								<div class="mr-auto-left">
									<img style="float: right;" src="http://localhost/cdn/web-gallery/v2/images/offline.gif" padding="5px">
								</div>	
								<?php }	?>				
							</div>
							<?php } } else { ?>
								<h4 style="background-color:#bf6060;color:#fff;font-size:14px;margin:8px;border-radius:4px;text-align:center;padding:3px">Sem staff nesta categoria.</h4>
							<?php } ?>
						</div>

						<div class="staff-box card" style="margin-top:10px;width:353px">
							<div class="my-article-box-header flex" style="background-image: url('https://2.bp.blogspot.com/-WhxjGssrdvU/Vt4-iEhtfpI/AAAAAAAAkCg/966e5W9DMuI/s1600/articleHeader_business2.gif');">
								<label class="color-1 flex-column mr-auto-top">
									<h4 class="bold">Moderadores</h4>
									<h6>Responsáveis pela segurança e diversão do hotel</h6>
								</label>
							</div>
						<?php
							 $consult_mod = $db->prepare("SELECT username, figure, last_online, online FROM players WHERE rank = ?");
							 $consult_mod->bindValue(1, '6');
							 $consult_mod->execute();
						 ?>
						 <?php if ($consult_mod->rowCount() > 0) {
							  while($result_mod = $consult_mod->fetch(PDO::FETCH_ASSOC)) {
						 ?>								
							<div class="staff-box-actions flex" style="">
							<img src="<?= AVATARIMAGE . $result_mod['figure'];?>&action=wav&direction=2&head_direction=2&gesture=std&size=n&img_format=png&frame=0&headonly=1https://habbo.city/habbo-imaging/avatarimage?figure=figure=sh-290-62.hd-205-1383.ch-215-82.lg-275-110.ha-1015-62&action=wav&direction=2&head_direction=2&gesture=std&size=n&img_format=png&frame=0&headonly=1" style="position: absolute;left:6px;bottom: -1px;">
							<h4 class="bold" style="left: 60px"><?= $result_mod['username'];?></h4>
							<div class="mr-auto-left" style="position:absolute;top:41px;left:80px;float:left;text-align:left;">
								<h5><b>Ultimo login:</b></br> 
								<?= strftime('%d de %B de %Y às %H:%M', $result_mod['last_online']); ?></h5>
							</div>
							<?php if ($result_mod['online'] == 1) { ?>
								<div class="mr-auto-left">
									<img style="float: right;" src="http://localhost/cdn/web-gallery/v2/images/online.gif" padding="5px">
								</div>
							<?php } else { ?>
								<div class="mr-auto-left">
									<img style="float: right;" src="http://localhost/cdn/web-gallery/v2/images/offline.gif" padding="5px">
								</div>
							<?php } ?>							
							</div>
							<?php } } else { ?>
								<h4 style="background-color:#bf6060;color:#fff;font-size:14px;margin:8px;border-radius:4px;text-align:center;padding:3px">Sem staff nesta categoria.</h4>
							<?php } ?>
						</div>

						<div class="staff-box card" style="margin-top:10px;width:353px">
							<div class="my-article-box-header flex" style="background-image: url('https://2.bp.blogspot.com/-XmctuTLNKC8/XZOw6oeEvYI/AAAAAAABV6U/bGd2lldEUrUa_pcFfI4XofDQu-ambPaBwCKgBGAsYHg/s1600/3.png');">
								<label class="color-1 flex-column mr-auto-top">
									<h4 class="bold">Embaixadores</h4>
									<h6>Responsáveis pela segurança e duvidas dos usuários</h6>
								</label>
							</div>
						<?php
							 $consult_emb = $db->prepare("SELECT username, figure, last_online, online FROM players WHERE rank = ?");
							 $consult_emb->bindValue(1, '5');
							 $consult_emb->execute();
						 ?>
						 <?php if ($consult_emb->rowCount() > 0) {
							  while($result_emb = $consult_emb->fetch(PDO::FETCH_ASSOC)) {
						 ?>								
							<div class="staff-box-actions flex" style="">
							<img src="<?= AVATARIMAGE . $result_emb['figure'];?>&action=wav&direction=2&head_direction=2&gesture=std&size=n&img_format=png&frame=0&headonly=1https://habbo.city/habbo-imaging/avatarimage?figure=figure=sh-290-62.hd-205-1383.ch-215-82.lg-275-110.ha-1015-62&action=wav&direction=2&head_direction=2&gesture=std&size=n&img_format=png&frame=0&headonly=1" style="position: absolute;left:6px;bottom: -1px;">
							<h4 class="bold" style="left: 60px"><?= $result_emb['username'];?></h4>
							<div class="mr-auto-left" style="position:absolute;top:41px;left:80px;float:left;text-align:left;">
								<h5><b>Ultimo login:</b></br> 
								<?= strftime('%d de %B de %Y às %H:%M', $result_emb['last_online']); ?></h5>
							</div>
							<?php if ($result_emb['online'] == 1) { ?>
								<div class="mr-auto-left">
									<img style="float: right;" src="http://localhost/cdn/web-gallery/v2/images/online.gif" padding="5px">
								</div>
							<?php } else { ?>
								<div class="mr-auto-left">
									<img style="float: right;" src="http://localhost/cdn/web-gallery/v2/images/offline.gif" padding="5px">
								</div>
							<?php } ?>						
							</div>
							<?php } } else { ?>
								<h4 style="background-color:#bf6060;color:#fff;font-size:14px;margin:8px;border-radius:4px;text-align:center;padding:3px">Sem staff nesta categoria.</h4>
							<?php } ?>
						</div>
				</div>
			</div>
			</div>
<?php 
	include('../others/bottom.php');
?>
