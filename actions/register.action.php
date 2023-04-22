<?php
    session_start();

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/client.php');

    $db = getDatabaseConnection();

    if ($_POST['password'] != $_POST['confirm-password']) {
        header('Location: ../pages/page.php');
    }

    $userCreated = createNewUser($db, $_POST['username'], $_POST['email'], $_POST['password']);
    if (!$userCreated[0]) {
        header('Location: ../pages/page.php');
    }
    else {
        $_SESSION['uid'] = $userCreated[1];
        $_SESSION['level'] = 0;
        $_SESSION['animation'] = true;
    }

    header('Location: ../pages/page.php');
?>    