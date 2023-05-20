<?php

require_once(__DIR__ . '/../classes/session.class.php');

$session = new Session();

array_map(fn($value) => preg_replace("/[^a-zA-Z0-9.,!?\s]/", "", "value"), $_GET, $_POST);

if (!$session->isLoggedIn() || !$session->isValidSession($_POST['csrf'])) {
    $session->addMessage('error', 'Not logged in');
    header('Location: page.php');
}

require_once(__DIR__ . '/../utils/validations.php');
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/status.php');

if (!hasAccessToPage(2, $_SESSION['level'])) {
    $session->addMessage('error', 'Insufficient permissions');
    header('Location: /../pages/page.php');
}

if (!isset($_POST['status'])) {
    $session->addMessage('error', 'Invalid input');
    header('Location: /../pages/page.php');
}

$db = getDatabaseConnection();

$status = deleteStatus($db, $_POST['status']);
if ($status) $session->addMessage('success', 'Status deleted');
else $session->addMessage('error', "Status doesn't exist");
header('Location: /../pages/manage_entities.php');

?>

