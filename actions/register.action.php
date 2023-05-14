<?php
    require_once(__DIR__ . '/../classes/session.class.php');

    $session = new Session();
    
    if (!$session->isLoggedIn() || !$session->isValidSession($_POST['csrf'])) {
        $session->addMessage('error', 'Not logged in');
        header('Location: page.php');
    }

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/client.php');
    require_once(__DIR__ . '/../utils/validations.php');

    $db = getDatabaseConnection();

    if (($_POST['password'] != $_POST['confirm-password']) || !isValidName($_POST['username']) || !isValidEmail($_POST['email'])) {
        $session->addMessage('error', "Passwords don't match / invalid name and/or email");
        header('Location: ../pages/page.php');
    }

    $userCreated = createNewUser($db, $_POST['username'], $_POST['email'], $_POST['password']);
    if (!$userCreated[0]) {
        $session->addMessage('error', 'Error creating account');
        header('Location: ../pages/page.php');
    }
    else {
        $_SESSION['uid'] = $userCreated[1];
        $_SESSION['level'] = 0;
        $_SESSION['animation'] = 2;
    }

    $session->addMessage('success', 'Account created');
    header('Location: ../pages/page.php');
?>    