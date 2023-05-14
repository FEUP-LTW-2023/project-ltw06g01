<?php

require_once(__DIR__ . '/../classes/session.class.php');

$session = new Session();

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

addDepartment($db, $_POST['department']);
$session->addMessage('success', 'Department created');

?>

