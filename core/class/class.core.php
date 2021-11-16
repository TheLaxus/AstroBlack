<?php 
	require('class.pdo.php');
	require('class.functions.php');
	require('class.hotel.php');
	require('class.security.php');
	require('class.template.php');
	require('class.user.php');
	require('class.api.php');

	$PDO = new Database();
	$db = $PDO->connection();
	
	$Functions = new Functions();
	$Hotel = new Hotel();
	$Security = new Security();
	$Template = new Template();
	$User = new User();
	$Api = new Api();

?>