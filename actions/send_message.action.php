<?php
    require_once(__DIR__ . '/../utils/validations.php');

    session_start();
    if (!isset($_SESSION['uid']) || !isValidUser($_GET['tuid'], $_GET['auid'], $_SESSION['uid'], $_SESSION['level'])) {
      header('Location: page.php');
    }

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/message.php');

    $db = getDatabaseConnection();

    sendMessageToTicket($db, $_GET['tID'], $_SESSION['uid'], $_GET['text']);

    $id = $_GET['tID'];
    header("Location: /../pages/view_ticket.php?id=$id");
?>
