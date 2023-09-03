<?php include('parts-front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            <?php
            // get the search keyword
            $search = $_POST['search'];// we used here insted of down because to display the name what we hav searched

             ?>
            <h2>Foods on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
              // get the search keyword
              //$search = $_POST['search'];
              // sql query based on search keyword
              $sql = "SELECT * FROM food WHERE title LIKE '%$search%' OR description LIKE '%$search%' ";// this query will try to find based on search keyword this keyword tries to match on tittle or description
              // execution of query
              $res = mysqli_query($conn,$sql);// execution of query
              $count = mysqli_num_rows($res);//count rows
              // checl wether the food is available or not
              if($count>0)
              {
                  while($row = mysqli_fetch_assoc($res))
                  {
                    //get the detailes
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
                    ?>

                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <img src="images/food/<?php echo $image_name;  ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">₹<?php echo $price; ?></p>
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
                  echo "<div class='error'>food not found</div>";

              }

             ?>


            <div class="clearfix"></div>


        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

  <?php include('parts-front/footer.php'); ?>
