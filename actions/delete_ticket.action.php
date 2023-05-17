<?php

require_once(__DIR__ . '/../classes/session.class.php');

$session = new Session();
echo var_dump($_POST);

if (!$session->isLoggedIn() || !$session->isValidSession($_POST['csrf'])) {
    $session->addMessage('error', 'Not logged in');
    header('Location: page.php');
}

require_once(__DIR__ . '/../utils/validations.php');
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../classes/ticket.class.php');

$db = getDatabaseConnection();
$ticket = Ticket::getTicket($db, $_POST['id']);

$ticket->deleteTicket($db);

$session->addMessage('success', 'Ticket deleted');
header('Location: ../pages/open_tickets.php');
