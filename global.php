<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	ini_set('error_reporting', E_ALL);
	ini_set('display_startup_errors', 1);
	error_reporting(-1);

	if (!isset($_SESSION)) {
		session_start();
	}

	define('SEPARATOR', DIRECTORY_SEPARATOR);
	define('DIR', __DIR__);

	require(DIR . '/core/class/class.core.php');
	require(DIR . '/core/functions.php');

	define('URL', (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? "https" : "http" . "://" . $_SERVER['HTTP_HOST']);
	define('URL_ATUAL', (isset($_SERVER['HTTPS'])) && $_SERVER['HTTPS'] === 'on' ? "https" : "http" . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
	define('UPDATE', mt_rand(500, 999));
	define('GENERATE_KEY', md5(microtime() . rand()));
	define('IP', $Functions::IP());

    define('API', URL . '/api');
    define('CDN', URL . '/cdn');
    define('SWF', URL . '/swf');
    define('AVATARIMAGE', $Hotel::Settings('avatarimage'));
    define('TIME', time());
    define('USERS', $Functions::Users('online'));
	define('PATH_BADGEIMAGE', DIR . SEPARATOR . '/swf/c_images/album1584');
	define('BADGEIMAGE', URL . '/swf/c_images/album1584/%badge%.gif');


	$name = "Habbo";
	$url = $_SERVER["HTTP_HOST"];
	if ($url == "lella.la" || $url == "lella.org" || $url == "lella.habbo.net" || $url == "app.lella.org" || $url == "w.lella.org" || $url == "m.lella.org" || $url == "lella.ws"){
		$name = "Lella";
	} else if ($url == "habbinfo.info" || $url == "habbinfo.habbo.net"){
		$name = "Habbinfo";
	} else if ($url == "hapixel.bz" || $url == "hapixel.habbo.net"){
		$name = "Hapixel";
	} else if ($url == "hablitz.bz" || $url == "hablitz.habbo.net"){
		$name = "Hablitz";
	} else if ($url == "habblet.online" || $url == "habblet.habbo.net"){
		$name = "Habblet";
	} else if ($url == "habblive.com.br" || $url == "habblive.com.br"){
		$name = "Habblive";
	}

    define('HOTELNAME', $name);

	$allowed_view_ips = array("Laxus", "Wake"); //nicks usuarios



    # Puxando informaçõs do usuários se o mesmo estiver conectado, dando acesso para utilizar a variavél $user
	if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
		$username = $_SESSION['username'];
		$password = password_hash($_SESSION['password'], PASSWORD_BCRYPT);

		if (password_verify($_SESSION['password'], $password)) {		
			$users = $db->prepare("SELECT * FROM players WHERE username = ? LIMIT 1");
			$users->bindValue(1, $_SESSION['username']);
			$users->execute();
	
			if ($users->rowCount() > 0) {
				$user = $users->fetch(PDO::FETCH_ASSOC);
	
				define('USERNAME', $user['username']);
				
			} else {
				session_destroy();
				Redirect(URL);
			}		
		}

	}
	
	header("Content-Type: text/html; charset=utf-8", true);
	setlocale(LC_ALL, 'pt_BR', 'pt_BR.iso-8859-15', 'portuguese');
	date_default_timezone_set('America/Sao_Paulo');