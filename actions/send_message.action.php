<?php
    require_once(__DIR__ . '/../utils/validations.php');

    require_once(__DIR__ . '/../classes/session.class.php');

$session = new Session();

array_map(fn($value) => preg_replace("/[^a-zA-Z0-9.,!?\s]/", "", $value), $_GET, $_POST);

if (!$session->isLoggedIn() || !$session->isValidSession($_GET['csrf'])) {
    $session->addMessage('error', 'Not logged in');
    header('Location: page.php');
}

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/message.php');
    require_once(__DIR__ . '/../classes/ticket.class.php');

    $db = getDatabaseConnection();
    $ticket = Ticket::getTicket($db, $_GET['tID']);

    if (isValidUser($ticket->uid, $ticket->aid, $_SESSION['uid'], $_SESSION['level']) == 0) {
        $session->addMessage('error', "You can't send messages for this ticket");
        header('Location: /../pages/page.php');
    }


    sendMessageToTicket($db, $_GET['tID'], $_SESSION['uid'], $_GET['text']);

    $session->addMessage('success', 'Message sent');
    $id = $_GET['tID'];
    header("Location: /../pages/view_ticket.php?id=$id");
?>
