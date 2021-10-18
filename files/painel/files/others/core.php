<?php
	require_once('../../../../global.php');

	require_once('class.panel.php');

	$Panel = new Panel();

	define('URL_PANEL', URL . '/panel');
	define('ASSETS_PANEL', URL . '/files/painel');

	if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
		$username = $_SESSION['username'];
		$password = password_hash($_SESSION['password'], PASSWORD_BCRYPT);

		if (password_verify($_SESSION['password'], $password)) {
			$consult_panel_user = $db->prepare("SELECT * FROM players WHERE username = ? LIMIT 1");
			$consult_panel_user->bindValue(1, $username);
			$consult_panel_user->execute();

			if ($consult_panel_user->rowCount() > 0) {
				$result_panel_user = $consult_panel_user->fetch(PDO::FETCH_ASSOC);
			} else {
				unset($_SESSION['pin_panel']);
				Redirect(URL_PANEL);
			}
		}
	}

	$developer = '11';
	$fundador = '10';
	$ceo = '9';
	$manager = '8';
	$administrator = '7';
	$moderator = '6';
?>