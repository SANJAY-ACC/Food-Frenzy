<?php include('parts-front/menu.php'); ?>


    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

            <?php
              // display all the categories that are active
              $sql="SELECT * FROM category WHERE active='yes'";// query to fetch the data from database for displaying
              //execution
              $res = mysqli_query($conn,$sql);
              $count = mysqli_num_rows($res);// count the rows
              // check wether the categories are available or not
              if($count>0)
              {
                  while($row = mysqli_fetch_assoc($res))
                  {
                      $Id=$row['Id'];
                      $title=$row['title'];
                      $image_name=$row['image_name'];

                      ?>
                                          <!-- here questionmark(?) is GET-METHOD is used to get the values from database  -->
                      <a href="category-foods.php?category_id=<?php echo $Id; ?>">
                        <div class="box-3 float-container">
                            <img src="images/category/<?php echo $image_name; ?>"  class="img-responsive img-curve" width="500px" height="300px">

                            <h3 class="float-text text-white"><?php echo $title; ?></h3>
                        </div>
                      </a>


                      <?php
                  }
              }
              else
              {
                echo "<div class='error'>categories not found</div>";
              }


             ?>





            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


  <?php include('parts-front/footer.php'); ?>
