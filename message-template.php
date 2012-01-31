<?php
$message = new Zend_Mail_Message(array('raw' => $email->message));
//print_r(get_class_methods($message));
$headers = $message->getHeaders();
foreach ($headers as $key => $value) {
	echo ucfirst($key), ": ", htmlentities($value), "<br />";
}
echo "<br />";
$content = $message->getContent();
if (strpos($headers['content-transfer-encoding'], 'quoted-printable') !== false) {
    $content = quoted_printable_decode($content);
}
if (strpos($headers['content-type'], 'text/html') !== false) {
    echo '</pre>';
    echo htmlentities($content);
    echo '<pre>';
} else {
	echo htmlentities($content);
}