<?php
    require_once(__DIR__ . '/../classes/session.class.php');

    $session = new Session();
    
    if (!$session->isLoggedIn() || !$session->isValidSession($_POST['csrf'])) {
        header('Location: page.php');
    }

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/tickets.php');
    require_once(__DIR__ . '/../classes/ticket.class.php');
    require_once(__DIR__ . '/../database/tags.php');

    $db = getDatabaseConnection();
    $status = Ticket::openTicket($db, intval($_SESSION['uid']), $_POST['title'], $_POST['fulltext'], $_POST['department']);
    
    if (!isset($status) == -1) header('Location: ../pages/page.php');
    else header("Location: ../pages/view_ticket.php?id=$status->id");
?>    