<?php
require 'start.php';

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
    <?php foreach ($messages as $email): ?>
    <h2>Message #<?= $email->id; ?>: </h2>
<pre>
<?php 
    try {
		require 'message-template.php';
    } catch (Exception $e) {
		echo "Failed parsing message, outputing as raw:<br />";
        echo htmlentities($email->message); 
    }
    ?>
    </pre>
    <br />
    <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
