<?php include('parts/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
        <h1>Add food</h1>

        <br><br>

        <form action="" method="post" enctype="multipart/form-data">
            <table class="tbl-30">
              <tr>
                  <td>Tittle:</td>
                  <td>
                      <input type="text" name="title" placeholder="title of the food">
                  </td>
              </tr>

              <tr>
                  <td>Description:</td>
                  <td>
                      <textarea name="description" rows="5" cols="30" placeholder="description of the food"></textarea>
                  </td>
              </tr>

              <tr>
                  <td>Price:</td>
                  <td>
                      <input type="number" name="price" >
                  </td>
              </tr>

              <tr>
                  <td>Select image:</td>
                  <td>
                      <input type="file" name="image" >
                  </td>
              </tr>

              <tr>
                  <td>Category:</td>
                  <td>
                      <select  name="category">
                        <?php
                        // code to display categories from database
                        // query to get all category from database, the table name is "category"
                        $sql = "SELECT * FROM category WHERE active='yes'";
                        // execution of query
                        $res = mysqli_query($conn,$sql);
                        // count the rows to check wether the caetegories or not
                        $count = mysqli_num_rows($res);
                        // if count greater than zero we have category else we dont have category
                        if($count>0)
                        {
                            while($row = mysqli_fetch_assoc($res))// fetching details from database
                            {
                                $Id = $row['Id'];
                                $title = $row['title'];
                                ?>

                                <option value="<?php echo $Id; ?>"><?php echo$title; ?></option>

                                <?php
                            }
                        }
                        else
                        {
                          // we dont have Category
                          ?>
                              <option value="0">No category found</option>
                          <?php
                        }

                         ?>


                      </select>
                  </td>
              </tr>

              <tr>
                  <td>featured:</td>
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
                    <input type="submit" name="submit" value="Add food" class="btn-secondary">
                </td>
              </tr>


            </table>

        </form>

        <?php
        // here we insert all value of title,discription,and Price
    if(isset($_POST['submit']))
    {
          $title = $_POST['title'];
          $description = $_POST['description'];
          $price = $_POST['price'];
          $category = $_POST['category'];
          // condition for check wether the radio button for featured and active cehcked or not
          if(isset($_POST['featured']))
          {
            $featured = $_POST['featured'];
          }
          else
          {
            $featured = "no"; //setting default value
          }
          if(isset($_POST['active']))
          {
            $active = $_POST['active'];
          }
          else
          {
            $active = "no"; //setting default value
          }
          $image_name = $_FILES['image']['name'];
            // condition to check wether the image is selected and upload i
            if($image_name !="")
            {
              //uploading of image
              // get source and destination path
                $src = $_FILES['image']['tmp_name'];//source path of current loaction
                $dst = "../images/food/".$image_name;//destination path
                //uploading the food image
                $upload = move_uploaded_file($src,$dst);
                // check wether the image is uploaded ro not
                if($upload == false)
                {
                  echo '<script type="text/javascript">
                    alert("failed to upload image");
                    window.location = "add-food.php";
                    </script>';
                    die();
                  }
             }
          //insert into database
          // create sql query
          // for numerical value we need not use the single quote for passing value but for stings it is compulsory
          $sql2 ="INSERT INTO food SET
                  title = '$title',
                  description = '$description',
                  price = $price,
                  image_name = '$image_name',
                  category = $category,
                  featured = '$featured',
                  active = '$active'
            "; // we used sql2 becoz sql variable is already used in line no :46
          // execution of query
          $res2 = mysqli_query($conn,$sql2);
          // check whether data is inserted or not
          if($res2 == true)
          {
            echo '<script type="text/javascript">
              alert("food added successfully");
              window.location = "manage-food.php";
              </script>';
          }
          else
          {
            echo '<script type="text/javascript">
              alert("failed to add the food");
              window.location = "manage-food.php";
              </script>';
          }

      }



     ?>


    </div>
</div>

<?php include('parts/footer.php'); ?>
