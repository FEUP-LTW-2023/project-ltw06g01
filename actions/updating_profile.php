<?php 
    session_start();

    require_once(__DIR__ . '/../database/client.php');
    require_once(__DIR__ . '/../database/connection.php');

    $db = getDatabaseConnection();
    $user_id = $_SESSION['uid'];
    $email = $_POST['email'];
    $username = $_POST['username'];

    $updated = updateProfile($db, $user_id, $username, $email);

    header('Location: ../pages/profile.php');
?>    