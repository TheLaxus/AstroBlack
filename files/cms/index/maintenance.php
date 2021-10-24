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
						<img class="error-image-main" src="<?= CDN; ?>/assets/img/main_frank.png" />

						<a class="btn purple main login-staff link width-fit mr-top-1">Acesso ao hotel⠀⠀<img src="https://2.bp.blogspot.com/-a9e2N1_yJ8I/XK0oYoYMACI/AAAAAAABOsg/WSNqdOUb7cIwMAfKnQ-UT6HhidIEHT7RwCKgBGAs/s1600/Image%2B1846.png" style="position:absolute;margin-top:-3px;margin-left:0px;z-index:0"></a><br><br></p>
				</div>
			</div>
			<div class="social-main">
				<a href="https://twitter.com/hp_lella" target="_blank"><img src="<?= CDN; ?>/assets/img/tt.png" title="Siga nosso twitter!" style="position:absolute;width:37px; margin-left:10px;top:-4px"></a>
				<a href="https://discord.gg/WnRdQqD7zb" target="_blank"><img src="<?= CDN; ?>/assets/img/dc.png" title="Entre no nosso Discord!" style="position:absolute;width:52px; margin-left:26px;"></a>
				<a href="https://facebook.com/equipecrazzy" target="_blank"><img src="<?= CDN; ?>/assets/img/fb.png" title="Siga nosso Facebook!" style="position:absolute;width:28px; margin-left:59px;"></a>
				<a href="https://www.instagram.com/hplella/" target="_blank"><img src="<?= CDN; ?>/assets/img/insta.png" title="Siga nosso instagram!" style="position:relative;width:29px; margin-left:81px;"></a>
			</div>

			<div id="counter-main">
				<div id="counter-column" style="background-color:#aaa;"><span></span>
					<div id="days">&nbsp;</div>
				</div>
				<div id="counter-column" style="background-color:#bbb;"><span></span>
					<div id="hours">&nbsp;</div>
				</div>
				<div id="counter-column" style="background-color:#aaa;"><span></span>
					<div id="mins">&nbsp;</div>
				</div>
				<div id="counter-column" style="background-color:#bbb;"><span></span>
					<div id="secs">&nbsp;</div>
				</div>
			</div>
		</div>
	</div>

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
</div>

<div class="modal-info-a" id="exampleModal">
	<div class="modal staff-login" style="width:600px">
		<div class="login-staff flex-column" >
			<div class="errors-area"></div>
			<label class="mr-bottom-1">
				<h2 class="bold uppercase">UM LELLA MELHOR PARA TODOS!</h2>
				<img style="position:relative;float:right;" src="https://cdn.discordapp.com/attachments/790287842873704458/901639364113727518/teaser_descone.png" />
				<br>
				<h4>Para você que tem uma má conexão de internet, isso agora acabou! O Lella encontra-se hospedado em servidores de <b>localidade brasileira</b> para diminuir o <b>lag e garantir uma boa jogatina</b> a todos os nossos jogadores!</h4>
				<br>
				<a href="https://discord.gg/WnRdQqD7zb" target="_blank" class="btn purple main login-staff link width-fit mr-top-1">Saiba mais no nosso discord⠀⠀<img src="https://2.bp.blogspot.com/-ewCmbBLmwJQ/XK0oYo3mucI/AAAAAAABOsg/knrP3-QOugwU-J_O2LNkqZ8G7I2oLXACgCKgBGAs/s1600/Image%2B271.png" style="position:absolute;margin-top:-1px;margin-left:0px;z-index:0"></a><br><br></p>
			</label>
			</div>
	</div>
</div>

</body>
<script type="text/javascript" src="<?= CDN; ?>/assets/js/jquery.js?<?= TIME; ?>"></script>
<script type="text/javascript" src="<?= CDN; ?>/assets/js/main.js?<?= TIME; ?>"></script>
<script type="text/javascript" src="<?= CDN; ?>/assets/js/ajax.js?<?= TIME; ?>"></script>
<script type="text/javascript" src="<?= CDN; ?>/assets/js/maintenance.js?<?= TIME; ?>"></script>
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

	$(window).on('load',function(){
        $('.modal-info-a').modal('show');
		$('.modal-info-a').fadeIn(250);
    });

	$(document).on('click', '.modal-info-a', function() {
		if (!$(this).find('.modal').is(':hover')) {
			$(this).fadeOut(250);
		}
	});
</script>
</html>
