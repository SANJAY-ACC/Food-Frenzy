<?php include('parts/menu.php'); ?>

<?php
    // get all the details
    $id = $_GET['id'];
    // sql query to get the selected foods
    $sql2="SELECT * FROM food WHERE id=$id";
    $res2=mysqli_query($conn,$sql2);//execution of query
    // get the value based on query selected
    $row2 =mysqli_fetch_assoc($res2);
    // get the individual value of selected food
    $title = $row2['title'];
    $description = $row2['description'];
    $price = $row2['price'];
    $current_image = $row2['image_name'];
    $current_category = $row2['category'];
    $featured = $row2['featured'];
    $active = $row2['active'];


 ?>

<div class="main-content">
    <div class="wrapper">
          <h1>Update food</h1>
          <br><br>

          <form  action="" method="post" enctype="multipart/form-data">
              <table class="tbl-30">
                    <tr>
                        <td>Tittle:</td>
                        <td>
                          <input type="text" name="title"value="<?php  echo $title; ?>">
                        </td>
                    </tr>

                    <tr>
                        <td>Description:</td>
                        <td>
                            <textarea name="description" rows="5" cols="30"><?php  echo $description; ?></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Price:</td>
                        <td>
                            <input type="number" name="price" value="<?php  echo $price; ?>" >
                        </td>

                    </tr>

                    <tr>
                        <td>Current Image:</td>
                        <td>
                            <img src="../images/food/<?php echo $current_image; ?>" width="100px" height="100px">
                        </td>
                    </tr>

                    <tr>
                        <td>Select new Image:</td>
                        <td>
                              <input type="file" name="image">
                        </td>
                    </tr>

                    <tr>
                        <td>Category:</td>
                        <td>
                            <select  name="category">
                              <?php
                                  // display categories from database
                                  $sql = "SELECT * FROM category WHERE active='yes'";// query to get categories which are only active
                                  $res = mysqli_query($conn,$sql);// execution of query
                                  $count = mysqli_num_rows($res);// count the rows

                                  // check wether the category is availabe are not
                                    if($count>0)
                                    {
                                      // category availabe
                                          while($row = mysqli_fetch_assoc($res))
                                          {
                                              $category_title = $row['title'];
                                              $category_id = $row['Id'];


                                              ?>
                                                  <option <?php if($current_category==$category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>

                                              <?php

                                          }
                                    }
                                    else
                                    {
                                      // category not available
                                       echo "<option value='0'>category not available</option>";
                                    }
                               ?>


                            </select>
                        </td>

                    <tr>
                        <td>featured:</td>
                        <td>
                            <input <?php if($featured == "yes"){echo "checked";} ?> type="radio" name="featured" value="yes">Yes
                            <input <?php if($featured == "no"){echo "checked";} ?>  type="radio" name="featured" value="no">No
                        </td>
                    </tr>

                    <tr>
                        <td>Active:</td>
                        <td>
                            <input <?php if($active == "yes"){echo "checked";} ?> type="radio" name="active" value="yes">Yes
                            <input <?php if($active == "no"){echo "checked";} ?> type="radio" name="active" value="no">No
                        </td>
                    </tr>

                    <tr>
                      <td colspan="2">
                          <input type="hidden" name="id" value="<?php echo $id; ?>">
                          <input type="hidden" name="current_image" value="<?php echo $current_image ?>">
                          <input type="submit" name="submit" value="Update food" class="btn-secondary">
                      </td>
                    </tr>
              </table>
          </form>

          <?php
            if(isset($_POST['submit']))
            {
                //1. get all the details from the form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];

                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //2. Remove the current image if new image is uploaded
                // upload the image if selected
                if(isset($_FILES['image']['name']))
                {
                    // upload if  button clicked
                    $image_name = $_FILES['image']['name'];// new image name

                      // check wether the file is availabe are not
                      if($image_name != "")
                      {
                              // to upload the image get the source path and destination path
                              $src_path = $_FILES['image']['tmp_name'];// source path
                              $dest_path = "../images/food/".$image_name;// destination path

                              // upload the images
                              $upload = move_uploaded_file($src_path,$dest_path);
                              if($upload== false)
                              {
                                echo '<script type="text/javascript">
                                  alert("failed to upload image");
                                  window.location = "manage-food.php";
                                </script>';
                                die();
                              }
                              if($current_image!="")
                              {
                                    // remove current image
                                    $remove_path = "../images/food/".$current_image;
                                    $remove = unlink($remove_path);
                              }
                      }
                      else
                      {
                        $image_name = $current_image;
                      }
                }
                else
                {
                   $image_name = $current_image;
                }
                  // update the food in database
                  $sql3="UPDATE food SET
                        title = '$title',
                        description = '$description',
                        price = $price,
                        image_name = '$image_name',
                        category = '$category',
                        featured = '$featured',
                        active = '$active'
                        WHERE id=$id
                  ";
                  // execution of sql query
                  $res3 = mysqli_query($conn,$sql3);
                  // check wethe the query is executed or not
                  if($res3== true)
                  {
                    echo '<script type="text/javascript">
                      alert("food updated successfully");
                      window.location = "manage-food.php";
                    </script>';
                  }
                  else
                  {
                    echo '<script type="text/javascript">
                      alert("failed to update");
                      window.location = "manage-food.php";
                    </script>';
                  }
            }



           ?>

    </div>
</div>


<?php include('parts/footer.php'); ?>
