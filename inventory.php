<!DOCTYPE html>
<?php 
include ("functions/functions.php");
session_start();
?>

<html lang="en">

<head>
 
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/final1.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Online Shopping Inventory
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
  <style>
    
  </style>
</head>
 <style>
  body{
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
  background-position: center center;
  }
</style>
<body class="index-page sidebar-collapse" style="background-image: url('./assets/img/subg.jpg')";>
  
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


   <div class="container">
        <table class="table-striped table">
            <thead class="thead-inverse">
           
                  <tr>
                    <th>Product Name</th>
                    <th>Product Code</th>
                    <th>Product Supplier </th>   
                    <th>Product Price</th>
                    <th>Product Quantity</th>
                    <th>Product Image</th>
                    <th class="text-center">Remarks</th>
                </tr>
            </thead>
            <tbody>
                <form action="inventory.php" method="post">
                <?php mySearch(); myInventory(); ?>             
                </form>
             </tbody>
                  </table>
             </div>

 <!-- Button trigger modal -->

<?php 
            if(isset($_POST['delete']))
            {
            $product_code = $_POST['product_code'];
       
            $query="DELETE FROM products WHERE product_code = '$product_code'";
            $result = mysqli_query($conn, $query);

             if ($result) {
            echo "<script>window.open('inventory.php','_self');</script>";
            }else{
            echo 'data not DELETED';
            }  
            mysqli_close($conn);
            }
?>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

 <?php           
      if(isset($_POST['update']))
      {    
      $product_quantity = $_POST['product_quantity'];
      $product_code = $_POST['product_code'];
          
       $query="UPDATE products SET 
       product_quantity = '$product_quantity' WHERE product_code = '$product_code' ";
       $result = mysqli_query($conn, $query);

       if ($result) {
        ?>
        <script>
        setTimeout(function() {
          swal("Good job!", "Product Saved Successfully!", "success").then(function() {
            window.location = window.location.href;
          });
        },500);
      </script>
  <?php
       echo "<script>window.open('inventory.php','_self');</script>";
       }else{
       echo 'data not updated';
       }  
       mysqli_close($conn);
    }
?>

</body>
</html>
