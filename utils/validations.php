<?php
    require_once(__DIR__ . '/../classes/session.class.php');

    function isValidUser($tUID, $aUID, $uid, $level) {
        if ($level == 2) return 3;
        else if ($uid == $tUID) return 1;
        else if ($aUID == $tUID) return 2;
        else return 0;
    }

    function hasAccessToPage($requiredLevel, $level) {
        return $level >= $requiredLevel;
    }

    function isValidName(String $attempt) : bool {
        if (!isset($attempt)) return false;
        if (!preg_match ("/^[a-zA-Z0-9]+$/", $attempt)) {
            return false;
        }
        return true;
    }

    function isValidEmail(String $attempt) : bool {
        if (!isset($attempt)) return false;
        if (filter_var($attempt, FILTER_VALIDATE_EMAIL) == NULL) {
            return false;
        }
        return true;
    }

    function isValidPassword(string $password, Session $session): bool {
        if (!isset($password) || strlen($password) < 12) {
            $session->addMessage('error', 'Password must have at least 12 characters');
            return false;
        }
        else if(!preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password)) {
            $session->addMessage('error', 'Password must have at least one lowercase and at least one uppercase character');
            return false;
        }
        else return true;
    }
