<?php
    function getMessagesFromTicket($db, $id) {
        $stmt = $db->prepare('SELECT * FROM message WHERE tID = ?');
        $stmt->execute(array($id));

        return $stmt->fetchAll();
    }

    function sendMessageToTicket($db, $id, $authorID, $text) {
        $stmt = $db->prepare('INSERT INTO MESSAGE(text, dateSent, tID, uID) VALUES (?, ?, ?, ?)');
        $date = date('Y-m-d H:i:s');
        $stmt->execute(array($text, $date, $id, $authorID));
    }
?>