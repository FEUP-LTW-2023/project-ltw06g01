<?php
session_start();
if (!isset($_SESSION['uid'])) {
  header('Location: page.php');
}

require_once(__DIR__ . '/../utils/validations.php');
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../classes/user.class.php');
require_once(__DIR__ . '/../templates/profile.tpl.php');
require_once(__DIR__ . '/../templates/common.tpl.php');

if (!hasAccessToPage(2, $_SESSION['level'])) {
    header('Location: page.php');
}

$db = getDatabaseConnection();
$users = User::getUsersAdmin($db);


?>
<!DOCTYPE html>
<html>
<head>
<title>All Tickets</title>
  <link rel="stylesheet" href="geralstyle.css">
  <script src="/../javascript/scr.js" defer></script>
  <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</head>
<body>
  <div id="header">
      <?php drawHeader(0, 4, "Manage users"); ?>
    </div>
    <div id="nav">
      <?php drawSideBar(); ?>
    </div>
    <div id="content">
    <?php
      foreach ($users as $user) {
        drawUserBox($user, true);
      }
      ?>
    </div>
