<?php
    require_once(__DIR__ . '/../classes/session.class.php');

    $session = new Session();
    
    if (!$session->isLoggedIn() || !$session->isValidSession($_POST['csrf'])) {
        header('Location: page.php');
    }

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/client.php');

    $db = getDatabaseConnection();

    $user = tryLoginName($db, $_POST["username"]);

    if (empty($user)) {
        echo "NO USER";
    }
    else {
        if ($user['passHash'] == hash('sha256', $_POST["password"])) {
            $_SESSION['uid'] = $user['uid'];
            $_SESSION['level'] = $user['permissionLevel'];
            $_SESSION['animation'] = 1;
            $_SESSION['loggedin'] = 1;
        }
    }

    header('Location: ../pages/page.php');
?>    