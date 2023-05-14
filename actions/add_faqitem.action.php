<?php

require_once(__DIR__ . '/../classes/session.class.php');

$session = new Session();

if (!$session->isLoggedIn() || !$session->isValidSession($_POST['csrf'])) {
    $session->addMessage('error', 'Not logged in');
    header('Location: page.php');
}

require_once(__DIR__ . '/../utils/validations.php');
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/faq.php');

if (!hasAccessToPage(1, $_SESSION['level'])) {
    $session->addMessage('error', 'Insufficient permissions');
    header('Location: /../pages/page.php');
}

if (!isset($_POST['question']) || !isset($_POST['answer'])) {
    $session->addMessage('error', 'Invalid inputs');
    header('Location: /../pages/page.php');
}

$db = getDatabaseConnection();

createFAQItem($db, $_POST['question'], $_POST['answer']);
$session->addMessage('success', 'FAQ item created');


?>

