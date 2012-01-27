<?php
session_start();
if(isset($_SESSION['logged_in']))
{
unset($_SESSION['logged_in']);
unset($_SESSION['name']);
unset($_SESSION['account']);
}
header('location: home.php');

?>