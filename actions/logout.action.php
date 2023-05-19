<?php
    require_once(__DIR__ . '/../classes/session.class.php');

    $session = new Session();

    array_map(fn($value) => preg_replace("/[^a-zA-Z0-9.,!?\s]/", "", "value"), $_GET, $_POST);
    
    if (!$session->isLoggedIn() || !$session->isValidSession($_GET['csrf'])) {
        $session->addMessage('error', 'Not logged in');
        header('Location: page.php');
    }

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/client.php');

    session_unset();
    session_destroy();
    session_write_close();
    change_animationFlag($_GET["next-logout"]);

    session_regenerate_id(true);


    $session->addMessage('success', 'Logged out');
    header('Location: ../pages/page.php');
?>

