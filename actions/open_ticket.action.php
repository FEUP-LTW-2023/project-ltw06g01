<?php
    session_start();
    if (!isset($_SESSION['uid'])) {
      header('Location: page.php');
    }

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/tickets.php');
    $db = getDatabaseConnection();
    addTicket($db, intval($_SESSION['uid']), $_POST['title'], $_POST['fulltext'], $_POST['department']);
    exit();
?>    