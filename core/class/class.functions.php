<?php
/*
	 * - Users
	 * - User
	 * - GetByUsername
	 * - Filter
	 * - Validate
	 * - IP
	 * - Random
	 * - Session
	 * - Login
	 */
class Functions
{

	static function Users($type)
	{
		global $db;

		if ($type == 'online') {
			$consult_users_online = $db->prepare("SELECT online FROM players WHERE online = ?");
			$consult_users_online->bindValue(1, '1');
			$consult_users_online->execute();

			if ($consult_users_online->rowCount() == 1) {
				$result = '<b>1</b> usuário conectado';
			} else {
				$result = '<b>' . $consult_users_online->rowCount() . '</b> usuários conectados';
			}
		}

		return $result;
	}


	static function userSettingsById($key, $playerId)
	{
		global $db;
		$stmt = $db->prepare("SELECT " . $key . " FROM player_settings WHERE player_id = :id");
		$stmt->bindParam(':id', $playerId);
		$stmt->execute();
		$row = $stmt->fetch();
		return $row[$key];
	}

    static function insertRowInArchive($msg, $arquivo)
    {
        $escrever = "\r\n" . $msg;
        $abertoa = fopen($arquivo, 'a'); // abrindo para adicionar no arquivo
        fwrite($abertoa, $escrever); // escrevendo no final do arquivo o texto
    }

	static function User($type = null, $username = null)
	{
		global $db;

		if ($type != null && $username != null) {
			if ($type == 'auth_ticket') {
				$ticket = self::Random('sso');

				$update_auth_ticket = $db->prepare("UPDATE players SET auth_ticket = ? WHERE username = ?");
				$update_auth_ticket->bindValue(1, $ticket);
				$update_auth_ticket->bindValue(2, $username);
				$update_auth_ticket->execute();

				/*$consult_auth_ticket = $db->prepare("SELECT auth_ticket FROM users WHERE username = ?");
					$consult_auth_ticket->bindValue(1, $username);
					$consult_auth_ticket->execute();
					$result_auth_ticket = $consult_auth_ticket->fetch(PDO::FETCH_ASSOC);*/
				return $ticket;
			}
		} else {
			echo 'As variaveis estão nulas, e não é possível executar nenhum ação.';
		}
	}

	static function GetByUsername($username = null, $type = null)
	{

		if ($username != null && $username != null) {
			if ($type == 'credits') {
				$result = '2';
			}
		} else {
			$result = 'undefined';
		}

		return $result;
	}

	static function Filter($type, $string)
	{
		if ($type == 'XSS' || $type == 'xss') {
			$value = htmlspecialchars_decode($string);
			$value = trim($value);

			# 18
			$search = [
				"<script", "/script>",
				"<div", "/div>",
				"<a", "/a>",
				"<button", "/button>",
				"<?php", "?>", "<?=",
				"https://", "http://",
				"<svg", "/svg>",
				"<link", "<?xml"
			];

			$replace = [
				"", "",
				"", "",
				"", "",
				"", "",
				"", "", "",
				"", "",
				"", "",
				"", ""
			];

			$value = str_replace($search, $replace, $value);
		} else if ($type == 'username') {
			$value = htmlspecialchars_decode($string);
			$value = trim($value);

			$search = [
				" ", "/", "\\"
			];

			$replace = [
				"", "", ""
			];

			$value = str_replace($search, $replace, $value);
		} else if ($type == 'article') {
			$value = htmlspecialchars_decode($string);

			$search = [
				"<script", "/script>",
				"<?php", "?>", "<?=",
				"<svg", "/svg>",
				"<link", "<?xml"
			];

			$replace = [
				"", "", 
				"", "", "",
				"", "",
				"", "",
			];
			
			$value = str_replace($search, $replace, $value);
		}

		return $value;
	}

	static function Validate($type, $string)
	{
		if ($type == "username") {
			$pattern = "/[^a-zA-Z0-9]+/";
			$match = preg_match($pattern, $string);

			if ($match == 1) {
				return false;
			} else {
				return true;
			}
		} else if ($type == "email") {
			$pattern = "/^[a-z0-9_\.-]+@([a-z0-9]+([\-]+[a-z0-9]+)*\.)+[a-z]{2,7}$/i";
			$match = preg_match($pattern, $string);

			if ($match == 1) {
				return false;
			} else {
				return true;
			}
		}
	}

	static function IP()
	{
		if (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) {
			$ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
		} else if (!empty($_SERVER['HTTP_INCAP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_INCAP_CLIENT_IP'];
		} else if (!empty($_SERVER['HTTP_X_SUCURI_CLIENTIP'])) {
			$ip = $_SERVER['HTTP_X_SUCURI_CLIENTIP'];
		} else if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else if (!empty($_SERVER['HTTP_X_FORWARDED'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED'];
		} else if (!empty($_SERVER['HTTP_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_FORWARDED_FOR'];
		} else if (!empty($_SERVER['HTTP_FORWARDED'])) {
			$ip = $_SERVER['HTTP_FORWARDED'];
		} else if (!empty($_SERVER['REMOTE_ADDR'])) {
			$ip = $_SERVER['REMOTE_ADDR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}

		return $ip;
	}

	static function Random($type, $length = null)
	{
		switch ($type) {
			case "sso":
				$data = 'CrazzY-' . self::Random("random", 16) . '-' . self::Random("random", 8) . '-' . self::Random("random", 18);
				return $data;
				break;
			case "random":
				$data = null;
				$possible  = 'abcdefghijklmnopqrstuvwxyz';
				$possible .= 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$possible .= '1234567890';

				for ($i = 0; $i < $length; $i++) {
					$data .= substr($possible, rand() % (strlen($possible)), 1);
				}

				return $data;
				break;
			case "random_number":
				$data = "";
				$possible = "1234567890";
				$i  = 0;

				while ($i < $length) {
					$char = substr($possible, mt_rand(0, strlen($possible) - 1), 1);
					$data = $char;
					$i++;
				}

				return $data;
				break;
		}
	}

	static function Session($type)
	{
		if ($type == 'connected') {
			if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
				Redirect(URL . '/me');
			}
		} else if ($type == 'disconnected') {
			if (!isset($_SESSION['username']) && !isset($_SESSION['password'])) {
				Redirect(URL);
			}
		}
	}
	

	static function Login($username, $password, $type = null)
	{
		global $db;

		$password_bcrypt = password_hash($password, PASSWORD_BCRYPT);

		$consult_user = $db->prepare("SELECT id, username, password, ip_register, ip_current, machine_id, account_disabled, rank, staff_access FROM players WHERE username = ?");
		$consult_user->bindValue(1, $username);
		$consult_user->execute();

		$verif_user = $db->prepare("SELECT * FROM players WHERE username = ?");
		$verif_user->bindValue(1, $username);
		$verif_user->execute();

		if (strlen($username) <= 0 || strlen($password) <= 0) {
			echo json_encode([
				"response" => 'error',
				"append" => '<div class="error-box"><label class="color-1"><h6 class="fs-12">Você precisa fornecer seu <b>nome de usuário</b> e <b>senha</b> para poder fazer login.</h6></label></div>'
			]);
		} else if ($consult_user->rowCount() <= 0 && $verif_user->rowCount() <= 0) {
			echo json_encode([
				"response" => 'error',
				"append" => '<div class="error-box"><label class="color-1"><h6 class="fs-12"><b>Não foi possível encontrar</b> nenhuma conta com os dados fonecidos!</h6></label></div>'
			]);
		} else if ($consult_user->rowCount() == 0 && $verif_user->rowCount() > 0) {
			echo json_encode([
				"response" => 'error',
				"append" => '<div class="error-box"><label class="color-1"><h6 class="fs-12">Sua senha está incorreta, caso tenha esquecido a mesma entre em contato com um membro <b>desenvolvedor</b> pelo <b>discord</b> para poder recupera-lá.</h6></label></div>'
			]);
		} else {
			$result_user = $consult_user->fetch(PDO::FETCH_ASSOC);

			if (password_verify($password, $result_user['password'])) {
				$verif_ban = $db->prepare("SELECT reason,expire FROM bans WHERE (type = ? OR type = ? OR type = ?) ORDER BY expire");
				$verif_ban->bindValue(1, $result_user['ip_current']);
				$verif_ban->bindValue(2, $result_user['ip_register']);
				$verif_ban->bindValue(3, $result_user['machine_id']);
				$verif_ban->execute();

				if ($verif_ban->rowCount() > 0) {
					$result_ban = $verif_ban->fetch(PDO::FETCH_ASSOC);

					$now_timestamp = TIME;
					$ban_timestamp = $result_ban['expire'];

					if ($ban_timestamp == '0') {
						echo json_encode([
							"response" => 'error',
							"append" => '<div class="error-box"><label class="color-1"><h6 class="fs-12">Sua conta foi banida permanentemente do hotel pelo seguinte motivo: <b>' . $result_ban['reason'] . '</b>.</h6></label></div>'
						]);
					} else if ($now_timestamp < $ban_timestamp) {
						echo json_encode([
							"response" => 'error',
							"append" => '<div class="error-box"><label class="color-1"><h6 class="fs-12">Sua conta está banida até ' . utf8_decode(strftime('%d de %B de %Y', $ban_timestamp)) . ' às ' . utf8_decode(strftime('%H:%M', $ban_timestamp)) . ' pelo seguinte motivo: <b>' . $result_ban['reason'] . '</b></h6></label></div>'
						]);
					} else if ($now_timestamp > $ban_timestamp) {
						$delete_ban = $db->prepare("DELETE FROM bans WHERE (type = ? OR type = ? OR type = ?");
						$delete_ban->bindValue(1, $result_user['ip_current']);
						$delete_ban->bindValue(2, $result_user['ip_register']);
						$delete_ban->bindValue(3, $result_user['machine_id']);
						$delete_ban->execute();


						if ($type == 'staff' && $result_user['rank'] < 6) {
							echo json_encode([
								"response" => 'error',
								"append" => '<div class="error-box"><label class="color-1"><h6 class="fs-12">No momento, <b>apenas usuários membros da equipe</b> podem fazer login, tente novamente mais tarde!</h6></label></div>'
							]);
						} else if ($type == 'permission' && $result_user['staff_access'] == '0') {
							echo json_encode([
								"response" => 'error',
								"append" => '<div class="error-box"><label class="color-1"><h6 class="fs-12">No momento, <b>apenas usuários autorizados</b> podem fazer login, tente novamente mais tarde!</h6></label></div>'
							]);
						} else {
							session_regenerate_id();

							if (!isset($_SESSION)) {
								session_start();
							}

							$_SESSION['username'] = $result_user['username'];
							$_SESSION['password'] = $password_bcrypt;

							echo json_encode([
								"response" => 'success'
							]);
						}
					}
				} else if ($result_user['account_disabled'] == '1') {
					echo json_encode([
						"response" => 'error',
						"append" => '<div class="error-box"><label class="color-1"><h6 class="fs-12">Sua conta foi <b>desativada</b> se você acha que isso foi um engano, <b>entre em contato</b> com a <b>equipe de densenvolvimento</b>.</h6></label></div>'
					]);
				} else {
					if ($type == 'staff' && $result_user['rank'] < 6) {
						echo json_encode([
							"response" => 'error',
							"append" => '<div class="error-box"><label class="color-1"><h6 class="fs-12">No momento, <b>apenas usuários membros da equipe</b> podem fazer login, tente novamente mais tarde!</h6></label></div>'
						]);
					} else if ($type == 'permission' && $result_user['staff_access'] == '0') {
						echo json_encode([
							"response" => 'error',
							"append" => '<div class="error-box"><label class="color-1"><h6 class="fs-12">No momento, <b>apenas usuários autorizados</b> podem fazer login, tente novamente mais tarde!</h6></label></div>'
						]);
					} else {
						session_regenerate_id();

						if (!isset($_SESSION)) {
							session_start();
						}

						$_SESSION['username'] = $result_user['username'];
						$_SESSION['password'] = $password_bcrypt;

						echo json_encode([
							"response" => 'success'
						]);
					}
				}
			} else {
				echo json_encode([
					"response" => 'error',
					"append" => '<div class="error-box"><label class="color-1"><h6 class="fs-12">Sua senha está incorreta, caso tenha esquecido a mesma entre em contato com um membro <b>desenvolvedor</b> pelo <b>discord</b> para poder recupera-lá.</h6></label></div>'
				]);
			}
		}
	}

	static function Logout() {

		//Apagar o cookie
		//self::deleteCookie();

		session_destroy();
		Redirect(URL);

	}

	static function Remember($username) {

		$validate = strtotime("+1 week"); //guardar usuário por 1 semana

		setcookie("sisgen_username", $username, $validate, "/", "", false, true);
	}

	 static function deleteCookie() {

		$validate = time() - 3600;

		setcookie("sisgen_username", "", $validate, "/", "", false, true);
	}

	static function deleteBan($id) {
		global $db;
	
		$id = (int)$id;
		$deleteBan = $db->prepare("DELETE FROM bans WHERE id = ?");
		$deleteBan->bindValue(1, $id);
		$deleteBan->execute();
	
		return $deleteBan;
	}

	static function deletePage() {
        global $db;
        if (isset($_GET['delete'])) {
            $deleteNews = $db->prepare("DELETE FROM catalog_pages WHERE id = ?");
            $deleteNews->bindValue(1, $_GET['delete']);
            $deleteNews->execute();

            header("Location: /panel/create-page");

        }
    }

	
}
