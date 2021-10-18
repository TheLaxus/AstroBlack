<?php

class User {
    
    static function userData($key) {
        global $db;

        $consultPlayer = $db->prepare("SELECT " . $key . " FROM players WHERE username = ?");
        $consultPlayer->bindValue(1, $_SESSION['username']);
        $consultPlayer->execute();
        $resultPlayer = $consultPlayer->fetch(PDO::FETCH_ASSOC);

        return $resultPlayer[$key];

    }

    static function bcryptHash($password) {
        return password_hash($password, PASSWORD_BCRYPT);
    }


    static function editSettingsAccount() {
		global $db;

		$editAccount = $db->prepare("SELECT id,email,password,motto FROM players WHERE username = ?");
		$editAccount->bindValue(1, $_SESSION['username']);
		$editAccount->execute();
		$fetch = $editAccount->fetch(PDO::FETCH_ASSOC);

        if (isset($_POST['settings-account'])) {

            $online = $db->prepare("SELECT online FROM players WHERE id = ?");
            $online->bindValue(1, $fetch['id']);
            $online->execute();
            $isOnline = $online->fetch(PDO::FETCH_ASSOC);

            if($isOnline['online'] != 1) {
                $motto = Functions::Filter('XSS', $_POST['motto']);

                if (strlen($motto) > 32) {
                    echo "<div class='rounded rounded-red'>Sua missão deve conter menos de 32 caracteres.</div>";
                    return;
                } else {
                    $updateMotto = $db->prepare("UPDATE players SET motto = ? WHERE id = ?");
                    $updateMotto->bindValue(1, $motto);
                    $updateMotto->bindValue(2, $fetch['id']);
                    $updateMotto->execute();
                }
    
    
    
                $versions = 0;

                if (isset($_POST['version']) == '24' || isset($_POST['version']) == '60') {
                    $versions = $_POST['version'];
                }

                $updateClientVersion = $db->prepare("UPDATE cms_clients SET version = ? WHERE user_id = ?");
                $updateClientVersion->bindValue(1, $versions);
                $updateClientVersion->bindValue(2, $fetch['id']);
                $updateClientVersion->execute();

                $hideOnline = isset($_POST['hideonline']) ? '0' : '1';
                $lastOnline = isset($_POST['lastonline']) ? '0' : '1';
                $friendsRequests = isset($_POST['amizade']) ? '1' : '0';
                $follow = isset($_POST['seguir']) ? '1' : '0';
                $copyFigure = isset($_POST['copiar']) ? '1' : '0';
                $allowTrade = isset($_POST['negociar']) ? '1' : '0';
                $whispers = isset($_POST['sussurrar']) ? '0' : '1';
                $allowSex = isset($_POST['sexo']) ? '1' : '0';

                $updateUserSettings = $db->prepare("UPDATE player_settings SET hide_online = ?, 
                                                    hide_last_online = ?, 
                                                    allow_friend_requests = ?, 
                                                    allow_follow = ?, 
                                                    allow_mimic = ?, 
                                                    allow_trade = ?,
                                                    disable_whisper = ?,
                                                    allow_sex = ? WHERE player_id = ?
                                                    ");
                $updateUserSettings->bindValue(1, $hideOnline);
                $updateUserSettings->bindValue(2, $lastOnline);
                $updateUserSettings->bindValue(3, $friendsRequests);
                $updateUserSettings->bindValue(4, $follow);
                $updateUserSettings->bindValue(5, $copyFigure);
                $updateUserSettings->bindValue(6, $allowTrade);
                $updateUserSettings->bindValue(7, $whispers);
                $updateUserSettings->bindValue(8, $allowSex);
                $updateUserSettings->bindValue(9, $fetch['id']);

                $updateUserSettings->execute();
    
                echo "<div class='rounded rounded-green'>Preferências salvas com sucesso!</div>";

            } else {

                echo "<div class='rounded rounded-red'>Você não pode alterar suas preferências enquanto estiver online.</div>";
            
            }

        } else if (isset($_POST['saveEmail'])) {

            $oldEmail = strtolower($_POST['currentemail']);
            $newEmail = strtolower($_POST['email']);

            if (empty($newEmail) || empty($oldEmail)) {
                echo "<div class='rounded rounded-red'>Preencha os campos informados.</div>";
                return;
            }

            if(!empty($newEmail) && $newEmail !== $fetch['email']) {

                    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

                            $changing = $db->prepare("UPDATE players SET email = ? WHERE id = ? AND email = ?");
                            $changing->bindValue(1, $newEmail);
                            $changing->bindValue(2, $fetch['id']);
                            $changing->bindValue(3, $oldEmail);
                            $changing->execute();

                            echo "<div class='rounded rounded-green'>Seu email foi alterado com sucesso.</div>";

                    } else {
                        echo "<div class='rounded rounded-red'>E-mail em formato inválido</div>";
                    }
            }

        } else if (isset($_POST['savePassword'])) {

            $oldPassword = $_POST['currentpassword'];
            $newPassword = $_POST['password'];

            if (isset($oldPassword) && !empty($oldPassword)) {

                    if (isset($newPassword) && !empty($newPassword)) {

                        $getID = $db->prepare("SELECT id,username,password FROM players WHERE username = ?");
                        $getID->bindValue(1, $_SESSION['username']);
                        $getID->execute();
                        $getInfo = $getID->fetch(PDO::FETCH_ASSOC);

                        if (password_verify($oldPassword, $getInfo['password'])) {

                            if (strlen($newPassword) >= 6) {

                                $newPasswordHashed = self::bcryptHash($newPassword);
                                $changing = $db->prepare("UPDATE players SET password = ? WHERE id = ?");
                                $changing->bindValue(1, $newPasswordHashed);
                                $changing->bindValue(2, $fetch['id']);
                                $changing->execute();

                                echo "<div class='rounded rounded-green'>Sua senha foi alterada com sucesso.</div>";

                            } else {
                                echo "<div class='rounded rounded-red'>Sua senha deve conter mais de 6 caracteres.</div>";
                            }

                        } else {
                            echo "<div class='rounded rounded-red'>Sua senha antiga está incorreta.</div>";
                        }
                    } else {
                        echo "<div class='rounded rounded-red'>Preencha todos os campos informados.</div>";
                    }
            } else {
                echo "<div class='rounded rounded-red'>Preencha todos os campos informados.</div>";
            }

        }
	}

    static function deleteTags() {
        global $db;
        if (isset($_GET['delete'])) {
            $deleteNews = $db->prepare("DELETE FROM player_tags WHERE id = ?");
            $deleteNews->bindValue(1, $_GET['delete']);
            $deleteNews->execute();

            header("Location: /");

        }
    }

    static function userTaken($username) {
        global $db;

        $stmt = $db->prepare("SELECT username FROM players WHERE username = ? LIMIT 1");
        $stmt->bindValue(1, $username);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

}

?>