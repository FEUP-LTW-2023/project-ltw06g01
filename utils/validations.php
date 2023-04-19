<?php
    function isValidUser($ticket, $uid, $level) {
        if ($level == 2) return true;
        if ($uid == $ticket['uID'] || $uid == $ticket['aID']) return true;
        else return false;
    }
?>    