A web application for logging mail sent from PHP. 

Installing
==========

Create a virtual host, or dump the files into your web server's document root.

Create the sqlite database and set permissions by running this script:

    $ scripts/setup

This will create a world-writeable directory "var" in the same directory
as you extracted the files along with a world-writeable SQLite database.


Setting up on Unix/Mac OS
=========================

Configure PHP
-------------
Configure the sendmail_path variable to point to scripts/sendmail:

    sendmail_path = "/path/to/logmail/scripts/sendmail".  

This is a PHP script that will send the output of the mail() function to
the SQLite database.


Test
----
Try to send a test email.  If you set up on localhost for example run:

    http://localhost/logmail/test.php

Then load http://localhost/logmail to see your test message.

Also, you can test it from the command line:

    $ php test.php


View Messages
------------
Go to:

    http://localhost/logmail/

To view the messages currently stored in the database.  If you it's
setup correctly, should be able to add to it by using the PHP mail()
function.


Setting up Windows
==================

A perl SMTP server is included.  You will need to install the
appropriate CPAN packages. 


Configure PHP
-------------
Change your php.ini to use SMTP = "localhost" and change the port to
2525 inside php.ini:

    SMTP = localhost
    smtp_port = 2525

Port 2525 is hard-coded in the perl SMTP server script.

Run/Configure Server
--------------------
Extract the files to a web server's directory.  Run:

	$ scripts/smtp-server

in a separate window.  


Test
----
In another window,

	$ php test.php

If that works, you'll Also make sure the mail() function is working from
a web browser.  Load:

    http://localhost/logmail/test.php

And look for a "sent mail successfully" message.

View Messages
-------------
Go to

    http://localhost/logmail/

To view the messages currently stored in the database.  If it's setup
correctly, you should be able to see any messages sent with the PHP
mail() function.
