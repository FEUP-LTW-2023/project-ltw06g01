<?php

require_once(__DIR__ . '/../classes/session.class.php');

$session = new Session();

array_map(fn($value) => preg_replace("/[^a-zA-Z0-9.,!?\s]/", "", $value), $_GET, $_POST);

if (!$session->isLoggedIn() || !$session->isValidSession($_POST['csrf'])) {
    $session->addMessage('error', 'Not logged in');
    header('Location: page.php');
}

require_once(__DIR__ . '/../utils/validations.php');
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../classes/ticket.class.php');

$db = getDatabaseConnection();
$ticket = Ticket::getTicket($db, $_POST['id']);
echo var_dump($ticket);

$ticket->deleteTicket($db);

$session->addMessage('success', 'Ticket deleted');
header('Location: ../pages/open_tickets.php');
