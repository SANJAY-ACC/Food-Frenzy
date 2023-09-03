<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <style media="screen">
    img{
      margin-left: 45vh;
      margin-top: 15vh;
    }

    p{
      margin-left: 78vh;
      font-family: serif;
      font-size: 75px;
    }
  </style>
  <body>



    <img src="images/logo2.jpg" >

    <script type="text/javascript">


    var sec = 0;
    function displaysec() {
      sec +=1;
    //  window.alert("successfull");
    }
    setInterval(displaysec,1000);

    function redirect() {
      window.location = "home.php";
    }
    setTimeout('redirect()',2500)

    </script>

  </body>
</html>
