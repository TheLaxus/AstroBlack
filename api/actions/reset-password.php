<?php
	require_once('../../global.php');

    header('Content-Type: application/json');

    if (extract($_POST)) {
        $order = (isset($_POST['order'])) ? $_POST['order'] : '';

        if ($order == 'reset-password') {
            $resetKey = (isset($_POST['resetKey'])) ? $_POST['resetKey'] : '';
            $new_password = (isset($_POST['newPassword'])) ? $_POST['newPassword'] : '';
            $repeat_password = (isset($_POST['repeatPassword'])) ? $_POST['repeatPassword'] : '';

            if (isset($resetKey)) {
                if (empty($new_password)) {
                    echo json_encode([
                        "response" => 'error',
                        "input" => 'input[name="newpassword_reset"]',
                        "error" => [
                            "class" => 'div.col-input-separator:nth-child(2) > .error-input-warn',
                            "text" => 'Insira sua nova senha.'
                        ]
                    ]);
                } else if (empty($repeat_password)) {
                    echo json_encode([
                        "response" => 'error',
                        "input" => 'input[name="repeat_password"]',
                        "error" => [
                            "class" => 'div.col-input-separator:nth-child(5) > .error-input-warn',
                            "text" => 'Repita sua nova senha para confirma-la.'
                        ]
                    ]);
                } else if (strlen($new_password) < 6) {
                    echo json_encode([
                        "response" => 'error',
                        "input" => 'input[name="newpassword_reset"]',
                        "error" => [
                            "class" => 'div.col-input-separator:nth-child(2) > .error-input-warn',
                            "text" => 'Sua senha deve conter mais de 6 (seis) caracteres..'
                        ]
                    ]);
                } else if ($new_password != $repeat_password) {
                    echo json_encode([
                        "response" => 'error',
                        "input" => 'input[name="repeat_password"]',
                        "error" => [
                            "class" => 'div.col-input-separator:nth-child(5) > .error-input-warn',
                            "text" => 'As senhas não conferem.'
                        ]
                    ]);
                } else {

                    $reset = $db->prepare('SELECT * FROM cms_reset_password WHERE reset_key = ?');
                    $reset->bindValue(1, $resetKey);
                    $reset->execute();

                    if ($reset->rowCount() > 0) {
                        $reset_sql = $reset->fetch(PDO::FETCH_ASSOC);

                        if ($reset_sql['enabled'] == '1') {
                            $time = $reset_sql['timestamp'];

                            if (($time + (60 * 60 * 6)) < time()) {
                                echo json_encode([
                                    "response" => 'error',
                                    "input" => 'input[name="repeat_password"]',
                                    "error" => [
                                        "class" => 'div.col-input-separator:nth-child(5) > .error-input-warn',
                                        "text" => 'Este link de redifinição já expirou.'
                                    ]
                                ]);
                            } else {
                                $desactive = $db->prepare('UPDATE cms_reset_password SET enabled = "0", last_ip = ? WHERE reset_key = ?');
                                $desactive->bindValue(1, IP);
                                $desactive->bindValue(2, $resetKey);
                                $desactive->execute();

                                $newPasswordHashed = User::bcryptHash($new_password);

                                $updateUser = $db->prepare('UPDATE players SET password = ? WHERE id = ?');
                                $updateUser->bindValue(1, $newPasswordHashed);
                                $updateUser->bindValue(2, $reset_sql['player_id']);
                                $updateUser->execute();

                                echo json_encode([
                                    "response" => 'success',
                                    "append" => '<div class="alert success">Você alterou sua senha com êxito! Você será redirecionado em 5 segundos.</div><br>'
                                ]);
                            }
                        } else {
                            echo json_encode([
                                "response" => 'error',
                                "input" => 'input[name="repeat_password"]',
                                "error" => [
                                    "class" => 'div.col-input-separator:nth-child(5) > .error-input-warn',
                                    "text" => 'Este link de redifinição já foi usado ou é inválido.'
                                ]
                            ]);
                        }
                    } else {
                        echo json_encode([
                            "response" => 'error',
                            "input" => 'input[name="repeat_password"]',
                            "error" => [
                                "class" => 'div.col-input-separator:nth-child(5) > .error-input-warn',
                                "text" => 'Este link de redifinição já foi usado ou é inválido.'
                            ]
                        ]);
                    }
                }
            } else {
                echo 'A chave de redefinição de senha não foi informada.';
            } 
        }
    } else {
        echo 'Cannot get ' . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) . '.';
    }

?>