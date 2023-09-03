<?php
      // this page is for deleteing category in admin module
 include('parts/connection.php');// for database connection

  if(isset($_GET['Id']) OR isset($_GET['image_name'])) // here GET method is used to get te data from database
  {
    $Id=$_GET['Id'];
    $image_name=$_GET['image_name'];

    //echo $title;
    //echo $image_name;
    if($image_name != "")
    {
      $path = "../images/category/".$image_name;
        // remove image from folder
      $remove= unlink($path);
    }

    // delete data frm database
    // sql query to delete data from
    $sql="DELETE FROM category WHERE Id = $Id";
     // executeion of query
    $res = mysqli_query($conn,$sql);

    echo '<script type="text/javascript">
      alert("deleted successfully");
      window.location = "manage-category.php";

    </script>';
    die();
  }
  else
  {
    echo '<script type="text/javascript">
      alert("failed to delete data");
      window.location = "manage-category.php";

    </script>';
    die();
  }













 ?>
