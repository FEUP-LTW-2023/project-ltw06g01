<?php
session_start();
if (!isset($_SESSION['uid'])) {
  header('Location: page.php');
}

require_once(__DIR__ . '/../utils/validations.php');

if (!hasAccessToPage(2, $_SESSION['level'])) {
    header('Location: page.php');
}
?>