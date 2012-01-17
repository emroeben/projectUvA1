<?php
$host = "localhost";
$username = "webdb1240";
$password = "zud4a5ep";
$dbname = "webdb1240";

$connectie = mysql_connect($host,$username,$password) or die(mysql_error());
echo "Connected to MySQL<br />";
mysql_select_db($dbname);
echo "Connected to Database<br />";
$aap = md5('aapapapapaapapapafhidufghroighjeroignjeoigherioghignrogheiurogreignreoigneoh');
echo $aap;
?>
