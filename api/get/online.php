<?php 
	require_once('../../global.php');

	header('Content-Type: application/json');

	echo json_encode([
		"count" => USERS,
	]);
?>