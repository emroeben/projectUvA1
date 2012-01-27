<?xml version="1.0"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" 
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<?php
 echo'<?xml version="1.0"?>';
 include 'Verbindingsdata.php';
 include 'vars.php';
 ?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Jammir Webshop</title>
	
<?php
echo $meta;
?>
	
<link rel="stylesheet" type="text/css" href="css/master.css" />
<link rel="stylesheet" type="text/css" href="css/home.css" />
</head>

<body class="Home">
<?php
echo '<div id="page-container">
'.$banner.'
<div id="login">';

if(isset($_SESSION['logged_in'])) // already logged in
{
	echo '<div id="logged_in">';
	echo "welcome ". $_SESSION['name'] ."<br />";
	echo '</div>';
}elseif(isset($_SESSION['counter']) && $_SESSION['counter'] > 2)
{
echo 'you have failed to login to many times...you are fucked';
}
else // counter lager dan 3
{
	echo '<div id="login_border">
			<form action="login.php" method="post">
				<div id="login_top">
				Login
				</div>
				<div class="login_title">
					E-mail adress:
				</div>
				<div class="login_item">
					<input type="text" name="email" maxlength="50" />
				</div>
				<div class="login_title">
					Password:
				</div>
				<div class="login_item">
					<input type="password" name="password" maxlength="50" />
				</div>
				<div class="login_title">
					<input type="submit" name="logbutton" value="Login" />';
				if (isset($_SESSION['counter']) && $_SESSION['counter'] == 2)
				{
				echo '  1 more chance';
				}
				echo '</div>
			</form>
		</div>';
}
?>
</div> <!-- end login -->
<div id="adBig">
	</div> <!-- end adBig -->
		
	<div class="adS">
		<a href="./product.php?product=1"><img src="images/products/jellyfish_blue_01.jpg" width="100%" height="100%" alt="A blue jellyfish." /></a>
	</div> <!-- end class adS 3 -->
	<div class="adS">
		<a href="./product.php?product=3"><img src="images/products/seal_white_01.jpg" width="100%" height="100%" alt="A seal." /></a>		
	</div> <!-- end class adS 2 -->
	<div class="adS">
		<a href="./product.php?product=2"><img src="images/products/jellyfish_green_01.jpg" width="100%" height="100%" alt="A green jellyfish." /></a>
	</div> <!-- end class adS 1 -->

<?php
echo $footer;
echo '</div> <!-- end page-container -->';
mysql_close($connectie);
?>
</body>
</html>