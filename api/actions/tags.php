<?php
	require_once('../../global.php');

    header('Content-Type: application/json');

    if (extract($_POST)) {
        $order = (isset($_POST['order'])) ? $_POST['order'] : '';

        if ($order == 'add/tags') {
            $tag = (isset($_POST['tag_add'])) ? $_POST['tag_add'] : '';

            $getTotalTags = $db->prepare("SELECT id,tag FROM player_tags WHERE player_id = ?");
            $getTotalTags->bindValue(1, User::userData('id'));
            $getTotalTags->execute();


            if (empty($tag)) {
                echo json_encode([
                    "response" => 'error',
                    "input" => 'input[name="tag-add"]',
                    "error" => [
                        "class" => 'div.col-input-separator:nth-child(3) > .error-input-warn',
                        "text" => 'Insira a tag que você quer colocar.'
                    ]
                ]);
            } else if (strlen($tag) > 20) {
                echo json_encode([
                    "response" => 'error',
                    "input" => 'input[name="tag-add"]',
                    "error" => [
                        "class" => 'div.col-input-separator:nth-child(3) > .error-input-warn',
                        "text" => 'Sua tag deve conter menos de 20 caracteres.'
                    ]
                ]);
            } else if ($getTotalTags->rowCount() >= 3 && User::userData('vip') == 0 && User::userData('rank') < 6) {
                echo json_encode([
                    "response" => 'error',
                    "input" => 'input[name="tag-add"]',
                    "error" => [
                        "class" => 'div.col-input-separator:nth-child(3) > .error-input-warn',
                        "text" => 'Limite de 3 tags esgotada! Vire <b>VIP</b> e tenha 6 tags no total disponiveis.'
                    ]
                ]);
                return;
            } else if ($getTotalTags->rowCount() >= 6 && User::userData('vip') == 1 && User::userData('rank') < 6) {
                echo json_encode([
                    "response" => 'error',
                    "input" => 'input[name="tag-add"]',
                    "error" => [
                        "class" => 'div.col-input-separator:nth-child(3) > .error-input-warn',
                        "text" => 'Limite de 6 tags esgotada!'
                    ]
                ]);
                return;
                
            } else {
                $tags = strtolower(Functions::Filter("all", $tag));

                $insert_tags = $db->prepare("INSERT INTO player_tags (player_id, tag) VALUES(?,?)");
                $insert_tags->bindValue(1, User::userData('id'));
                $insert_tags->bindValue(2, $tags);
                $insert_tags->execute();

                if ($insert_tags->rowCount() > 0) {
                    echo json_encode([
                        "response" => 'success',
                        "append" => '<div class="success-input-warn"<h5>Você inseriu sua tag com êxito, recarregue a página.</h5></div><br>'
                    ]);
                }
            }

        }
    } else {
        echo 'Cannot get ' . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) . '.';
    }

?>