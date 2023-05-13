<?php

function getAllStatuses($db) {
    $stmt = $db->prepare('GET * FROM STATUS');
    $stmt->execute();

    return $stmt->fetchAll();
}