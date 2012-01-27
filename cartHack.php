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
	echo "yay";
	if (isset($_POST['cartHack']))
	{ 
		$array = explode(", ", $_POST['cartHack']);
		$_SESSION['cart'] = $array;
	}
?>



</body>
</html>