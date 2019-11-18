<?php
echo "hello world";

$temp=$_GET['temp'];
$hum=$_GET['hum'];
$myObj->temp = $temp;
$myObj->hum= $hum;


$myJSON = json_encode($myObj);

echo $myJSON;
file_put_contents("clouddata","[".$myJSON."]")

?>
