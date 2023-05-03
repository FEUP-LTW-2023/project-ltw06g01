<?php

function getAllTags($db) {
    $stmt = $db->prepare('SELECT * FROM TAG');
    $stmt->execute();

    return $stmt->fetchAll();
}

function getTicketTags($db, $id) {
    $stmt = $db->prepare('SELECT tag FROM tickettag WHERE tid = ?');
    $stmt->execute(array($id));

    return $stmt->fetchAll();
}

function setTicketTags($db, $id, $tags) {
    $n = count($tags);
    if ($n == 0) return;

    $params = array();

    $query = 'INSERT INTO TICKETTAG VALUES';
    for ($i = 0; $i < $n-1; $i++) {
        $query = $query . '(?, ?),';
        $params[] = $id;
        $params[] = $tags[$i];
    }
    $query = $query . '(?, ?)';
    $params[] = $id;
    $params[] = $tags[$n-1];

    $stmt = $db->prepare($query);
    $stmt->execute($params);
}