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
?>    