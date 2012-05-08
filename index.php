<?php
require dirname(__FILE__).'/lib/init.php';

$messages = $db->query("SELECT * FROM message ORDER BY id DESC")->fetchAll(PDO::FETCH_OBJ);
$template = new Logmail_Message_Template;
?>
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>logmail</h1>
    <?php if (empty($messages)): ?>
    <p>No messages sent yet</p>
    <a href="test.php">Send a test message</a>
    <?php else: ?>
    <?php foreach ($messages as $i => $email): ?>
    <div class="message<?php echo $i == 0 ? ' latest' : ''; ?>">
        <h2>message #<?= $email->id; ?></h2>
<pre class="content"><?php
    try {
        $template->out($email->message);
    } catch (Exception $e) {
		echo "Failed parsing message, outputing as raw:<br />";
        echo htmlentities($email->message);
    }
?></pre>
    </div>
    <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
