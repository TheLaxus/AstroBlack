<?php
	require_once('../../global.php');

	header('Content-Type: application/json');

    if (extract($_POST)) {
        $order = (isset($_POST['order'])) ? $_POST['order'] : '';

        if ($order == 'send-badge') {

            $article_id = (isset($_POST['article_id'])) ? $_POST['article_id'] : '';
            $username = (isset($_POST['username'])) ? $_POST['username'] : '';
            $badgeCode = (isset($_POST['badge_code'])) ? $_POST['badge_code'] : '';


            $verifyPromoActive = $db->prepare("SELECT timestamp_expire FROM cms_news WHERE id = ?");
            $verifyPromoActive->bindValue(1, $article_id);
            $verifyPromoActive->execute();

            if ($verifyPromoActive->rowCount() > 0) {
                $result = $verifyPromoActive->fetch(PDO::FETCH_ASSOC);

                if ($result['timestamp_expire'] < TIME) {
                    echo json_encode([
                        "response" => 'error',
                        "input" => 'input[name="badgeCode"]',
                        "error" => [
                            "class" => 'div.col-input-separator:nth-child(6) > .error-input-warn',
                            "text" => 'Esta promoção não está mais ativa.'
                        ]
                    ]);
                } else if (!file_exists(PATH_BADGEIMAGE . '/' . $badgeCode . '.gif')) {
                    echo json_encode([
                        "response" => 'error',
                        "input" => 'input[name="badgeCode"]',
                        "error" => [
                            "class" => 'div.col-input-separator:nth-child(6) > .error-input-warn',
                            "text" => 'O emblema não foi encontrado.'
                        ]
                    ]);
                } else {

                    $getPlayerId = $db->prepare("SELECT id FROM players WHERE username = ?");
                    $getPlayerId->bindValue(1, $username);
                    $getPlayerId->execute();
                    
                    if ($getPlayerId->rowCount() > 0) {
                        $resultPlayer = $getPlayerId->fetch(PDO::FETCH_ASSOC);

                        $verifyHasBadge = $db->prepare("SELECT id FROM player_badges WHERE badge_code = ? AND player_id = ?");
                        $verifyHasBadge->bindValue(1, $badgeCode);
                        $verifyHasBadge->bindValue(2, $resultPlayer['id']);
                        $verifyHasBadge->execute();

                        if ($verifyHasBadge->rowCount() > 0) {
                            echo json_encode([
                                "response" => 'error',
                                "input" => 'input[name="badgeCode"]',
                                "error" => [
                                    "class" => 'div.col-input-separator:nth-child(6) > .error-input-warn',
                                    "text" => 'Você já possui este emblema.'
                                ]
                            ]);
                        } else {
                            $sendBadge = $db->prepare("INSERT INTO player_badges (badge_code, player_id) VALUES (?,?)");
                            $sendBadge->bindValue(1, $badgeCode);
                            $sendBadge->bindValue(2, $resultPlayer['id']);
                            $sendBadge->execute();

                            if ($sendBadge->rowCount() > 0) {
                                echo json_encode([
                                    "response" => 'success',
                                    "append" => '<div class="success-input-warn"<h5>Você recebeu seu emblema com êxito.</h5></div><br>'
                                ]);
                            }
                        }

                    }
                }
            }
        }
    } else {
        echo 'Cannot get ' . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) . '.';
    }

?>