<?php 
	require_once('../../global.php');

	header('Content-Type: application/json');

	if (extract($_POST)) {
		$type = (isset($_POST['type'])) ? $_POST['type'] : '';
		$username = (isset($_POST['username'])) ? $_POST['username'] : '';
		$password = (isset($_POST['password'])) ? $_POST['password'] : '';

		if ($type == 'normal') {
			$Functions::Login($username, $password);
		} else if ($type == 'staff') {
			$Functions::Login($username, $password, 'permission');
			
		}
	} else {
		echo 'Cannot get ' . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	} 
?>