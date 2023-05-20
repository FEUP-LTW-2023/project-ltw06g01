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
require_once(__DIR__ . '/../database/departments.php');

if (!hasAccessToPage(2, $_SESSION['level'])) {
    $session->addMessage('error', 'Insufficient permissions');
    header('Location: /../pages/page.php');
}

if (!isset($_POST['department'])) {
    $session->addMessage('error', 'Invalid name');
    header('Location: /../pages/page.php');
}

$db = getDatabaseConnection();

$status = deleteDepartment($db, $_POST['department']);
if ($status) $session->addMessage('success', 'Department deleted');
else $session->addMessage('error', "Department doesn't exist");
header('Location: /../pages/manage_entities.php');
?>
