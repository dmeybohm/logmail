A web application for logging mail sent from PHP. 

Unix/Mac OS
===========

Setup
-----

Extract the files to a web server's directory.  Then either
setup a virtual host or run  the document root as usual.

Create the sqlite database and set permissions:

    $ php setup.php


Configure PHP
-------------
Configure the sendmail_path variable to point to "sendmail".  This is
a PHP script that will send the output of the mail() function to
the SQLite database.


Test
----

Try to send a test email.  If you set up on localhost for
example run:

    http://localhost/logmail/test.php

Then load http://localhost/logmail to see your test message.

Also, you can test it from the command line:

    $ php test.php


Windows
=======
A perl SMTP server is included.  You will need to install the appropriate
CPAN packages. Change your php.ini to use sendmail_from = "localhost" and
change the port to 2525.

Extract the files to a web server's directory.  Run:

	$ php setup.php
	$ perl server/server.pl

in a separate window.  In another window,

	$ php testmail.php

Then load the directory you extracted in your web browser, and you should
see the first test message.
