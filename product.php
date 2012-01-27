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
	<link rel="stylesheet" type="text/css" href="css/product.css" />
	<script type="text/javascript">
	<!--
	function delayer(){
		window.location = "main.php"
	}
//-->
</script>
</head>
<?php
include 'Verbindingsdata.php';
if(!isset($_GET['product']) || empty($_GET['product']) || !is_numeric($_GET['product']))
	{
	echo'<body onLoad="';echo"setTimeout('delayer()'";echo', 5000)"> 
	<div id="page-container">'.$banner.'
	No product page was specified, you will be returned to the overview of products<b />
	if you are not being redirected click <a href="./main.php">Here</a></div>
	</body>
	</html>';
    exit;
	}else
	{
	$product = beveilig($_GET['product']);
	// DE HOOFDQUERY!
	$result = mysql_query("SELECT prodID, name, price, story FROM products
		WHERE prodID = $product LIMIT 0, 1");
	
	if (mysql_num_rows($result) == 0)
	{
	echo'<body onLoad="';echo"setTimeout('delayer()'";echo', 5000)"> 
	<div id="page-container">'.$banner.'
	The product you are looking for no longer exists, you will be returned to the overview of products<b />
	if you are not being redirected click <a href="./main.php">Here</a></div>
	</body>
	</html>';
    exit;
	}
	}
	?>
<body>
<div id="page-container">

	<?php
	echo $banner;
	
	$row = mysql_fetch_row($result);
	$plaatje = mysql_query("SELECT url FROM images WHERE prodID=".$row[0]." LIMIT 0, 4");
		if (mysql_num_rows($plaatje) == 0) {
		$url[0] = "images/products/none.jpg";
		// VERANDER !!!! IMG!!!!!
		echo'<div id="Bimg">
		<img src="'.$url[0].'" alt="'.$row[1].'" class="plat"/>
		</div>';}
		else
		{
		$groot = mysql_query("SELECT url FROM images WHERE prodID=".$row[0]." LIMIT 0, 1");
		$url = mysql_fetch_row($groot);
		echo'<div id="Bimg" style="background: 
		url('.$url[0].') no-repeat;">
		</div>';}
		
	?>
	<div id="Right">
		<div id="Name">
			<br />
			<?php
			echo $row[1];
			?>
		</div> <!-- end div Name -->
		<div id="Pay">
			<p style="font-size:40%;">price</p>
			<?php
			echo $row[2];
			?>
			<p style="font-size:30%;">excl. BTW</p>
		</div> <!-- end div Pay -->
		<div id="Add">
		<div style="text-align:center;" >
		<form method="post" action="./checkout.php" >
			<input type="text" <input type="text" maxlength="2" value="1" size="2" name="item<?php echo $product;?>" />
			<input type="submit" value="Add to cart" />
		</form>
		</div> <!-- end div -->
		</div> <!-- ebd div add -->
		<a href="./main.php">Return to main</a><br/><br/><br/><br/><br/>
		<p style="font-family:Bodoni MT;font-size:20px;padding:0px 200px 0px 10px;text-align:justify;">
		<?php
		echo $row[3];
		?>
		</p>
	</div>
	<div id="Simg">
		<div class="inner">
		<?php
		if (mysql_num_rows($plaatje) == 0) {
		echo'<img src="'.$url[0].'" alt="'.$row[1].'" class="small"/>';
		} else { 
		while($img = mysql_fetch_array($plaatje))
		{
		echo'<img src="'.$img['url'].'" alt="'.$row[1].'" class="small"/>&nbsp;';
		}}
		?>
		
			</div>
	</div>
	
	<?php
	echo $footer;
	mysql_close($connectie);
	?>

</div> <!-- end page-container -->

</body>
</html>