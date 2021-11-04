<?php 
	require_once('../../../global.php');

	$keywords = "habbo, habbo pirata, habbo atlanta, atlanta, habbon, habblet, habbinc, habbig, habbink, habbolove, habblove, hybbe, Haibbo Hotel, habbolella, lella hotel, lella, iron, iron hotel, habbig hotel, crazzy, crazzy habbo, habbok, habbook hotel, habbinfo, habblive, live, hotel, habbonados, raduckets, catálogo atualizado, habbo futebol, mobis, mobilias, snow war, futebol, bola rebug, bola habbo, bola 100%, bola 8q, bola 6q, bola 4q, wireds, mascotes, habbocity, habbo.com, habbo.,habbo online, habbo lotado, habbo bom, habbo atualizado, habbo antigo, habbo r63, habbo dino, habbo dinossauro, habbo original, habbo oficial, retro server, habb, rabbo, hotel, Age, Like Hotel, Habbo Privado, Pirata, Privado, Habbo.com.br, habble, habblo, fresh-hotel, crazzy, habbo hotel, virtual, mundo, comunidade virtual, grátis, comunidade, avatar, bate papo, online, jovem, rpg, entre, social, grupos, fóruns, seguro, jogue, jogos, online, amigos, jovens, raros, mobis raros, colecionar, expressão, emblemas, diversão, música, celebridade, visita de famosos, celebridades, mmo, mmorpg, rpg online";
	global $db;
?>
<!DOCTYPE html>
<html>
	<head>
		<base href="<?= URL; ?>">
		<meta charset="utf-8">
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
		<meta http-equiv="content-language" content="pt-br">
		<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
		<meta name="robots" content="index,follow,all">
		<meta name="googlebot" content="index,follow,all">
		<title><?= $page_title; ?></title>
		<meta name="author" content="<?= HOTELNAME; ?>">
		<meta name="description" content="<?= $page_description; ?>">
		<meta name="keywords" content="<?= $keywords; ?>">
		<meta name="category" content="Wesbite">
		<meta name="classification" content="Online Games">
		<meta name="country" content="Brazil">
		<meta name="language" content="Portuguese">
		<meta name="reply-to" content="mail@undefined">
		<meta property="og:title" content="<?= $page_title; ?>">
		<meta property="og:description" content="<?= $page_description; ?>">
		<meta property="og:site_name" content="<?= HOTELNAME; ?>">
		<meta property="og:image" content="<?= $page_image; ?>">
		<meta property="og:locale" content="pt_BR">
		<meta property="og:url" content="<?= URL_ATUAL; ?>">
		<meta property="og:type" content="wesbite">
		<meta name="twitter:title" content="<?= $page_title; ?>">
		<meta name="twitter:description" content="<?= $page_description; ?>">
		<meta name="twitter:site" content="@undefined">
		<meta name="twitter:card" content="summary">
		<meta name="twitter:image:src" content="<?= URL; ?>/image.png">
		<meta name="twitter:domain" content="<?= URL_ATUAL; ?>">
		
		<link rel="shortcut icon" href="<?= URL; ?>/favicon.ico?<?= time(); ?>">

		<!--<link type="text/css" href="<?= CDN; ?>/assets/css/lella-c.css" rel="stylesheet">--><!--Tema claro-->
		<link type="text/css" href="<?= CDN; ?>/assets/css/lella-e.css" rel="stylesheet"><!--Tema escuro-->
		<link type="text/css" href="<?= CDN; ?>/assets/css/dutstrap.css" rel="stylesheet"><!--Tema escuro-->
		<script type="text/javascript" src="<?= CDN; ?>/assets/js/vendor.js"></script>
        <script type="text/javascript" src="<?= CDN; ?>/assets/js/app.js"></script>

		<script type="text/javascript" src="<?= CDN; ?>/assets/js/main.js?<?= TIME; ?>"></script>
		<script type="text/javascript" src="<?= CDN; ?>/assets/js/ajax.js?<?= TIME; ?>"></script>
		<script type="text/javascript" src="<?= CDN; ?>/assets/js/online.js?<?= TIME; ?>"></script>


</head>
<body>
<div id="header-content">

<div class="header-s"></div>
<div class="container">
<div class="online-count-box"><?= USERS; ?></div>
<?php if (isset($_SESSION['username'])) { ?>
						<?php if (User::userData('rank') >= 6) { ?>
<a href="/panel" class="btn red big next-register" target="_blank" style="position:absolute;margin-left:-360px;top:50px">Painel</a>
<?php } ?>
					<?php } ?>
<a href="client" class="btn purple big check-in-header next-register" target="_blank">Entrar no Lella</a>
			<div class="row">
				<div class="col-12">
					
				</div>
			</div>
		</div>
	</div>
	<div id="header-menu">
		<div class="container">
			<div class="row">
				<div class="col-4">
					<ul class="user-menu">
					<?php if(isset($_SESSION['username'])) { ?>
						<li>
							<a href="me">
							<?= USERNAME; ?><span><i class="far fa-angle-down"></i></span>
							</a>

							<ul class="user-subnavi">
								<li><a href="/perfil">Meu perfil</a></li>
								<li><a href="/settings">Configurações</a></li>
								<li><a href="/logout" class="logout">Sair da conta</a></li>
							</ul>
						</li>
						<?php } else { ?>
							<li>
							<a href="/index">
							Faça login ou registre-se!
							</a>
						</li>
						<?php } ?>
					</ul>
					
				</div>
				<div class="col-2">
					<a href="\" class="logo"></a>
				</div>
				<div class="col-6">
					<ul class="navigation">
						<li>
							<a href="/community">Comunidade<span><i class="far fa-angle-down"></i></span></a>

							<ul class="subnavi">
								<li><a href="/community/staff">Equipe</a></li>
								<li><a href="/community/colab">Colaboradores</a></li>
								<li><a href="/community/etiqueta">Lella Etiqueta</a></li>
							</ul>
						</li>
						<li>
							<a href="/hall">Hall Da Fama</a>

						
						</li>
						<li>
							<a href="/shop/buy">VIP<span><i class="far fa-angle-down"></i></span></a>

							<ul class="subnavi">
								<li><a href="/community/vips">Membros VIP</a></li>
							</ul>
						</li>
						<li>
							<a href="/articles">Noticias<span></a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!--<div id="header-submenu">
	<div class="container">
			<div class="row">
				<div class="col-4">
					<ul class="user-menu">
						<li>
							<a href="me.php">
								Wake<span><i class="far fa-angle-down"></i></span>
							</a>

							<ul class="user-subnavi">
								<li><a href="profile.php">Meu perfil</a></li>
								<li><a href="settings.php">Configurações</a></li>
								<li><a href="" class="logout">Sair da conta</a></li>
							</ul>
						</li>
					</ul>
					
				</div>
				<div class="col-2">
					<a href="\" class="logo"></a>
				</div>
				<div class="col-6">
					<ul class="navigation">
						<li>
							<a href="community.php">Comunidade<span><i class="far fa-angle-down"></i></span></a>

							<ul class="subnavi">
								<li><a href="news.php">Equipe</a></li>
								<li><a href="staffs.php">Colaboradores</a></li>
								<li><a href="photos.php">Lella Etiqueta</a></li>
							</ul>
						</li>
						<li>
							<a href="community.php">Hall Da Fama</a>

						
						</li>
						<li>
							<a href="#">VIP<span><i class="far fa-angle-down"></i></span></a>

							<ul class="subnavi">
								<li><a href="news.php">Sobre o VIP</a></li>
								<li><a href="staffs.php">Membros VIP</a></li>
								<li><a href="photos.php">Perguntas frequentes</a></li>
							</ul>
						</li>
						<li>
							<a href="community.php">Noticias<span><i class="far fa-angle-down"></i></span></a>

							<ul class="subnavi">
								<li><a href="news.php">News</a></li>
								<li><a href="staffs.php">Mitarbeiter</a></li>
								<li><a href="photos.php">Fotos</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>-->


	
