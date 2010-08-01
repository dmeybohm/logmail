<?php

// Make sure this doesn't run when called from the web server:
if (isset($_SERVER['REQUEST_URI'])) {
    header("HTTP/1.1 404 Unavailable");
    echo "<h1>Not found</h1>";
    exit;
}

require 'db.php';

