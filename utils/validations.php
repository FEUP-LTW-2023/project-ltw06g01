<?php
    function isValidUser($tUID, $aUID, $uid, $level) {
        if ($level == 2) return 2;
        else if ($uid == $tUID) return 1;
        else if ($aUID == $tUID) return 2;
        else return 0;
    }

    function hasAccessToPage($requiredLevel, $level) {
        return $level >= $requiredLevel;
    }

    function isValidName(String $attemp) : bool {
        if (!preg_match ("/^[a-zA-Z0-9]+$/", $attemp)) {
            return false;
        }
        return true;
    }

    function isValidEmail(String $attemp) : bool {
        if (filter_var($attemp, FILTER_VALIDATE_EMAIL) == NULL) {
            return false;
        }
        return true;
    }

?>    