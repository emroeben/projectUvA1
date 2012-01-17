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

$banner = '
	<div id="banner">
	
		<div id="logo">
		<div id="account">
		</div> <!-- end account -->
		</div> <!-- end logo -->
		<div id="winkel">
		</div>
		<div id="nav-bar">
		<ul>
			<li id="Home"><a href="home.html">Home</a></li>
			<li id="Amigurumi"><a href="#">Amigurumi</a></li>
			<li id="Crochet"><a href="##">Crochet</a></li>
			<li id="Clay"><a href="###">Clay Charms</a></li>
			<li id="Jewelry"><a href="####">Jewelry</a></li>
			<li id="Contact"><a href="contact.html">Contact</a></li>
		</ul>
		</div> <!-- nav-bar -->
		<div class="search">
		</div> <!-- end search -->
	</div> <!-- end banner -->
	';
	
	$footer = '
	<div id="footer">
	<div class="search">
		</div> <!-- end search -->
	</div> <!-- end footer -->
	';
	
	function beveilig ($box)
	{
		$activiteit = strip_tags($box);
		$activiteit = htmlspecialchars($box);
		return $box;
	}
	
?>
