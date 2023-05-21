<?php
    function getDatabaseConnection() {
        $db = new PDO('sqlite:' . __DIR__ . '/../database/tickets.db');
        $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $db->prepare('PRAGMA foreign_keys = ON');
        $stmt->execute();

        return $db;
    }
