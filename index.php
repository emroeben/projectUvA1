<?php
include 'vars.php';
 echo'<?xml version="1.0"?>';?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" 
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Jammir Webshop</title>
	
	<?php
	echo $meta;
	?>
	
	
</head>
<?php
if(isset($_GET["page_id"]))
{
$id = $_GET["page_id"];
if($id == 1)
{
echo '<body class="Contact">';
}
else
{
echo '<body>';
}
}
?>
<div id="page-container">

	<?php
	echo $banner;
	
	if(isset($_GET["page_id"]))
	{
	$id = $_GET["page_id"];
	if($id == 1)
	{
	echo '<div id="main" style="height:500px;  background: #f2b3c4; padding: 40px;">
	
	<h1> Contact us </h1>
	
	If you have any comments or questions regarding Jammir products, policies or this Web site, 
	please fill in the contact form below and you will be contacted via e-mail within 3 business 
	days of us having received your e-mail. For your convenience, answers to many frequently 
	asked questions about our products are always available. (link)
	';
	include 'Verbindingsdata.php';
	echo'</div> <!-- end main -->';
	}
	else
	{
	echo '<div id="main"></div>';
	}}
	else
	{
	echo '<div id="main"></div>';
	}
	
	
	echo $footer;
	?>
</div> <!-- end page-container -->

</body>
</html>