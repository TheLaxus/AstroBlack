<?php 
	require_once('../../../global.php');

	$Functions::Session('disconnected');
	$Hotel::Manutention($user['rank']);


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
		<title>Client - <?= HOTELNAME; ?></title>
		<link rel="shortcut icon" href="<?= URL; ?>/favicon.ico?<?= TIME; ?>">
		<link rel="stylesheet" type="text/css" href="<?= CDN; ?>/assets/css/dutstrap.css?<?= TIME; ?>">
		<link rel="stylesheet" type="text/css" href="<?= CDN; ?>/assets/css/client.css?<?= TIME; ?>">
		<link rel="stylesheet" type="text/css" href="<?= CDN; ?>/assets/css/types.css?<?= TIME; ?>">

		<link rel="stylesheet" type="text/css" href="<?= CDN; ?>/assets/css/buttons.css?<?= TIME; ?>">


		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed|Ubuntu:300,300i,400,400i,500,500i,700,700i&display=swap">

		<script src="<?= CDN; ?>/assets/js/jquery.js?<?= TIME; ?>"></script>
		<script src="<?= CDN; ?>/assets/js/swfobject.js?<?= TIME; ?>"></script>

		<?php 
			if ($consult_client_version->rowCount() > 0) { 
				if ($result_client_version['version'] != '0') {
		?>
		<script type="text/javascript">
			var clientvars = {
				"client.allow.cross.domain": "1",
				"client.notify.cross.domain": "0",
				"connection.info.host": "127.0.0.1",
				"connection.info.port": "30000",
				"site.url": "<?= URL; ?>",
				"url.prefix": "<?= URL; ?>",
				"client.reload.url": "<?= URL; ?>/principal",
				"client.fatal.error.url": "<?= URL; ?>/principal",
				"client.connection.failed.url": "<?= URL; ?>/principal",
				"external.texts.txt": "<?= $Hotel::Settings('external_flash_texts'); ?>?<?= TIME; ?>",
				"external.variables.txt": "<?= $Hotel::Settings('external_variables'); ?>?<?= TIME; ?>",
				"furnidata.load.url": "<?= $Hotel::Settings('furnidata'); ?>?<?= TIME; ?>",
				"flash.dynamic.avatar.download.Settingsuration": "<?= $Hotel::Settings('figuremap'); ?>?<?= TIME; ?>",
				"%63%6f%6e%6e%65%63%74%69%6f%6e%2e%69%6e%66%6f%2e%68%6f%73%74": " <?= Security::encode($Hotel::Settings('ip')); ?>",
				"external.figurepartlist.txt": "<?= $Hotel::Settings('figuredata'); ?>",
				"external.override.texts.txt": "<?= $Hotel::Settings('external_flash_override_texts'); ?>",
				"flash.client.origin": "popup",
				"processlog.enabled": "1",
				"has.identity": "1",
				//"avatareditor.promohabbos":"",
				"client.starting" : "Aguarde, está carregando...",
				"client.starting.revolving": "Quando você menos esperar... terminaremos de carregar.../Carregando mensagem divertida! Por favor espere./Você quer batatas fritas para acompanhar?/Siga o pato amarelo./O tempo é apenas uma ilusão./Já chegamos?!/Eu gosto da sua camiseta./Olhe para um lado. Olhe para o outro. Pisque duas vezes. Pronto!/Não é você, sou eu./Shhh! Estou tentando pensar aqui./Carregando o universo de pixels.",
				"%63%6f%6e%6e%65%63%74%69%6f%6e%2e%69%6e%66%6f%2e%70%6f%72%74": "<?= Security::encode($Hotel::Settings('port')); ?>",
				"external.override.variables.txt": "<?= $Hotel::Settings('external_override_variables'); ?>?<?= TIME; ?>",
				"spaweb": "1",
				"use.sso.ticket" : "1",
				"sso.ticket" : "<?= $Functions::User('auth_ticket', USERNAME); ?>",
				"flash.client.url": "<?= $Hotel::Settings('flash_client_url'); ?>/"
			};

			var params = {
				"base": "<?= $Hotel::Settings('flash_client_url'); ?>/",
				"allowScriptAccess": "always",
				"menu": "false",
				"wmode": "opaque"
			};

			var player = {
				"ip": "",
				"port": "",
				"volume": ""
			};

			swfobject.embedSWF('<?= $Hotel::Settings('flash_client_url'); ?>/Habbo.swf', 'flash-container', '100%', '100%', '11.1.0', 'expressInstall.swf', clientvars, params, null, null);
		</script>

		<?php 
				}
			}
		?>

		<script src="<?= CDN; ?>/assets/js/client.js"></script>

	</head>
	<body>
	<?php 
			if ($consult_client_version->rowCount() > 0) { 
				if ($result_client_version['version'] != '0') {
		?>
				</div>
		<div id="flash-container" style="z-index: 99999 !important;">
			<div class="flash-disabled-container flex" style="background: url(<?= CDN; ?>/assets/img/background.png) rgb(53, 53, 53);">
				<div class="flash-disabled-content flex margin-auto">
					<div class="frank margin-right-md"></div>
					<div class="margin-auto-top-bottom flex-column">
						<label class="gray flex-column">
							<h1 class="bold uppercase margin-bottom-minm">Você está quase lá!</h1>
							<h5 class="margin-bottom-min">Agora so falta você permitir que o seu navegador possa executar o flash player para poder jogar.</h5>
							<h5 class="margin-bottom-min">E muito fácil! Basta você clicar no botão <b>Entrar no Hotel</b> e logo em seguida clicar em <b>Permitir</b> para poder executar o flash e você se juntar e desfrutar de toda a diversão que preparamos para você!</h5>
							<div class="padding-min general-radius">
								<label class="flex-column">
									<h5 class="margin-bottom-min uppercase">Não consegue ativar o <b>flash</b>?</h5>
									<h6>Está tendo problemas com a ativação do flash? Client branca ou preta? Não se preocupe, para tudo há uma solução!<br><br>E para isto você pode clicar <a class="bold">aqui</a> para, talvez, encontrar um possível solução e saber mais sobre tal problema.</h6>
								</label>
							</div>
						</label>
						<div class="flex margin-top-min margin-auto-left">
							<a href="https://get.adobe.com/flashplayer/" class="green-button-1 no-link" style="width: 180px;height: 48px;">
								<label class="margin-auto white">
									<h5>Entrar no Hotel</h5>
								</label>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>

			<?php } else { ?>
				<div class="client-version-container flex" style="z-index: 99999 !important;">
			<div class="client-version-content flex margin-auto">
				<div class="frank margin-right-md"></div>
				<div class="margin-auto-top-bottom flex-column">
					<label class="gray flex-column">
						<h1 class="bold uppercase">Escolha sua versão!</h1>
						<h5 class="margin-bottom-min">Agora você pode escolher a versão da client de acordo com o seu gosto!</h5>
						<h5>Você pode escolher a <b>client melhorada</b> caso queira animações mais rápidas e fluídas, ou escolher a <b>client normal</b> onde continua sendo a client padrão de sempre.</h5>
						<h5 class="margin-top-md">Você alterar a versão sempre que quiser nas configurações da sua client!</h5>
						<h5 class="bold margin-top-min uppercase">Escolha abaixo a versão desejada:</h5>
					</label>
					<div class="set-client-version flex margin-top-min">
						<button class="green-button-1 margin-right-min" version="60" style="width: 100%;height: 48px;">
							<label class="margin-auto white">
								<h5>Client melhorada</h5>
							</label>
						</button>
						<button class="green-button-1" version="24" style="width: 100%;height: 48px;">
							<label class="margin-auto white">
								<h5>Client normal</h5>
							</label>
						</button>
					</div>
				</div>
			</div>
		</div>
			
			<?php
				}
			} else {
		?>
		<div class="client-version-container flex" style="z-index: 99999 !important;">
			<div class="client-version-content flex margin-auto">
				<div class="frank margin-right-md"></div>
				<div class="margin-auto-top-bottom flex-column">
					<label class="gray flex-column">
						<h1 class="bold uppercase">Escolha sua versão!</h1>
						<h5 class="margin-bottom-min">Agora você pode escolher a versão da client de acordo com o seu gosto!</h5>
						<h5>Você pode escolher a <b>client melhorada</b> caso queira animações mais rápidas e fluídas, ou escolher a <b>client normal</b> onde continua sendo a client padrão de sempre.</h5>
						<h5 class="margin-top-md">Você alterar a versão sempre que quiser nas configurações da sua client!</h5>
						<h5 class="bold margin-top-min uppercase">Escolha abaixo a versão desejada:</h5>
					</label>
					<div class="set-client-version flex margin-top-min">
						<button class="green-button-1 margin-right-min" version="60" style="width: 100%;height: 48px;">
							<label class="margin-auto white">
								<h5 style="color:#fff;">Client melhorada</h5>
							</label>
						</button>
						<button class="green-button-1" version="24" style="width: 100%;height: 48px;">
							<label class="margin-auto white">
								<h5>Client normal</h5>
							</label>
						</button>
					</div>
				</div>
			</div>
		</div>
			<?php } ?>
	</body>
</html>