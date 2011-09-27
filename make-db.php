<?php
require 'db.php';

try {
    $db->query("CREATE TABLE IF NOT EXISTS message (id INTEGER PRIMARY KEY AUTOINCREMENT, message TEXT)");
} catch (Exception $e) {
    var_dump($e);
    exit;
}
if (chmod($dbconfig['db'], 0666) === false)
{
	echo "Error changing permissions";
	exit;
}
