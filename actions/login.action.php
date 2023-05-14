<?php
    require_once(__DIR__ . '/../classes/session.class.php');

    $session = new Session();
    
    //if (!$session->isLoggedIn() || !$session->isValidSession($_POST['csrf'])) {
    //    $session->addMessage('error', 'Not logged in');
    //    header('Location: page.php');
    //}

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/client.php');

    $db = getDatabaseConnection();

    $user = tryLoginName($db, $_POST["username"]);

    if (empty($user)) {
        $session->addMessage('error', 'Invalid login');
        echo "NO USER";
    }
    else {
        if (password_verify($_POST['password'], $user['passHash'])) {
            $_SESSION['uid'] = $user['uid'];
            $_SESSION['level'] = $user['permissionLevel'];
            $_SESSION['animation'] = 1;
            $_SESSION['loggedin'] = 1;
        }
    }

    $session->addMessage('success', 'Logged in');
    header('Location: ../pages/page.php');
?>    