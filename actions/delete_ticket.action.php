<?php

require_once(__DIR__ . '/../classes/session.class.php');

$session = new Session();

if (!$session->isLoggedIn() || !$session->isValidSession($_POST['csrf'])) {
    header('Location: ../pages/page.php');
}

require_once(__DIR__ . '/../utils/validations.php');
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../classes/ticket.class.php');

$db = getDatabaseConnection();
$ticket = Ticket::getTicket($db, $_POST['id']);

$ticket->deleteTicket();

header('Location: ../pages/open_tickets.php');
