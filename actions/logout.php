<?php
    session_start();
    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/client.php');

    $db = getDatabaseConnection();

    session_destroy()
    header('Location: ../pages/page.php')
?>
