<?php

function getAllStatuses($db) {
    $stmt = $db->prepare('SELECT * FROM STATUS');
    $stmt->execute();

    return $stmt->fetchAll();
}