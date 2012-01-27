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

</head>
<body>
<?php 
echo $_SESSION['cart'];
$cart = array();
$cart[0] = 'test1';
$cart[1] = 'test2';
$cart[2] = 'test3';
$_SESSION['cart'] = $cart;
echo $_SESSION['cart'];
?>
</body>
</html>