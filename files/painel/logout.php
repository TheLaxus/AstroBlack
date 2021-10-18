<?php
	require_once('core.php');
	
	if (isset($_SESSION['pin_panel'])) {
		unset($_SESSION['pin_panel']);
		
		Redirect(URL_PANEL);
	} else {
		Redirect(URL_PANEL);
	}
?>