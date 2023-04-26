<?php 
    session_start();

    require_once(__DIR__ . '/../database/client.php');

    $db = getDatabaseConnection();
    $user_id = $_SESSION['uid'];
    $email = $_SESSION['email'];
    $username = $_SESSION['username'];

    $updated = updateProfile($db, $user_id, $username, $email);

    header('Location: ../pages/profile.php');
?>    