<?php include('parts/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>

        <?php
        // check wether the id is set or not
        if(isset($_GET['id']))
        {
          // get the other detailes
          $id = $_GET['id'];
          // get all other detailes based on this id

          $sql = "SELECT * FROM tbl_order WHERE id=$id";// query to get the orderdetail
          $res = mysqli_query($conn,$sql);// execution of query
          // count the rows
          $count = mysqli_num_rows($res);
              if($count==1)
              {
                    //detailse available
                    $row=mysqli_fetch_assoc($res);
                    $food = $row['food'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $status = $row['status'];

              }
              else
              {
                // redirect page
                echo '<script type="text/javascript">
                  window.location = "manage-order.php";
                </script>';
              }

        }
        else
        {
          // redirect page
          echo '<script type="text/javascript">
            window.location = "manage-order.php";
          </script>';
        }

         ?>

        <form class="" action="" method="post">
            <table class="tbl-30">
              <tr>
                    <td>Foodname:</td>
                    <td><b><?php echo $food; ?></b> </td>
              </tr>

              <tr>
                    <td>Price:</td>
                    <td><b>₹<?php echo $price; ?></b></td>
              </tr>

              <tr>
                    <td>Quantity:</td>
                    <td><input type="number" name="qty" value="<?php echo $qty; ?>"> </td>
              </tr>

              <tr>
                    <td>Status:</td>
                    <td>
                        <select  name="status">
                            <option <?php if($status == "ordered"){echo "selected";} ?>  value="ordered">Ordered</option>
                            <option <?php if($status == "OnDelivery"){echo "selected";} ?>  value="OnDelivery">OnDelivery</option>
                            <option <?php if($status == "Delivered"){echo "selected";} ?>  value="Delivered">Delivered</option>
                            <option <?php if($status == "Cancelled"){echo "selected";} ?>  value="Cancelled">Cancelled</option>
                        </select>
                    </td>
              </tr>

              <tr>
                  <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="price" value="<?php echo $price; ?>">
                    <input type="submit" name="submit" value="update order" class="btn-secondary">
                  </td>
              </tr>
            </table>

        </form>

        <?php
          // check wether the update button is clicked or not
          if(isset($_POST['submit']))
          {
            // get all the value from database
            $id = $_POST['id'];
            $price = $_POST['price'];
            $qty = $_POST['qty'];
            $total = $price * $qty ;
            $status = $_POST['status'];

            // update the values in database
            $sql2 = "UPDATE tbl_order SET
                    qty = $qty,
                    total = $total,
                    status = '$status'
                    WHERE id=$id
            ";

            // execution of query
            $res2 = mysqli_query($conn,$sql2);
            // check wether the details are updated and redirct to manage-order page with message
                if($res2== true)
                {
                  echo '<script type="text/javascript">
                    alert("updated successfully");
                    window.location = "manage-order.php";
                  </script>';
                }
                else
                {
                  echo '<script type="text/javascript">
                    alert("failed to update order");
                    window.location = "manage-order.php";
                  </script>';
                }
          }


         ?>
    </div>
</div>


<?php include('parts/footer.php'); ?>
