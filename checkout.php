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
	<link rel="stylesheet" type="text/css" href="css/checkout.css" />
		
</head>

<body>
<div id="page-container">

	<?php 
	echo $banner; 
	?>

	<div id="checkout_body">
	<div id="checkout_main">
			<div id="checkout_top" style="font-weight:bold;font-family:Bodoni MT;font-size:40px;color:#bd0515;">
			Checkout
			</div>
			
	<?php
		$accID = 0;
		if (isset($_SESSION['account']))
			{ $accID = $_SESSION['account']; }
		$result = mysql_query("SELECT * FROM cart WHERE accID=$accID");
		$totalPrice=0;
		$totalString= "";
		
		if ($accID == 0)
		{
			echo '
					<div class="checkout_item" style="font-family:Bodoni MT;font-size:15px;color:black;">
					You are not loged in, click <a href="./home.php">here</a> to login.
					</div> <!-- end checkout_item -->
					<div id="checkout_bottom" style="font-family:Bodoni MT;font-size:15px;color:black;">
					</div> <!-- end checkout_bottom -->';
		}
		else
		{
			if(mysql_num_rows($result) >=1)
			{
				while($row = mysql_fetch_array($result))
				{
					$itemData = mysql_query("SELECT * FROM products WHERE prodID=$row[2]");
					$item = mysql_fetch_array($itemData);
					echo'
						<div class="checkout_item" style="font-family:Bodoni MT;font-size:15px;color:black;">
							<div class="checkout_item_name">'.$item['name'].'</div>
							<div class="checkout_item_buttons">
								<form method="post" action="./checkout.php">
									<input style="height:25px; width:25px" type="submit" name="Del'.$item['prodID'].'" value="Del" />
								</form>
							</div>
							<div class="checkout_item_info">item: '.$item['sstory'].',   ID: '.$item['Merk'].'_'.$item['prodID'].',   amount: '.$row['amount'].'</div>
							<div class="checkout_item_price">'.$row['amount'].' x $'.$item['price'].' = $'.$row['amount']*$item['price'].'</div>
						</div> <!-- end checkout_item -->
						';
					$totalString = $totalString.''.$item['name'].', '.$item['Merk'].', '.$item['prodID'].', '.$item['price'].', '.$row['amount'].'| ';
					$totalPrice += $item['price']*$row['amount'];
				}
				
				$endPrice = round( $totalPrice * 1.19 + 5, 2);
				echo '
					<div id="checkout_end" style="font-family:Bodoni MT;font-size:12px;color:black;">
					Total = $ '.$totalPrice.'<br/>
					inc. BTW (19.0%)<br/>and sending ($ 5,-)<br/><br/>
					<em style="font-style:normal;font-size:18px;">Total = $ '.$endPrice.'</em>
					</div> <!-- end checkout_end -->
					<div id="checkout_bottom">
					<form method="post" action="send.php" >'.// !!!! need to change send.php into other directory !!!!
						'
						<input type="hidden" value="'.$accID.'" name="accID" />
						<input type="hidden" value="'.$totalString.'" name="productString"/>
						<input type="hidden" value="'.$endPrice.'" name="totalPrice" />
						<input type="checkbox" name="isChecked" /> I have read the <a href="./toa.html">Terms of Agreement</a> and accept. 
						<input type="submit" value="Order" style="font-weight:bold;font-family:Bodoni MT;font-size:30px;color:#bd0515;" />
					</form>
					</div> <!-- end checkout_bottom -->
					';
			}
			else
			{
				echo '
					<div class="checkout_item" style="font-family:Bodoni MT;font-size:15px;color:black;">
					You have no items in your cart, click <a href="./main.php">here</a> to shop.
					</div> <!-- end checkout_item -->
					<div id="checkout_bottom" style="font-family:Bodoni MT;font-size:15px;color:black;">
					</div> <!-- end checkout_bottom -->';
			}
		}
	?>
			
			
	</div> <!-- end checkout_main -->
	</div> <!-- end checkout_body -->

	<?php
	echo $footer;
	?>

</div> <!-- end page-container -->

</body>
</html>