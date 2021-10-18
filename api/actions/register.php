<?php 
	require_once('../../global.php');

	header('Content-Type: application/json');

	if (extract($_POST)) {
		$username = (isset($_POST['username'])) ? $Functions::Filter('username', $_POST['username']) : '';
		$email = (isset($_POST['email'])) ? $_POST['email'] : '';
		$password = (isset($_POST['password'])) ? $_POST['password'] : '';
		$password_c = (isset($_POST['password_c'])) ? $_POST['password_c'] : '';
		//$captcha = (isset($_POST['captcha'])) ? $_POST['captcha'] : '';

		$user_exist = $db->prepare("SELECT username FROM players WHERE username = ?");
		$user_exist->bindValue(1, $username);
		$user_exist->execute();

		$email_exist = $db->prepare("SELECT email FROM players WHERE email = ?");
		$email_exist->bindValue(1, $email);
		$email_exist->execute();

		if (strlen($username) < 3 || strlen($username) > 15) {
			echo json_encode([
				"response" => 'error',
				"label" => [
					"append" => '<div class="register-error-box"><label class="color-1"><h4 class="bold">Oops!</h4><h6 class="fs-12">Seu nome de usuário precisar ter <b>no mínimo 3 caracteres</b> e <b>no máximo 15</b>!</h6></label></div>',
					"input" => 'input[name="username"]'
				]
			]);
		} else if ($Functions::Validate('username', $username) !== true) {
			echo json_encode([
				"response" => 'error',
				"label" => [
					"append" => '<div class="register-error-box"><label class="color-1"><h4 class="bold">Oops!</h4><h6 class="fs-12">Você precisa inserir um <b>nome de usuário válido</b>!</h6></label></div>',
					"input" => 'input[name="username"]'
				]
			]);
		} else if ($user_exist->rowCount() > 0) {
			echo json_encode([
				"response" => 'error',
				"label" => [
					"append" => '<div class="register-error-box"><label class="color-1"><h4 class="bold">Oops!</h4><h6 class="fs-12">Esse nome de usuário já <b>está sendo utilizado</b>!</h6></label></div>',
					"input" => 'input[name="username"]'
				]
			]);
		} else if (strlen($email) <= 0) {
			echo json_encode([
				"response" => 'error',
				"label" => [
					"append" => '<div class="register-error-box"><label class="color-1"><h4 class="bold">Oops!</h4><h6 class="fs-12">Você precisar fornecer um <b>endereço de e-mail</b>!</h6></label></div>',
					"input" => 'input[name="email"]'
				]
			]);
		} else if ($Functions::Validate('email', $email) !== false) {
			echo json_encode([
				"response" => 'error',
				"label" => [
					"append" => '<div class="register-error-box"><label class="color-1"><h4 class="bold">Oops!</h4><h6 class="fs-12">Você precisar fornecer um <b>endereço de e-mail válido</b>!</h6></label></div>',
					"input" => 'input[name="email"]'
				]
			]);
		} else if ($user_exist->rowCount() > 0) {
			echo json_encode([
				"response" => 'error',
				"label" => [
					"append" => '<div class="register-error-box"><label class="color-1"><h4 class="bold">Oops!</h4><h6 class="fs-12">Esse endereço de e-mail ja <b>está sendo utilizado</b>!</h6></label></div>',
					"input" => 'input[name="email"]'
				]
			]);
		} else if (strlen($password) < 6 || strlen($password) > 32) {
			echo json_encode([
				"response" => 'error',
				"label" => [
					"append" => '<div class="register-error-box"><label class="color-1"><h4 class="bold">Oops!</h4><h6 class="fs-12">Sua senha deve ter no mínimo <b>6 caracteres</b> e <b>no máximo 32</b>!</h6></label></div>',
					"input" => 'input[name="password"]'
				]
			]);
		} else if (strlen($password_c) <= 0) {
			echo json_encode([
				"response" => 'error',
				"label" => [
					"append" => '<div class="register-error-box"><label class="color-1"><h4 class="bold">Oops!</h4><h6 class="fs-12">Você precisa <b>confirmar sua senha</b>!</h6></label></div>',
					"input" => 'input[name="password"]'
				]
			]);
		} else if ($password_c != $password) {
			echo json_encode([
				"response" => 'error',
				"label" => [
					"append" => '<div class="register-error-box"><label class="color-1"><h4 class="bold">Oops!</h4><h6 class="fs-12">As <b>senhas não são iguais</b>, certifique-se de que você as digitou corretamente!</label></div>',
					"input" => 'input[name="password_c"]'
				]
			]);
		} /*else if (empty($captcha) || $captcha == null || $captcha == '') {
			echo json_encode([
				"response" => 'error',
				"label" => [
					"append" => '<div class="register-error-box"><label class="color-1"><h4 class="bold">Beep Boop Beep!</h4><h6 class="fs-12">Precisamos confirmar se você é humano mesmo, <b>verifique o reCAPTCHA</b> e nada de robôs.</label></div>'
				]
			]);
		} */ else if ($Hotel::Settings('register') == 'disabled') {
			echo json_encode([
				"response" => 'error',
				"label" => [
					"append" => '<div class="register-error-box"><label class="color-1"><h4 class="bold">Vish!</h4><h6 class="fs-12">Os registros estão desativados no momento. Portanto não é possivél registrar novas contas.</h6></label></div>'
				]
			]);
		} else {

			// Verificar se hcaptcha é válido
			$hcaptchaData = isset($_POST['captcha']) ? $_POST['captcha'] : '';

			if ($hcaptchaData) {
				$dataCaptcha = array(
					'secret' => '0xCa9E80bf55B0Ed250E8D083868FeC8249C9D8c09',
					'response' => $_POST['captcha']
				);
	
				$verifyCaptcha = curl_init();
				curl_setopt($verifyCaptcha, CURLOPT_URL, "https://hcaptcha.com/siteverify");
				curl_setopt($verifyCaptcha, CURLOPT_POST, true);
				curl_setopt($verifyCaptcha, CURLOPT_POSTFIELDS, http_build_query($dataCaptcha));
				curl_setopt($verifyCaptcha, CURLOPT_RETURNTRANSFER, true);
				$response = curl_exec($verifyCaptcha);
	
				$responseData = json_decode($response);
	
				if ($responseData->success == false) {
					echo json_encode([
						"response" => 'error',
						"label" => [
							"append" => '<div class="register-error-box"><label class="color-1"><h6 class="fs-12">Verifique se você é um robô.</h6></label></div>'
						]
					]);
					return;
				}
	
				$password_bcrypt = password_hash($password, PASSWORD_BCRYPT);
	
				$insert_account = $db->prepare("INSERT INTO players (username, email, password, figure, gender, motto, reg_date, last_online, ip_current, ip_register) VALUES (?,?,?,?,?,?,?,?,?,?)");
				$insert_account->bindValue(1, $username);
				$insert_account->bindValue(2, $email);
				$insert_account->bindValue(3, $password_bcrypt);
				$insert_account->bindValue(4, 'sh-290-62.hd-205-1383.ch-215-82.lg-275-110.ha-1015-62');
				$insert_account->bindValue(5, 'M');
				$insert_account->bindValue(6, 'Acabei de chegar no ' . HOTELNAME);
				$insert_account->bindValue(7, TIME);
				$insert_account->bindValue(8, TIME);
				$insert_account->bindValue(9, IP);
				$insert_account->bindValue(10, IP);
				$insert_account->execute();
	
				session_regenerate_id();
	
				if (!isset($_SESSION)) {
					session_start();
				}
	
				$_SESSION['username'] = $username;
				$_SESSION['password'] = $password_bcrypt;
	
				echo json_encode([
					"response" => 'success'
				]);
	
				exit();
			} else {
				echo json_encode([
					"response" => 'error',
					"label" => [
						"append" => '<div class="register-error-box"><label class="color-1"><h6 class="fs-12">Você é um robô?</h6></label></div>'
					]
				]);
			}

		}
	} else {
		echo 'Cannot get ' . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	}
?>