<?php
    function getUser($db, $id) {
        $stmt = $db->prepare('SELECT * FROM CLIENT WHERE uid = ?');
        $stmt->execute(array($id));

        return $stmt->fetch();
    }

    function tryLoginName($db, $name) {
        $stmt = $db->prepare('SELECT * FROM CLIENT WHERE username = ?');
        $stmt->execute(array($name));

        return $stmt->fetch();
    }

    function tryLoginEmail($db, $email) {
        $stmt = $db->prepare('SELECT * FROM CLIENT WHERE email = ?');
        $stmt->execute(array($email));

        return $stmt->fetch();
    }

    function createNewUser($db, $username, $email, $password) {
        $stmt = $db->prepare('INSERT INTO CLIENT(username, passHash, email, permissionLevel) VALUES (?, ?, ?, 0)');
        $result = $stmt->execute(array($username, hash('sha256', $password,), $email));

        return array(!($result === 0), $db->lastInsertId());
    }

    function updateUserPerms($db, $id, $newLevel) {
        if ($newLevel > 2 && $newLevel < 0) return;

        $stmt = $db->prepare('UPDATE CLIENT SET permissionLevel = ? WHERE uid = ?');
        $stmt->execute(array($newLevel, $id));
    }

    function updateProfile($db, $id, $username, $email) {
        $stmt = $db->prepare('UPDATE CLIENT SET username = ?, email = ? WHERE uid = ?');
        $stmt->execute(array($username, $email, $id));
    }

    function change_animationFlag($newFlag) {
        session_start();
        $_SESSION['animation'] = $newFlag;
        //session_write_close();
    }

    function getAllUsers($db) {
        $stmt = $db->prepare('SELECT * FROM CLIENT');
        $stmt->execute();

        return $stmt->fetchAll();
    }
?>