<?php 
include("functions/functions.php");
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/final1.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Online Shopping Update
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
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <style>
    form{
      margin-top: 150px;
    }
    body{
      background: url(./assets/img/sundown.jpg);
      background-repeat: no-repeat;
      background-position: center center;
      background-size: cover;
      background-image: none;
      background-attachment: fixed;
    }
  </style>
</head>

<body class="index-page sidebar-collapse" style="background-image: url('./assets/img/bg.jpg')";>
  
  <!-- Navbar -->
  
  <nav class="navbar navbar-expand-lg bg-primary fixed-top" color-on-scroll="400">
    <div class="container">
      <div class="navbar-translate">
 
        <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-bar top-bar"></span>
          <span class="navbar-toggler-bar middle-bar"></span>
          <span class="navbar-toggler-bar bottom-bar"></span>
        </button>
      </div>
      <div class="collapse navbar-collapse justify-content-end" id="navigation" data-nav-image="./assets/img/blurred-image-1.jpg">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="admindash.php" onclick="scrollToDownload()">
              <i class="far fa-handshake"></i>
              <p>DASHBOARD</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="customer.php" onclick="scrollToDownload()">
              <i class="far fa-handshake"></i>
              <p>CUSTOMER</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="inventory.php" onclick="scrollToDownload()">
              <i class="fas fa-user-edit"></i>
              <p>INVENTORY</p>
            </a>
          </li>
         <li class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink1" data-toggle="dropdown">
              <i class="now-ui-icons design_app"></i>
              <p>PRODUCT</p>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink1">
              <a class="dropdown-item" href="products.php">
                <i class="now-ui-icons business_chart-pie-36"></i>INSERT PRODUCT
              </a>
              <a class="dropdown-item" href="uproducts.php">
                <i class="now-ui-icons design_bullet-list-67"></i>UPDATE PRODUCT
              </a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="admin.php" onclick="scrollToDownload()">
              <i class="fas fa-user-edit"></i>
              <p>SIGN OUT</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <!-- End Navbar -->


<!-- Search update -->
          <!--   <section id="cover">
              <div id="cover-caption">
                  <div id="container" class="container">
                      <div class="row">
                          <div class="log col-sm-6 offset-sm-3">
                              <div class="info-form"> -->
                                <div class="row form-group d-flex justify-content-center">
                                <form class="searchbar justify-content-center" method="post" action="" style="margin-top: 70px;">                        
                                     
                                      <div class=" col-sm-6 d-flex pull-right">
                                       <input class="form-control mr-sm-2" type="text" name="product_code" placeholder="Search" aria-label="Search" style="width: 400px !important; min-width: 400px !important;">
                                        <button class="btn btn-outline-success my-2 my-sm-0 btn-round" name="search" type="submit">Search</button>
                                      </div>
                                     <div  class=" col-sm-6">
                                    </div>                                 
                                  </form>
                                  </div> 
              <!--                   </div>
                              <br>
                          </div>
                      </div>
                  </div>
               </div>
             </section> -->

<?php 
if (isset($_POST['search'])) {
    $product_code = $_POST['product_code'];

    $query = "SELECT * FROM products WHERE product_code = '$product_code' ";
    $record = mysqli_query($conn,$query);

    while($row = mysqli_fetch_array($record)){
      $directory = "assets/img/{$row["product_image"]}";

     
      ?>
             <section id="cover" class="up">
              <div id="cover-caption">
                  <div id="container" class="container">
                      <div class="row">
                          <div class="log col-sm-6 offset-sm-3 col">
                              <div class="info-form">                                                   
                                    <form class="form-inlin justify-content-center" method="post" action=""> 
                                      <div class="info-form">                                                  
                                     <div class="row form-group d-flex">
                                      <div class="col-sm-8 d-flex flex-column">
                                          
                                              <input type="text" class="form-control mb-2" name="product_code" value="<?php echo $row['product_code'] ?>" placeholder="Product Code">
                                             <input type="text" class="form-control mb-2" name="product_name" value="<?php echo $row['product_name'] ?>" placeholder="Product Name">
                                          
                                        </div>
                                      <div class=" col-sm-4">
                                      <?php  echo " <tr>
                                     <td><img src = '{$directory}'/.' width='100px' height='80px'></td></td>
                                      </td>"; ?> 
                                      </div>
                                      </div>
                                      </div>                         
                                      </div>
                                      <div class="form-group d-flex">
                                      <input type="text" class="form-control" name="product_supplier" value="<?php echo $row['product_supplier'] ?>" placeholder="Product Supplier">
                                      </div>
                                      <div class="form-group d-flex">
                                          <input type="text" class="form-control" name="product_price" value="<?php echo $row['product_price'] ?>" placeholder="Product Price">
                                          <input type="text" class="form-control" name="product_quantity" value="<?php echo $row['product_quantity'] ?>" placeholder="Product Quantity">                            
                                          <input type="text" class="form-control" name="product_category" value="<?php echo $row['product_category'] ?>" 
                                          placeholder="Product Category">                                
                                      </div>
                                        <input type="text" class="form-control" name="add_quantity" value="0" placeholder="Add Quantity">
                                        <button type="submit" name="update" class="btn btn-info btn-round">UPDATE</button>                      
                                  </form>
                              </div>
                              <br>
                          </div>
                      </div>
                  </div>
              </div>
          </section>
      <?php        
    }   
    }
?>
 <!-- update form -->

 <?php 
   updateProducts();
 ?>




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


