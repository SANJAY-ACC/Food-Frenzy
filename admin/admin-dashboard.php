<?php include('parts/menu.php'); // half part of menu section code is puted in to menu.php becoz to use that code multiple times ?>


    <div class="main-content">
      <div class="wrapper">
          <h1>Dashboard</h1>

          <div class="col-4 center">
            <?php
                // displaying total number of categories
                $sql="SELECT * FROM category";// sql query
                $res= mysqli_query($conn,$sql); // execution of query
                $count=mysqli_num_rows($res);// count rows
             ?>
            <h1><?php echo $count;?></h1>
            <br>
            Categories
          </div>

          <div class="col-4 center">

            <?php
                // displaying total number of foods
                $sql2="SELECT * FROM food ";// sql query
                $res2= mysqli_query($conn,$sql2); // execution of query
                $count2=mysqli_num_rows($res2);// count rows
             ?>

            <h1><?php echo $count2; ?></h1>
            <br>
            Foods
          </div>

          <div class="col-4 center">

            <?php
                // displaying total number of orders
                $sql3="SELECT * FROM tbl_order ";// sql query
                $res3= mysqli_query($conn,$sql3); // execution of query
                $count3=mysqli_num_rows($res3);// count rows
             ?>
            <h1><?php echo $count3;?></h1>
            <br>
            Total orders
          </div>

          <div class="col-4 center">
            <?php
                //creat sql query to get the total revenue generated
                // aggregate function in sql
                // here revenue means total anoumt got on  oderpage in total column i.e amount we earned by delivering successfully
                $sql4= "SELECT SUM(total) AS Total FROM tbl_order WHERE status = 'Delivered'";
                // execution of querty
                $res4= mysqli_query($conn,$sql4);
                // get the value
                $row4 = mysqli_fetch_assoc($res4);
                // get total revenue
                $total_revenue = $row4['Total'];
             ?>

            <h1>₹ <?php echo $total_revenue; ?></h1>
            <br>
            Revenue generated
          </div>

          <div class="clearfix"></div>
      </div>
    </div>
<?php include('parts/footer.php'); // half part of footer section code is puted in to footer.php becoz to use that code multiple times ?>
