<?php 
	require_once('core.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<meta chaset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<title><?= $page_title; ?></title>

		<!-- Estilos -->
		<link rel="stylesheet" href="<?= ASSETS_PANEL; ?>/assets/css/styles.css?<?= TIME; ?>">
		<link rel="stylesheet" href="<?= ASSETS_PANEL; ?>/assets/css/dutstrap.css?<?= TIME; ?>">
		<link rel="stylesheet" href="<?= ASSETS_PANEL; ?>/assets/css/layout.css?<?= TIME; ?>">
		<link rel="stylesheet" href="<?= ASSETS_PANEL; ?>/assets/css/types.css?<?= TIME; ?>">
		<link rel="stylesheet" href="<?= CDN; ?>/assets/css/buttons2.css?<?= TIME; ?>">

		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,600" rel="stylesheet">

		<script type="text/javascript" src="https://cdn.ckeditor.com/4.7.3/full/ckeditor.js?<?= TIME; ?>"></script>
	</head>
	<body>
		<div class="error-container"></div>
		<div class="container">
