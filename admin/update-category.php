<?php include('parts/menu.php'); ?>

<?php
// check wether the id is set or not
if(isset($_GET['Id']))
{
  // get the Id and all other details
  $Id = $_GET['Id'];
  // sql query to get all other details
  $sql = "SELECT * FROM category WHERE Id=$Id";
  // execution of query
  $res = mysqli_query($conn,$sql);
  // count the rows
  $count = mysqli_num_rows($res);

    if($count == 1)
    {
      // get the data from database
       $row = mysqli_fetch_assoc($res);

       $title = $row['title'];
       $current_image = $row['image_name'];
       $featured = $row['featured'];
       $active = $row['active'];


    }
    else
    {
      echo '<script type="text/javascript">
        alert("no category found")
        window.location = "manage-category.php";
      </script>';
    }
}
else
{
  // reirect to manage category  page
  echo '<script type="text/javascript">
    window.location = "manage-category.php";
  </script>';
}


 ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Categories</h1>
        <br><br>

        <form class="" action="" method="post" enctype="multipart/form-data">
          <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td>
                    <input type="text" name="title" value="<?php echo $title; ?>">
                </td>
            </tr>

            <tr>
              <td>Current image:</td>
              <td>
                  <img src="../images/category/<?php echo $current_image ?>" width="100px" height="100px">
              </td>
            </tr>


            <tr>
              <td>New image:</td>
              <td>
                  <input type="file" name="image">
              </td>
            </tr>

            <tr>
              <td>Featured:</td>
              <td>
                  <input <?php if($featured == "yes"){echo "checked";}?> type="radio" name="featured" value="yes">yes
                  <input <?php if($featured == "no"){echo "checked";} ?> type="radio" name="featured" value="no">no
              </td>
            </tr>

            <tr>
              <td>Active:</td>
              <td>
                  <input <?php if($featured == "yes"){echo "checked";}?> type="radio" name="active" value="yes">yes
                  <input <?php if($featured == "no"){echo "checked";}?> type="radio" name="active" value="no">no
              </td>


            </tr>
            <tr>
              <td colspan="2">
                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                <input type="hidden" name="Id" value="<?php echo $Id; ?>">

                <input type="submit" name="submit" value="Update category" class="btn-secondary">
              </td>
            </tr>

          </table>

        </form>

        <?php
          // perfoming update operation
          if(isset($_POST['submit']))
          {
                // 1. get al the values from the form
                $Id = $_POST['Id'];
                $title = $_POST['title'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                // 2.update the image if new image is selected
                if(isset($_FILES['image']['name']))
                {
                      //to upoload image we need image name ,source path and destination path
                      $image_name = $_FILES['image']['name'];

                      //check wether the file is available or not
                      if($image_name != "")
                      {
                            $source_path = $_FILES['image']['tmp_name'];// tmp_name is an sourse path of xapp server
                            $destination_path = "../images/category/".$image_name;

                             //finally upload the images
                             $upload = move_uploaded_file($source_path,$destination_path);

                             //check wether the image is upladed r Not
                             if($upload == false)
                             {
                               echo '<script type="text/javascript">
                                 alert("failed to upload image");
                                 window.location = "add-category.php";
                               </script>';

                                 die();
                             }
                             // remove the current images
                             if($current_image!="")
                             {
                               $remove_path = "../images/category/".$current_image;
                               $remove = unlink($remove_path);
                             }

                      }
                      else
                      {
                          $image_name = $current_image;

                      }
                      //3. update the food in database
                          $sql2 = "UPDATE category SET
                                    title = '$title',
                                    image_name = '$image_name',
                                    featured = '$featured',
                                    active = '$active'
                                    WHERE Id = $Id;
                                    ";

                          $res2= mysqli_query($conn,$sql2);// execution of query

                          if($res2 == true)
                          {
                              // category updated
                              echo '<script type="text/javascript">
                                alert("category updated successfully")
                                window.location = "manage-category.php";
                              </script>';

                          }
                          else
                          {
                                // display error message and redirect page to manage-category.php
                                echo '<script type="text/javascript">
                                  alert("Failed to update catefory")
                                  window.location = "manage-category.php";
                                </script>';
                          }

                }
                else
                {
                    $image_name = $current_image;

                }

          }

         ?>

    </div>

</div>


<?php include('parts/footer.php'); ?>
