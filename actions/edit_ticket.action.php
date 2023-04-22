<?php
    require_once(__DIR__ . '/../utils/validations.php');

    session_start();
    if (!isset($_SESSION['uid']) || !isValidUser($_GET['tuid'], $_GET['auid'], $_SESSION['uid'], $_SESSION['level'])) {
      header('Location: page.php');
    }

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/tickets.php');

    $db = getDatabaseConnection();
    $status = addTicket($db, intval($_SESSION['uid']), $_POST['title'], $_POST['fulltext'], $_POST['department'], $_POST['id']);