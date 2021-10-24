<?php 
	require_once('core.php');
?>
			<div class="sideBar flex-column">
				<div class="flex-column pd-2">
					<a href="<?= URL_PANEL; ?>/home" class="blue-button-1 no-link mr-bottom-2" style="width: 100%;height: 45px;">
						<label class="mr-auto color-1">
							<h5 class="fs-14">Inicio</h5>
						</label>
					</a>
					<a href="<?= URL_PANEL; ?>/logout" class="green-button-1 no-link" style="width: 100%;height: 45px;">
						<label class="mr-auto color-1">
							<h5 class="fs-14">Sair do painel</h5>
						</label>
					</a>
				</div>
					<hr>
				<nav>
					<ul class="flex-column">
						<label>
							<h6 class="fs-12 uppercase">Desenvolvimento</h6>
						</label>
						<li <?php if ($page_name == 'Logs-Painel') {?>class="visited"<?php } ?>>
							<a href="<?= URL_PANEL; ?>/logs-painel">Logs do Painel</a>
						</li>
					</ul>
					<ul class="flex-column">
						<label>
							<h6 class="fs-12 uppercase">CEO</h6>
						</label>
						<li <?php if ($page_name == 'Reset-Hall') {?>class="visited"<?php } ?>>
							<a href="<?= URL_PANEL; ?>/reset-hall">Resetar Hall da Fama</a>
						</li>
						<li <?php if ($page_name == 'Logs-Nicknames') {?>class="visited"<?php } ?>>
							<a href="<?= URL_PANEL; ?>/logs-changenick">Logs de Mudança de nick</a>
						</li>
						<li <?php if ($page_name == 'search-user') {?>class="visited"<?php } ?>>
							<a href="<?= URL_PANEL; ?>/edit-user">Editar usuário</a>
						</li>
						<li <?php if ($page_name == 'send-vip') {?>class="visited"<?php } ?>>
							<a href="<?= URL_PANEL; ?>/send-vip">Enviar VIP</a>
						</li>
					</ul>
					<ul class="flex-column">
						<label>
							<h6 class="fs-12 uppercase">Gerência</h6>
						</label>
						<li <?php if ($page_name == 'CreatePage') {?>class="visited"<?php } ?>>
							<a href="<?= URL_PANEL; ?>/create-page">Criar página catálogo</a>
						</li>
						<li <?php if ($page_name == 'AddFurni') {?>class="visited"<?php } ?>>
							<a href="<?= URL_PANEL; ?>/add-furniture">Adicionar mobi</a>
						</li>
						<li <?php if ($page_name == 'Bans') {?>class="visited"<?php } ?>>
							<a href="<?= URL_PANEL; ?>/bans">Banimentos</a>
						</li>
						<li <?php if ($page_name == 'Add-Pin') {?>class="visited"<?php } ?>>
							<a href="<?= URL_PANEL; ?>/add-pin">Adicionar pin</a>
						</li>
						<li <?php if ($page_name == 'give-rank') {?>class="visited"<?php } ?>>
							<a href="<?= URL_PANEL; ?>/give-rank">Dar cargo</a>
						</li>
					</ul>
					<ul class="flex-column">
						<label>
							<h6 class="fs-12 uppercase">Administração</h6>
						</label>
						<li <?php if ($page_name == 'Article/Create') {?>class="visited"<?php } ?>>
							<a href="<?= URL_PANEL; ?>/article/create">Criar noticia</a>
						</li>
						<li <?php if ($page_name == 'My-Articles') {?>class="visited"<?php } ?>>
							<a href="<?= URL_PANEL; ?>/articles/<?= $result_panel_user['username']; ?>">Minhas noticias</a>
						</li>
						<li <?php if ($page_name == 'My-Campaigns') {?>class="visited"<?php } ?>>
							<a href="<?= URL_PANEL; ?>/campaigns/<?= $result_panel_user['username'];?>">Minhas campanhas</a>
						</li>
						<li <?php if ($page_name == 'HospEmblemas') {?>class="visited"<?php } ?>>
							<a href="<?= URL_PANEL; ?>/uploaded-badges">Emblemas hospedados</a>
						</li>
						<li <?php if ($page_name == 'Host-Badge') {?>class="visited"<?php } ?>>
							<a href="<?= URL_PANEL; ?>/host-badge">Hospedar emblema</a>
						</li>
						<li <?php if ($page_name == 'Hall-Points') {?>class="visited"<?php } ?>>
							<a href="<?= URL_PANEL; ?>/hall-points">Pontos do Hall da Fama</a>
						</li>
					</ul>
					<ul class="flex-column">
						<label>
							<h6 class="fs-12 uppercase">Moderação</h6>
						</label>
					</ul>
				</nav>
			</div>
