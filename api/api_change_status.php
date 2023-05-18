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
$ticket->changeStatus($db, $_GET['status']);

echo json_encode($ticket->status);