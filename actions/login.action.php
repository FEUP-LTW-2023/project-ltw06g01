<?php
    session_start();

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/client.php');

    echo var_dump($_POST);

    $db = getDatabaseConnection();

    $user = tryLoginName($db, $_POST["username"]);

    if (empty($user)) {
        echo "NO USER";
    }
    else {
        if ($user['passHash'] == hash('sha256', $_POST["password"])) {
            $_SESSION['uid'] = $user['uid'];
            $_SESSION['level'] = $user['permissionLevel'];
        }
    }

    echo var_dump($_SESSION);
    session_destroy();
?>    