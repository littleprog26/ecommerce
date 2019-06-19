<?php
$conn=mysqli_connect("localhost", "root", "","conndb");
//$db=mysqli_select_db("ecom",$conn);	

function getIpAdd()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function insertProducts(){
  global $conn;

   if(isset($_POST['insert_product'])){
  
    //getting the text data from the fields
    $product_code = $_POST['product_code'];
    $product_name= $_POST['product_name'];
    $product_supplier = $_POST['product_supplier'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];
    $product_category = $_POST['product_category'];
  
    //getting the image from the field
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp = $_FILES['product_image']['tmp_name'];
    
    move_uploaded_file($product_image_tmp,"assets/img/$product_image");
  
     $insert_product = "INSERT INTO `products`(`product_code`, `product_name`, `product_supplier`, `product_price`, `product_quantity`, `product_image`, `product_category`) VALUES ('$product_code','$product_name','$product_supplier','$product_price','$product_quantity','$product_image','$product_category')";
     
     $insert_pro = mysqli_query($conn, $insert_product);
  
     if($insert_pro){
    ?>
      <script>
        setTimeout(function() {
          swal("Good job!", "Product Saved Successfully!", "success").then(function() {
            window.location = window.location.href;
          });
        },500);
      </script>
  <?php
     } 
   }
}

function updateProducts(){
  global $conn;

   if (isset($_POST['update'])) {
    $product_code = mysqli_real_escape_string($conn, $_POST['product_code']);
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $product_supplier = mysqli_real_escape_string($conn, $_POST['product_supplier']);
    $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
    $product_quantity = mysqli_real_escape_string($conn, $_POST['product_quantity']); // get the primary key to populate text field
    $product_category = mysqli_real_escape_string($conn, $_POST['product_category']);
    $add_quantity = mysqli_real_escape_string($conn, $_POST['add_quantity']);
    $add_quantity += $product_quantity;
    $add_quantity;

    mysqli_query($conn, "UPDATE products SET product_code='$product_code', product_name='$product_name', product_supplier='$product_supplier', product_price='$product_price', product_quantity='$add_quantity',product_category='$product_category' WHERE product_code='$product_code'");
    //$_SESSION['msg'] = 'Record has been updated!'; // notification message 
   
  }
}

function getProduct(){
  global $conn;

    if(!isset($_POST['category'])){
  $query="SELECT * from products";
  $result=mysqli_query($conn, $query);
  while($row = mysqli_fetch_array($result))
  {
    echo "<div class='col-lg-4 col-md-6'>
                            <div class='card'>
                                <img class='card-img' height='200px' width='100px' src='assets/img/".$row['product_image']."'>
                                <span class='content-card'>
                                    <h6>".$row['product_name']."</h6>
                                    <h7>".$row['product_supplier']."</h7>
                                    <h7>&#x20B1;".$row['product_price']."</h7>
                                </span> 
                                <form method ='post'>
                                <input type='text' name='product_code' hidden='text' value='".$row['product_code']."'>               
                                <input type='text' name='product_name' hidden='text' value='".$row['product_name']."'>
                                <input type='text' name='product_price' hidden='text' value='".$row['product_price']."'>
                                <div class='input-group w-50 pull-right'>
                                <input type='number' name='product_quantity' class='form-control' placeholder='Qty' aria-describedby='button-addon2' required>
                                <div class='input-group-append'>
                                <button class='buybtn btn btn-primary btn-round btn-sm' type='submit' name='addtocart'>CART</button>
                                </div>
                                </div>
                                </form>
                                ";
                                
        //    code for modal
        echo "<div class='modal fade' id='".$row['product_name']."' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                  <div class='modal-dialog'>
                    <div class='modal-content'>
                      <div class='modal-header'>
                        <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                        <h4 class='modal-title' id='myModalLabel'>".$row['product_supplier']."</h4>
                      </div>
                      <div class='modal-body'>
                      <h4><p align='right'>&#8377;".$row['product_price']."</p></h4>".
                          $row['product_code']
                      ."</div>
                     
                    </div>
                  </div>
                </div>
                                
              </div>
                        </div>";    //the last two </div> are from previous echo.
   }
    }

}
function customer(){
global $conn;


 if (!$conn) {
  die ('Failed to connect to MySQL: ' . mysqli_connect_error());  
}

$sql = 'SELECT client_email,product_code,product_name,product_quantity,product_price FROM checkout';
    
$query = mysqli_query($conn, $sql);

  if (!$query) {
    die ('SQL Error: ' . mysqli_error($conn));
  }
  while ($row = mysqli_fetch_array($query)) {
    // $directory = "assets/img/{$row["product_image"]}";
    $product_name = $row['product_name'];

        echo "<tr>  
            <td>{$row['client_email']}</td>   
            <td>{$row['product_code']}</td>
            <td>{$product_name}</td>
            <td>{$row['product_quantity']}</td>  
            <td>{$row['product_price']}</td>
            </tr>"; 

 }

}

function mySearch(){
global $conn;

if (isset($_POST['search'])) {
    $product_code = $_POST['product_code'];

    $query = "SELECT * FROM products WHERE product_code = '$product_code' ";
    $record = mysqli_query($conn,$query);

    while($row = mysqli_fetch_array($record)){
      $directory = "assets/img/{$row["product_image"]}";
      $product_name = $row['product_name'];

    echo "<tr>  
            <td>{$product_name}</td>
            <td>{$row['product_code']}</td>
            <td>{$row['product_supplier']}</td>
            <td>{$row['product_price']}</td>
            <td>{$row['product_quantity']}</td>
            <td><img src = '{$directory}'/.' width='100px' height='80px'></td></td>
            </td>
            <td scope='row' class='td-actions'>
                   <form method ='post'>
                   <h6> <div class='text'>
                       <label>
                       <input type='text' name='product_code' hidden='text' value='".$row['product_code']."'>
                       <button type='submit' name='delete' class='btn btn-primary'>DELETE</button> 
                       </label>
                       </div></h6> 
                       </form>
                </td>
            </tr>"; 

 }     
      
}
}

function myInventory() {
global $conn;


if (!$conn) {
die ('Failed to connect to MySQL: ' . mysqli_connect_error());  
}

        $sql = 'SELECT product_name,product_code,product_supplier,product_price,product_quantity,product_image  FROM products ORDER BY product_quantity DESC';
            
        $query = mysqli_query($conn, $sql);

        if (!$query) {
        die ('SQL Error: ' . mysqli_error($conn));
        }
        while ($row = mysqli_fetch_array($query)) {
        $directory = "assets/img/{$row["product_image"]}";
        $product_name = $row['product_name'];

        echo "<tr>  
            <td>{$product_name}</td>
            <td>{$row['product_code']}</td>
            <td>{$row['product_supplier']}</td>
            <td>{$row['product_price']}</td>
            <td>{$row['product_quantity']}</td>
            <td><img src = '{$directory}'/.' width='100px' height='80px'></td></td>
            </td>
            <td scope='row' class='td-actions'>
                   <form method ='post'>
                   <h6> <div class='text'>
                       <label>
                       <input type='text' name='product_code' hidden='text' value='".$row['product_code']."'>
                       <button type='submit' name='delete' class='btn btn-primary'>DELETE</button> 
                       </label>
                       </div></h6> 
                       </form>
                </td>
            </tr>"; 

 }
}

function clientCheck(){
global $conn;

      if(isset($_POST['delete']))
      {
      $product_code = $_POST['product_code']; 
      $query="DELETE FROM client WHERE product_code = '$product_code'";
      $result = mysqli_query($conn, $query);

      if($result) {
      echo "<script>window.open('cart.php','_self');</script>";
      }else{
      echo 'data not DELETED';
      }  
      
  }   

      if(isset($_POST['delete']))
      {
      $product_code = $_POST['product_code']; 
      $query="DELETE FROM checkout WHERE product_code = '$product_code'";
      $result = mysqli_query($conn, $query);

      if($result) {
  
      }else{
      echo 'data not DELETED';
      }  
      mysqli_close($conn);
 }     
}

function clientCart() {
global $conn;



 if (!$conn) {
  die ('Failed to connect to MySQL: ' . mysqli_connect_error());  
}
$count = 1;
$sql = 'SELECT client_email,product_code,product_name,product_quantity,product_price  FROM client';  
$query = mysqli_query($conn, $sql);
$total_price =0;
  if (!$query) {
    die ('SQL Error: ' . mysqli_error($conn));
  }
  while ($row = mysqli_fetch_array($query)) {
    $price_arr = array($row['product_price']);
    // $total_price = array_sum($price_arr);
    $single_price = $row['product_price'];
    $product_quantity = $row['product_quantity'];
    // $single_quantity *= $single_price;
    $single_price *= $product_quantity;
    $total_price += $single_price;
    
    // <td><img src='assets/images/".$row['product_image']."' width='60px' height='80px'></td>
    $product_name = $row['product_name'];
    
        echo "<tr>  
            <td>{$product_name}</td>
            <td>{$row['product_quantity']}</td>
            <td>{$row['product_price']}</td>
            <td scope='row' class='td-actions'>              
                   <h6> <div class='text'>
                       <label>
                       <form method ='post'>
                       <input type='text' name='product_code' hidden='text' value='".$row['product_code']."'>
                       <input type='text' name='product_name' hidden='text' value='".$row['product_name']."'>
                       <input type='text' name='client_email' hidden='text' value='".$row['client_email']."'>
                       <input type='text' name='product_price' hidden='text' value='".$row['product_price']."'>
                       <button type='submit' name='delete' class='btn btn-primary'>DELETE</button> 
                       <button type='submit' name='insert' class='btn btn-primary'>CHECKOUT</button>
                       <button type='submit' name='update' class='btn btn-primary'>UPDATE</button>
                       
                       <td>                       
                       <div class='qty mt-10'>
                       <span class='minus bg-dark'>-</span>
                       <input type='text' class='plus-minus qty'  name='product_quantity' value='".$row['product_quantity']."' >
                       <span class='plus bg-dark'>+</span>
                       </div>
                       </td>
                       </form>
                       </label>
                       </div></h6>    
                       </td>

                      <td><h3>&#x20B1;".$single_price."</h3></td> 
                      
            </tr>"; 
}
            echo "<tr><td colspan='6' align='right'><h3>Total = &#x20B1;".$total_price."</h3></td></tr>";
}

function update(){
   if(isset($_POST['update']))
    {
      $product_code = $_POST['product_code'];
        $product_name = $_POST['product_name'];  
        $product_supplier = $_POST['product_supplier'];
        $product_price = $_POST['product_price'];
        $product_quantity = $_POST['product_quantity'];
       
        $query="UPDATE products SET 
        product_name = '$product_name', product_supplier = '$product_supplier', product_price = '$product_price', product_quantity = '$product_quantity'WHERE product_code = '$product_code' ";
         $result = mysqli_query($conn, $query);
        if ($result) {
        echo 'data updated';
        }else{
        echo 'data not updated';
        }  
        mysqli_close($conn);
 }
}

function checkout(){
global $conn;

       if(isset($_POST['delete-check']))
       { 
       $query=" DELETE FROM client ";
       $result = mysqli_query($conn, $query);

       if ($result) {
         echo "<script>alert('Your Order has been process, thank you')</script>";

       echo "<script>window.open('cart.php','_self');</script>";
    }
  }

   if(isset($_POST['delete-check']))
    {
      $product_code = $_POST['product_code'];
        $product_quantity = $_POST['product_quantity'];
       
        $query="UPDATE products SET 
        product_quantity = '$product_quantity' WHERE product_code = '$product_code' ";
         $result = mysqli_query($conn, $query);
        if ($result) {
        echo 'data updated';
        }else{
        echo 'data not updated';
        }  
        mysqli_close($conn);
 } 
}