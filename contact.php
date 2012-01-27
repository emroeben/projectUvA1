<?php
require_once 'vars.php';
 echo'<?xml version="1.0"?>';

 ?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" 
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Jammir Webshop</title>
	<?php
	echo $meta;
	?>
	<link rel="stylesheet" type="text/css" href="css/contact.css" />
	
</head>
<body class="Contact">
<div id="page-container">

<?php
	echo $banner;
	
?>

<div id="midden">
	
	<h1> Contact us </h1>
	
	If you have any comments or questions regarding Jammir products, policies or this Web site, 
	please fill in the contact form below and you will be contacted via e-mail within 3 business 
	days of us having received your e-mail. For your convenience, answers to many frequently 
	asked questions about our products are always available.
	
	<br />
	<br />
	<?php
	if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['contact']))
	{
	$fname = 0;
	$lname = 0;
	$email = 0;
	$sub = 0;
	$comment = 0;
	$ok = 0;
	if(isset($_POST['first_name']) && $_POST['first_name'] !== "" && preg_match('#^[a-z]{1,50}$#i', $_POST['first_name']))
	{
	$fname = 1;
	}
	if(isset($_POST['last_name']) && !empty($_POST['last_name']) && filter_var($_POST['last_name'], FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES))
	{
	$lname = 1;
	}
	if(isset($_POST['email']) && !empty($_POST['email'])  && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
	{
	$email = 1;
	}
	if(isset($_POST['subject']) && !empty($_POST['subject']))
	{
	$sub = 1;
	}
	if(isset($_POST['comments']) && !empty($_POST['comments']))
	{
	$comment = 1;
	}
	if($fname == 1 && $lname == 1 && $email == 1 && $comment == 1 && $sub == 1)
	{
	$ok = 1;
	$to      = 'ow_nz@hotmail.com';
	$subject = strip_tags($_POST['subject']);
	$message = strip_tags($_POST['comments']);
	$headers = 'From: '. strip_tags($_POST['first_name']) . ' ' . strip_tags($_POST['last_name']).' <'.strip_tags($_POST['email']).'>' . "\r\n";
	mail($to, $subject, $message, $headers);
	
	echo '<script>alert("Your message has been sent succesfully.")</script>';
	}
	}
	
	
	
	
	?>
	<form name="<?php $_SERVER['PHP_SELF'] ?>" method="post">
		<table class="center">
			<tr>
			<td valign="top">
				<label for="first_name">First Name</label>
			</td>
			<td valign="top">
			<?php
				if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['contact']) && $ok != 1)
				{
					if($ok == 0 && $fname == 1)
					{
					echo '
					<input  type="text" name="first_name" maxlength="50" size="30" value="'.$_POST['first_name'].'"/>';
					}else
					{
					echo '
					<input  type="text" name="first_name" maxlength="50" size="30" />';
					echo'<br />The information you entered was invalid.';
					}
				}
				else
				{
				echo '<input  type="text" name="first_name" maxlength="50" size="30" />';
				}
				?>
			</td>
			</tr>
		 
			<tr>
			<td valign="top">
				<label for="last_name">Last Name</label>
			</td>
			<td valign="top">
				<?php
				if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['contact']) && $ok != 1)
				{
					if($ok == 0 && $lname == 1)
					{
					echo '
					<input  type="text" name="last_name" maxlength="50" size="30" value="'.$_POST['last_name'].'"/>';
					}else
					{
					echo '
					<input  type="text" name="last_name" maxlength="50" size="30" />';
					echo'<br />The information you entered was invalid.';
					}
				}
				else
				{
				echo '<input  type="text" name="last_name" maxlength="50" size="30" />';
				}
				?>
			</td>
			</tr>
			<tr>
			<td valign="top">
				<label for="email">Email Address</label>
			</td>
			<td valign="top">
				<?php
				if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['contact'])  && $ok != 1)
				{
										
					if($ok == 0 && $email == 1)
					{
					echo '
					<input  type="text" name="email" maxlength="50" size="30" value="'.$_POST['email'].'"/>';
					
					}else
					{
					echo '
					<input  type="text" name="email" maxlength="50" size="30" />';
					echo'<br />The information you entered was invalid.';
					}
				
				}else
				{
				echo '<input  type="text" name="email" maxlength="50" size="30" />';
				}
				
				?>
						
			</td>
			</tr>
			<tr>
				<td valign="top">
				<label for="subject">Subject</label>
			</td>
			<td valign="top">
				<?php
				if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['contact']) && $ok != 1)
				{
					if($ok == 0 && $sub == 1)
					{
					echo '
					<input  type="text" name="subject" maxlength="50" size="30" value="'.$_POST['subject'].'"/>';
					}else
					{
					echo '
					<input  type="text" name="subject" maxlength="50" size="30" />';
					echo'<br />U must enter some text in the box';
					}
				}
				else
				{
				echo '<input  type="text" name="subject" maxlength="50" size="30" />';
				}
				?>
			</td>
			</tr>
			<tr>
				<td valign="top">
				<label for="comments">Comments</label>
			</td>
			<td valign="top">
			<?php
				if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['contact']) && $ok != 1)
				{
					if($ok == 0 && $comment == 1)
					{
					echo '
					<textarea name="comments" cols="25" rows="6">'.$_POST['email'].'</textarea>';
					}else
					{
					echo '
					<textarea name="comments" cols="25" rows="6"></textarea>';
					echo'<br />U must enter some text in the box';
					}
				}
				else
				{
				echo '<textarea name="comments" cols="25" rows="6"></textarea>';
				}
				?>
				</td>
			</tr>
			<tr>
			<td colspan="2" style="text-align:center">
				<input type="submit" name="contact" value="Submit"/>  
			</td>
			</tr>
		</table>
	</form>
	
	
	</div> <!-- end main -->
	
	<?php
	echo $footer;
	?>

</div> <!-- end page-container -->

</body>
</html>
	