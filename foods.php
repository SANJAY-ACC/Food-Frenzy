<?php include('parts-front/menu.php'); ?>



    <!-- fOOD SEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

            <form action="food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD SEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>


            <?php
              // display that are active
              $sql="SELECT * FROM food WHERE active = 'yes'";
              $res = mysqli_query($conn,$sql);// execution of query
              $count=mysqli_num_rows($res);// count rows in database
              // check wether the food are available are not
              if($count>0)
              {
                  while($row=mysqli_fetch_assoc($res))
                  {
                      $id = $row['id'];
                      $title = $row['title'];
                      $description = $row['description'];
                      $price = $row['price'];
                      $image_name = $row['image_name'];

                      ?>

                      <div class="food-menu-box">
                          <div class="food-menu-img">
                              <img src="images/food/<?php echo $image_name; ?>"  class="img-responsive img-curve">
                          </div>

                          <div class="food-menu-desc">
                              <h4><?php echo $title;?></h4>
                              <p class="food-price">₹<?php echo $price;?></p>
                              <p class="food-detail">
                                  <?php echo $description; ?>
                              </p>
                              <br>

                              <a href="order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                          </div>
                      </div>


                      <?php
                  }
              }
              else
              {
                //food not available
                echo "<div class='error'>food not available</div>";
              }



             ?>




            <div class="clearfix"></div>



        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

  <?php include('parts-front/footer.php'); ?>
