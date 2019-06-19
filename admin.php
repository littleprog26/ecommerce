<?php
session_start();
include("functions/functions.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/">
      <link rel="icon" type="image/png" href="./assets/img/final1.png">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
          <title>
            Online Shopping Login
            </title>
              <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
              <!--     Fonts and icons     -->
              <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
              <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
              <!-- CSS Files -->
              <link href="./assets/css/bootstrap.min.css" rel="stylesheet" />
              <link href="./assets/css/now-ui-kit.css?v=1.3.0" rel="stylesheet" />
              <!-- CSS Just for demo purpose, don't include it in your project -->
              <link href="./assets/demo/demo.css" rel="stylesheet" />
            <link href="https://fonts.googleapis.com/css?family=Black+And+White+Picture|Lora" rel="stylesheet">
          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="dist/wow.js"></script>
      <link rel="stylesheet" href="css/libs/animate.css">
    <link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<style>
  .forget{
    color: white;
  }
  .button{
    margin-top: 5px;
    margin-left: 15px;
  }
</style>
</head>
<body>


    <div class="wrapper">
        <div class="page-header clear-filter" filter-color="orange">
         <div class="page-header-image" data-parallax="true" style="background-image:url('./assets/img/login.jpg');">
           </div>
         <div class="container">
       <div class="content-center brand">
     </div>



      <section id="testimonials">
        <div class="container">
          <div class="row">
            <div class="col-md-4 text-center">
              <div class="profile-admin" class="icon">
                <img src="./assets/img/admin-logo.jpg" class="user"> 
                <form method="post" class="form-bg">
                  <div class="form-input">
                    <i class="fa fa-user fa-2x cust" aria-hidden="true"></i>
                    <input type="text" name="username" value="" placeholder="Username" required><br>
                    <i class="fa fa-lock fa-2x cust" aria-hidden="true"></i>
                    <input type="password" name="password" value="" placeholder="Password" required><br>
                    <div class="button">
                    <input type="submit" name="submit" value="LOGIN" >
                     <a class="forget" href="signup.php">Sign Up</a> 
                    </div>
                </div>
               </form>
              </div>  
            </div>
          </div>
        </div>
      </section>



  <!--   Core JS Files   -->
  <script src="./assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="./assets/js/core/bootstrap.min.js" type="text/javascript"></script>
  <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
  <script src="./assets/js/plugins/bootstrap-switch.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="./assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
  <!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
  <script src="./assets/js/plugins/bootstrap-datepicker.js" type="text/javascript"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
  <script src="./assets/js/now-ui-kit.js?v=1.3.0" type="text/javascript"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php
if (isset($_POST['submit'])) {
  $username = mysqli_escape_string($conn,$_POST['username']);
  $password = mysqli_escape_string($conn,$_POST['password']);
if ($username == 0 && $password == 0) {
  $sql = "SELECT id FROM login WHERE username='$username' and password='$password'";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  $count = mysqli_num_rows($result);
  
if ($count==1){
    echo "<script>alert('Welcome admin')</script>";
    echo "<script>window.open('admindash.php','_self')</script>";
  }
  }
  if ($username!="" && $password !="") {
  $sql = "SELECT id FROM register WHERE username='$username' and password='$password'";
  $result = mysqli_query($conn,$sql);
  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
  $count = mysqli_num_rows($result);
  
  if ($count==1){
        $_SESSION['username']=$username;
    echo "<script>alert('welcome client')</script>";
    echo "<script>window.open('index.php','_self')</script>";
  }
  else{
     echo "<script>setTimeout(function() {swal('Error...!', 'User Credentials Failed...!', 'error')}, 500)</script>";
  }
  }
}
?>




  <script>new WOW().init();</script>
  <script>
    $(document).ready(function() {
      // the body of this function is in assets/js/now-ui-kit.js
      nowuiKit.initSliders();
    });

    function scrollToDownload() {

      if ($('.section-download').length != 0) {
        $("html, body").animate({
          scrollTop: $('.main').offset().top
        }, 1000);
      }
    }
  </script>
</body>
</html>