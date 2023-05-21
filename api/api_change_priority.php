<?php

require_once(__DIR__ . '/../classes/session.class.php');

$session = new Session();

if (!$session->isLoggedIn() || !$session->isValidSession($_GET['csrf'])) {
    header('Location: page.php');
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

echo json_encode($ticket->priority);
