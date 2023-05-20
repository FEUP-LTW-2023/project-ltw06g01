<?php
    require_once(__DIR__ . '/../classes/session.class.php');

    $session = new Session();

    $password = $_POST['password'];
    $confirm = $_POST['confirm-password'];
    array_map(fn($value) => preg_replace("/[^a-zA-Z0-9.,!?\s]/", "", $value), $_GET, $_POST);

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/client.php');
    require_once(__DIR__ . '/../utils/validations.php');

    $db = getDatabaseConnection();

    if (($password != $confirm) || !isValidName($_POST['username']) || !isValidEmail($_POST['email'])) {
        $session->addMessage('error', "Passwords don't match / invalid name and/or email");
        header('Location: ../pages/page.php');
    }

    if (!isValidPassword($password, $session)) {
        header('Location: ../pages/page.php');
    }

    $userCreated = createNewUser($db, $_POST['username'], $_POST['email'], $password);
    if (!$userCreated[0]) {
        $session->addMessage('error', 'Error creating account');
        header('Location: ../pages/page.php');
    }
    else {
        $_SESSION['uid'] = $userCreated[1];
        $_SESSION['level'] = 0;
        $_SESSION['animation'] = 2;
        $_SESSION['loggedin'] = 1;
    }

    $session->addMessage('success', 'Account created');
    header('Location: ../pages/page.php');
?>    