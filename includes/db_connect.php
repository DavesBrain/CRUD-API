<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL);

echo "!";
$connection = @mysql_connect("mysql509.ixwebhosting.com", "DaveC42_user3", "uUUuzU8d35cc")
or die(mysql_error());
$db = @mysql_select_db(DATABASE, $connection) or
die(mysql_error());