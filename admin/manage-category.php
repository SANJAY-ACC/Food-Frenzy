<?php include('parts/menu.php'); ?>


<div class="main-content">
    <div class="wrapper">
      <h1>Manage Categories</h1>
      <br><br>
      <?php

        if(isset($_SESSION['remove']))
        {
          echo $_SESSION['remove'];
          unset($_SESSION['remove']);
        }

       ?>
      <a href="add-category.php" class="btn-primary">Add category</a>
      <br><br>

      <table class="tbl">
        <tr>
            <th>Sl.no</th>
            <th>Title</th>
            <th>Image</th>
            <th>Featured</th>
            <th>Active</th>
            <th>Action</th>
        </tr>

        <?php

        // query to get data from database
        $sql = "SELECT * FROM category";

        // execution of query
        $res = mysqli_query($conn,$sql);
        // count rows
        $count = mysqli_num_rows($res);

        // to check wether the data is in database or not

        // fr SLNO we will assign sn=1 and it keeps on increasing
        $sn=1;

        if($count>0)
        {
          // fetching data frm database n displaying
          while($row=mysqli_fetch_assoc($res))
          {
            $Id= $row['Id'];
            $title = $row['title'];
            $image_name = $row['image_name'];
            $featured = $row['featured'];
            $active = $row['active'];
            ?>
            <!---display the dataa------>
            <tr>
                <td><?php echo $sn++ ; ?></td>
                <td><?php echo  $title; ?></td>
                <td>
                  <img src="../images/category/<?php echo $image_name; ?>" width="100px" alt="">
               </td>
                <td><?php echo  $featured; ?></td>
                <td><?php echo  $active; ?></td>

                <td>
                    <a href=update-category.php?Id=<?php echo $Id; ?>&image_name=<?php echo $image_name; ?>" class="btn-primary">Update category</a>
                                              <!---here ? after delete-category.php resembles the get data method ----->
                    <a href="delete-category.php?Id=<?php echo $Id; ?>&image_name=<?php echo $image_name; ?>" class="btn-red">Delete category</a>
                </td>
            </tr>


            <?php
          }

        }
        else {
            // display msg inside the table
            ?>

            <tr>
              <div class="error">No category added</div>
            </tr>


            <?php
        }



         ?>



      </table>

    </div>

</div>


<?php include('parts/footer.php'); ?>
