<?php 
	require_once('class.pdo.php');
	require_once('class.functions.php');
	require_once('class.hotel.php');
	require_once('class.security.php');
	require_once('class.template.php');
	require_once('class.user.php');

	$PDO = new Database();
	$db = $PDO->connection();
	
	$Functions = new Functions();
	$Hotel = new Hotel();
	$Security = new Security();
	$Template = new Template();
	$User = new User();

?>