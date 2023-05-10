<?php
    function getTicket($db, $id) {
        $stmt = $db->prepare('SELECT * FROM ticket WHERE id = ?');
        $stmt->execute(array($id));

        return $stmt->fetch();
    }

    function getFilteredTickets($db, $statusFilter = null) {
        
        if ($statusFilter === null || $statusFilter == 'all') {
            $stmt = $db->prepare('SELECT * FROM ticket AND future is NULL');
        } else {
            $stmt = $db->prepare('SELECT * FROM ticket WHERE status = :status AND future is NULL');
            $stmt->bindParam(':status', $statusFilter);
        }
        
        $stmt->execute();
        return $stmt->fetchAll();
    }

    function getTicketsByUser($db, $uid) {
        $stmt = $db->prepare('SELECT * FROM ticket WHERE uID = ? AND future is NULL');
        $stmt->execute(array($uid));

        return $stmt->fetchAll();
    }

    function getTicketsFromDepartment($db, $department) {
        $stmt = $db->prepare('SELECT * FROM ticket WHERE department = ? AND future is NULL');
        $stmt->execute(array($department));

        return $stmt->fetchAll();
    }

    /*function getTicketHistory($db, $id, $maxVersions) {
        $stmt = $db->prepare('SELECT * FROM ticket WHERE id = ? LIMIT ?');
        $stmt->execute(array($id, $maxVersions));

        return $stmt->fecthAll();
    }*/

    function getTicketsFromAgent($db, $aid) {
        $stmt = $db->prepare('SELECT * FROM ticket WHERE aid = ? AND future is NULL');
        $stmt->execute(array($aid));

        return $stmt->fetchAll();
    }

    function getTicketTags($db, $id, $maxTags) {
        $stmt = $db->prepare('SELECT tag FROM tickettag WHERE tid = ? AND future is NULL LIMIT ?');
        $stmt = $db->execute(array($id, $maxTags));

        return $stmt->fecthAll();
    }

    function addTicket($db, $uid, $title, $text, $department) {
        $stmt = $db->prepare('INSERT INTO TICKET(title, text, dateCreated, uID, department) VALUES (?, ?, ?, ?, ?)');
        $date = date('Y-m-d');
        $result = $stmt->execute(array($title, $text, $date, $uid, $department));

        if ($result === 0) return -1;
        else return $db->lastInsertId();
    }

    function updateTicket($db, $uid, $title, $text, $department, $id) {
        $stmt = $db->prepare('INSERT INTO TICKET(title, text, dateCreated, uID, department, history) VALUES (?, ? ,?, ?, ?, ?)');
        $date = date('Y-m-d');
        $result = $stmt->execute(array($title, $text, $date, $uid, $department, $id));
        $newId = $db->lastInsertId();

        $stmt = $db->prepare('UPDATE TICKET SET future = ? WHERE id = ?');
        $stmt->execute(array($newId, $id));

        $stmt = $db->prepare('INSERT INTO MESSAGE (text, dateSent, uID, tID) SELECT text, dateSent, uID, ? FROM MESSAGE WHERE tID = ?');
        $stmt->execute(array($newId, $id));

        $stmt = $db->prepare('INSERT INTO TICKETTAG (tID, tag) SELECT ?, tag FROM TICKETTAG WHERE tID = ?');
        $stmt->execute(array($newId, $id));

        if ($result === 0) return -1;
        else return $newId;
    }
?>