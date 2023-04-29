<?php
session_start();

session_start();
if (!isset($_SESSION['uid'])) {
    header('Location: /../pages/page.php');
}

require_once(__DIR__ . '/../utils/validations.php');
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/client.php');

if (!hasAccessToPage(2, $_SESSION['level'])) {
    header('Location: /../pages/page.php');
}

if (!isset($_GET['uid']) || !isset($_GET['level'])) {
    header('Location: /../pages/page.php');
}

$db = getDatabaseConnection();
$result = User::updateUserPermissions($db, $_GET['uid'], $_GET['level']);
$result = $result ? 1 : 0;

$json = array();
$json['success'] = $result;

echo json_encode($json);
