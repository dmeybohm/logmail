#!/usr/bin/env php
<?php
require dirname(dirname(__FILE__)).'/config.php';

if (!file_exists(dirname($config['db']))) {
    echo "Making directory: ", dirname($config['db']), "\n";
    if (mkdir(dirname($config['db'])) === false) {
        echo "Failed making db\n";
    }
}
 
if (chmod(dirname($config['db']), 0755) === false ||
    touch($config['db']) === false || 
    chmod($config['db'], 0777) === false)
{
	echo "Error changing permissions";
	exit;
}

if (chmod(dirname($config['log']), 0755) === false ||
    touch($config['log']) === false || 
    chmod($config['log'], 0666) === false)
{
	echo "Error changing permissions";
	exit;
}

require dirname(__FILE__).'/lib/init.php';
try {
    $db->query("CREATE TABLE IF NOT EXISTS message (id INTEGER PRIMARY KEY AUTOINCREMENT, message TEXT)");
} catch (Exception $e) {
    var_dump($e);
    exit;
}
