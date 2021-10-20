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