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
if (!isset($_SESSION))
{session_start();}

$search = '<div class="search">
	<form action="search.php" method="get">
		<p><input type="text" name="search" size="15" maxlength="30" />
			<input type="submit" value="Search" /></p>
			</form>
		</div> <!-- end search -->';

if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1)
		{
		$acc = '<a href="logout.php"  style="color: #FFFFFF"> Log out  | </a>';
		$reg = '<a href="account.php"  style="color: #FFFFFF"> Account </a>';
		}
		else
		{
		$acc = '<a href="home.php" style="color: #FFFFFF"> Login  | </a>';
		$reg = '<a href="register.php" style="color: #FFFFFF"> Register </a>';
		}

$amount = 0;		
if ( isset($_SESSION['account']) )
{
	include 'Verbindingsdata.php';
	$cartQuerry = mysql_query("SELECT * FROM cart WHERE accID=".$_SESSION['account']."");
	while($rowCart = mysql_fetch_array($cartQuerry))
		{
			$amount += $rowCart['amount'];
		}
	mysql_close($connectie);
}

$banner = <<<EOT
	<div id="banner">
	
		<div id="logo">
		<div id="account">
		{$acc}{$reg}
		</div> <!-- end account -->
		</div> <!-- end logo -->
		<div id="winkel">
		<img src="images/winkelwagen.png" id="wagen">
			<a style="color: #f2b3c4; font-size:20px;" href="./checkout.php"> View Cart </a>
			<p style="padding-left: 60px; color: #f8fbfd;">	Items in cart: {$amount}</p> 
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
	{$search}
	<div class="lefto"><a href="toa.php">Terms of Agreement</a><div>
	</div> <!-- end footer -->
EOT;
	
	
	function beveilig ($box)
	{
		$act = strip_tags($box);
		$terug = mysql_real_escape_string($act);
		return $terug;
	}
	
	function searchbar($aantal_pag)
		{
			if(isset($_GET['page']) && !empty($_GET['page']))
			{
				$page = intval($_GET['page']);
				if($page <= 1)
				{
					echo '<< < ';
				}
				else
				{
					echo '<a href="'.add_get ($_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'], 'page', 1).'"><< </a>';
					echo '<a href="'.add_get ($_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'], 'page', $page-1).'"> <</a>';
				}
			}else
			{
			echo '<< < ';
			}
			
			for ($a = 1; $a <= $aantal_pag; $a++) 
			{
			echo '
			<a href="'.add_get($_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'], 'page', $a).'">'.$a.'</a>';
		
			echo ' ';
			}
			
			if(isset($_GET['page']) && !empty($_GET['page']))
				{
				$page = intval($_GET['page']);
				if($page >= $aantal_pag || $aantal_pag == 1)
				{
					echo '> >> ';
				}
				else
				{
					echo '<a href="'.add_get($_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'], 'page', $page+1).'">></a>';
					echo '<a href="'.add_get($_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'], 'page', $aantal_pag).'"> >></a>';
					
				}
			}else
			{
			$page=1;
			if($page >= $aantal_pag)
			{
			echo '> >>';
			}else
			{
			echo '<a href="'.add_get($_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'], 'page', $page+1).'">></a>';
					echo '<a href="'.add_get($_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'], 'page', $aantal_pag).'"> >></a>';
			}
			}
		}
	
	function add_get ($c_url, $nname, $nval) 
{
	list ($path, $gets) = explode ('?', $c_url);
	if($gets != '')
	{
	$sets= explode ('&', $gets);
	$count = count ($sets);
	// of er iets vervangen is
	$replaced = 0;
	// als $n gelijk is aan 0, dan wordt deze niet uitgevoerd
	for ($n = 0; $n < $count; $n++) 
	{
		list ($name, $value) = explode('=', $sets[$n]);
		// als de variabele gelijk is aan de naam die je wilt veranderen.
		if ($name == $nname) {
			// verandere de waarde die bij die naam hoort in de nieuwe
			$sets[$n] = $nname . '=' . $nval;
			// er is iets vervangen
			$replaced = 1;
			break;
		}
		}
	// als er niets aangepast is, voeg dan toe
	if ($replaced == 0) 
	{
		// als er niets vervangen is, voeg een nieuwe waarde aan de array toe.
		$sets[] = $nname . '=' . $nval;
	}
	// maak de nieuwe url en return deze als output
	$n_url = $path . '?' . implode ('&', $sets);
	}else
	{
	$n_url = $path . '?' . $nname . '=' . $nval;
	}
	return $n_url;
}
	
?>