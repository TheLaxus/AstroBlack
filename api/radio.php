<?php 
	require_once('../global.php');
	error_reporting(E_ALL);

	header('Content-Type: application/json');

	if (extract($_POST)) {
		$order = (isset($_POST['order'])) ? $_POST['order'] : '';

		if ($order == 'status') {

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'https://secury.ipstm.net:7022/index.html?sid=1');
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.1) Gecko/20061204 Firefox/2.0.0.1");
			$default = curl_exec($ch);
			$online = 1;
			$server = strpos($default, 'Stream is currently up');


			if ($online == 1) {
				# Locutor(a)
				$speaker = explode('<td>Playing Now: </td><td><b><a href="currentsong?sid=1">', $default);
				$speaker = explode('</a></b></td>', $speaker[1]);
				$speaker = $speaker[0];

				# Ouvintes sintonizados
				$listeners = explode('with ', $default);
				$listeners = explode(' of 699 listeners', $listeners[1]);
				$listeners = $listeners[0];

				$consult_speaker = $db->prepare("SELECT figure FROM players WHERE username = ? LIMIT 1");
				$consult_speaker->bindValue(1, Functions::Filter('xss', $speaker));
				$consult_speaker->execute();

				if ($consult_speaker->rowCount() > 0) {
					$result_speaker = $consult_speaker->fetch(PDO::FETCH_ASSOC);

					$speaker_look = AVATARIMAGE . 'figure=' . $result_speaker['figure'] . '&headonly=0&size=n&gesture=sml&direction=2&head_direction=3&action=wlk,crr=';
				} else {
					$speaker = explode('><td>Stream Name: </td><td><b>', $default);
					$speaker = explode('</b></td>', $speaker[1]);
					$speaker = $speaker[0];
					
					$speaker_look = '/cdn/assets/img/radio/ghost.png';
				}

				$programation = 'Tocando as melhores';
				

				# Exibição
				echo json_encode([
					"speaker" => utf8_decode($speaker),
					"figure" => utf8_decode($speaker_look),
					"programation" => utf8_decode($programation),
					"listeners" => utf8_decode($listeners)
				], JSON_UNESCAPED_UNICODE);
			} else {
				echo json_encode([
					"speaker" => '...',
					"figure" => '/cdn/assets/img/radio/ghost.png',
					"programation" => '...',
					"listeners" => '...'
				], JSON_UNESCAPED_UNICODE);
			}
		}
	} else {
		echo 'Cannot get ' . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) . '.';
	}
?>