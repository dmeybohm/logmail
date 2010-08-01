<?php

require 'db.php';

$msg = stream_get_contents(STDIN);
$stmt = $db->prepare("INSERT INTO message (message) VALUES(:message)");
$stmt->execute(array(':message' => $msg));
