<?php

session_start();
if (!isset($_SESSION['uid'])) {
    header('Location: /../pages/page.php');
}

require_once(__DIR__ . '/../utils/validations.php');
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../classes/ticket.class.php');

if (!hasAccessToPage(1, $_SESSION['level'])) {
    header('Location: /../pages/page.php');
}

$db = getDatabaseConnection();
$ticket = Ticket::getTicket($db, $_GET['id']);
$ticket->changePriority($db, $_GET['priority']);