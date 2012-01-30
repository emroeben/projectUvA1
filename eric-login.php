<?php
echo'<?xml version="1.0"?>';
include 'Verbindingsdata.php';
include 'vars.php';
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" 
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html>
<body>

<?php
//session_destroy();
if(isset($_SESSION['counter']))
{
	if(isset($_SESSION['logged_in'])) // check if array has value
	{
	echo'You are already logged in.';
	}
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$email = beveilig($_POST['email']);
		$pass = beveilig($_POST['password']);

		$result = mysql_query("SELECT * FROM accounts
		WHERE email = '$email' AND password = '$pass'");
		
		if($_SESSION['counter']<=2)
		{
			if(mysql_num_rows($result) == 1)
			{
				$accountrow = mysql_fetch_row($result);
				echo "Welcome " . $accountrow[3] . " " . $accountrow[4] . "<br />";
				echo "Your password is " . $pass . ".";
				$_SESSION['counter'] = 0;
				$_SESSION['logged_in'] = 1; // assign value to array
			}
			else
			{
				echo '<form action="eric-test.php" method="post">
				Invalid login, try again: <br />
				<b>Email: </b><input type="text" name="email" />
				<b>Password: </b><input type="text" name="password" />
				<input type="submit" value="Continue" />
				</form>';
				$_SESSION['counter']=$_SESSION['counter']+1;;
			}
		}
		else
			{
				echo '<form action="eric-test.php" method="post">
				You have failed to login too many times, you can try again in 20 minutes.<br />
				<b>Email: </b><input type="text" name="email" />
				<b>Password: </b><input type="text" name="password" />
				<input type="submit" value="Continue" />
				</form>';
			}
	}
	else
	{
		echo '<form action="eric-test.php" method="post">
		Please fill in your email and password in order to log in: <br />
		<b>Email: </b><input type="text" name="email" />
		<b>Password: </b><input type="text" name="password" />
		<input type="submit" value="Continue" />
		</form>';
	}
}
else
{
	$_SESSION['counter']=0;
}
mysql_close($connectie);
?>

</body>
</html> 