<?php
error_reporting(E_ALL);

$headers = "From: logmail@example.org\nDate: " . date(DATE_RFC822);
$body = "sendmail_from: ". ini_get('sendmail_from'). "\n".
        "smtp_port: ". ini_get('smtp_port'). "\n".
        "sendmail_path: ". ini_get('sendmail_path'). "\n";

if (mail("a@test.invalid", "Test message", $body, $headers) === false) {
    echo "Failed sending mail\n";
} else {
    echo "Mail sent successfully.\n";
    if (php_sapi_name() != 'cli') {
        $base = dirname($_SERVER['PHP_SELF']);
        echo "<a href=\"$base\">View messages</a>";
    }
}

