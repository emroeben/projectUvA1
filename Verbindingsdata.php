<?php
$host = "localhost";
$username = "webdb1240";
$password = "zud4a5ep";
$dbname = "webdb1240";

$connectie = mysql_connect($host,$username,$password) 
or die('Could not connect: ' . mysql_error());
mysql_select_db($dbname);
?>
