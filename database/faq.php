<?php
    function getFAQItems($db) {
        $stmt = $db->prepare('SELECT * FROM FAQITEM');
        $stmt->execute();

        return $stmt->fetchAll();
    }

    function getFAQItemTags($db, $id, $maxTags) {
        $stmt = $db->prepare('SELECT tag FROM faqtag WHERE fid = ? limit ?');
        $stmt->execute();

        return $stmt->fecthAll();
    }
?>