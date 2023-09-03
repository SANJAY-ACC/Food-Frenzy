<?php include('parts/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
      <h1>Manage food</h1>
      <br><br>
      <a href="add-food.php" class="btn-primary">Add food</a>
      <br><br>

      <table class="tbl">
        <tr>
            <th>Sl No</th>
            <th>Title</th>
            <th>Price</th>
            <th>Image</th>
            <th>Feautred</th>
            <th>Active</th>
            <th>Action</th>
        </tr>
        <?php
          // query to get all the food
          $sql="SELECT * FROM food ";
          // execute the query
          $res = mysqli_query($conn,$sql);
          // count the rows to sheck wether the foods are their are not
          $count = mysqli_num_rows($res);

          // fr SLNO we will assign sn=1 and it keeps on increasing
          $sn= 1;
          if($count>0)
          {
            // we have food in database
            // get the details from database and display
              while($row = mysqli_fetch_assoc($res))
              {
                  $id = $row['id'];
                  $title = $row['title'];
                  $price = $row['price'];
                  $image_name = $row['image_name'];
                  $featured = $row['featured'];
                  $active = $row['active'];

                  ?>
                  <tr>
                      <td><?php echo $sn++; ?></td>
                      <td><?php echo $title; ?></td>
                      <td>₹<?php echo $price; ?></td>
                      <td>
                          <img src="../images/food/<?php echo $image_name; ?>" width="100px" height="100px">
                      </td>
                      <td><?php echo $featured; ?></td>
                      <td><?php echo $active; ?></td>
                      <td>
                                              <!---here ? after delete-food.php resembles the get data method ----->
                          <a href="update-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-primary">Update Food</a>
                          <a href="delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-red">Delete Food</a>
                      </td>
                  </tr>

                  <?php
              }
          }
          else
          {
            // display error Message
            echo "  <tr>
                <td colspan='7' class='error'>Food not added Yet.</td>
              </tr>";
          }


         ?>

      </table>

    </div>

</div>


<?php include('parts/footer.php'); ?>
