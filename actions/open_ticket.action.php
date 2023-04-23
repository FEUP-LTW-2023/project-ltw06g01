<?php
    session_start();
    if (!isset($_SESSION['uid'])) {
      header('Location: page.php');
    }

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/tickets.php');
    $db = getDatabaseConnection();
    $status = Ticket::openTicket($db, intval($_SESSION['uid']), $_POST['title'], $_POST['fulltext'], $_POST['department']);
    
    if ($status == -1) header('Location: ../pages/page.php');
    else header("Location: ../pages/view_ticket.php?id=$status->id");
?>    