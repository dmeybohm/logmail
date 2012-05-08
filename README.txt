A web application for logging mail sent from PHP. 

Setting up onUnix/Mac OS
========================

Initialize
----------

Extract the files to a web server's directory.  Then either
setup a virtual host or run  the document root as usual.

Create the sqlite database and set permissions:

    $ scripts/setup


Configure PHP
-------------
Configure the sendmail_path variable to point to "scripts/sendmail".  This is a
PHP script that will send the output of the mail() function to the SQLite
database.


Test
----

Try to send a test email.  If you set up on localhost for
example run:

    http://localhost/logmail/test.php

Then load http://localhost/logmail to see your test message.

Also, you can test it from the command line:

    $ php test.php


View Messages
------------

Go to

    http://localhost/logmail/

To view the messages currently stored in the database.


Setting up Windows
==================

A perl SMTP server is included.  You will need to install the appropriate
CPAN packages. 


Initialize
----------

	$ scripts/setup


Configure PHP
-------------
Change your php.ini to use sendmail_from = "localhost" and
change the port to 2525, the port the SMTP server will
listen on.


Run/Configure Server
--------------------
Extract the files to a web server's directory.  Run:

	$ scripts/smtp-server

in a separate window.  


Test
----
In another window,

	$ php test.php

Also make sure the mail() function is working from a web browser.
Load:

    http://localhost/logmail/test.php

And look for a "sent mail successfully" message.

Finally, load

    http://localhost/logmail/

Then load the directory you extracted in your web browser, and you should
see the first test message.

View Messages
------------

Go to

    http://localhost/logmail/

To view the messages currently stored in the database.
