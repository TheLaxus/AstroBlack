<?php
	require_once('../../global.php');

    header('Content-Type: application/json');


    if (extract($_POST)) {
        $order = (isset($_POST['order'])) ? $_POST['order'] : '';

        if ($order == 'settings/account') {


            $online = $db->prepare("SELECT online FROM players WHERE id = ?");
            $online->bindValue(1, User::userData('id'));
            $online->execute();
            $isOnline = $online->fetch(PDO::FETCH_ASSOC);

            if ($isOnline['online'] != 1) {
                $motto = Functions::Filter('XSS', $_POST['motto']);

                if (strlen($motto) > 32) {
                    echo json_encode([
                        "response" => 'error',
                        "input" => 'input[name="motto"]',
                        "error" => [
                            "class" => 'div.col-input-separator:nth-child(2) > .error-input-warn',
                            "text" => 'Sua missão deve conter no máximo 32 caracteres.'
                        ]
                    ]);                    return;
                } else {
                    $updateMotto = $db->prepare("UPDATE players SET motto = ? WHERE id = ?");
                    $updateMotto->bindValue(1, $motto);
                    $updateMotto->bindValue(2, User::userData('id'));
                    $updateMotto->execute();
                }
            

                $versions = 0;
            
                if (isset($_POST['version']) == '24' || isset($_POST['version']) == '60') {
                    $versions = $_POST['version'];
                }

                $updateClientVersion = $db->prepare("UPDATE cms_clients SET version = ? WHERE user_id = ?");
                $updateClientVersion->bindValue(1, $versions);
                $updateClientVersion->bindValue(2, User::userData('id'));
                $updateClientVersion->execute();


                $hideOnline = isset($_POST['hideonline']) ? '0' : '1';
                $lastOnline = isset($_POST['lastOnline']) ? '0' : '1';
                $follow = isset($_POST['seguir']) ? '1' : '0';
                $copyFigure = isset($_POST['copiar']) ? '1' : '0';
                $allowTrade = isset($_POST['negociar']) ? '1' : '0';
                $whispers = isset($_POST['sussurrar']) ? '0' : '1';
                $allowSex = isset($_POST['sexo']) ? '1' : '0';


            $updateUserSettings = $db->prepare("UPDATE player_settings SET hide_online = ?, 
                                                                        hide_last_online = ?, 
                                                                        allow_follow = ?, 
                                                                        allow_mimic = ?, 
                                                                        allow_trade = ?,
                                                                        disable_whisper = ?,
                                                                        allow_sex = ? WHERE player_id = ?
                                                                        ");
                $updateUserSettings->bindValue(1, $hideOnline);
                $updateUserSettings->bindValue(2, $lastOnline);
                $updateUserSettings->bindValue(3, $follow);
                $updateUserSettings->bindValue(4, $copyFigure);
                $updateUserSettings->bindValue(5, $allowTrade);
                $updateUserSettings->bindValue(6, $whispers);
                $updateUserSettings->bindValue(7, $allowSex);
                $updateUserSettings->bindValue(8, User::userData('id'));

                $updateUserSettings->execute();

                echo json_encode([
                    "response" => 'success',
                    "append" => '<div class="alert success">Você editou suas preferências com êxito.</div><br>'
                ]);
                
            
            } else {
                echo json_encode([
                    "response" => 'success',
                    "append" => '<div class="alert failed">Você precisa está <b>offline</b> para atualizar suas preferências.</div><br>'
                ]);
            }

        } else if ($order == 'settings/email') {
            $password = (isset($_POST['password'])) ? $_POST['password'] : '';
            $email = strtolower((isset($_POST['email'])) ? $_POST['email'] : '');
            

            if (empty($password)) {
                echo json_encode([
                    "response" => 'error',
                    "input" => 'input[name="currentPassword"]',
                    "error" => [
                        "class" => 'div.col-input-separator:nth-child(2) > .error-input-warn',
                        "text" => 'Você não pode deixar o campo de senha vázio.'
                    ]
                ]);
            } else if (empty($email)) {
                echo json_encode([
                    "response" => 'error',
                    "input" => 'input[name="email"]',
                    "error" => [
                        "class" => 'div.col-input-separator:nth-child(5) > .error-input-warn',
                        "text" => 'Você não pode deixar o campo de e-mail vázio.'
                    ]
                ]);
            } else if (!password_verify($password, User::userData('password'))) {
                echo json_encode([
                    "response" => 'error',
                    "input" => 'input[name="currentPassword"]',
                    "error" => [
                        "class" => 'div.col-input-separator:nth-child(2) > .error-input-warn',
                        "text" => 'Sua senha atual está incorreta.'
                    ]
                ]);
            } else {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

                    $change_email = $db->prepare("UPDATE players SET email = ? WHERE id = ?");
                    $change_email->bindValue(1, $email);
                    $change_email->bindValue(2, User::userData('id'));
                    $change_email->execute();

                    if ($change_email->rowCount() > 0) {
                        echo json_encode([
                            "response" => 'success',
                            "append" => '<div class="alert success">Você editou seu email com êxito.</div><br>'
                        ]);
                    } else {
                        echo json_encode([
                            "response" => 'success',
                            "append" => '<div class="alert failed">Ocorreu um erro ao trocar seu email.</div><br>'
                        ]);
                    }

                }
            }

        } else if ($order == 'settings/password') {
            $currentpassword = (isset($_POST['currentpassword'])) ? $_POST['currentpassword'] : '';
            $new_password = (isset($_POST['new_password'])) ? $_POST['new_password'] : '';

            if (empty($currentpassword)) {
                echo json_encode([
                    "response" => 'error',
                    "input" => 'input[name="currentpassword"]',
                    "error" => [
                        "class" => 'div.col-input-separator:nth-child(2) > .error-input-warn',
                        "text" => 'Preencha sua senha atual.'
                    ]
                ]);
            } else if (empty($new_password)) {
                echo json_encode([
                    "response" => 'error',
                    "input" => 'input[name="password"]',
                    "error" => [
                        "class" => 'div.col-input-separator:nth-child(5) > .error-input-warn',
                        "text" => 'Preencha sua nova senha.'
                    ]
                ]);
            } else if (!password_verify($currentpassword, User::userData('password'))) {
                echo json_encode([
                    "response" => 'error',
                    "input" => 'input[name="currentpassword"]',
                    "error" => [
                        "class" => 'div.col-input-separator:nth-child(2) > .error-input-warn',
                        "text" => 'Sua senha atual está incorreta.'
                    ]
                ]);
            } else if (strlen($new_password) < 6) {
                echo json_encode([
                    "response" => 'error',
                    "input" => 'input[name="password"]',
                    "error" => [
                        "class" => 'div.col-input-separator:nth-child(5) > .error-input-warn',
                        "text" => 'Sua senha tem que conter no minímo 6 caracteres.'
                    ]
                ]);
            } else {
                $newPasswordHashed = User::bcryptHash($new_password);

                $change_password = $db->prepare("UPDATE players SET password = ? WHERE id = ?");
                $change_password->bindValue(1, $newPasswordHashed);
                $change_password->bindValue(2, User::userData("id"));
                $change_password->execute();

                if ($change_password->rowCount() > 0) {
                    echo json_encode([
                        "response" => 'success',
                        "append" => '<div class="alert success">Você alterou sua senha com êxito! Sua conta será desconectada em 5 segundos.</div><br>'
                    ]);

                    session_destroy();
                } else {
                    echo json_encode([
                        "response" => 'success',
                        "append" => '<div class="alert failed">Ocorreu um erro ao trocar sua senha, tente novamente mais tarde!</div><br>'
                    ]);
                }
            }

        }

    } else {
        echo 'Cannot get ' . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) . '.';
    }
?>