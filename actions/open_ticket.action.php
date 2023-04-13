<?php
    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/tickets.php');
    $db = getDatabaseConnection();
    addTicket($db, intval($_POST['uid']), $_POST['title'], $_POST['fulltext']);
    exit();
?>    