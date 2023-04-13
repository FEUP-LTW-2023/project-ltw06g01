<?php
    function getTicket($db, $id) {
        $stmt = $db->prepare('SELECT * FROM ticket WHERE id = ? AND isHistory = 0');
        $stmt->execute(array($id));

        return $stmt->fetch();
    }

    function getTicketsFromDepartment($db, $department) {
        $stmt = $db->prepare('SELECT * FROM ticket WHERE department = ? AND isHistory = 0');
        $stmt->execute(array($department));

        return $stmt->fetchAll();
    }

    function getTicketHistory($db, $id, $maxVersions) {
        $stmt = $db->prepare('SELECT * FROM ticket WHERE id = ? LIMIT ?');
        $stmt->execute(array($id, $maxVersions));

        return $stmt->fecthAll();
    }

    function getTicketsFromAgent($db, $aid) {
        $stmt = $db->prepare('SELECT * FROM ticket WHERE aid = ?');
        $stmt->execute(array($aid));

        return $stmt->fetchAll();
    }

    function getTicketTags($db, $id, $maxTags) {
        $stmt = $db->prepare('SELECT tag FROM tickettag WHERE tid = ? LIMIT ?');
        $stmt = $db->execute(array($id, $maxTags));

        return $stmt->fecthAll();
    }

    function addTicket($db, $uid, $title, $text) {
        $stmt = $db->prepare('INSERT INTO TICKET(title, text, dateCreated, uID, isHistory) VALUES (?, ?, ?, ?, 0)');
        $date = date('Y-m-d');
        $stmt->execute(array($title, $text, $date, $uid));
    }
?>