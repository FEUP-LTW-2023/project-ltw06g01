<?php
    require_once(__DIR__ . '/../classes/session.class.php');

    $session = new Session();
    
    if (!$session->isLoggedIn() || !$session->isValidSession($_POST['csrf'])) {
        header('Location: page.php');
    }

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/client.php');

    session_unset();
    session_destroy();
    session_write_close();
    change_animationFlag($_GET["next-logout"]);

    session_regenerate_id(true);


    header('Location: ../pages/page.php');
?>

