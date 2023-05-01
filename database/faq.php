<?php
    function getFAQItems($db) {
        $stmt = $db->prepare('SELECT * FROM FAQITEM');
        $stmt->execute();

        return $stmt->fetchAll();
    }

    function getFAQItemTags($db, $id, $maxTags) {
        $stmt = $db->prepare('SELECT tag FROM faqtag WHERE fid = ? limit ?');
        $stmt->execute(array($id, $maxTags));

        return $stmt->fecthAll();
    }

    function assignFAQItemToTicket($db, $faqID, $tID) {
        $stmt = $db->prepare('UPDATE TICKET SET faqitem = ? WHERE id = ?');
        $stmt->execute(array($faqID, $tID));
    }

    function createFAQItem($db, $question, $answer) {
        $stmt = $db->prepare('INSERT INTO FAQITEM(question, answer, dateCreated) VALUES (?, ?, ?)');
        $date = date('Y-m-d');
        $stmt->execute(array($question, $answer, $date));

        return $db->lastInsertId();
    }
?>