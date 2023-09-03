<?php include('parts/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Add Categories</h1>



        <br><br>

        <form  action="" method="post" enctype="multipart/form-data"> <!---enctype is used to post image------>
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Category title">
                    </td>
                </tr>
                <tr>
                    <td>Select image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>


                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="yes">Yes
                        <input type="radio" name="featured" value="no">No
                    </td>
                </tr>

                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="yes">Yes
                        <input type="radio" name="active" value="no">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add category" class="btn-secondary">

                    </td>
                </tr>
            </table>

        </form>

        <?php

        // data base connection

        // if condndition is used if we click submit button it is going to add the data into tha data base
          if(isset($_POST['submit']))
          {
              $title = $_POST['title'];
              //echo $title;
              if(isset($_POST['featured']))
              {
                  $featured = $_POST['featured'];
              }
              else {
                $featured = "no";
              }
              if(isset($_POST['active']))
              {
                  $active = $_POST['active'];
              }
              else {
                $active = "no";
              }

            //  print_r($_FILES['image']);
            //  die();

            // for uploading image
            if(isset($_FILES['image']['name']))
            {
              //to upoload image we need image name ,source path and destination path
              $image_name = $_FILES['image']['name'];
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
            }
            else {
                $image_name = "";
            }




              // query for  database connection
              $sql ="INSERT INTO category SET
                      title = '$title',
                      image_name = '$image_name',
                      featured = '$featured',
                      active = '$active'
                ";
              // execution of query
              $res = mysqli_query($conn,$sql);
              // check whether data is inserted or not
              if($res == true)
              {
              ?>
              <script type="text/javascript">
              alert("category added sucessfully");
              window.location = "manage-category.php";
              </script>
              <?php
              }
              else
              {
                echo '<script type="text/javascript">
                  alert("failed to add the category");
                  window.location = "manage-category.php";
                  </script>';
              }

          }
         ?>
    </div>
</div>


<?php include('parts/footer.php'); ?>
