<?php
    session_start();
    require_once(__DIR__ . '/../utils/validations.php');
    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../classes/ticket.class.php');
    require_once(__DIR__ . '/../database/tickets.php');

    if (!isset($_POST['id'])) {
      die();
    }

    $db = getDatabaseConnection();
    $ticket = Ticket::getTicket($db, $_POST['id']);
    
    if (!isset($_SESSION['uid']) || !isValidUser($ticket->uid, $ticket->aid, $_SESSION['uid'], $_SESSION['level'])) {
      header('Location: page.php');
    }

    $oldTicket = Ticket::getTicket($db, $_POST['id']);
    $status = $oldTicket->updateTicket($db, $_SESSION['uid'], $_POST['title'], $_POST['fulltext'], $_POST['department'], $_POST['id']);
    
    if ($status == -1) header('Location: ../pages/page.php');
    else header("Location: ../pages/view_ticket.php?id=$status->id");
?>    