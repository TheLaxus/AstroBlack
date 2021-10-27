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

</head>
<body>
<?php
	if ($consult_client_version->rowCount() > 0) {
		if ($result_client_version['version'] != '0') {
?>
    <app-root></app-root>
   <script>
   var NitroConfig = {
            configurationUrls: [ '/game/renderer-config<?=$result_client_version['version'];?>.json', '/game/ui-config.json' ],
            sso: '<?= $Functions::User('auth_ticket', USERNAME); ?>'
        };

    </script>
      <script src="<?= URL; ?>/game/runtime.89b19697d99ffd421697.js" defer></script>
    <script src="<?= URL; ?>/game/polyfills.69f5eeb47c76f3508a0b.js" defer></script>
    <script src="<?= URL; ?>/game/vendor.a9d82c76db70560a0888.js" defer></script>
    <script src="<?= URL; ?>/game/main.11be41cba051016c3ae1.js" defer></script>
  	<script>console.log('%c Lella HTML5 desenvolvido por Emerson, Laxus e Wake. %c\nAgradecimentos à: Billsonnn e desenvolvedores do Nitro.', 'color: #black; font-size: 13pt; padding: 20px;', 'font-size: 9pt; padding: 5px 20px 20px;');</script>

	  <?php
		} else {?>

<div class="flash-disabled-container flex" style="z-index: 99999 !important; background: url(../img/background.png) rgb(53, 53, 53);">
		<div class="container">
			<div class="row">
				<div class="logo"></div>
				<div class="col-12">
					<div id="content-box">
						<div class="title-box png20">
							Escolha a versão que deseja jogar o <?= HOTELNAME;?> Hotel!
						</div>
					</div>
				</div>
				<div class="col-6">
					<div id="content-box">
						<div class="title-box png20 bg-h">
							<div class="title-v">JOGAR VERSÃO HTML (NOVO)</div>
							<div class="png20"></div>
						</div>
						<button type="submit" class="btn purple save" id="html-v" data-modal="html" style="float:right;position:relative;padding:10px;margin-top:-30px;left:-11px">Jogar versão HTML</button>
					</div>
				</div>

				<div class="col-6">
					<div id="content-box">
						<div class="title-box png20 bg-f">
							<div class="title-v">JOGAR VERSÃO FLASH (ANTIGO)</div>
							<div class="png20"></div>
						</div>
						<button type="submit" class="btn green save" id="flash-v" data-modal="flash" style="float:right;position:relative;padding:10px;margin-top:-30px;left:-11px">Jogar versão FLASH</button>
					</div>
				</div>

				<div class="col-7">
					<div id="content-box">
						<div class="title-box png20 bg-o-a">
							<div class="title-v">JOGAR COM APLICATIVO (PC)</div>
							<div class="desc-v">Jogue sem usar o navegador somente baixando o nosso aplicativo exclusivo.</div>
							<div class="png20"></div>
						</div>
						<button class="btn purple save" style="float:right;position:relative;padding:10px;margin-top:-30px;left:-11px">Baixar aplicativo windows</button>
					</div>
				</div>

				<div class="col-5">
					<div id="content-box">
						<div class="title-box png20 bg-o">
							<div class="title-v">JOGAR NO PUFFIN (ANDROID/IOS)</div>
							<br>
							<div class="png20"></div>
						</div>
						<button class="btn purple save" style="float:right;position:relative;padding:10px;margin-top:-30px;left:-11px">Baixar aplicativo</button>
					</div>
				</div>
			</div>


			<div class="modal-container" id="html" data-modal="html">
				<div id="modal-content">
					<div id="news-modal">
						<div class="col-12">
							<div id="content-box" style="height:190px;">
								<div class="title-box png20">
									<div class="title"> ESCOLHA O TIPO DE CLIENT (HTML)</div>
									<button type="ok" class="close close-modal" style="position:relative;top:-20px;float:right;right:14px"></button>

									<div class="margin-top-min">
										<div class="set-client-version">
										<form method="POST" class="set-client-beta-24">
											<button type="submit" class="btn purple big next-register" versionBeta_24="24" class="button" style="width: 100%; height: 45px;margin-bottom:7px;margin-top:20px">Jogar em 24 fps</button>
										</form>	
										<form method="POST" class="set-client-beta-60">
											<button type="submit" class="btn purple big next-register" versionBeta_60="60" class="button" style="width: 100%; height: 45px;">Jogar em 60 fps</button>
										</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="modal-container" id="flash" data-modal="flash">
				<div id="modal-content">
					<div id="news-modal">
						<div class="col-12">
							<div id="content-box" style="height:190px;">
								<div class="title-box png20">
									<div class="title"> ESCOLHA O TIPO DE CLIENT (FLASH)</div>
									<button type="ok" class="close close-modal" style="position:relative;top:-20px;float:right;right:14px"></button>

									<div class="margin-top-min">
										<div class="set-client-version">
										<form method="POST" class="set-client-flash-24">
											<button type="submit" class="btn purple big next-register" version_24="24" class="button" style="width: 100%; height: 45px;margin-bottom:7px;margin-top:20px">Jogar em 24 fps</button>
										</form>
										<form method="POST" class="set-client-flash-60">
											<button type="submit" class="btn purple big next-register" version_60="60" class="button" style="width: 100%; height: 45px;">Jogar em 60 fps</button>
										</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<script src="<?= CDN; ?>/assets/js/client.js?<?=TIME?>"></script>

			<script type="text/javascript" src="<?= CDN; ?>/assets/js/jquery.js?<?= TIME; ?>"></script>
			<script type="text/javascript" src="<?= CDN; ?>/assets/js/main.js?<?= TIME; ?>"></script>
			<script type="text/javascript" src="<?= CDN; ?>/assets/js/ajax.js?<?= TIME; ?>"></script>
			<?php } 
				} else {  ?>
				<div class="flash-disabled-container flex" style="z-index: 99999 !important; background: url(../img/background.png) rgb(53, 53, 53);">
		<div class="container">
			<div class="row">
				<div class="logo"></div>
				<div class="col-12">
					<div id="content-box">
						<div class="title-box png20">
							Escolha a versão que deseja jogar o <?= HOTELNAME;?> Hotel!
						</div>
					</div>
				</div>
				<div class="col-6">
					<div id="content-box">
						<div class="title-box png20 bg-h">
							<div class="title-v">JOGAR VERSÃO HTML (NOVO)</div>
							<div class="png20"></div>
						</div>
						<button type="submit" class="btn purple save" id="html-v" data-modal="html" style="float:right;position:relative;padding:10px;margin-top:-30px;left:-11px">Jogar versão HTML</button>
					</div>
				</div>

				<div class="col-6">
					<div id="content-box">
						<div class="title-box png20 bg-f">
							<div class="title-v">JOGAR VERSÃO FLASH (ANTIGO)</div>
							<div class="png20"></div>
						</div>
						<button type="submit" class="btn green save" id="flash-v" data-modal="flash" style="float:right;position:relative;padding:10px;margin-top:-30px;left:-11px">Jogar versão FLASH</button>
					</div>
				</div>

				<div class="col-7">
					<div id="content-box">
						<div class="title-box png20 bg-o-a">
							<div class="title-v">JOGAR COM APLICATIVO (PC)</div>
							<div class="desc-v">Jogue sem usar o navegador somente baixando o nosso aplicativo exclusivo.</div>
							<div class="png20"></div>
						</div>
						<button class="btn purple save" style="float:right;position:relative;padding:10px;margin-top:-30px;left:-11px">Baixar aplicativo windows</button>
					</div>
				</div>

				<div class="col-5">
					<div id="content-box">
						<div class="title-box png20 bg-o">
							<div class="title-v">JOGAR NO PUFFIN (ANDROID/IOS)</div>
							<br>
							<div class="png20"></div>
						</div>
						<button class="btn purple save" style="float:right;position:relative;padding:10px;margin-top:-30px;left:-11px">Baixar aplicativo</button>
					</div>
				</div>
			</div>


			<div class="modal-container" id="html" data-modal="html">
				<div id="modal-content">
					<div id="news-modal">
						<div class="col-12">
							<div id="content-box" style="height:190px;">
								<div class="title-box png20">
									<div class="title"> ESCOLHA O TIPO DE CLIENT (HTML)</div>
									<button type="ok" class="close close-modal" style="position:relative;top:-20px;float:right;right:14px"></button>

									<div class="margin-top-min">
										<div class="set-client-version">
										<form method="POST" class="set-client-beta-24">
											<button type="submit" class="btn purple big next-register" versionBeta_24="24" class="button" style="width: 100%; height: 45px;margin-bottom:7px;margin-top:20px">Jogar em 24 fps</button>
										</form>	
										<form method="POST" class="set-client-beta-60">
											<button type="submit" class="btn purple big next-register" versionBeta_60="60" class="button" style="width: 100%; height: 45px;">Jogar em 60 fps</button>
										</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="modal-container" id="flash" data-modal="flash">
				<div id="modal-content">
					<div id="news-modal">
						<div class="col-12">
							<div id="content-box" style="height:190px;">
								<div class="title-box png20">
									<div class="title"> ESCOLHA O TIPO DE CLIENT (FLASH)</div>
									<button type="ok" class="close close-modal" style="position:relative;top:-20px;float:right;right:14px"></button>

									<div class="margin-top-min">
										<div class="set-client-version">
										<form method="POST" class="set-client-flash-24">
											<button type="submit" class="btn purple big next-register" version_24="24" class="button" style="width: 100%; height: 45px;margin-bottom:7px;margin-top:20px">Jogar em 24 fps</button>
										</form>
										<form method="POST" class="set-client-flash-60">
											<button type="submit" class="btn purple big next-register" version_60="60" class="button" style="width: 100%; height: 45px;">Jogar em 60 fps</button>
										</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php } ?>
			<script src="<?= CDN; ?>/assets/js/client.js?<?=TIME?>"></script>

			<script type="text/javascript" src="<?= CDN; ?>/assets/js/jquery.js?<?= TIME; ?>"></script>
			<script type="text/javascript" src="<?= CDN; ?>/assets/js/main.js?<?= TIME; ?>"></script>
			<script type="text/javascript" src="<?= CDN; ?>/assets/js/ajax.js?<?= TIME; ?>"></script>
</body>
</html>