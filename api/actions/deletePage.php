<?php
	require_once('../../global.php');

    if($user['rank'] >= 8) {
        Functions::deletePage();
    } else {
        echo "Você não tem permissão para apagar está página";
    }
    
?>