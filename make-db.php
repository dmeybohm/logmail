<?php
require 'db.php';

try {
    $db->query("CREATE TABLE IF NOT EXISTS message (id INTEGER PRIMARY KEY AUTOINCREMENT, message TEXT)");
} catch (Exception $e) {
    var_dump($e);
    exit;
}
chmod('./mail.sqlite', 0666);
