<?php
echo ini_get('sendmail_from'), "\n";
echo ini_get('SMTP'), "\n";
echo ini_get('smtp_port'), "\n";
mail("test@test.com", "test", "Hello from localhost", "From: testfrom@example.org\r\n");
