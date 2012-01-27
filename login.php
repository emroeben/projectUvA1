<?php
include 'Verbindingsdata.php';
include('vars2.php');

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['logbutton']))
		{
		$email = beveilig($_POST['email']);
		$pass = beveilig($_POST['password']);
		$result = mysql_query("SELECT * FROM accounts WHERE email='$email' AND password='$pass'");
		if ( mysql_num_rows($result) == 1 ) // eerste login
	{
		$accountrow = mysql_fetch_row($result);
		$_SESSION['account'] = $accountrow[0];
		$_SESSION['name'] = $accountrow[3] . ' ' . $accountrow[4];
		$_SESSION['logged_in'] = 1;
		$_SESSION['counter'] = 0;
	}
	else // login fail
	{
		$_SESSION['counter']=$_SESSION['counter']+1;;
	}
	header("location:home.php");
}
?>