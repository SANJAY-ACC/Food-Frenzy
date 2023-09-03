<?php

// this page is for deleteing food  in admin module
include('parts/connection.php');// for database connection


  if(isset($_GET['id']) OR isset($_GET['id']))
  {
    // process to delete
    $id=$_GET['id'];
    $image_name=$_GET['image_name'];

    //echo $title;
    //echo $image_name;
    if($image_name != "")
    {
      $path = "../images/food/".$image_name;
      // remove image from folder
      $remove= unlink($path);
    }

    // delete data frm database
    // sql query to delete data from
    $sql="DELETE FROM food WHERE id = $id";
     // executeion of query
    $res = mysqli_query($conn,$sql);

    echo '<script type="text/javascript">
      alert("deleted successfully");
      window.location = "manage-food.php";

    </script>';
    die();
  }
  else
  {
    // redirect to manage-food page
    echo '<script type="text/javascript">
      alert("failed to delete data");
      window.location = "manage-food.php";

    </script>';
    die();
  }

 ?>
