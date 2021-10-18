<?php 
	require_once('../../../global.php');

	$Functions::Session('connected');

	$page_name = 'Index';
	$page_title = HOTELNAME . ' - Crie sua conta, faça amigos e divirta-se gratuitamente.';
	$page_description = 'No ' . HOTELNAME . ', você pode fazer novos amigos, ganhar eventos, ser o mais rico, jogar e criar os seus próprios jogos, ser famoso, bater-papo, decorar e criar quartos incríveis com uma imensidão de mobílias disponíveis no nosso catálogo. Tudo isso, e muito mais, você encontrar aqui GRATUITAMENTE, o que está esperando para se registar neste incrível universo pixealado e fazer parte do nosso hotel??!!';
	$page_image =  URL . '/image.png';
	$keywords = "habbo, habbo pirata, habbo atlanta, atlanta, habbon, habblet, habbinc, habbig, habbink, habbolove, habblove, hybbe, Haibbo Hotel, habbolella, lella hotel, lella, iron, iron hotel, habbig hotel, crazzy, crazzy habbo, habbok, habbook hotel, habbinfo, habblive, live, hotel, habbonados, raduckets, catálogo atualizado, habbo futebol, mobis, mobilias, snow war, futebol, bola rebug, bola habbo, bola 100%, bola 8q, bola 6q, bola 4q, wireds, mascotes, habbocity, habbo.com, habbo.,habbo online, habbo lotado, habbo bom, habbo atualizado, habbo antigo, habbo r63, habbo dino, habbo dinossauro, habbo original, habbo oficial, retro server, habb, rabbo, hotel, Age, Like Hotel, Habbo Privado, Pirata, Privado, Habbo.com.br, habble, habblo, fresh-hotel, crazzy, habbo hotel, virtual, mundo, comunidade virtual, grátis, comunidade, avatar, bate papo, online, jovem, rpg, entre, social, grupos, fóruns, seguro, jogue, jogos, online, amigos, jovens, raros, mobis raros, colecionar, expressão, emblemas, diversão, música, celebridade, visita de famosos, celebridades, mmo, mmorpg, rpg online";
?>
<!DOCTYPE html>
<html>
	<head>
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
		<meta name="reply-to" content="email@undefined">
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

		<!-- Estilos -->
		<link rel="stylesheet" type="text/css" href="<?= CDN; ?>/assets/css/pop.css?<?= TIME; ?>" >
		<link rel="stylesheet" type="text/css" href="<?= CDN; ?>/assets/css/bootstrap/bootstrap-grid.css?<?= TIME; ?>" >
		<link rel="stylesheet" type="text/css" href="<?= CDN; ?>/assets/css/dutstrap.css?<?= TIME; ?>" >
		<!--<link type="text/css" href="<?= CDN; ?>/assets/css/lella-c.css" rel="stylesheet">--><!--Tema claro-->
		<link type="text/css" href="<?= CDN; ?>/assets/css/lella-e.css" rel="stylesheet"><!--Tema escuro-->
		<script src='https://www.hCaptcha.com/1/api.js' async defer></script>
	</head>
	<body class="main">
		<div class="cover-register"></div>
		<div class="container">
			<div class="row flex-column">
				<div class="flex-column mr-auto-left-right mr-bottom-5">
					<a href="<?= URL; ?>" class="logo mr-auto-left-right"></a>
				</div>
				<div class="register-area col-sm-7">
					<div class="register-errors"></div>
					<div class="flex-column mr-bottom-3">
						<label class="mr-bottom-1 color-5">
							<h5 class="bold">Nome de usuário</h5>
						</label>
						<input type="text" name="username" placeholder="Nome de usuário">
						<label class="mr-top-1">
							<h6 class="color-1">Deve ter dentre <b>3</b> a <b>16 caracteres</b> e não deve conter símbolos ou caracteres especiais.</h6>
						</label>
					</div>
					<div class="flex-column mr-bottom-3">
						<label class="mr-bottom-1 color-5">
							<h5 class="bold">E-mail</h5>
						</label>
						<input type="text" name="email" placeholder="E-mail">
						<label class="mr-top-1">
							<h6 class="color-1">Você vai precisar deste endereço de e-mail para <b>recuperar a sua conta</b> e realizar outras mudanças nela. Por favor, utilize um endereço de <b>e-mail válido</b>.</h6>
						</label>
					</div>
					<div class="flex-column mr-bottom-3">
						<label class="mr-bottom-1 color-5">
							<h5 class="bold">Senha</h5>
						</label>
						<input type="password" name="password" placeholder="Senha">
						<label class="mr-top-1">
							<h6 class="color-1">Segurança nunca é demais! Então use uma <b>senha segura</b> que você lembre dele para manter sua conta segura.</h6>
						</label>
					</div>
					<div class="flex-column mr-bottom-3">
						<label class="mr-bottom-1 color-5">
							<h5 class="bold">Confirme sua senha</h5>
						</label>
						<input type="password" name="password_c" placeholder="Confirme sua senha">
						<label class="mr-top-1">
							<h6 class="color-1">Agora confirme a sua senha pra vermos se você lembrou mesmo dela.</h6>
						</label>
					</div>
					<div class="flex-column">
						<label class="mr-bottom-2">
							<h5 class="bold color-5">Vamos ver se você é humano mesmo!</h5>
							<h6 class="color-1"><b>Verifique o hCaptcha</b> abaixo e logo apos crie a sua conta para fazer parte da diversão.</h6>
						</label>
						<div class="flex">
							<!--<div class="g-recaptcha" data-sitekey="6LeiZMwUAAAAABqdBwQo60gvZvmgP_3UhSCZXGY9" data-expired-callback="RecaptchaExpired"></div>-->
							<div class="h-captcha" data-sitekey="21799838-5a36-40e2-86f7-97b39e645bb5"></div>
							<button class="btn big purple register-button mr-left-2">Criar conta</button>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
				<?php
$Template->AddTemplate('others', 'bottom');
?>
			</div>
		</div>
	</body>
	<script type="text/javascript" src="<?= CDN; ?>/assets/js/jquery.js?<?= TIME; ?>"></script>
	<script type="text/javascript" src="https://www.google.com/recaptcha/api.js?<?= TIME; ?>"></script>
	<script type="text/javascript" src="<?= CDN; ?>/assets/js/main.js?<?= TIME; ?>"></script>
	<script type="text/javascript" src="<?= CDN; ?>/assets/js/ajax.js?<?= TIME; ?>"></script>
</html>
