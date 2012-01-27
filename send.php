<?php
require_once 'vars.php';
 echo'<?xml version="1.0"?>';
 include 'Verbindingsdata.php';
 ?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Jammir Webshop</title>
	<?php
	echo $meta;
	?>
	<link rel="stylesheet" type="text/css" href="css/send.css" />
</head>

<body>
<?php
$order = explode("| ", $_POST['productString']);
$totalArray = array();
for ($i=0; $i < count($order); $i++ )
	{
		$list = explode(", ", $order[$i]);
		array_push($totalArray, $list);
	}	

echo $_POST['productString'].'</br>';
//echo $totalArray[2][0];

?>
<?php
echo '<div id="send_body">
	<div id="send_text">';
		echo '<table border="0" width="100%">
		<caption><h1>Order<h1></caption> 
		<tr>
		<th>Product ID</th>
		<th>Quantity</th>
		<th>Product</th>
		<th>Price product</th>
		<th>Subtotal</th>
		</tr>
		<tr><td width="10%">';
		echo '<center>' . $totalArray[0][2] . '</center>';
		echo '</td width="10%"><td>';
		echo '<center>' . $totalArray[0][4] . '</center>';
		echo '</td width="10%"><td>';
		echo '<center>' . $totalArray[0][0] . '</center>';
		echo '</td width="10%"><td>';
		echo '<center>' . $totalArray[0][3] . '</center>';
		echo '</td width="10%"><td>';
		echo '<center>' . $totalArray[0][3] . '</center>';
		echo '</td></tr>
		</table>';
	
	/*
	<table border="0" width="100%">
	<caption>Order</caption>
	<tr>
	<th>Product ID</th>
	<th>Quantity</th>
	<th>Product</th>
	<th>Price product</th>
	<th>Subtotal</th>
	</tr>
	<tr>
	<td width="10%">row 1, cell 1</td>
	<td width="10%">row 1, cell 2</td>
	<td width="55%">row 1, cell 3</td>
	<td width="10%">row 1, cell 4</td>
	<td width="15%">row 1, cell 5</td>
	</tr>
	<tr>
	<td>row 2, cell 1</td>
	<td>row 2, cell 2</td>
	<td>row 2, cell 3</td>
	<td>row 2, cell 4</td>
	<td>row 2, cell 5</td>
	</tr>
	</table>
	*/
	echo '</div>
</div>';
?>
</body>
</html>