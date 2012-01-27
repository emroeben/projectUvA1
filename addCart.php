<?php //updates cart in database
	session_start();
	include 'Verbindingsdata.php';
		if (isset($_SESSION['account']))
		{
			$allProd = mysql_query("SELECT prodID FROM products ORDER BY prodID");
			while($row = mysql_fetch_array($allProd))
			{
				if (isset($_POST['item'.$row[0]]))
				{
					$amount = $_POST['item'.$row[0]];
					$accID = $_SESSION['account'];
					$prodID = $row[0];
					
					$querryI = mysql_query("SELECT * FROM cart WHERE accID=$accID AND prodID=$prodID");
					if (mysql_num_rows($querryI) == 1)
					{
					$oldAmount = mysql_fetch_row($querryI);
					$querry = "UPDATE cart SET amount=".($amount+$oldAmount[3])." WHERE accID=$accID AND prodID=$prodID";
					}
					else
					{
					$querry = "INSERT INTO cart (accID, prodID, amount) VALUES ($accID, $prodID, $amount)";
					}
					mysql_query($querry);
				}
				else if (isset($_POST['Del'.$row[0]]))
				{
					$prodID = $row[0];
					$accID = $_SESSION['account'];
					
					$querry = "DELETE FROM cart WHERE accID=$accID AND prodID=$prodID";
					mysql_query($querry);
				}
			}
		}
	mysql_close($connectie);
?>