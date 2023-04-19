<?php
    function isValidUser($tUID, $aUID, $uid, $level) {
        if ($level == 2) return true;
        if ($uid == $tUID || $uid == $tAID) return true;
        else return false;
    }
?>    