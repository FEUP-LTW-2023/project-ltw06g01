<?php
    require_once(__DIR__ . '../database/connection.php');
    require_once(__DIR__ . '../database/tickets.php');
    $db = getDatabaseConnection();
    addTicket($db, $_POST['uid'], $_POST['title'], $_POST['fulltext']);
    exit();
?>    