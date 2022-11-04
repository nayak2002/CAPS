<?php

/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'sql12.freemysqlhosting.net');
define('DB_USERNAME', 'sql12542208');
define('DB_PASSWORD', 'GZEyjnuhyU');
define('DB_NAME', 'sql12542208');
 
/* Attempt to connect to MySQL database */
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
error_reporting(E_ALL);
ini_set('display_errors', '1');
// Check connection
if($link === false)
{
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
else{
}

