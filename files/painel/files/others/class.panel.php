<?php 
	class Panel {
		
		static function Session($type, $rank = null) {
			if ($type == 'connected') {
				if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
					if (isset($_SESSION['pin_panel'])) {
						Redirect(URL_PANEL . '/home');
					}
				}
			} else {
				if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
					if (!isset($_SESSION['pin_panel'])) {
						Redirect(URL_PANEL);
					}
				}
			}
		}
	}
?>