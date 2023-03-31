<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
define('FDB_SERVER', 'localhost');
define('FDB_USERNAME', 'root');
define('FDB_PASSWORD', 'mysql');
define('FDB_NAME', 'j2f1belp5l1');
 
/* Attempt to connect to MySQL database */
$mysqli = new mysqli(FDB_SERVER, FDB_USERNAME, FDB_PASSWORD, FDB_NAME);
 
// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
?>