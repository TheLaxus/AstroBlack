<?php
    session_start();

    require_once "../../global.php";

    $id = (int)$_POST['id'];

    if(Functions::deleteBan($id)) {
        echo "sucesso";

        $insert_panel_log = $db->prepare("INSERT INTO cms_panel_logs (label) VALUES (?)");
        $insert_panel_log->bindValue(1, 'deleted-ban;' . $user['id'] . ';' . TIME . ';' . IP . ';success');
        $insert_panel_log->execute();

    } else {
        echo 'erro';
    }

?>