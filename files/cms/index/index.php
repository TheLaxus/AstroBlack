<?php 
	require_once('../../../global.php');

	$Functions::Session('connected');

	$page_name = 'Index';
	$page_title = HOTELNAME . ' - Entre na sua conta, faça amigos e divirta-se gratuitamente.';
	$page_description = 'No ' . HOTELNAME . ', você pode fazer novos amigos, ganhar eventos, ser o mais rico, jogar e criar os seus próprios jogos, ser famoso, bater-papo, decorar e criar quartos incríveis com uma imensidão de mobílias disponíveis no nosso catálogo. Tudo isso, e muito mais, você encontrar aqui GRATUITAMENTE, o que está esperando para se registar neste incrível universo pixealado e fazer parte do nosso hotel??!!';
	$page_image =  URL . '/image.png';
	$keywords = "habbo, habbo pirata, habbo atlanta, atlanta, habbon, habblet, habbinc, habbig, habbink, habbolove, habblove, hybbe, Haibbo Hotel, habbolella, lella hotel, lella, iron, iron hotel, habbig hotel, crazzy, crazzy habbo, habbok, habbook hotel, habbinfo, habblive, live, hotel, habbonados, raduckets, catálogo atualizado, habbo futebol, mobis, mobilias, snow war, futebol, bola rebug, bola habbo, bola 100%, bola 8q, bola 6q, bola 4q, wireds, mascotes, habbocity, habbo.com, habbo.,habbo online, habbo lotado, habbo bom, habbo atualizado, habbo antigo, habbo r63, habbo dino, habbo dinossauro, habbo original, habbo oficial, retro server, habb, rabbo, hotel, Age, Like Hotel, Habbo Privado, Pirata, Privado, Habbo.com.br, habble, habblo, fresh-hotel, crazzy, habbo hotel, virtual, mundo, comunidade virtual, grátis, comunidade, avatar, bate papo, online, jovem, rpg, entre, social, grupos, fóruns, seguro, jogue, jogos, online, amigos, jovens, raros, mobis raros, colecionar, expressão, emblemas, diversão, música, celebridade, visita de famosos, celebridades, mmo, mmorpg, rpg online";

	if (isset($user['username'])) {
		$Hotel::Manutention($user['rank']);
	} else {
		$Hotel::Manutention();
	}
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
	</head>
	<body class="main">
		<div class="cover">
			<div class="hotel"></div>
		</div>
		<div class="container flex-column">
			<div class="header-content flex mr-bottom-4">
				<div class="row mr-auto-top">
					<div class="col-md-12 flex">
						<div class="logo mr-auto-top-bottom" id="logo-index"></div>
						<!--<div class="online-count mr-auto-top-bottom flex">
							<h5 class="color-2 mr-auto-top-bottom"><?= USERS; ?></h5>
						</div>-->
					</div>
				</div>
			</div>

			<div class="row mr-bottom-5">
				<div class="col-md-5">
					<div class="login-area">
						<label class="color-1 mr-bottom-3 flex-column">
							<h1 class="bold fs-600">Login</h1>
							<h5 class="color-1">Entre na sua conta para jogar conosco!</h5>
						</label>
						<div class="login-area flex-column">
							<div class="errors-area"></div>
							<div class="flex-column mr-bottom-4">
								<label class="mr-bottom-1 color-5">
									<h5 class="bold">Usuário</h5>
								</label>
								<form method="POST">
								<input type="text" name="username" class="form-control" placeholder="Usuário">
							</div>
							<div class="flex-column mr-bottom-3">
								<label class="mr-bottom-1 color-5">
									<h5 class="bold">Senha</h5>
								</label>
								<input type="password" name="password" class="form-control" placeholder="Senha">
							</div>

							<button class="btn big purple login-button">Entrar</button>
</form>
						</div>
					</div>
					<div class="row">
						<label class="col-md-12 mr-top-5 mr-bottom-5 color-5">
							<h5 class="uppercase fw-600 fs-12 text-center">E se você não tiver uma conta...</h5>
						</label>
						<div class="col-md-12">
							<a href="<?= URL; ?>/register" class="btn big orange register-button">Registre-se agora mesmo!</a>
						</div>
					</div>
				</div>
			</div><br><br><br>
			<div class="row mr-top-5">
				<div class="col-md-12 flex-column">
					<label class="mr-bottom-1 flex-column">
						<h2 class="color-1 bold">Últimas noticias</h2>
						<h5>Veja aqui o que nossos jornalistas prepararam pra você.</h5>
					</label>
					<div class="row flex">
					<?php 
						$consult_last_articles = $db->prepare("SELECT id,title,subtitle,image FROM cms_news ORDER BY timestamp DESC LIMIT 6");
						$consult_last_articles->execute();

						if ($consult_last_articles->rowCount() > 0) {
							while ($result_last_articles = $consult_last_articles->fetch(PDO::FETCH_ASSOC)) {
					?>
						<a href="<?= URL . '/article/' . $result_last_articles['id']; ?>" class="article-featured flex-column no-link">
							<div class="article-featured-thumbnail" style="background-image: url('<?= $result_last_articles['image']; ?>');"></div>
							<label class="color-1 flex-column pointer-none">
								<h4 class="bold"><?= $result_last_articles['title']; ?></h4>
								<h5><?= $result_last_articles['subtitle']; ?></h5>
							</label>
						</a>
					<?php 	}
						} else { 
					?>
					<?php } ?>
					</div>
				</div>
			</div>
			
<?php
$Template->AddTemplate('others', 'bottom');
?>

	</body>
	<script type="text/javascript" src="<?= CDN; ?>/assets/js/jquery.js?<?= TIME; ?>"></script>
	<script type="text/javascript" src="<?= CDN; ?>/assets/js/main.js?<?= TIME; ?>"></script>
	<script type="text/javascript" src="<?= CDN; ?>/assets/js/ajax.js?<?= TIME; ?>"></script>
</html>