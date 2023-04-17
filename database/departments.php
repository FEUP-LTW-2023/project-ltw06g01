<?php
    function getDepartments($db) {
        $stmt = $db->prepare('SELECT * FROM DEPARTMENT');
        $stmt->execute();

        return $stmt->fetchAll();
    }
?>    