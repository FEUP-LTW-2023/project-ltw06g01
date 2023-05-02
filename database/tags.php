<?php

function getAllTags($db) {
    $stmt = $db->prepare('SELECT * FROM TAG');
    $stmt->execute();

    return $stmt->fetchAll();
}

function getTicketTags($db, $id) {
    $stmt = $db->prepare('SELECT * FROM TICKETTAG WHERE tID = ?');
    $stmt->execute(array($id));

    return $stmt->fetchAll();
}