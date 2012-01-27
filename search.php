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
	
	<link rel="stylesheet" type="text/css" href="css/search.css" />
	
</head>
<body>
<div id="page-container">

<?php
	echo $banner;
	if(isset($_GET['search']))
{
$sear = $_GET['search'];
	$data = "SELECT DISTINCT prodID, name, price FROM products WHERE name LIKE '%$sear%' OR story LIKE '%$sear%'";
	}
?>
	
	
	<div id="ms">
		
		<div id="pri-nav">
		
		<div class="nav">
		</div>
		<?php
		if(isset($_GET['search']) && $_GET['search'] != "" && !empty($_GET['search']))
	{
		$result = mysql_query($data);
		$aantal_pag = ceil(mysql_num_rows($result) / 16);
		searchbar($aantal_pag);
		}
		?>
		</div>
		<div id="shop">
		
<?php
	if(isset($_GET['search']))
	{
if ($sear == "" || empty($sear)) 
 { 
echo '<script>alert("You forgot to enter a term.")</script>';
   } else
   {
    $zoek = mysql_query($data);
     $match = mysql_num_rows($zoek); 
   if ($match != 0)
	{
   $sear = beveilig($_GET['search']); 
   
   
		$min = 0;		
		$max = 20;
		if(isset($_GET['page']) && !empty($_GET['page']) && is_numeric($_GET['page']))
		{
		$c_page = $_GET['page'];
			if($c_page > 1 && $c_page <= $aantal_pag)
			{
			$min = 0 + ($aantal_pag - 1) * 20;
			$max = 21 + ($aantal_pag - 1) * 20;
			}
		}
   
   
   echo 'The search results for "'.$sear.'" are:<br />';
   $data .= " LIMIT $min, $max";
   $zoek = mysql_query($data);
while($row = mysql_fetch_array($zoek))
		{
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
			echo 'No products were found for'.$sear;
			}
			}
			}
	
	
?>




</div> <!-- end shop -->
		<div id="sec-nav">
		<div class="nav">
		<?php
		if(isset($_GET['search']) && $_GET['search'] != "" && !empty($_GET['search']))
	{
		searchbar($aantal_pag);
		}
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