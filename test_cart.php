
<html>
<head></head>
<body>
<?php

session_start();

$array = array();

for($i=0;$i<5;$i++) {

$array[] = $i; //insert $i to an array

}

$_SESSION['array'] = $array; //assign $array to the session variable $_SESSION['array']

?>

<?php

//session_start();

$array = $_SESSION['array']; //assign $_SESSION['array'] to $array

foreach($array as $value) {

print $value; //print $array contents

}
?>
</body>
</html>