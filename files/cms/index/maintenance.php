<?php
require_once('../../../global.php');

$Functions::Session('connected');

if ($Hotel::Manutention('state') == 'disabled') {
	Redirect(URL);
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Manutenção - <?= HOTELNAME; ?></title>
	<link rel="icon" href="<?= URL; ?>/favicon.ico">
	<link rel="stylesheet" type="text/css" href="<?= CDN; ?>/assets/css/maintenance.css?<?= TIME; ?>">
	<link rel="stylesheet" type="text/css" href="<?= CDN; ?>/assets/css/dutstrap.css?<?= TIME; ?>">
	<link type="text/css" href="<?= CDN; ?>/assets/css/lella-e.css" rel="stylesheet">
	<!--Tema escuro-->
	<script type="text/javascript" src="<?= CDN; ?>/assets/js/vendor.js"></script>
	<script type="text/javascript" src="<?= CDN; ?>/assets/js/app.js"></script>
</head>

<body class="main">
	<div class="container flex" style="position:relative;top:30%;height:0px">
		<div class="logo"></div>
		<div id="content-box" class="profile" style="height:200px;">
			<div class="bg"></div>
			<div class="overlay">
				<div class="username">O <?= HOTELNAME; ?> está em manutenção!</div>
				<div class="motto">Parece que o Frank pisou em alguns fios espalhados pelo nosso servidor, brincadeirinha não vamos por a culpa no coitado...</h5>
					<h5>Nosso servidor está em manutenção para resolver falhas e realizar atualizações, e por isso nossa equipe de desenvolvimento <p> está a postos pra resolver o quanto antes, enquanto isso <b>fique ligado nas nossas redes sociais!</b></p>
						<img class="error-image-main" src="https://1.bp.blogspot.com/-tS8wNcYFSQQ/X7vniDAGJEI/AAAAAAABfW4/eSEMf3ltz6oskFFt-UDaFXtR3qqkHddXQCPcBGAsYHg/s0/notification_image_caution.png" />

						<a class="btn purple main login-staff link width-fit mr-top-1">Acesso ao hotel⠀⠀<img src="https://2.bp.blogspot.com/-a9e2N1_yJ8I/XK0oYoYMACI/AAAAAAABOsg/WSNqdOUb7cIwMAfKnQ-UT6HhidIEHT7RwCKgBGAs/s1600/Image%2B1846.png" style="position:absolute;margin-top:-3px;margin-left:0px;z-index:1"></a><br><br></p>
				</div>
			</div>
			<div class="social-main">
				<a href="https://twitter.com/hp_lella" target="_blank"><img src="https://cliply.co/wp-content/uploads/2019/07/371907030_TWITTER_ICON_1080.png" title="Siga nosso twitter!" style="position:absolute;width:37px; margin-left:10px;top:-4px"></a>
				<a href="https://discord.gg/WnRdQqD7zb" target="_blank"><img src="https://logosmarcas.net/wp-content/uploads/2020/12/Discord-Emblema.png" title="Entre no nosso Discord!" style="position:absolute;width:52px; margin-left:26px;"></a>
				<a href="https://facebook.com/equipecrazzy" target="_blank"><img src="https://logopng.com.br/logos/facebook-13.png" title="Siga nosso Facebook!" style="position:absolute;width:28px; margin-left:59px;"></a>
				<a href="https://www.instagram.com/hplella/" target="_blank"><img src="https://assets.itpacporto.edu.br/arquivos/2019/ninter/instagram.png" title="Siga nosso instagram!" style="position:relative;width:29px; margin-left:81px;"></a>
			</div>
		</div>
	</div>
</body>

<div class="modal-area" style="display: none;">
	<div class="modal staff-login">
		<div class="login-staff flex-column">
			<div class="errors-area"></div>
			<label class="mr-bottom-3">
				<h2 class="bold uppercase">Login staff</h2>
				<h6>Você é um membro da equipe? Faça seu login aqui!</h6>
			</label>
			<div class="flex-column mr-bottom-2">
				<label class="mr-bottom-1">
					<h5 class="bold">Usuário(a)</h5>
				</label>
				<input type="text" name="username">
			</div>
			<div class="flex-column mr-bottom-2">
				<label class="mr-bottom-1">
					<h5 class="bold">Senha</h5>
				</label>
				<input type="password" name="password">
			</div>
			<button class="staff-login btn purple big">Entrar como Staff</button>
		</div>
	</div>
</div>

</body>
<script type="text/javascript" src="<?= CDN; ?>/assets/js/jquery.js?<?= TIME; ?>"></script>
<script type="text/javascript" src="<?= CDN; ?>/assets/js/main.js?<?= TIME; ?>"></script>
<script type="text/javascript" src="<?= CDN; ?>/assets/js/ajax.js?<?= TIME; ?>"></script>
<script type="text/javascript">
	$(document).on('click', 'a.login-staff', function() {
		if ($('.modal-area > .login-staff')) {
			$('.modal-area').fadeIn(250);
		}
	});

	$(document).on('click', '.modal-area', function() {
		if (!$(this).find('.modal').is(':hover')) {
			$(this).fadeOut(250);
		}
	});
</script>

</html>
