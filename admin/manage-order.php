<?php include('parts/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Order</h1>

        <table class="tbl">
            <tr>
                <th>Sl.no</th>
                <th>Food</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Order date</th>
                <th>Status</th>
                <th>Coustomer name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Action</th>
            </tr>
            <?php
                // get the orders frm the database
                $sql = "SELECT * FROM tbl_order ORDER BY id DESC";// this ORDER BY id DESC arranges in desinding order becoz latest order will appear in top
                $res = mysqli_query($conn,$sql);// execution of query
                $count = mysqli_num_rows($res);// count the rows

                $sn=1;// creat a serial number and set its initial value as 1

                if($count>0)
                {
                    // order available
                    while($row = mysqli_fetch_assoc($res))
                    {
                        // get all the order details
                        $id = $row['id'];
                        $food = $row['food'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $total = $row['total'];
                        $order_date = $row['order_date'];
                        $status = $row['status'];
                        $coustomer_name = $row['coustomer_name'];
                        $coustomer_contact = $row['coustomer_contact'];
                        $coustomer_email = $row['coustomer_email'];
                        $coustomer_address = $row['coustomer_address'];

                        ?>
                            <tr>
                                <td><?php echo $sn++; ?></td>
                                <td><?php echo $food; ?></td>
                                <td><?php echo $price; ?></td>
                                <td><?php echo $qty; ?> </td>
                                <td><?php echo $total; ?> </td>
                                <td><?php echo $order_date; ?> </td>
                                <td>
                                  <?php
                                        // this section is to display different color for each status
                                        if($status=="ordered")
                                        {
                                            echo "<label>$status</label>";// default black color
                                        }
                                        elseif($status=="OnDelivery")
                                        {
                                            echo "<label style='color: orange;'>$status</label>";// orange color
                                        }
                                        elseif($status=="Delivered")
                                        {
                                            echo "<label style='color: green;'>$status</label>";// green color
                                        }
                                        elseif($status=="Cancelled")
                                        {
                                            echo "<label style='color: red;'>$status</label>";// red color
                                        }

                                   ?>
                                </td>
                                <td><?php echo $coustomer_name; ?> </td>
                                <td><?php echo $coustomer_contact; ?> </td>
                                <td><?php echo $coustomer_email; ?> </td>
                                <td><?php echo $coustomer_address; ?> </td>
                                <td>
                                      <a href="update-order.php?id=<?php echo $id; ?>" class="btn-secondary" >UpdateOrder</a>
                                </td>
                            </tr>

                        <?php
                    }
                }
                else
                {
                  // order not available
                  echo "<tr><td  colspan='12' class='error'>Orders not available</td></tr>";
                }
             ?>
        </table>

    </div>

</div>

<?php include('parts/footer.php'); ?>
