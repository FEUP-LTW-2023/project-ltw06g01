<?php

require_once(__DIR__ . '/../classes/session.class.php');

$session = new Session();

if (!$session->isLoggedIn() || !$session->isValidSession($_POST['csrf'])) {
    $session->addMessage('error', 'Not logged in');
    header('Location: page.php');
}

require_once(__DIR__ . '/../utils/validations.php');
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../classes/faq.class.php');
require_once(__DIR__ . '/../classes/ticket.class.php');

$db = getDatabaseConnection();
$ticket = Ticket::getTicket($db, $_POST['tid']);

if (!hasAccessToPage(2, $_SESSION['level']) || ($_SESSION['uid'] != $ticket->aid)) {
    $session->addMessage('error', 'Insufficient permissions');
    header('Location: /../pages/page.php');
}

$faqitem = FAQ::getFAQItem($db, $_POST['faq-selection']);
$faqitem->assignToTicket($db, $_POST['tid']);
$tID = $ticket->id;

$session->addMessage('success', 'FAQ item assigned');
header("Location: /../pages/view_ticket.php?id=$tID");