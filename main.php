<?php
require_once 'addCart.php';
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

	<link rel="stylesheet" type="text/css" href="css/main.css" /> 
			
</head>

<body class="Products">
<div id="page-container">
<?php
	
// om een $_get uit een url aan te passen.		

?>
	
	
	<?php
	echo $banner;
		
	// de query die alle producten zoekt.
	$alles = "SELECT DISTINCT products.prodID, name, story, price FROM products, cats WHERE cats.prodID = products.prodID";
	$ami = "SELECT DISTINCT products.prodID, name, story, price FROM products, cats WHERE cats.prodID = products.prodID AND catID = 1";
	$cro = "SELECT DISTINCT products.prodID, name, story, price FROM products, cats WHERE cats.prodID = products.prodID AND catID = 2";
	$cla = "SELECT DISTINCT products.prodID, name, story, price FROM products, cats WHERE cats.prodID = products.prodID AND catID = 3";
	
	// CATEGORIE //
	
	if(!isset($_GET['categorie']))
	{
		$q = $alles;
	}
	else
	{
		$categorie = intval($_GET['categorie']);
		if($categorie == 1)
		{$q = $ami;
		echo"<script>document.body.className = 'Amigurumi'</script>";}
		elseif($categorie == 2)
		{$q = $cro;
		echo"<script>document.body.className = 'Crochet'</script>";}
		elseif($categorie == 3)
		{$q = $cla;
		echo"<script>document.body.className = 'Clay'</script>";}
		else
		{$q = $alles;}		
	}
	
	// CATEGORIE	
	?>
	
	<div id="main">
		
		<div id="filter">
		<div style="filterI">
			<form action="<?php $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']?>" method="get">
			<input type="hidden" name="filter" value="on">
			<dl class="dl-style">
			<dt class="dt-style">Type</dt>
				<dd><input type="checkbox" name="t1" <?php echo (isset($_GET['t1']) ? ' checked="checked"' : '') ?> /> Food </dd>
				<dd><input type="checkbox" name="t2" <?php echo (isset($_GET['t2']) ? ' checked="checked"' : '') ?> /> Birds </dd>
				<dd><input type="checkbox" name="t3" <?php echo (isset($_GET['t3']) ? ' checked="checked"' : '') ?> /> Sea Animals </dd>
				<dd><input type="checkbox" name="t4" <?php echo (isset($_GET['t4']) ? ' checked="checked"' : '') ?> /> Land animals </dd>
				<dd><input type="checkbox" name="t5" <?php echo (isset($_GET['t5']) ? ' checked="checked"' : '') ?> /> Cushion </dd>
				<dd><input type="checkbox" name="t6" <?php echo (isset($_GET['t6']) ? ' checked="checked"' : '') ?> /> Jewelry </dd></dl>
			<dl class="dl-style">
			<dt class="dt-style">Color</dt>
				<dd><input type="checkbox" name="c1" <?php echo (isset($_GET['c1']) ? ' checked="checked"' : '') ?> /> Green </dd>
				<dd><input type="checkbox" name="c2" <?php echo (isset($_GET['c2']) ? ' checked="checked"' : '') ?> /> Blue </dd>
				<dd><input type="checkbox" name="c3" <?php echo (isset($_GET['c3']) ? ' checked="checked"' : '') ?> /> White </dd>
				<dd><input type="checkbox" name="c4" <?php echo (isset($_GET['c4']) ? ' checked="checked"' : '') ?> /> Black </dd>
				<dd><input type="checkbox" name="c5" <?php echo (isset($_GET['c5']) ? ' checked="checked"' : '') ?> /> Red </dd>	
			</dl>
			<dl class="dl-style">				
			<dt class="dt-style">Price</dt>
				<dd><input type="checkbox" name="p1" <?php echo (isset($_GET['p1']) ? ' checked="checked"' : '') ?> /> $0,00 &nbsp; - $5,00 </dd>
				<dd><input type="checkbox" name="p2" <?php echo (isset($_GET['p2']) ? ' checked="checked"' : '') ?> /> $5,00 &nbsp; - $10,00 </dd>
				<dd><input type="checkbox" name="p3" <?php echo (isset($_GET['p3']) ? ' checked="checked"' : '') ?> /> $10,00 - $20,00 </dd>
				<dd><input type="checkbox" name="p4" <?php echo (isset($_GET['p4']) ? ' checked="checked"' : '') ?> /> $20,00 - $30,00 </dd>
			</dl>
			<input type="submit" value="Apply Filter"/>
			</form>
		</div>
	
		</div> <!-- end filter -->
		<div id="pri-nav">
		
		<div class="nav">
		<?php
		// FILTERS //
		if(isset($_GET['filter']))
		{
		//$f = "SELECT * FROM cats WHERE prodID = $row[0]";
		$filters = array();
		// TYPES
		if(isset($_GET['t1']))
		{
		array_push($filters, "catID = 9");
		}
		if(isset($_GET['t2']))
		{
		array_push($filters, "catID = 5");
		}
		if(isset($_GET['t3']))
		{
		array_push($filters, "catID = 6");
		}
		if(isset($_GET['t4']))
		{
		array_push($filters, "catID = 8");
		}
		if(isset($_GET['t5']))
		{
		array_push($filters, "catID = 10");
		}
		// TYPES
		// COLORS
		if(isset($_GET['c1']))
		{
		array_push($filters, "catID = 11");
		}
		if(isset($_GET['c2']))
		{
		array_push($filters, "catID = 12");
		}
		if(isset($_GET['c3']))
		{
		array_push($filters, "catID = 13");
		}
		if(isset($_GET['c4']))
		{
		array_push($filters, "catID = 14");
		}
		if(isset($_GET['c5']))
		{
		array_push($filters, "catID = 15");
		}
		// COLORS
		// PRICE
		if(isset($_GET['p1']))
		{
		array_push($filters, "(price >= 0 AND price <= 5)");
		}
		if(isset($_GET['p2']))
		{
		array_push($filters, "(price >= 5 AND price <= 10)");
		}
		if(isset($_GET['p3']))
		{
		array_push($filters, "(price >= 10 AND price <= 20)");
		}
		if(isset($_GET['p4']))
		{
		array_push($filters, "(price >= 20 AND price <= 30)");
		}
		
		// PRICE
		echo '<!-- '. count($filters) .' -->';
		for($i = 0; $i < count($filters); $i++)
		{
		if($i == 0)
		{
		$q .= ' AND (' . $filters[$i];
		}
		else
		{
		$q .= ' OR '. $filters[$i];
		}
		}
		if(count($filters) > 0)
		{
		$q .= ')';
		}
		echo '<!-- '. $q .' -->';
		$ff = mysql_query($q);
		}
		
		// FILTERS //
		
		
		$result = mysql_query($q);
		$aantal_pag = ceil(mysql_num_rows($result) / 16);
		searchbar($aantal_pag);
		?>
		
		</div>
		
		</div> <!-- end pri-nav -->
		<div id="shop">
		
		<?php
		// $result staat onder de banner. 
		// (omdat hij dan overal (onder de banner) gebruikt kan worden in de code)		
		$min = 0;		
		$max = 16;
		if(isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page']))
		{
		$c_page = $_GET['page'];
			if($c_page > 1 && $c_page <= $aantal_pag)
			{
			$min = 1 + ($aantal_pag - 1) * 16;
			$max = 17 + ($aantal_pag - 1) * 16;
			}
		}
		
		echo "<!-- $q . \" LIMIT $min, $max\", $aantal_pag -->";
		$result = mysql_query($q . " LIMIT $min, $max");
		
		if(mysql_num_rows($result) >=1)
		{
		while($row = mysql_fetch_array($result))
		{
		// FILTER
		if(isset($_GET['filter']))
		{
		
		if(mysql_num_rows($ff) == 0)
		{continue;}
		
		}
		// FILTER
		
		$plaatje = mysql_query("SELECT url FROM images WHERE prodID=".$row['prodID']." LIMIT 0, 1");
		if (mysql_num_rows($plaatje) == 0) {
		$url[0] = "images/products/none.jpg";
		} else { 
		$url = mysql_fetch_row($plaatje);
		}
		
		echo'
			<div class="item">
			<div class="itemI">
				<a href="./product.php?product='.$row['prodID'].'"><img src="'
				.$url[0].'" alt="'.$row['name'].'" class="image"/></a>
			</div> <!-- end itemI -->
			<div class="bedrag">
				price<p class="price">$ '.$row['price'].' </p> excl. BTW
			</div> <!-- end bedrag -->
			<div class="naam">'
			.$row['name'].'
			</div> <!-- end naam -->
			<div class="add">
			<form method="post" action="'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'" >
				<input type="text" maxlength="2" value="1" size="2" name="item'.$row['prodID'].'" />
				<input type="submit" value="Add to cart" />
			</form>
			</div> <!-- end add -->
		</div> <!-- end item -->';	
				
		}
		}else
		{
		echo 'After applying the filters, no products could be found';
		}
		?>
				
		</div> <!-- end shop -->
		<div id="sec-nav">
		<div class="nav">
		<?php
		searchbar($aantal_pag);
		?>
		</div>
		</div> <!-- end sec-nav -->
	</div> <!-- end main -->

	<?php
	echo $footer;
	mysql_close($connectie);
	?>

</div> <!-- end page-container -->

</body>
</html>