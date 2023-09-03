<?php

  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $password = $_POST['password'];


  //database connetion
  $conn = new mysqli('localhost','root','','food');
  if($conn->connect_error){
    die('Connection failed :'.$conn->connect_error);
  }else{
    $stmt = $conn->prepare("insert into registration(firstname,lastname,email,password)
      values(?,?,?,?)");
    $stmt->bind_param("ssss",$firstname,$lastname,$email,$password);
    $stmt->execute();
    echo '<script type="text/javascript">
      alert("your account is successfully created");
      window.location = "login.html";
    </script>';
    $stmt->close();
    $conn->close();
  }

 ?>
