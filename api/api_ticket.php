<?php
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/tickets.php');
require_once(__DIR__ . '/../classes/ticket.class.php');

$db = getDatabaseConnection();

$ticket == Ticket::getTicket($db, $_GET['id']);

echo json_encode($ticket);
?>