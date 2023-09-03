<?php include('parts-front/menu.php'); ?>


<?php
// get the catogies id from categories.php page
$category_id=$_GET['category_id'];

// get the category title based on category_id
$sql = "SELECT title FROM category WHERE Id = $category_id";// query to get the title from database using id
$res=mysqli_query($conn,$sql);// execution of query
//get the value from database
$row=mysqli_fetch_assoc($res);
// get the title
$category_title = $row['title'];
 ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            // sql query to get the foods based on selected category
            $sql2="SELECT * FROM food WHERE category=$category_id";// we used sql2 because sql variable is already used in line no 9
            // execution pf qyery
            $res2= mysqli_query($conn,$sql2);
            // count the rows
            $count = mysqli_num_rows($res2);
            // check wether the food is available are not
            if($count>0)
            {
                // food is available
                while($row2=mysqli_fetch_assoc($res2))
                {
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $price = $row2['price'];
                    $description = $row2['description'];
                    $image_name = $row2['image_name'];
                    ?>

                    <div class="food-menu-box">
                        <div class="food-menu-img">
                            <img src="images/food/<?php echo $image_name; ?>" class="img-responsive img-curve">
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title; ?></h4>
                            <p class="food-price">₹<?php echo$price; ?></p>
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
              // food is mot available
              echo "<div class='error'>Food is not available</div>";
            }

             ?>

            <div class="clearfix"></div>



        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

  <?php include('parts-front/footer.php'); ?>
