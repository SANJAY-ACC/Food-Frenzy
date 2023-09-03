<?php include('parts-front/menu.php'); ?>

<?php
// check wether the food-id is present or not
if(isset($_GET['food_id']))
{
  // get the food id and details of the selected food
  $food_id = $_GET['food_id'];
  // get the detailes of selected food
  $sql="SELECT * FROM food WHERE id=$food_id";
  $res=mysqli_query($conn,$sql);// execution of query
  // count the rows
  $count= mysqli_num_rows($res);
  // check wether the data is availabe or not
      if($count==1)
      {
        // get the data from database
        $row= mysqli_fetch_assoc($res);

        $title= $row['title'];
        $price= $row['price'];
        $image_name= $row['image_name'];

      }
      else
      {
        // redirect the page
      }

}
else
{
  echo '<script type="text/javascript">
    window.location = "categories.php";
  </script>';
}



 ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">

            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <img src="images/food/<?php echo $image_name; ?>" class="img-responsive img-curve">
                    </div>

                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title;  ?>">

                        <p class="food-price">₹<?php echo $price; ?></p>
                        <input type="hidden" name="price" value="<?php echo $price;  ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>

                    </div>

                </fieldset>

                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="enter your name" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. xyz@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
              // this php is post all the customer detailes in database
              if(isset($_POST['submit']))
              {
                  //get all the detailse from  user
                  $food = $_POST['food'];
                  $price = $_POST['price'];
                  $qty = $_POST['qty'];

                  $total = $price * $qty; // total is price X quantity

                  $order_date = date("Y-m-d h:i:sa"); // it is data function displayes date and tym here y=year,m=month,d=days and h=hour,i=min,s=sec,a=am/pm

                  $status = "ordered";// there r 3 status 1. ordered 2.on deliviry 3.delivered 4.canclled

                  $coustomer_name = $_POST['full-name'];// how this full mane came means see in line no 73 in input-type
                  $coustomer_contact = $_POST['contact'];// how this contact came means see in line no 76 in input-type
                  $coustomer_email = $_POST['email'];
                  $coustomer_address = $_POST['address'];

                  if ( strlen($coustomer_contact) < 10 || strlen($coustomer_contact) > 10 ) {

                  ?>
                  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

                  <script type="text/javascript">
                          swal({
                          title: "Oops!",
                          text: "enter valid mobile number",
                          icon: "error",

                          });

                  </script>


                  <?php
                    die();

                  }

                  // save the order in database
                  // create sqlto save the data
                  // here in sql query only for string we use single  qute not for numbers
                  $sql2="INSERT INTO tbl_order SET
                          food = '$food',
                          price = $price,
                          qty ='$qty',
                          total = $total,
                          order_date = '$order_date',
                          status = '$status',
                          coustomer_name='$coustomer_name',
                          coustomer_contact='$coustomer_contact',
                          coustomer_email='$coustomer_email',
                          coustomer_address='$coustomer_address'

                  ";

                  // execution of query
                  $res2=mysqli_query($conn,$sql2);

                  // check wether the query executed successfully or not
                  if($res2== true)
                  {
                    ?>
                        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

                        <script type="text/javascript">
                                swal({
                                title: "Food Ordered successfully !",
                                text: "Thank you  so much for your order! I hope you enjoy your food",
                                icon: "success",

                                });

                        </script>


                    <?php
                  }
                  else
                  {

                    ?>
                        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

                        <script type="text/javascript">
                                swal({
                                title: "Oops!",
                                text: "Unable to place the order",
                                icon: "error",

                                });

                        </script>


                    <?php
                  }




              }



             ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- social Section Starts Here -->
    <section class="social">
        <div class="container text-center">
        </div>
    </section>


    <!-- social Section Ends Here -->
<?php include('parts-front/footer.php'); ?>
