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

$consult_client_version = $db->prepare("SELECT version FROM cms_clients_beta WHERE user_id = ?");
$consult_client_version->bindValue(1, $user['id']);
$consult_client_version->execute();

$result_client_version = $consult_client_version->fetch(PDO::FETCH_ASSOC);

if ($consult_client_version->rowCount() == 0) {
	$insertFPS = $db->prepare("INSERT INTO cms_clients_beta (user_id, version) VALUES (?,?)");
	$insertFPS->bindValue(1, User::userData('id'));
	$insertFPS->bindValue(2, '24');
	$insertFPS->execute();
} else if ($result_client_version['version'] == 0) {
	$updateFPS = $db->prepare("UPDATE cms_clients_beta SET version = ? WHERE user_id = ?");
	$updateFPS->bindValue(1, '24');
	$updateFPS->bindValue(2, User::userData('id'));
	$updateFPS->execute();
}

?>
<!doctype html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<title>BETA - Lella</title>
	<base href="/">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="<?= CDN; ?>/assets/css/dutstrap.css?<?= TIME; ?>">
	<link rel="stylesheet" type="text/css" href="<?= CDN; ?>/assets/css/client.css?<?= TIME; ?>">
	<link rel="stylesheet" type="text/css" href="<?= CDN; ?>/assets/css/types.css?<?= TIME; ?>">
	<link type="text/css" href="<?= CDN; ?>/assets/css/lella-e.css" rel="stylesheet">
	<!--Tema escuro-->
	<link rel="stylesheet" type="text/css" href="<?= CDN; ?>/assets/css/buttons.css?<?= TIME; ?>">

	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
	<link rel="stylesheet" href="<?= URL; ?>/game/styles.3f08ab665bffd7c30247.css">

	<script>
		var player = {
			volume: 0.5,
			url: 'http://srv11.ipstm.net:7022/;'
		};
	</script>

</head>

<body>
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
	<app-root></app-root>
	<script>
		var NitroConfig = {
			<?php if ($consult_client_version->rowCount() > 0) { ?>
				configurationUrls: ['/game/renderer-config<?= $result_client_version['version']; ?>.json', '/game/ui-config.json'],
				sso: '<?= $Functions::User('auth_ticket', USERNAME); ?>'
		};
		<?php } else { ?>
			configurationUrls: ['/game/renderer-config24.json', '/game/ui-config.json'],
				sso: '<?= $Functions::User('auth_ticket', USERNAME); ?>'
			};
		<?php } ?>
	</script>
	<script src="<?= URL; ?>/game/runtime.89b19697d99ffd421697.js" defer></script>
	<script src="<?= URL; ?>/game/polyfills.69f5eeb47c76f3508a0b.js" defer></script>
	<script src="<?= URL; ?>/game/vendor.a9d82c76db70560a0888.js" defer></script>
	<script src="<?= URL; ?>/game/main.11be41cba051016c3ae1.js" defer></script>
	<script>
		console.log('%c Lella HTML5 desenvolvido por Emerson, Laxus e Wake. %c\nAgradecimentos à: Billsonnn e desenvolvedores do Nitro.', 'color: #black; font-size: 13pt; padding: 20px;', 'font-size: 9pt; padding: 5px 20px 20px;');
	</script>




			<script type="text/javascript" src="<?= CDN; ?>/assets/js/jquery.js?<?= TIME; ?>"></script>
			<script type="text/javascript" src="<?= CDN; ?>/assets/js/main.js?<?= TIME; ?>"></script>
			<script type="text/javascript" src="<?= CDN; ?>/assets/js/ajax.js?<?= TIME; ?>"></script>
			<script src="<?= CDN; ?>/assets/js/radio.js?<?= time(); ?>"></script>

			<script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.1.2/howler.min.js"></script>

			<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
			<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>


</body>

</html>