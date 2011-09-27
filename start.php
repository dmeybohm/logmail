<?php
error_reporting(E_ALL);

require 'db.php';

set_include_path(get_include_path().PATH_SEPARATOR.dirname(__FILE__).DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR);

function __autoload($class_name) {
    $filename = str_replace('_', '/', $class_name);
    require_once $filename . '.php';
}

