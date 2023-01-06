<?php
    require "../includes/dbh.inc.php";
    include('../functions/functions.php');
    session_start();
?>
<!DOCTYPE html>
     <head>
          <meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <title>Computer-Store | Cart</title>
          <link rel="shortcut icon" type="image/png" href="../img/favicon.png" >
          <meta name="description" content="">
          <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../style.css">
        <link rel="stylesheet" href="../customstyle.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css" integrity="sha384-rtJEYb85SiYWgfpCr0jn174XgJTn4rptSOQsMroFBPQSGLdOC5IbubP6lJ35qoM9" crossorigin="anonymous">
        <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script>
            jQuery(document).ready(function() {
            jQuery('.toggle-nav').click(function(e) {
                jQuery(this).toggleClass('active');
                jQuery('.menu ul').toggleClass('active');

                e.preventDefault();
            });
            });
        </script>
     </head>
     <body>
          <!-- NavBar Starts -->
               <div style="position:sticky;top:0px;z-index:1;height:8%;" class="d-flex flex-col w-100 white shadow-sm">
                    <div class="d-flex jcsb">
                         <div class="d-flex flex-row">
                              <div>
                                   <a href="../indexcopy.php"><img class="img1" src="../img/cpu.png" alt=""></a>
                              </div>
                              <div class="hamburger">
                              <div class="line"></div>
                              <div class="line"></div>
                              <div class="line"></div>
                              </div>
                              <div class="menu">
                              <ul class="ls-none active current-item">
                                   <li class="p-1"><a class="pl-1 text-deco-none text-black nav" href="../index.php">Home</a></li>
                                   <li class="p-1"><a class="pl-1 text-deco-none text-black nav" href="../builds/system-build.php">SystemBuild</a></li>
                                   <li class="p-1"><a class="pl-1 text-deco-none text-black nav" href="../builds/completed_build.php">CompletedBuild</a></li>
                                   <li class="p-1"><a class="pl-1 text-deco-none text-black nav" href="../about.php">About</a></li>
                                   <li class="p-1"><a class="pl-1 text-deco-none text-black nav" href="../contact.php">Contact</a></li>
                              </ul>
                              </div>
                              <div>
                              <a class="toggle-nav" href="#">&#9776;</a>
                              </div>
                         </div>
                         <div class="mt-1">
                              <?php
                              if(isset($_SESSION['userId'])){
                                   echo'<form action="includes/logout.inc.php" method="post">
                                   <div class="d-flex jcfe">
                                   <div class="cart-btn">
                                   <div style="font-size:30px;" class="nav-icon"><a href="../cart/cart.php"><i style="color:black;" class="fas fa-cart-plus"></i></a></div>
                                   <div class="cart-items">'?><?php cartcount(); echo'</div>
                                   </div>
                                   <div style="font-size:30px; padding:0 15px;" class="text-black"><a class="text-black" href="../account/myAccount.php?acc"><div class="mx-1" ><i class="fas fa-user-circle"></i></div></a></div>
                                   <div style="margin-top:10px;"><a class="text-deco-none signup-button-field mr-2 text-black pr-1" href="../includes/logout.inc.php" name="logout-submit">Logout</a></div>
                                   </div>
                                   </form>';
                              }
                              else{
                                   echo'
                                   <div class="container d-flex flex-row jcfe">
                                        <div style="margin-top:3px;"><a class="text-deco-none signup-button-field mr-2 text-black pr-1" href="../signup.php">Signup</a></div>
                                        <div style="margin-top:3px;"><a class="text-deco-none text-black pr-1 mr-2 nav loginphp" href="../login.php">Login</a></div>
                                   </div>
                                   ';
                              }
                              ?>
                         </div>
                    </div>
               </div>
          <!-- Navbar Ends -->

          <div class="primary bg-color">
               <div class="container acc-container pt-1">
                    <div style=" height:45px; font-size:18px;" class="py-sm pl-2 my-1 b-rad-2 shadow-sm white text-left"><a style="color:#28AB87;" class="text-deco-none" href="../index.php">Home</a>  > My Cart</div>
                    <div class="d-flex md-d-flex md-flex-col">
                         <!-- Cart Table Starts -->
                         <div class="w-100 b-rad-2 shadow-md white text-left p-3 md-p-1 sm-p-sm" >
                              <!-- Count the products in cart -->
                                   <?php
                                        $userID = $_SESSION['userId'];
                                        $selectQuery = "SELECT * FROM cart WHERE userID='$userID'";
                                        $runQuery = mysqli_query($conn, $selectQuery);
                                        $count = mysqli_num_rows($runQuery);
                                        
                                        $countCart = "SELECT * FROM pccart WHERE userid='$userID'";
                                        $countQuery = mysqli_query($conn, $countCart);
                                        $count += mysqli_num_rows($countQuery);
                                   ?>
                              <!-- Count the products in cart ENDS -->
                              <h1 style="color:#003426;" class=" md-m-sm sm-md-0 md-p-sm sm-m-0">Shopping Cart</h1>
                              <div class="pb-1 mt-1 md-m-sm sm-md-0 md-p-sm sm-m-0" style="color:gray">You Have currently <?php cartcount() ?> item(s) in your cart</div>
                                   <?php
                                        if($count != 0){
                                             ?>
                                                  <form action="cart.php" method="POST" enctype="multipart/form-data">
                                                       <table style="width:100%" class="content-table">
                                                            <thead>
                                                                 <tr>
                                                                      <th>Product</th>
                                                                      <th>Quantity</th>
                                                                      <th>Unit Price</th>
                                                                      <th>Discount</th>
                                                                      <th>Delete</th>
                                                                      <th>Total</th>
                                                                 </tr>
                                                            </thead>
                                                            <tbody>
                                                                      <?php
                                                                           $grandTotal = 0;
                                                                           $userID = $_SESSION['userId'];
                                                                           $getCart = "SELECT * FROM cart WHERE userID='$userID'";
                                                                           $runGetCart = mysqli_query($conn, $getCart);
                                                                           while($row = mysqli_fetch_array($runGetCart)){
                                                                                $productID = $row['productid'];
                                                                                $quantity = $row['quantity'];
                                                                                $getproduct = "SELECT * FROM pcpart WHERE pcPartID='$productID'";
                                                                                $rungetProduct = mysqli_query($conn, $getproduct);
                                                                                while($productrow = mysqli_fetch_array($rungetProduct)){
                                                                                     $partTitle = $productrow['partTitle'];
                                                                                     $image = $productrow['image'];
                                                                                     $unitprice = $productrow['price'];
                                                                                     $haha = $quantity * $unitprice;
                                                                                     $discount = $unitprice * $quantity * 0.11;
                                                                                     $subTotal = $haha - $discount;
                                                                                     $partgrandTotal += $subTotal;
                                                                                     echo '
                                                                                     <tr>
                                                                                          <td>
                                                                                               <a class="text-deco-none" href="../details.php?part_det='?><?php echo $productrow['pcPartID']; echo'">
                                                                                               <img class="img1" src="../admin/upload/'.$productrow['image'].'" alt="amd">'?>
                                                                                                    <?php echo $partTitle; echo'
                                                                                               </a>
                                                                                          </td>
                                                                                          <td>'?><?php echo $quantity; echo'</td>
                                                                                          <td>&#8377;'.$unitprice.'</td>
                                                                                          <td>&#8377;'.$discount.'</td>
                                                                                          <td><input type="checkbox" name="remove[]" value='?><?php echo $productID; echo'></td>
                                                                                          <td>&#8377;'.$subTotal.'</td>
                                                                                     </tr>
                                                                                     ';
                                                                                }
                                                                                session_start();
                                                                                $_SESSION['partgrandtotal'] = $partgrandTotal;
                                                                           }

                                                                           $getCart = "SELECT * FROM pccart WHERE userid='$userID'";
                                                                           $runGetCart = mysqli_query($conn, $getCart);
                                                                           while($row = mysqli_fetch_array($runGetCart)){
                                                                                
                                                                                $productID = $row['pcid'];
                                                                                $quantity = 1;
                                                                                $getproduct = "SELECT * FROM pc_details WHERE pc_id='$productID'";
                                                                                $rungetProduct = mysqli_query($conn, $getproduct);
                                                                                while($productrow = mysqli_fetch_array($rungetProduct)){
                                                                                     $grandTotal = $_SESSION['grandtotal'];
                                                                                     $partTitle = $productrow['pcName'];
                                                                                     $image = $productrow['pc_image'];
                                                                                     $unitprice = $productrow['pcPrice'];
                                                                                     $haha = $quantity * $unitprice;
                                                                                     $discount = $unitprice * $quantity * 0.11;
                                                                                     $subTotal = $haha - $discount;
                                                                                     $pcgrandTotal += $subTotal;
                                                                                     echo '
                                                                                     <tr>
                                                                                          <td>
                                                                                               <a class="text-deco-none" href="../details.php?pc_det='?><?php echo $productrow['pc_id']; echo'">
                                                                                               <img class="img1" src="../admin/upload/'.$image.'" alt="amd">'?>
                                                                                                    <?php echo $partTitle; echo'
                                                                                               </a>
                                                                                          </td>
                                                                                          <td>'?><?php echo $quantity; echo'</td>
                                                                                          <td>&#8377;'.$unitprice.'</td>
                                                                                          <td>&#8377;'.$discount.'</td>
                                                                                          <td><input type="checkbox" name="delete[]" value='?><?php echo $productID; echo'></td>
                                                                                          <td>&#8377;'.$subTotal.'</td>
                                                                                     </tr>
                                                                                     ';
                                                                                }
                                                                           }
                                                                           $_SESSION['pcgrandtotal'] = $pcgrandTotal;

                                                                           $_SESSION['grandtotal'] = $_SESSION['partgrandtotal'] + $_SESSION['pcgrandtotal'];
                                                                           $grandTotal = $_SESSION['grandtotal'];
                                                                      ?>
                                                            </tbody>
                                                       </table>
                                                       <div class="text-right mr-4 mb-2"><?php 
                                                            if($count === 0){ echo "<p style='font-size:14px;'>No items in your cart</p>";}
                                                            else{
                                                                 echo"<b>Total: </b> "; 
                                                                 echo "&#8377;"+$_SESSION['grandtotal'];}?>
                                                            </div>
                                                       <div class="d-flex jcsb md-d-flex md-flex-col text-center">
                                                            <div>
                                                                 <pre><a href="../index.php" style="padding:10px 14px;margin-top:20px;background:#28AB87; border:none; color:white;font-size:16px;" class="text-deco-none b-rad-2 shadow-md"><i class="fas fa-step-backward pr-sm"></i>Continue Shopping</a></pre></div>
                                                            <div class="md-mb-1">
                                                                 <button type="submit" name="update" value="Update Cart" style="padding:10px 14px;margin-top:20px;background:#28AB87; border:none; color:white;" class="text-deco-none b-rad-2 shadow-md">
                                                                      <pre><i class=" fas fa-refresh pr-sm"></i>Update Cart</pre>
                                                                 </button>
                                                            </div>
                                                            <div>
                                                                 <pre><a href="./order/proceedcheckout.php" style="padding:10px 14px;margin-top:20px;background:#28AB87; border:none; color:white;font-size:16px;" class="text-deco-none b-rad-2 shadow-md">Proceed Checkout<i class="pl-sm fas fa-fast-forward"></i></a></pre>
                                                            </div>
                                                       </div>
                                                  </form>
                                             <?php
                                        }else{
                                   ?>
                                        <div class="p-1">No Items in your cart</div>
                                        <div style="color:gray" class="p-1">Click here to start your order,<a style='background:#28AB87'  class='ml-1 button-field text-deco-none shadow-sm' href='../index.php'>Shop Now</a></div>
                                        <div></div>
                                   <?php }?>
                              <?php
                                   function update_cart(){
                                        global $conn;
                                        if(isset($_POST['update'])){
                                             foreach($_POST['remove'] as $remove_id){
                                                  $delete_product = "DELETE FROM cart WHERE productid='$remove_id'";
                                                  $run_delete = mysqli_query($conn, $delete_product);
                                                  if($run_delete){
                                                       echo"<script>window.open('cart.php','_self')</script>";
                                                  }
                                             }
                                             foreach($_POST['delete'] as $delete_id){
                                                  echo $delete_id;
                                                  $delete_product = "DELETE FROM pccart WHERE pcid='$delete_id'";
                                                  $run_delete = mysqli_query($conn, $delete_product);
                                                  if($run_delete){
                                                       echo"<script>window.open('cart.php','_self')</script>";
                                                  }
                                             }
                                        }
                                   }
                                   echo @$up_cart = update_cart();
                                   if($count == 0)
                                   {
                                        $shippingCharge = 0;
                                        $taxCharge = 0;
                                   }
                                   else{
                                        if($grandTotal <= 1000){
                                             $shippingCharge = 20;
                                        }
                                        else{
                                             $shippingCharge = 0;
                                        }
                                        if($grandTotal <= 250){
                                             $taxCharge = 6;
                                        }
                                        elseif($grandTotal <= 500){
                                             $taxCharge = 16;
                                        }
                                        elseif($grandTotal <= 1000){
                                             $taxCharge = 32;
                                        }
                                        elseif($grandTotal >= 1000){
                                             $taxCharge = 60;
                                        }
                                   }

                              ?>
                         </div>
                         <!-- Cart Table Ends -->
                         
                         <!-- Order Summary Starts-->
                         <div class="ml-1 white b-rad-2 sm-w-100 md-mt-2">
                              <div style="background:#e0e0e0" class="b-rad-1">
                                   <h1 class="py-1">Order Summary</h1>
                              </div>
                              <div style="color:gray;" class="py-2 container">
                                   <p>
                                        Shipping and additional costs are calculated based on value you have entered
                                   </p>
                              </div>
                              <div class="mx-2">
                                   <hr>
                              </div>
                              <div class="d-flex jcsb mx-3 my-1">
                                   <p>Order Sub-total</p>
                                   <p>&#8377;<?php echo $grandTotal; ?></p>
                              </div>
                              <div class="mx-2">
                                   <hr>
                              </div>
                              <div class="d-flex jcsb mx-3 my-1">
                                   <p>Shipping</p>
                                   <p>&#8377;<?php session_start();$_SESSION['shippingCharge']=$shippingCharge; echo $shippingCharge; ?></p>
                              </div>
                              <div class="mx-2">
                                   <hr>
                              </div>
                              <div class="d-flex jcsb mx-3 my-1">
                                   <p>Tax</p>
                                   <p>&#8377;<?php session_start(); $_SESSION['taxCharge']=$taxCharge; echo $taxCharge; ?></p>
                              </div>
                              <div class="mx-2">
                                   <hr>
                              </div>
                              <div class="d-flex jcsb mx-3 my-1">
                                   <p><b>Total</b></p>
                                   <p><b>&#8377;
                                        <?php
                                             $total=$shippingCharge+$grandTotal+$taxCharge;
                                             session_start();
                                             $_SESSION['total']=$total;
                                             echo $total;
                                        ?>
                                   </b></p>
                              </div>
                         </div>
                         <!-- Order Summary Ends-->
                    </div>
                    <div class="mt-1">
                         <div style="" class="container acc-container2 white p-1">
                              <b> Products You may also like</b>
                         </div>
                    </div>
                    <div class="d-flex flex-wrap jcc">
                         <?php
                         $query = "SELECT * FROM pcpart ORDER BY RAND() LIMIT 0,3;";
                         $check = mysqli_query($conn, $query);
                         while ($row = mysqli_fetch_assoc($check)) {
                              $partname = $row['partKeyword'];
                              $partID = $row['pcPartID'];
                              echo "
                              <div style='width:220px;' class='shadow-md responsive-card white b-rad-2 card-hover'>
                                  <a style='color:#28AB87' class='text-deco-none' href='details.php?part_det=".$partID."'>
                                  <div class='single-img'>
                                      <img class='img2 mt-1' src='../admin/upload/".$row['image']."'/>
                                  </div>
                                  <div style='font-size:20px;' class='text-center'>";
                                      echo"<h4 class='m-1'>{$row['partTitle']}</h4></a><br>";
                                      echo"<div class='text-primary'>
                                                  <b></b>
                                                  <div class='m-1 text-black'><b>&#8377;{$row['price']}/-</b></div>
                                          </div>
                                          <div class='mx-sm'>
                                          <div class='mb-3 mt-2 md-mt-2 d-flex jcsa md-flex-col'>
                                                  <div class='md-mb-2'><a style='background:#28AB87' class='button-field text-deco-none shadow-md' href='details.php?part_det={$partID}'>Details</a></div>
                                                  <div><a style='background:#28AB87'  class='button-field text-deco-none shadow-md' href='index.php?add_cart={$partID}'>AddToCart</a></div>
                                          </div>
                                          </div>
                                  </div>
                              </div>
                              ";
                      }
                         ?>
                    </div>
          </div>

          <script src="" async defer></script>
          <?php require'../footer.php';?>
          <?php
               if (isset($_GET['add_cart'])) {
                    $userID = $_SESSION['userId'];
                    $p_id = $_GET['add_cart'];
                      $check_product = "SELECT * FROM cart WHERE userID='$userID' AND productid='$p_id';";
                      $run_product = mysqli_query($conn, $check_product);
                      $part_qty = 1;
                      if (mysqli_fetch_array($run_product) > 0) {
                           echo"<script>alert('This product has already added in cart')</script>";
                           echo"<script>window.open('index.php?pro_id=$p_id','_self')</script>";
                      } else {
                         $query = "INSERT INTO cart(cID, userID, productid, quantity) VALUES (null, '$userID', '$p_id','$part_qty');";
                         $check = mysqli_query($conn, $query);
                         if($check){
                              echo"<script>window.open('index.php?part_det='$p_id'','_self')</script>";
                         }
                         
                    }
                    
               }
          ?>
     </body>
</html>