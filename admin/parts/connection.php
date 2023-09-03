<?php


define('LOCALHOST','localhost');// capital letter means constant and small letter means variable
define('USERNAME','root');
define('PASSWORD','');
define('DB_NAME','food');
$conn = mysqli_connect(LOCALHOST,USERNAME,PASSWORD,DB_NAME) or die(mysqli_error());


 ?>
