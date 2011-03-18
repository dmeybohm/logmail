<?php
$message = new Zend_Mail_Message(array('raw' => $email->message));
//print_r(get_class_methods($message));
$headers = $message->getHeaders();
foreach ($headers as $key => $value) {
	echo ucfirst($key), ": ", htmlentities($value), "<br />";
}
echo "<br />";
//if (strpos($headers['content-type'], 'text/html') !== false) {
//	echo $message->getContent();
//} else {
	echo htmlentities($message->getContent());
//}
