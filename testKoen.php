<?php
 echo'<?xml version="1.0"?>';
 include 'Verbindingsdata.php';
 include 'vars.php';
 ?>
 
<html>
<body>

<?php
if(isset($_SESSION['login']))
{
echo "You are logged in";
session_destroy();
}
elseif($_SERVER['REQUEST_METHOD'] == 'POST' )
{
	$email = beveilig($_POST['email']);
	$pass = beveilig($_POST['password']);

	$result = mysql_query("SELECT * FROM accounts WHERE email='$email' AND password='$pass'");
	
	if (mysql_num_rows($result) == 1)
	{
		$accountrow = mysql_fetch_row($result);
		
		echo "welcome: " . $accountrow[3] . " " . $accountrow[4] . "<br />";
		
		echo "e-mail: " . $email . "<br />";
		
		$_SESSION['login']=1;
	}
	else
	{
		echo "Invalid login";
	}
}
else
{
	echo '<form action="testKoen.php" method="post">
	<input type="text" name="email" />
	<input type="password" name="password" />
	<input type="submit" />
	</form>';
}

mysql_close($connectie);
?>

</body>
</html>