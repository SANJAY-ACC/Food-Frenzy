<?php

$name = $_POST['name'];
$number = $_POST['number'];
$email = $_POST['email'];
$doorno = $_POST['doorno'];
$landmark = $_POST['landmark'];
$area = $_POST['area'];
$pincode = $_POST['pincode'];
$city = $_POST['city'];
$state = $_POST['state'];

if( strlen($number) < 10 || strlen($number) > 10){
  echo '<script type="text/javascript">
  alert("enter 10 digit mob number");
  window.location = "address.html";
  </script>';
 die();


}

//database connection
$conn = new mysqli('localhost','root','','login');// for final change databasename login to food and also creat address table in fooddatabase
if($conn->connect_error){
  die('Connection failed :'.$conn->connect_error);
}else{
  $stmt = $conn->prepare("insert into address(name,number,email,doorno,landmark,area,pincode,city,state)
    values(?,?,?,?,?,?,?,?,?)");
  $stmt->bind_param("sisississ",$name,$number,$email,$doorno,$landmark,$area,$pincode,$city,$state);
  $stmt->execute();
  echo "successfull";
  $stmt->close();
  $conn->close();
}


 ?>
