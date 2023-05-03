<?php
    session_start();
    if (!isset($_SESSION['uid'])) {
      header('Location: page.php');
    }

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/tickets.php');
    require_once(__DIR__ . '/../classes/ticket.class.php');
    require_once(__DIR__ . '/../database/tags.php');

    $db = getDatabaseConnection();
    $status = Ticket::openTicket($db, intval($_SESSION['uid']), $_POST['title'], $_POST['fulltext'], $_POST['department']);
    setTicketTags($db, $status->id, array('potato', 'tomato'));
    
    if ($status == -1) header('Location: ../pages/page.php');
    else header("Location: ../pages/view_ticket.php?id=$status->id");
?>    