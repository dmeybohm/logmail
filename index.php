<?php
require 'db.php';

$messages = $db->query("SELECT * FROM message ORDER BY id DESC")->fetchAll(PDO::FETCH_OBJ);
?>
<!doctype html>
<html>
    <head></head>
<body>
    <h1>Logmail</h1>
    <?php if (empty($messages)): ?> 
    <p>No messages sent yet</p>
    <?php else: ?>
    <?php foreach ($messages as $message): ?>
    <h2>Message #<?= $message->id; ?>: </h2>
    <pre>
    <?php echo $message->message; ?>
    </pre>
    <br />
    <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
