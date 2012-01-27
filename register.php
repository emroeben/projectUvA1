<?php
require_once 'vars.php';
echo'<?xml version="1.0"?>';
include 'Verbindingsdata.php';
?> 

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" 
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Jammir Webshop</title>
	<?php
	echo $meta;
	?>
	<link rel="stylesheet" type="text/css" href="css/account.css" />
</head>
<body>
<div id="page-container">

	<?php 
	echo $banner; 
	?>

	<div id="midden">
	
	<?php
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$fname_check = 0;
		$lname_check = 0;
		$company_check = 0;
		$birth_check = 0;
		$address_check = 0;
		$postal_check = 0;
		$city_check = 0;
		$country_check = 0;
		$telephone_check = 0;
		$mail1_check = 0;
		$mail2_check = 0;
		$pass1_check = 0;
		$pass2_check = 0;
		$all_check = 0;
		
		$birthlength = 0;
		$phonelength = 0;
		$mailmatch = 0;
		$passmatch = 0;
		$passlength1 = 0;
		$passlength2 = 0;
		
		if(strlen($_POST['birthdate']) == 10)
		{
		$birthlength = 1;
		}
		if(strlen($_POST['telephone']) == 9)
		{
		$phonelength = 1;
		}
		if($_POST['mail1'] == $_POST['mail2'])
		{
		$mailmatch = 1;
		}
		if($_POST['pass1'] == $_POST['pass2'])
		{
		$passmatch = 1;
		}
		if(strlen($_POST['pass1']) > 5 && strlen($_POST['pass1']) < 19)
		{
		$passlength1 = 1;
		}
		if(strlen($_POST['pass2']) > 5 && strlen($_POST['pass2']) < 19)
		{
		$passlength2 = 1;
		}
		
		if(isset($_POST['first']) && !empty($_POST['first']) && filter_var($_POST['first'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW))
		{
		$fname_check = 1;
		}
		if(isset($_POST['last']) && !empty($_POST['last']) && filter_var($_POST['last'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW))
		{
		$lname_check = 1;
		}
		if(isset($_POST['company']) && filter_var($_POST['company'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW) || empty($_POST['company']))
		{
		$company_check = 1;
		}
		if(isset($_POST['birthdate']) && !empty($_POST['birthdate']) && filter_var($_POST['birthdate'], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_LOW))
		{
		$birth_check = 1;
		}
		if(isset($_POST['address']) && !empty($_POST['address']) && filter_var($_POST['address'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW))
		{
		$address_check = 1;
		}
		if(isset($_POST['postal']) && !empty($_POST['postal']) && filter_var($_POST['postal'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW))
		{
		$postal_check = 1;
		}
		if(isset($_POST['city']) && !empty($_POST['city']) && filter_var($_POST['city'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW))
		{
		$city_check = 1;
		}
		if(isset($_POST['country']) && !empty($_POST['country']) && filter_var($_POST['country'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW))
		{
		$country_check = 1;
		}
		if(isset($_POST['telephone']) && !empty($_POST['telephone']) && filter_var($_POST['telephone'], FILTER_VALIDATE_INT) && filter_var($_POST['telephone'], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_LOW))
		{
		$telephone_check = 1;
		}
		if(isset($_POST['mail1']) && !empty($_POST['mail1']) && filter_var($_POST['mail1'], FILTER_VALIDATE_EMAIL) && filter_var($_POST['mail1'], FILTER_SANITIZE_EMAIL, FILTER_FLAG_STRIP_LOW))
		{
		$mail1_check = 1;
		}
		if(isset($_POST['mail2']) && !empty($_POST['mail2']) && filter_var($_POST['mail2'], FILTER_VALIDATE_EMAIL) && filter_var($_POST['mail2'], FILTER_SANITIZE_EMAIL, FILTER_FLAG_STRIP_LOW))
		{
		$mail2_check = 1;
		}
		if(isset($_POST['pass1']) && !empty($_POST['pass1']) && filter_var($_POST['pass1'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW))
		{
		$pass1_check = 1;
		}
		if(isset($_POST['pass2']) && !empty($_POST['pass2']) && filter_var($_POST['pass2'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW))
		{
		$pass2_check = 1;
		}	
		
		if($fname_check == 1 &&	$lname_check == 1 && $company_check == 1 && $birth_check == 1 && $address_check == 1 && $postal_check == 1
			&& $city_check == 1 && $country_check == 1 && $telephone_check == 1 && $mail1_check == 1 && $mail2_check == 1 && $pass1_check == 1
			&& $pass2_check == 1 && $birthlength == 1 && $phonelength == 1 && $mailmatch == 1 && $passmatch == 1 && $passlength1 == 1 && $passlength2 == 1)
		{
		$all_check = 1;
		echo '<script>alert("Your account has been created succesfully.")</script>';
		
		mysql_query("INSERT INTO accounts (email, password, firstname, lastname, geboorte, company, address, postalcode, city, country, telephone) 
		VALUES ('$_POST[mail1]','$_POST[pass1]','$_POST[first]','$_POST[last]','$_POST[birthdate]','$_POST[company]','$_POST[address]','$_POST[postal]','$_POST[city]','$_POST[country]','$_POST[telephone]')");

		mysql_close($connectie);
		}
	}
	?>
		<h2>Account Registration</h2>
		<form name="<?php $_SERVER['PHP_SELF'] ?>" method="post">
			<table class="center2">
				<tr>
					<td align="right" width="250"><label for="first">First Name</label></td>
					<td><?php
						if($_SERVER["REQUEST_METHOD"] == "POST" && $all_check != 1)
						{
							if($all_check == 0 && $fname_check == 1)
							{
							echo '
							<input type="text" name="first" maxlength="50" size="35" value="'.$_POST['first'].'"/>';
							}
							else
							{
							echo '<input type="text" name="first" maxlength="50" size="35" />
							<td>The information you entered was invalid.</td>';
							}
						}
						else
						{
						echo '<input type="text" name="first" maxlength="50" size="35" />';
						} 
						?></td>
				</tr>
				<tr>
					<td align="right"><label for="last">Last Name</label></td>
					<td><?php
						if($_SERVER["REQUEST_METHOD"] == "POST" && $all_check != 1)
						{
							if($all_check == 0 && $lname_check == 1)
							{
							echo '
							<input type="text" name="last" maxlength="50" size="35" value="'.$_POST['last'].'"/>';
							}
							else
							{
							echo '<input type="text" name="last" maxlength="50" size="35" />
							<td>The information you entered was invalid.</td>';
							}
						}
						else
						{
						echo '<input  type="text" name="last" maxlength="50" size="35" />';
						}
						?></td>
				</tr>
				<tr>
					<td align="right"><label for="company">Company</label></td>
					<td><?php
						if($_SERVER["REQUEST_METHOD"] == "POST" && $all_check != 1)
						{
							if($all_check == 0 && $company_check == 1)
							{
							echo '
							<input type="text" name="company" maxlength="50" size="35" value="'.$_POST['company'].'"/></td>';
							}
							else
							{
							echo '<input  type="text" name="company" maxlength="50" size="35" /></td><td>(optional)</td>';
							}
						}
						else
						{
						echo '<input  type="text" name="company" maxlength="50" size="35" /></td><td>This field is optional.</td>';
						}
						?>
				</tr>
								<tr>
					<td align="right"><label for="birthdate">Date of Birth</label></td>
					<td><?php
						if($_SERVER["REQUEST_METHOD"] == "POST" && $all_check != 1)
						{
							if($all_check == 0 && $birth_check == 1 && $birthlength == 1)
							{
							echo '<input type="text" name="birthdate" maxlength="50" size="35" value="'.$_POST['birthdate'].'"/>';
							}
							else
							{
								if($all_check == 0 && $birth_check == 1 && $birthlength == 0)
								{
								echo '<input type="text" name="birthdate" maxlength="50" size="35" />
								<td>Please use the format yyyy-mm-dd.</td>';
								}
								else
								{
								echo '<input type="text" name="birthdate" maxlength="50" size="35" />
								<td>The information you entered was invalid.</td>';									
								}
							}
						}
						else
						{
						echo '<input  type="text" name="birthdate" maxlength="50" size="35" /><td>Example: 1980-06-09</td>';
						}
						?></td>
				</tr>
				<tr>
					<td align="right"><label for="address">Address</label></td>
					<td><?php
						if($_SERVER["REQUEST_METHOD"] == "POST" && $all_check != 1)
						{
							if($all_check == 0 && $address_check == 1)
							{
							echo '
							<input type="text" name="address" maxlength="50" size="35" value="'.$_POST['address'].'"/>';
							}
							else
							{
							echo '<input type="text" name="address" maxlength="50" size="35" />
							<td>The information you entered was invalid.</td>';
							}
						}
						else
						{
						echo '<input  type="text" name="address" maxlength="50" size="35" />';
						}
						?></td>
				</tr>
				<tr>
					<td align="right"><label for="postal">Postal Code</label></td>
					<td><?php
						if($_SERVER["REQUEST_METHOD"] == "POST" && $all_check != 1)
						{
							if($all_check == 0 && $postal_check == 1)
							{
							echo '
							<input type="text" name="postal" maxlength="50" size="35" value="'.$_POST['postal'].'"/>';
							}
							else
							{
							echo '<input type="text" name="postal" maxlength="50" size="35" />
							<td>The information you entered was invalid.</td>';
							}
						}
						else
						{
						echo '<input  type="text" name="postal" maxlength="50" size="35" />';
						}
						?></td>
				</tr>
				<tr>
					<td align="right"><label for="city">City</label></td>
					<td><?php
						if($_SERVER["REQUEST_METHOD"] == "POST" && $all_check != 1)
						{
							if($all_check == 0 && $city_check == 1)
							{
							echo '
							<input type="text" name="city" maxlength="50" size="35" value="'.$_POST['city'].'"/>';
							}
							else
							{
							echo '<input type="text" name="city" maxlength="50" size="35" />
							<td>The information you entered was invalid.</td>';
							}
						}
						else
						{
						echo '<input  type="text" name="city" maxlength="50" size="35" />';
						}
						?></td>
				</tr>
				<tr>
					<td align="right"><label for="country">Country</label></td>
					<td><?php
						if($_SERVER["REQUEST_METHOD"] == "POST" && $all_check != 1)
						{
							if($all_check == 0 && $country_check == 1)
							{
							echo '
							<input type="text" name="country" maxlength="50" size="35" value="'.$_POST['country'].'"/>';
							}
							else
							{
							echo '<input type="text" name="country" maxlength="50" size="35" />
							<td>The information you entered was invalid.</td>';
							}
						}
						else
						{
						echo '<input  type="text" name="country" maxlength="50" size="35" />';
						}
						?></td>
				</tr>
				<tr>
					<td align="right"><label for="telephone">Telephone</label></td>
					<td><?php
						if($_SERVER["REQUEST_METHOD"] == "POST" && $all_check != 1)
						{
							if($all_check == 0 && $telephone_check == 1 && $phonelength == 1)
							{
							echo '<input type="text" name="telephone" maxlength="50" size="35" value="'.$_POST['telephone'].'"/>';
							}
							else
							{
								if($all_check == 0 && $telephone_check == 1 && $phonelength == 0)
								{
								echo '<input type="text" name="telephone" maxlength="50" size="35" />
								<td>Must be 10 digits in length.</td>';
								}
								else
								{
								echo '<input type="text" name="telephone" maxlength="50" size="35" />
								<td>The information you entered was invalid.</td>';									
								}
							}
						}
						else
						{
						echo '<input  type="text" name="telephone" maxlength="50" size="35" /><td>Example: 0612345678</td>';
						}
						?></td>
				</tr>
				<tr>
					<td align="right"><label for="mail1">E-mail</label></td>
					<td><?php
						if($_SERVER["REQUEST_METHOD"] == "POST" && $all_check != 1)
						{
							if($all_check == 0 && $mail1_check == 1 && $mailmatch == 1)
							{
							echo '<input type="text" name="mail1" maxlength="50" size="35" value="'.$_POST['mail1'].'"/>';
							}
							else
							{
								if($all_check == 0 && $mail1_check == 1 && $mailmatch == 0)
								{
								echo '<input type="text" name="mail1" maxlength="50" size="35" />
								<td>The email addresses do not match.</td>';
								}
								else
								{
								echo '<input type="text" name="mail1" maxlength="50" size="35" />
								<td>The information you entered was invalid.</td>';									
								}
							}
						}
						else
						{
						echo '<input  type="text" name="mail1" maxlength="50" size="35" />';
						}
						?></td>
				</tr>
				<tr>
					<td align="right"><label for="mail2">Confirm E-mail</label></td>
					<td><?php
						if($_SERVER["REQUEST_METHOD"] == "POST" && $all_check != 1)
						{
							if($all_check == 0 && $mail2_check == 1 && $mailmatch == 1)
							{
							echo '<input type="text" name="mail2" maxlength="50" size="35" value="'.$_POST['mail2'].'"/>';
							}
							else
							{
								if($all_check == 0 && $mail2_check == 1 && $mailmatch == 0)
								{
								echo '<input type="text" name="mail2" maxlength="50" size="35" />
								<td>The email addresses do not match.</td>';
								}
								else
								{
								echo '<input type="text" name="mail2" maxlength="50" size="35" />
								<td>The information you entered was invalid.</td>';									
								}
							}
						}
						else
						{
						echo '<input  type="text" name="mail2" maxlength="50" size="35" />
						<td>Please type the E-mail address again.</td>';
						}
						?></td>
				</tr>
				<tr>
					<td align="right"><label for="pass1">Password</label></td>
					<td><?php
						if($_SERVER["REQUEST_METHOD"] == "POST" && $all_check != 1)
						{
							if($all_check == 0 && $pass1_check == 1 && $passmatch == 1 && $passlength1 == 1)
							{
							echo '<input type="password" name="pass1" maxlength="50" size="35" value="'.$_POST['pass1'].'"/>';
							}
							else
							{
								if($all_check == 0 && $pass1_check == 1 && $passlength1 == 0)
								{
								echo '<input type="password" name="pass1" maxlength="50" size="35" />
								<td>Must be between 6 to 18 characters in length.</td>';
								}
								else
								{
									if($all_check == 0 && $pass1_check == 1 && $passmatch == 0)
									{
									echo '<input type="password" name="pass1" maxlength="50" size="35" />
									<td>The passwords do not match.</td>';
									}
									else
									{
									echo '<input type="password" name="pass1" maxlength="50" size="35" />
									<td>The information you entered was invalid.</td>';		
									}
								}
							}
						}
						else
						{
						echo '<input  type="password" name="pass1" maxlength="50" size="35" />
						<td>Must be between 6 to 18 characters in length.</td>';
						}
						?></td>
				</tr>
				<tr>
					<td align="right"><label for="pass2">Confirm Password</label></td>
					<td><?php
						if($_SERVER["REQUEST_METHOD"] == "POST" && $all_check != 1)
						{
							if($all_check == 0 && $pass2_check == 1 && $passmatch == 1 && $passlength2 == 1)
							{
							echo '<input type="password" name="pass2" maxlength="50" size="35" value="'.$_POST['pass2'].'"/>';
							}
							else
							{
								if($all_check == 0 && $pass2_check == 1 && $passlength2 == 0)
								{
								echo '<input type="password" name="pass2" maxlength="50" size="35" />
								<td>Must be between 6 to 18 characters in length.</td>';
								}
								else
								{
									if($all_check == 0 && $pass2_check == 1 && $passmatch == 0)
									{
									echo '<input type="password" name="pass2" maxlength="50" size="35" />
									<td>The passwords do not match.</td>';
									}
									else
									{
									echo '<input type="password" name="pass2" maxlength="50" size="35" />
									<td>The information you entered was invalid.</td>';		
									}
								}
							}
						}
						else
						{
						echo '<input  type="password" name="pass2" maxlength="50" size="35" />
						<td>Please type the password again.</td>';
						}
						?></td>
				</tr>
			</table>
				<tr>
					<h3><input type="submit" value="Register" /></h3>
				</tr>
		</form>
	
	</div> <!-- end midden -->

	<?php
	echo $footer;
	?>

</div> <!-- end page-container -->

</body>
</html>