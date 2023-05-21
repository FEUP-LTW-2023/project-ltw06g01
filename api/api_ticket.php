<?php
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/tickets.php');
require_once(__DIR__ . '/../classes/ticket.class.php');
require_once(__DIR__ . '/../classes/session.class.php');

$session = new Session();

if (!$session->isLoggedIn() || !$session->isValidSession($_GET['csrf'])) {
    header('Location: page.php');
}

$db = getDatabaseConnection();

$ticket = Ticket::getTicket($db, $_GET['id']);

echo json_encode($ticket);
