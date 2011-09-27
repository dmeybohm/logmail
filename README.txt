Local SMTP server for logging mail.  Requires perl at the moment
and some classes from CPAN.

Change your php.ini to use sendmail_from = "localhost" and change the port to
2525.

Extract the files to a web server's directory.  Run:

	$ php make-db.php
	$ perl server.pl

in a separate window.  In another window,

	$ php testmail.php

Then load the directory you extracted in your web browser, and you should
see the first test message.
