<?php
	require_once('../../global.php');

	header('Content-Type: application/json');

    if (extract($_POST)) {
        $order = (isset($_POST['order'])) ? $_POST['order'] : '';

        if ($order == 'request-form') {

            $article_id = (isset($_POST['article_id'])) ? $_POST['article_id'] : '';
            $username = (isset($_POST['username'])) ? $_POST['username'] : '';
            $message = (isset($_POST['message'])) ? $_POST['message'] : '';


           if (empty($message)) {
                echo json_encode([
                    "response" => 'error',
                    "input" => 'input[name="form_message"]',
                    "error" => [
                        "class" => 'div.col-input-separator:nth-child(3) > .error-input-warn',
                        "text" => 'Você precisa enviar uma mensagem.'
                    ]
                ]);
            } else if (strlen($message) > 85) {
                echo json_encode([
                    "response" => 'error',
                    "input" => 'input[name="form_message"]',
                    "error" => [
                        "class" => 'div.col-input-separator:nth-child(3) > .error-input-warn',
                        "text" => 'Seu envio não pode mais que <b>85 caracteres</b>.'
                    ]
                ]);
            } else {
                
                $getPlayerId = $db->prepare("SELECT id FROM players WHERE username = ?");
                $getPlayerId->bindValue(1, $username);
                $getPlayerId->execute();

                if ($getPlayerId->rowCount() > 0) {
                    $result = $getPlayerId->fetch(PDO::FETCH_ASSOC);

                    $query = $db->prepare("INSERT INTO cms_post_forms (type, post_id, label, user_id, timestamp) VALUES (?,?,?,?,?)");
                    $query->bindValue(1, 'article');
                    $query->bindValue(2, $article_id);
                    $query->bindValue(3, Functions::Filter('xss', $message));
                    $query->bindValue(4, $result['id']);
                    $query->bindValue(5, TIME);
                    $query->execute();

                    if ($query->rowCount() > 0) {
                        echo json_encode([
                            "response" => 'success',
                            "append" => '<div class="success-input-warn"<h5>Você enviou seu formulário com êxito.</h5></div><br>'
                        ]);
                    }
                }
            }
        }         
    } else {
        echo 'Cannot get ' . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) . '.';
    }
?>