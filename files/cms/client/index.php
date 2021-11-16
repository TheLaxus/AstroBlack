<?php
require_once('../../../global.php');

$Functions::Session('disconnected');

if (isset($_GET['room']) && is_numeric($_GET['room'])) {
	$room = $_GET['room'];

	if ($room > 0) {
		$consult_room = $db->prepare("SELECT id FROM rooms WHERE id = ? LIMIT 1");
		$consult_room->bindValue(1, $room);
		$consult_room->execute();

		if ($consult_room->rowCount() == 1) {
			$result_room = $consult_room->fetch(PDO::FETCH_ASSOC);

			if ($user['online'] == '1') {
				$have_room_loader = true;
				$have_room = true;
			} else {
			}
		} else {
			$have_room_error = true;
		}
	}
}

$consult_if_users_settings = $db->prepare("SELECT expire FROM player_subscriptions WHERE user_id = ?");
$consult_if_users_settings->bindValue(1, $user['id']);
$consult_if_users_settings->execute();

if ($consult_if_users_settings->rowCount() > 0) {
	$result_if_users_settings = $consult_if_users_settings->fetch(PDO::FETCH_ASSOC);

	$timestamp_now = TIME;
	$timestamp_new_hc = '1893549600';
	$timestamp_hc = $result_if_users_settings['expire'];

	if ($timestamp_now > $timestamp_hc || $result_if_users_settings['expire'] == NULL || $result_if_users_settings['expire'] == '' || $result_if_users_settings['expire'] == '0') {
		$update_hc_timestamp = $db->prepare("UPDATE players_subscriptions SET expire = ? WHERE user_id = ?");
		$update_hc_timestamp->bindValue(1, $timestamp_new_hc);
		$update_hc_timestamp->bindValue(2, $user['id']);
		$update_hc_timestamp->execute();
	}
} else {
	$insert_users_settings = $db->prepare("INSERT INTO player_subscriptions (user_id, expire) VALUES (?,?)");
	$insert_users_settings->bindValue(1, $user['id']);
	$insert_users_settings->bindValue(2, '1893549600');
	$insert_users_settings->execute();
}

$consult_client_version = $db->prepare("SELECT version FROM cms_clients WHERE user_id = ?");
$consult_client_version->bindValue(1, $user['id']);
$consult_client_version->execute();
$result_client_version = $consult_client_version->fetch(PDO::FETCH_ASSOC);


if ($consult_client_version->rowCount() == 0) {
	$insertFPS = $db->prepare("INSERT INTO cms_clients (user_id, version) VALUES (?,?)");
	$insertFPS->bindValue(1, User::userData('id'));
	$insertFPS->bindValue(2, '24');
	$insertFPS->execute();
} else if ($result_client_version['version'] == 0) {
	$updateFPS = $db->prepare("UPDATE cms_clients SET version = ? WHERE user_id = ?");
	$updateFPS->bindValue(1, '24');
	$updateFPS->bindValue(2, User::userData('id'));
	$updateFPS->execute();
}



?>
<!DOCTYPE html>
<html oncontextmenu="false">

<head>
	<base href="<?= URL; ?>">
	<meta charset="utf-8">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
	<meta http-equiv="content-language" content="pt-br">
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
	<meta name="robots" content="index,follow,all">
	<meta name="googlebot" content="index,follow,all">
	<title>Client - <?= HOTELNAME; ?></title>
	<link rel="shortcut icon" href="<?= URL; ?>/favicon.ico?<?= TIME; ?>">
	<link rel="stylesheet" type="text/css" href="<?= CDN; ?>/assets/css/dutstrap.css?<?= TIME; ?>">
	<link rel="stylesheet" type="text/css" href="<?= CDN; ?>/assets/css/client.css?<?= TIME; ?>">
	<link rel="stylesheet" type="text/css" href="<?= CDN; ?>/assets/css/types.css?<?= TIME; ?>">
	<link type="text/css" href="<?= CDN; ?>/assets/css/lella-e.css" rel="stylesheet">
	<!--Tema escuro-->
	<link rel="stylesheet" type="text/css" href="<?= CDN; ?>/assets/css/buttons.css?<?= TIME; ?>">


	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed|Ubuntu:300,300i,400,400i,500,500i,700,700i&display=swap">

	<script src="<?= CDN; ?>/assets/js/jquery.js?<?= TIME; ?>"></script>


	<script src="<?= CDN; ?>/assets/js/swfobject.js?<?= TIME; ?>"></script>

			<script type="text/javascript">
				var clientvars = {
					"client.allow.cross.domain": "1",
					"client.notify.cross.domain": "0",
					"site.url": "<?= URL; ?>",
					"url.prefix": "<?= URL; ?>",
					"client.reload.url": "<?= URL; ?>/me",
					"client.fatal.error.url": "<?= URL; ?>/me",
					"client.connection.failed.url": "<?= URL; ?>/me",
					"external.texts.txt": "<?= $Hotel::Settings('external_flash_texts'); ?>?v=12",
					"external.variables.txt": "<?= $Hotel::Settings('external_variables'); ?>?v=14",
					"external.override.variables.txt": "<?= $Hotel::Settings('external_override_variables'); ?>?v=13",
					"%63%6f%6e%6e%65%63%74%69%6f%6e%2e%69%6e%66%6f%2e%68%6f%73%74": "<?= Security::encode("102.165.46.178"); ?>",
					"productdata.load.url": "<?= $Hotel::Settings('productdata'); ?>?v=1",
					"furnidata.load.url": "<?= $Hotel::Settings('furnidata'); ?>?v=11",
					"flash.dynamic.avatar.download.configuration": "<?= $Hotel::Settings('figuremap'); ?>?v=15",
					"external.figurepartlist.txt": "<?= $Hotel::Settings('figuredata'); ?>?v=20",
					"external.override.texts.txt": "<?= $Hotel::Settings('external_flash_override_texts'); ?>?v=4",
					"flash.client.origin": "popup",
					"processlog.enabled": "1",
					"has.identity": "1",
					//"avatareditor.promohabbos":"",
					"client.starting": "Aguarde, está carregando...",
					"client.starting.revolving": "Quando você menos esperar... terminaremos de carregar.../Carregando mensagem divertida! Por favor espere./Você quer batatas fritas para acompanhar?/Siga o pato amarelo./O tempo é apenas uma ilusão./Já chegamos?!/Eu gosto da sua camiseta./Olhe para um lado. Olhe para o outro. Pisque duas vezes. Pronto!/Não é você, sou eu./Shhh! Estou tentando pensar aqui./Carregando o universo de pixels.",
					"%63%6f%6e%6e%65%63%74%69%6f%6e%2e%69%6e%66%6f%2e%70%6f%72%74": "<?= Security::encode("30000"); ?>",
					"external.override.variables.txt": "<?= $Hotel::Settings('external_override_variables'); ?>",
					"spaweb": "1",
					"use.sso.ticket": "1",
					"sso.ticket": "<?= $Functions::User('auth_ticket', USERNAME); ?>",
					"flash.client.url": "<?= $Hotel::Settings('flash_client_url'); ?>/",
					<?php if (isset($_GET['room']) && is_numeric($_GET['room'])) { ?> "forward.type": "2",
						"forward.id": "<?= $room; ?>",
					<?php } else if ($Hotel::Settings('force_room') != false) { ?> "forward.type": "2",
						"forward.id": "<?= $Hotel::Settings('force_room_id'); ?>",
					<?php } else if ($Hotel::Settings('force_room') != true && $user['home_room'] != '0') { ?> "forward.type": "2",
						"forward.id": "<?= $user['home_room']; ?>",
					<?php } ?> "user.hash": "<?= sha1(md5($user['username']) . sha1(Functions::Random('random_number', '50'))); ?>",
					"user.timestamp": "<?= date('Y-m-d H:i:s'); ?>"
				};

				var params = {
					"base": "<?= $Hotel::Settings('flash_client_url'); ?>/",
					"allowScriptAccess": "always",
					"menu": "false",
					"wmode": "opaque"
				};

				var player = {
					volume: 0.5,
					url: 'http://srv11.ipstm.net:7022/;'
				};

				<?php if ($consult_client_version->rowCount() > 0) { ?>
				swfobject.embedSWF('<?= $Hotel::Settings('flash_client_url'); ?>/Habbo<?= $result_client_version['version']; ?>.swf?v=13', 'flash-container', '100%', '100%', '11.1.0', 'expressInstall.swf', clientvars, params, null, null);
				<?php } else { ?>
					swfobject.embedSWF('<?= $Hotel::Settings('flash_client_url'); ?>/Habbo24.swf?v=13', 'flash-container', '100%', '100%', '11.1.0', 'expressInstall.swf', clientvars, params, null, null);
				<?php } ?>
			</script>

			<script src="<?= CDN; ?>/assets/js/habboapi.js"></script>

	<script src="<?= CDN; ?>/assets/js/radio.js?<?= time(); ?>"></script>


	<script src="<?= CDN; ?>/assets/js/client.js?<?= TIME ?>"></script>
	<!--<script src="<?= CDN; ?>/assets/js/socket.js"></script>-->
</head>

<body>

	<div class="client-ui flex">
		<!--<button class="client-expand flex margin-right-minm" tooltip="Colocar a client em modo tela cheia.">
			<icon name="expand" class="margin-auto"></icon>
		</button>
		<button class="client-unfreeze flex margin-right-minm" tooltip="Descongelar a client.">
			<icon name="flake" class="margin-auto"></icon>
		</button>
		<button class="client-refresh flex" tooltip="Recarregar a client." onclick="window.location.reload();">
			<icon name="reload" class="margin-auto"></icon>
		</button>-->
	</div>
	<div class="webview-client">

		<div class="client-notification flex-column">
			<button class="client-notification-closeall bold fs-14 uppercase">Fechar tudo</button>
			<div class="client-notification-area"></div>
		</div>
		<div class="haibbo-player-area">
			<div class="haibbo-player maximized loadding" style="top: 0px">
				<div class="player-min haibbo-player-large-control"></div>
				<div class="haibbo-player-large flex-column">
					<div class="haibbo-player-large-area flex">
						<div class="haibbo-player-speaker">
							<div class="haibbo-player-speaker-imager" style="background-image: unset;"></div>
						</div>
						<div class="haibbo-player-infos">
							<div class="haibbo-player-infos-speaker">
								<span>...</span>
							</div>
							<div class="haibbo-player-infos-programation">
								<span>...</span>
							</div>
							<div class="haibbo-player-infos-listeners">
								<span>... ouvintes</span>
							</div>
						</div>
						<div class="haibbo-player-large-control"></div>
					</div>
					<div class="player-large-actions flex">
						<div class="player-large-actions-volume">
							<div class="player-large-actions-volume-bar"></div>
						</div>
						<div class="player-large-actions-playpause paused"></div>
						<div class="player-large-actions-reconnect"></div>
						<div class="player-large-actions-dragplayer"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>


			<div id="flash-container" style="z-index: 99999 !important;">
				<div class="container">
					<div class="row">
						<div class="logo"></div>
						<div class="col-12">
							<div id="content-box">
								<div class="title-box png20">
									Seu navegador não suporta mais o <b>Flash Player</b>! Escolha uma das opções abaixo para continuar jogando o <?= HOTELNAME; ?>.
								</div>
							</div>
						</div>
						<div class="col-7">
							<div id="content-box">
								<div class="title-box png20 bg-h">
									<div class="title-v">JOGAR VERSÃO HTML (NOVO)</div>
									<div class="png20"></div>
								</div>
								<a href="/html5 " class="btn purple save" id="html-v" style="float:right;position:relative;padding:10px;margin-top:-30px;left:-11px">Jogar versão HTML</a>
							</div>
						</div>

						<div class="col-6">
							<div id="content-box">
								<div class="title-box png20 bg-o-a">
									<div class="title-v">JOGAR COM APLICATIVO (PC)</div>
									<div class="desc-v">Jogue sem usar o navegador somente baixando o nosso aplicativo exclusivo.</div>
									<div class="png20"></div>
								</div>
								<form method="POST" class="download-app">
									<a href="https://mega.nz/file/92R1wKjK#lO4K6Qb8hZ-KSLcXocWfsjfTryc5kWLa66-cUVal93o" target="_blank" class="btn purple save" style="float:right;position:relative;padding:10px;margin-top:-30px;left:-11px">Baixar aplicativo windows</a>
								</form>
							</div>
						</div>

						<div class="col-5">
							<div id="content-box">
								<div class="title-box png20 bg-o">
									<div class="title-v">JOGAR NO PUFFIN (ANDROID/IOS)</div>
									<br>
									<div class="png20"></div>
								</div>
								<form method="POST" class="download-puffin">
									<a href="https://play.google.com/store/apps/details?id=com.cloudmosa.puffinFree&hl=pt_BR&gl=US" target="_blank" class="btn purple save" style="float:right;position:relative;padding:10px;margin-top:-30px;left:-11px">Baixar aplicativo</a>
								</form>
							</div>
						</div>
					</div>

			</div>

			<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
			<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>


</body>

</html>