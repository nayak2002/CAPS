<?php

/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('DB_SERVER', 'caps-rds.cnnqam53vmhp.us-east-1.rds.amazonaws.com');
define('DB_USERNAME', 'admin');
define('DB_PASSWORD', 'caps12345');
define('DB_NAME', 'caps_data');
 
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

?>