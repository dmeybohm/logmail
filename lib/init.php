<?php
error_reporting(E_ALL);
define('TOP_DIR', dirname(dirname(__FILE__)));

set_include_path(TOP_DIR.DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.
                 PATH_SEPARATOR.TOP_DIR.DIRECTORY_SEPARATOR.
                 PATH_SEPARATOR.get_include_path());

function __autoload($class_name) {
    $filename = str_replace('_', '/', $class_name);
    require_once $filename . '.php';
}

require TOP_DIR.'/lib/db.php';

