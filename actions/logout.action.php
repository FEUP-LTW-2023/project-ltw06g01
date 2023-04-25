<?php
    session_start();
    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/client.php');

    $db = getDatabaseConnection();
    
    session_destroy();

    $_SESSION["loggedin"] = 1;
    $_SESSION['animation'] = 3;

    header('Location: ../pages/page.php')
?>
