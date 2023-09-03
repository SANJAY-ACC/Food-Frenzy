<?php
if(isset($_POST['submit']))
{
  $fullname = $_POST['submit'];
  $fullname = $_POST['submit'];
  $fullname = $_POST['submit'];
// query to save the data to data base
    $sql = "INSERT INTO table name SET
        fullname = '$fullname',
        fullname = '$fullname',
        fullname = '$fullname'
    ";

      //execute the query and save into database
      $conn = mysqli_connect('localhost','root','','food') or die(mysqli_error());
      $res = mysqli_query($conn,$sql) or die(mysqli_error());

        //headder function
         header('location: http://www.google.com.au/');
         echo '<script type="text/javascript">
           alert("successfull");
           window.location = "address.html";
         </script>';

         ALTER TABLE food ADD id int not null AUTO_INCREMENT PRIMARY KEY FIRST;

         title,image_name,featured,active

         $title,$image_name,$featured,$active
}

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

                        <script type="text/javascript">
                                    swal({
                                title: "Food Ordered successfully !",
                                text: "enjoy your <?php echo $title;  ?>",
                                icon: "success",

                                });

                        </script>
 ?>
