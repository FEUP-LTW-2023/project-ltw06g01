<?php
    function getDepartments($db) {
        $stmt = $db->prepare('SELECT * FROM DEPARTMENT');
        $stmt->execute();

        return $stmt->fetchAll();
    }

    function getDepartmentsAgent($db, $aid) {
        $stmt = $db->prepare('SELECT * FROM AGENTDEPARTMENT WHERE aid = ?');
        $stmt->execute(array($aid));

        return $stmt->fetchAll();
    }

    function toggleDepartment($db, $aid, $department) {
        $stmt = $db->prepare('SELECT * FROM AGENTDEPARTMENT WHERE aid = ? AND department = ?');
        $stmt->execute(array($aid, $department));

        if (empty($stmt->fetch())) {
            $stmt = $db->prepare('INSERT INTO AGENTDEPARTMENT VALUES (?,?)');
            $stmt->execute(array($aid, $department));
        }
        else {
            $stmt = $db->prepare('DELETE FROM AGENTDEPARTMENT WHERE aid = ? AND department = ?');
            $stmt->execute(array($aid, $department));
        }

        return getDepartmentsAgent($db, $aid);
    }
?>    