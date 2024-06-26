<?php
    function getTicket($db, $id) {
        $stmt = $db->prepare('SELECT * FROM ticket WHERE id = ?');
        $stmt->execute(array($id));

        return $stmt->fetch();
    }

    function getFilteredTickets($db, $status, $agent, $department) {
        $query = 'SELECT * FROM ticket WHERE future is NULL';
        $params = array();

        if ($status != 'all') {
            $query .= ' AND status = ?';
            $params[] = $status;
        }
        if ($agent != -1) {
            $query .= ' AND aID = ?';
            $params[] = $agent;
        }
        if ($department != 'unassigned') {
            $query .= ' AND department = ?';
            $params[] = $department;
        }
        $stmt = $db->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll();
    }

    function getTicketsWithTags($db, array $tags) {
        if (empty($tags)) {
            $stmt = $db->prepare('SELECT * FROM TICKET WHERE future is NULL');
            $stmt->execute(array());

            return $stmt->fetchAll();
        }
        $query = 'SELECT * FROM ticket t JOIN TICKETTAG tt ON t.id = tt.tID WHERE t.future is NULL AND tt.tag = ?';
        for ($i = 0; $i < count($tags) - 1; $i++) {
            $query = $query . ' OR tt.tag = ?';
        }
        $query = $query . ' GROUP BY t.id HAVING count(tt.tag) = ' . count($tags);

        $stmt = $db->prepare($query);
        $stmt->execute($tags);

        return $stmt->fetchAll();
    }

    function getTicketsByUser($db, $uid) {
        $stmt = $db->prepare('SELECT * FROM ticket WHERE uID = ? AND future is NULL');
        $stmt->execute(array($uid));

        return $stmt->fetchAll();
    }

    function addTicket($db, $uid, $title, $text, $department) {
        $stmt = $db->prepare('INSERT INTO TICKET(title, text, dateCreated, uID, department, status, priority) VALUES (?, ?, ?, ?, ?, ?, ?)');
        $date = date('Y-m-d');
        $result = $stmt->execute(array($title, $text, $date, $uid, $department, 'open', 0));

        if ($result === 0) return -1;
        else return $db->lastInsertId();
    }

    function deleteTicket($db, $id) {
        $stmt = $db->prepare('DELETE FROM TICKET WHERE id = ? AND future is NULL');
        $stmt->execute(array($id));
    }

    function updateTicket($db, $uid, $title, $text, $department, $id, $status, $priority, $faqitem, $aid) {
        $stmt = $db->prepare('INSERT INTO TICKET(title, text, dateCreated, uID, department, history, status, priority, faqitem, aID) VALUES (?, ? ,?, ?, ?, ?, ?, ?, ?, ?)');
        $date = date('Y-m-d');
        $result = $stmt->execute(array($title, $text, $date, $uid, $department, $id, $status, $priority, $faqitem, $aid));
        $newId = $db->lastInsertId();

        $stmt = $db->prepare('UPDATE TICKET SET future = ? WHERE id = ?');
        $stmt->execute(array($newId, $id));

        $stmt = $db->prepare('INSERT INTO MESSAGE (text, dateSent, uID, tID) SELECT text, dateSent, uID, ? FROM MESSAGE WHERE tID = ?');
        $stmt->execute(array($newId, $id));

        if ($result === 0) return -1;
        else return $newId;
    }

    function assignAgent($db, $id, $aid) {
        $stmt = $db->prepare('UPDATE TICKET SET aID = ? WHERE id = ? AND future is NULL');
        $otherStmt = $db->prepare('UPDATE TICKET SET status = "assigned" WHERE id = ? AND status = "open" AND future is NULL');

        $stmt->execute(array($aid, $id));
        $otherStmt->execute(array($id));
    }

    function changeStatus($db, $status, $id) {
        $stmt = $db->prepare('UPDATE TICKET SET status = ? WHERE id = ? AND future is NULL');
        $stmt->execute(array($status, $id));
    }

    function changePriority($db, $priority, $id) {
        if ($priority < 0 || $priority > 3) return;

        $stmt = $db->prepare('UPDATE TICKET SET priority = ? WHERE id = ? AND future is NULL');
        $stmt->execute(array($priority, $id));
    }
