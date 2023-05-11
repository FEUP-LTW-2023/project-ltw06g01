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
    
/* mostra todos os tickets só para fazer o css

    function getFilteredTickets($db) {
    $stmt = $db->prepare('SELECT * FROM ticket');
    $stmt->execute();
    return $stmt->fetchAll();
}

*/    

    function getTicketsAssignedTo($db, $aid) {
        $stmt = $db->prepare('SELECT * FROM ticket WHERE aID = ? AND future = NULL');
        $stmt->execute(array($aid));

        return $stmt->fetchAll();
    }

    function getTicketsWithTags($db, array $tags) {
        if (empty($tags)) return;
        $query = 'SELECT * FROM ticket t JOIN TICKETTAG tt ON t.id = tt.tID WHERE tt.tag = ?';
        for ($i = 0; $i < count($tags) - 1; $i++) {
            $query = $query . ' OR tt.tag = ?';
        }
        $query = $query . ' GROUP BY t.id HAVING count(tt.tag) = ?';
        
        $stmt = $db->prepare($query);
        $stmt->execute(array_merge($tags, array(count($tags) - 1)));

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

    /*function getTicketTags($db, $id, $maxTags) {
        $stmt = $db->prepare('SELECT tag FROM tickettag WHERE tid = ? AND future is NULL LIMIT ?');
        $stmt = $db->execute(array($id, $maxTags));

        return $stmt->fecthAll();
    }*/

    function addTicket($db, $uid, $title, $text, $department) {
        $stmt = $db->prepare('INSERT INTO TICKET(title, text, dateCreated, uID, department, status) VALUES (?, ?, ?, ?, ?, ?)');
        $date = date('Y-m-d');
        $result = $stmt->execute(array($title, $text, $date, $uid, $department, 'open'));

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

        //$stmt = $db->prepare('INSERT INTO TICKETTAG (tID, tag) SELECT ?, tag FROM TICKETTAG WHERE tID = ?');
        //$stmt->execute(array($newId, $id));

        if ($result === 0) return -1;
        else return $newId;
    }

    function assignAgent($db, $id, $aid) {
        $stmt = $db->prepare('UPDATE TICKET SET aID = ? WHERE id = ? AND future = NULL');
        $otherStmt = $db->prepare('UPDATE TICKET SET status = "assigned" WHERE id = ? AND status = "open" AND future = NULL');

        $stmt->execute(array($aid, $id));
        $otherStmt->execute(array($id));
    }
?>