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
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>BETA - Lella</title>
    <base href="/">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
	<link rel="stylesheet" href="<?= URL; ?>/game/styles.3f08ab665bffd7c30247.css">
</head>
<body>
    <app-root></app-root>
   <script>
   var NitroConfig = {
            configurationUrls: [ '/game/renderer-config.json', '/game/ui-config.json' ],
            sso: '<?= $Functions::User('auth_ticket', USERNAME); ?>'
        };

    </script>
      <script src="<?= URL; ?>/game/runtime.89b19697d99ffd421697.js" defer></script>
    <script src="<?= URL; ?>/game/polyfills.69f5eeb47c76f3508a0b.js" defer></script>
    <script src="<?= URL; ?>/game/vendor.a9d82c76db70560a0888.js" defer></script>
    <script src="<?= URL; ?>/game/main.11be41cba051016c3ae1.js" defer></script>
  	<script>console.log('%c Lella HTML5 desenvolvido por Emerson, Laxus e Wake. %c\nAgradecimentos à: Billsonnn e desenvolvedores do Nitro.', 'color: #black; font-size: 13pt; padding: 20px;', 'font-size: 9pt; padding: 5px 20px 20px;');</script>


</body>
</html>