<?php 
	require_once('core.php');

	header('Content-Type: application/json');

	if ($_POST) {
		$badge_title = (isset($_POST['badge-title'])) ? $_POST['badge-title'] : '';
		$badge_description = (isset($_POST['badge-description'])) ? $_POST['badge-description'] : '';
		$badge_file = (isset($_FILES['badge-file'])) ? $_FILES['badge-file'] : '';

		if (empty($badge_title)) {
			echo json_encode([
				"response" => 'error',
				"input" => 'input[name="badge-title"]',
				"error" => [
					"class" => 'div.col-input-separator:nth-child(2) > .error-input-warn',
					"text" => 'O título do seu emblema é essencial, então não o deixe vazio.'
				]
			]);
		} else if (empty($badge_description)) {
			echo json_encode([
				"response" => 'error',
				"input" => 'input[name="badge-description"]',
				"error" => [
					"class" => 'div.col-input-separator:nth-child(3) > .error-input-warn',
					"text" => 'A descrição do seu emblema é essencial, então não a deixe vazia.'
				]
			]);
		} else if (!isset($badge_file['tmp_name']) || empty($badge_file['tmp_name'])) {
			echo json_encode([
				"response" => 'error',
				"input" => 'input[name="badge-file"]',
				"error" => [
					"class" => 'div.col-input-separator:nth-child(4) > .error-input-warn',
					"text" => 'Você precisa enviar um emblema para ser hospedado.'
				]
			]);
		} else {
			$path_badge = DIR . SEPARATOR . 'swf/c_images/album1584/' . $badge_file['name'];
			$path_text = DIR . SEPARATOR . 'swf/gamedata/external_flash_texts.txt';

			$badge_name = str_replace('.gif', '', $badge_file['name']);

			$badge_size = getimagesize($badge_file['tmp_name']);
			$badge_width = $badge_size[0];
			$badge_height = $badge_size[1];

			$badge_format = pathinfo($badge_file['name'], PATHINFO_EXTENSION);

			if (strlen($badge_title) > 20) {
				echo json_encode([
					"response" => 'error',
					"input" => 'input[name="badge-title"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(2) > .error-input-warn',
						"text" => 'Para o conforto de todos, o título do seu emblema não deve conter mais que 20 caracteres.'
					]
				]);
			} else if (strlen($badge_description) > 100) {
				echo json_encode([
					"response" => 'error',
					"input" => 'input[name="badge-description"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(3) > .error-input-warn',
						"text" => 'Para o conforto de todos, a descrição do seu emblema não deve conter mais que 100 caracteres.'
					]
				]);
			} else if ($badge_format != 'gif') {
				echo json_encode([
					"response" => 'error',
					"input" => 'input[name="badge-file"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(4) > .error-input-warn',
						"text" => 'O emblema que você está tentando hospedar não está no formato <b>.gif</b>.'
					]
				]);
			} else if ($badge_width < 40 || $badge_height < 40) {
				echo json_encode([
					"response" => 'error',
					"input" => 'input[name="badge-file"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(4) > .error-input-warn',
						"text" => 'As dimensões mínimas para hospedar um emblema devem ser 10×10.'
					]
				]);
			} else if ($badge_width > 40 || $badge_height > 40) {
				echo json_encode([
					"response" => 'error',
					"input" => 'input[name="badge-file"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(4) > .error-input-warn',
						"text" => 'O emblema que você quer hospedar tem as dimensões maiores que 40×40.'
					]
				]);
			} else if (strlen($badge_name) < 5 || strlen($badge_name) > 5 || preg_match('/[^a-zA-Z0-9]+/', $badge_name) == true) {
				echo json_encode([
					"response" => 'error',
					"input" => 'input[name="badge-file"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(4) > .error-input-warn',
						"text" => 'Para ficar fácil de lembrar, o nome do seu emblema deve conter <b>5 letras</b> ou <b>números</b>.'
					]
				]);
			} else if (file_exists($path_badge)) {
				echo json_encode([
					"response" => 'error',
					"input" => 'input[name="badge-file"]',
					"error" => [
						"class" => 'div.col-input-separator:nth-child(4) > .error-input-warn',
						"text" => 'O emblema de código <b>' . $badge_name . '</b> já está hospedado na galeria de emblemas, tente usar outro código.'
					]
				]);
			} else {
				move_uploaded_file($badge_file['tmp_name'], $path_badge);

				$path_text_content = fopen($path_text, 'a');
				fwrite($path_text_content, "badge_name_" . $badge_name . "=" . $badge_title . "\nbadge_desc_" . $badge_name . "=" . $badge_description . "\n");
				fclose($path_text_content);

				echo json_encode([
					"response" => 'success',
					"append" => '<div class="form-warn success"><label class="flex-column"><h4 class="bold uppercase">Successo!</h4><h5>O emblema de código <b>' . $badge_name . '</b> foi hospedado com sucesso!</h5></label></div>'
				]);
			}
		}
	} else {
		echo 'Cannot get ' . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) . '.';
	}
?>