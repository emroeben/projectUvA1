<?php

$meta = '
<meta http-equiv="Content-Type" content="text/html;
	charset=iso-8859-1" />
		
	<meta name="description" content="Webshop Jammir" />
	<meta name="keywords" content="webshop, amigumuri, netherlands, nederland,
	selling, sale, shop, " />
	
	<meta name="author" content="Jammir" />
	<link rel="stylesheet" type="text/css" href="css/master.css" />
';

$search = '<div class="search">
		<p><input type="text" name="search" size="15" maxlength="30" />
			<input type="submit" value="Search" /></p>
		</div> <!-- end search -->';

session_start();
if (! isset( $_SESSION['cart'] ) )
{
	$cart = array();
	$cart[] = "test1";
	$cart[] = "test2";
	$cart[] = "test3";
	$_SESSION['cart'] = $cart;
}

$amount = count( $_SESSION['cart'] );

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1)
		{
		//unset($_SESSION['logged_in']);
		$acc = '<a href="logout.php"  style="color: #FFFFFF"> Log out </a>';
		}
		else
		{
		$acc = '<a href="home.php" style="color: #FFFFFF"> Click here to log in</a>';
		}

$banner = <<<EOT
	<div id="banner">
	
		<div id="logo">
		<div id="account">
		{$acc}
		</div> <!-- end account -->
		<form type="GET" action="{$_SERVER['PHP_SELF']}" name="cartForm">
			<input type="hidden" id="cartHack" name="cartHack" value="" />
			</form>
		</div> <!-- end logo -->
		<div id="winkel">
		<img src="images/winkelwagen.png" id="wagen">
			<a style="color: #f2b3c4; font-size:20px;" href="./checkout.html"> View Cart </a>
			<p style="padding-left: 60px; color: #f8fbfd;">	Items in cart: <em id="numOfItems">{$amount}</em></p> 
		</div>
		<div id="nav-bar">
		<ul>
			<li id="Home"><a href="home.php">Home</a></li>
			<li id="Products"><a href="main.php">All Products</a></li>
			<li id="Amigurumi"><a href="main.php?categorie=1">Amigurumi</a></li>
			<li id="Crochet"><a href="main.php?categorie=2">Crochet</a></li>
			<li id="Clay"><a href="main.php?categorie=3">Clay Charms</a></li>
			<li id="Contact"><a href="contact.php">Contact</a></li>
		</ul>
		</div> <!-- nav-bar -->
		{$search}
	</div> <!-- end banner -->
EOT;
	
	$footer = <<<EOT
	<div id="footer">
	<a href="toa.php">Terms of Agreement</a>
	{$search}
	</div> <!-- end footer -->
EOT;
	
	
	function beveilig ($box)
	{
		$act = strip_tags($box);
		$terug = mysql_real_escape_string($act);
		return $terug;
	}
	
	
?>

<script type="text/javascript" >
	var cart = new Array();

	function initCart()
	{
		var allelements = "<?php echo implode(",",$_SESSION['cart']);?>";
		cart = allelements.split(",");
		setCartNum();
	}
	
	function setCartNum()
	{
		document.getElementById("numOfItems").innerHTML=cart.length;
	}

	
</script>
