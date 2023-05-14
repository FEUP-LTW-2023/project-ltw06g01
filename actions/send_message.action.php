<?php
    require_once(__DIR__ . '/../utils/validations.php');

    require_once(__DIR__ . '/../classes/session.class.php');

$session = new Session();

if (!$session->isLoggedIn() || !$session->isValidSession($_GET['csrf'])) {
    $session->addMessage('error', 'Not logged in');
    header('Location: page.php');
}

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/message.php');

    $db = getDatabaseConnection();

    sendMessageToTicket($db, $_GET['tID'], $_SESSION['uid'], $_GET['text']);

    $id = $_GET['tID'];
    header("Location: /../pages/view_ticket.php?id=$id");
?>
