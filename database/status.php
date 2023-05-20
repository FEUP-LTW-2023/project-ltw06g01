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

function deleteStatus($db, $status) {
    $stmt = $db->prepare('DELETE FROM STATUS WHERE name = ?');
    $stmt->execute(array($status));

    if ($stmt->rowCount() == 0) return false;
    else return true;
}