<?php
    function isValidUser($tUID, $aUID, $uid, $level) {
        if ($level == 2) return true;
        if ($uid == $tUID || $uid == $aUID) return true;
        else return false;
    }

    function hasAccessToPage($requiredLevel, $level) {
        return $level >= $requiredLevel;
    }
?>    