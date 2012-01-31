<?php

$message = new Zend_Mail_Message(array('raw' => $email->message));
$headers = $message->getHeaders();

foreach ($headers as $key => $value) {
	echo ucfirst($key), ": ", htmlentities($value), "<br />";
}

echo '<br />';
$content = $message->getContent();
$charset = 'UTF-8';

if (strpos($headers['content-transfer-encoding'], 'quoted-printable') !== false) {
    $content = quoted_printable_decode($content);
}

if (preg_match('/charset=([^ ]+)/', $headers['content-type'], $matches)) {
    $charset = strtoupper($matches[1]);
}

echo htmlentities($content, ENT_COMPAT, $charset);