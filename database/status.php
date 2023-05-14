<?php

function getAllStatuses($db) {
    $stmt = $db->prepare('SELECT * FROM STATUS');
    $stmt->execute();

    return $stmt->fetchAll();
}

function addStatus($db, $status) {
    $stmt = $db->prepare('INSERT INTO STATUS VALUES (?)');
    $stmt->execute(array($status));
}