<?php

  $email = $_POST['email'];
  $password = $_POST['password'];

  //database connection
  $con = new mysqli("localhost","root","","food");
  if($con->connect_error){
    die("Failed to connect :".$con->connect_error);
  }else{
    $stmt = $con->prepare("select * from registration where email = ?");
    $stmt->bind_param("s",$email);
    $stmt->execute();
    $stmt_result =$stmt->get_result();
    if($stmt_result->num_rows > 0){
      $data = $stmt_result->fetch_assoc();
      if($data['password'] === $password){
       
       echo '<script type="text/javascript">
        window.location = "admin-dashboard.php";
      </script>';

      }else{
        echo '<script type="text/javascript">
          alert("incorrect email/password");
          window.location = "login.html";
        </script>';
      }
    }else{
      echo '<script type="text/javascript">
        alert("unsuccessfull");
        window.location = "login.html";
      </script>' ;
    }
  }

 ?>
