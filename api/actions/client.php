<?php 
	require_once('../../global.php');

	header('Content-Type: application/json');

	if (extract($_POST)) {
		$order = (isset($_POST['order'])) ? $_POST['order'] : '';

		if ($order == 'version') {

			//FLASH
			$version24 = (isset($_POST['version24'])) ? $_POST['version24'] : '';
			$version60 = (isset($_POST['version60'])) ? $_POST['version60'] : '';

			
			$consult_client_version = $db->prepare("SELECT * FROM cms_clients WHERE user_id = ?");
			$consult_client_version->bindValue(1, $user['id']);
			$consult_client_version->execute();

			if ($consult_client_version->rowCount() > 0) {
				$result_client_version = $consult_client_version->fetch(PDO::FETCH_ASSOC);

				
				$update_client_version = $db->prepare("UPDATE cms_clients SET version = ? WHERE user_id = ?");
				if ($result_client_version['version'] != $version24) {
					$update_client_version->bindValue(1, $version24);

				} else if ($result_client_version['version'] != $version60) {
					$update_client_version->bindValue(1, $version60);
				}

				$update_client_version->bindValue(2, $user['id']);
				$update_client_version->execute();
				
				echo json_encode([
					"response" => 'success'
				]);
			} else {
				$insert_client_version = $db->prepare("INSERT INTO cms_clients (user_id, version) VALUES (?,?)");
				$insert_client_version->bindValue(1, $user['id']);
				if ($version24) {
					$insert_client_version->bindValue(2, $version24);
				} else if ($version60) {
					$insert_client_version->bindValue(2, $version60);
				}
				$insert_client_version->execute();

				echo json_encode([
					"response" => 'success'
				]);
			}
		} else if ($order == 'version-beta') {
			//BETA
			$versionBeta24 = (isset($_POST['versionBeta_24'])) ? $_POST['versionBeta_24'] : '';
			$versionBeta60 = (isset($_POST['versionBeta_60'])) ? $_POST['versionBeta_60'] : '';


			$consult_client_version_beta = $db->prepare("SELECT * FROM cms_clients_beta WHERE user_id = ?");
			$consult_client_version_beta->bindValue(1, $user['id']);
			$consult_client_version_beta->execute();

			if ($consult_client_version_beta->rowCount() > 0) {
				$result_client_version_beta = $consult_client_version_beta->fetch(PDO::FETCH_ASSOC);

				$update_client_version_beta = $db->prepare("UPDATE cms_clients_beta SET version = ? WHERE user_id = ?");
				if ($result_client_version_beta['version'] != $versionBeta24) {
					$update_client_version_beta->bindValue(1, $versionBeta24);

				} else if ($result_client_version_beta['version'] != $versionBeta60) {
					$update_client_version_beta->bindValue(1, $versionBeta60);
				}

				$update_client_version_beta->bindValue(2, $user['id']);
				$update_client_version_beta->execute();
				
				echo json_encode([
					"response" => 'success'
				]);
			} else {
				$insert_client_version_beta = $db->prepare("INSERT INTO cms_clients_beta (user_id, version) VALUES (?,?)");
				$insert_client_version_beta->bindValue(1, $user['id']);
				if ($versionBeta24) {
					$insert_client_version_beta->bindValue(2, $versionBeta24);
				} else if ($versionBeta60) {
					$insert_client_version_beta->bindValue(2, $versionBeta60);
				}
				$insert_client_version_beta->execute();

				echo json_encode([
					"response" => 'success'
				]);
			}
		}

	} else {
		echo 'Cannot get ' . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) . '.';
	}
?>