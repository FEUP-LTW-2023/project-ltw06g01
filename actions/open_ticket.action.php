<?php
    $db = getDatabaseConnection();
    addTicket($db, $_POST['uid'], $_POST['title'], $_POST['fulltext']);
    exit();
?>    