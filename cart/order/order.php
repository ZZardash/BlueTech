<?php
    require "../../includes/dbh.inc.php";
    include('../../functions/functions.php');
    session_start();
?>
<?php
     if (isset($_GET['sb'])) {
          if(isset($_POST['payment'])){
               $grandTotal = 0;
               $sbname = $_GET['sbname'];
               $_SESSION['packingtype'] = $_GET['packing'];
               $packing = $_GET['packing'];
               $paymentMethod = $_POST['paymentmethod'];
               // print($paymentMethod);
               $ordernumber = rand();
               if($paymentMethod == "cod"){
                    $sbName = $_GET['sbname'];
                    //print($sbName);
                    $shippingCharge = $_SESSION['shippingCharge'];
                    $taxCharge = $_SESSION['taxCharge'];
                    $userID = $_SESSION['userId'];
                    $cartSelect = "SELECT * FROM systembuild WHERE userID='$userID'";
                    $runQuery = mysqli_query($conn, $cartSelect);
                    if($runQuery){
                         while($cartrow = mysqli_fetch_array($runQuery)){
                              $subTotal = $cartrow['partPrice'];
                              $total = $taxCharge + $subTotal + $shippingCharge;
                              $partID = $cartrow['partID'];
                              $grandTotal = $grandTotal + $subTotal;
                              $partQty = 1;
                              $paymentMethod = $_POST['paymentmethod'];
                              $pcID = 0;
                              if(empty($paymentMethod)){
                                   header("LOCATION: payment.php?payment=false");
                              }
                              else{
                                   $insertorder = "INSERT INTO sborders VALUES(NULL, '$ordernumber', '$userID', '$sbName', '$partID', '$partQty', '$paymentMethod', '$subTotal', '$shippingCharge', '$taxCharge', '$total', NOW(), 'Pending')";
                                   $insertcheck = mysqli_query($conn, $insertorder);
                                   if($insertcheck){
                                        $deletecart = "DELETE FROM systembuild WHERE partID='$partID'";
                                        $rundelete = mysqli_query($conn, $deletecart);
                                   }
                              }
                         }
                         // print($grandTotal);
                         $insertquery = "INSERT INTO sbpc VALUES(NULL, '$ordernumber', '$sbName', '$grandTotal', '$userID', '$paymentMethod', NOW(), '$packing', 'Pending')";
                         $inserCheck = mysqli_query($conn, $insertquery);
                    }
               }
               else{
                    header("LOCATION: ../../includes/onlinepayment.inc.php?paymentMethodsb=online&sbname=$sbname");
               }
          }
     }
     else{
          if(isset($_POST['payment'])){
               $paymentMethod = $_POST['paymentmethod'];
               $ordernumber = rand();
               if($paymentMethod == "cod"){
                    $subTotal = $_SESSION['grandtotal'];
                    $shippingCharge = $_SESSION['shippingCharge'];
                    $taxCharge = $_SESSION['taxCharge'];
                    $total = $_SESSION['total'];
                    $userID = $_SESSION['userId'];
                    $cartSelect = "SELECT * FROM cart WHERE userID='$userID'";
                    $runQuery = mysqli_query($conn, $cartSelect);
                    if($runQuery){
                         while($cartrow = mysqli_fetch_array($runQuery)){
                              $partID = $cartrow['productid'];
                              $partQty = $cartrow['quantity'];
                              $pcID = 0;
                              if(empty($paymentMethod)){
                                   header("LOCATION: payment.php?payment=false");
                              }
                              else{
                                   $insertorder = "INSERT INTO orders VALUES(NULL, '$ordernumber', '$userID', '$pcID', '$partID', '$partQty', '$paymentMethod', '$subTotal', '$shippingCharge', '$taxCharge', '$total', NOW(), 'Pending')";
                                   $insertcheck = mysqli_query($conn, $insertorder);
                                   if($insertcheck){
                                        $selectpart = "SELECT * FROM pcpart WHERE pcPartID='$partID'";
                                        $query = mysqli_query($conn, $selectpart);
                                        // print($partID);
                                        while($selectPCpart = mysqli_fetch_array($query)){
                                             $qty = $selectPCpart['qty'];
                                             $updateQty = $qty - $partQty;
                                             $updatecheck = "UPDATE pcpart SET qty='$updateQty' WHERE  pcPartID='$partID'";
                                             $updatequery = mysqli_query($conn, $updatecheck);
                                             if($updatequery){
                                                  $deletecart = "DELETE FROM cart WHERE productid='$partID'";
                                                  $rundelete = mysqli_query($conn, $deletecart);
                                             }
                                        }
                                   }
                              }
                         }
                    }
                    $cartSelect = "SELECT * FROM pccart WHERE userID='$userID'";
                    $runQuery = mysqli_query($conn, $cartSelect);
                    if($runQuery){
                         while($cartrow = mysqli_fetch_array($runQuery)){
                              $pcID = $cartrow['pcid'];
                              $pcQty = 1;
                              $paymentMethod = $_POST['paymentmethod'];
                              $partID = 0;
                              if(empty($paymentMethod)){
                                   header("LOCATION: payment.php?payment=false");
                              }
                              else{
                                   $insertorder = "INSERT INTO orders VALUES(NULL, '$ordernumber', '$userID', '$pcID', '$partID', '$pcQty', '$paymentMethod', '$subTotal', '$shippingCharge', '$taxCharge', '$total', NOW(), 'Pending')";
                                   $insertcheck = mysqli_query($conn, $insertorder);
                                   if($insertcheck){
                                        $selectpart = "SELECT * FROM pc_details WHERE pc_id='$pcID'";
                                        $query = mysqli_query($conn, $selectpart);
                                        // print($partID);
                                        while($selectPCpart = mysqli_fetch_array($query)){
                                             $qty = $selectPCpart['pcQty'];
                                             $updateQty = $qty - $pcQty;
                                             $updatecheck = "UPDATE pc_details SET pcQty='$updateQty' WHERE  pc_id='$pcID'";
                                             $updatequery = mysqli_query($conn, $updatecheck);
                                             if($updatequery){
                                                  $deletecart = "DELETE FROM pccart WHERE pcid='$pcID'";
                                                  $rundelete = mysqli_query($conn, $deletecart);
                                             }
                                        }
                                   }
                              }
                         }
                    }
               }
               else{
                    header("LOCATION: ../../includes/onlinepayment.inc.php?paymentMethod=online");
               }
          }
     }
     if(isset($_GET['success'])){
          $paymentMethod = "online";
          $ordernumber = rand();
          if($paymentMethod == "online"){
               $subTotal = $_SESSION['grandtotal'];
               $shippingCharge = $_SESSION['shippingCharge'];
               $taxCharge = $_SESSION['taxCharge'];
               $total = $_SESSION['total'];
               $userID = $_SESSION['userId'];
               $cartSelect = "SELECT * FROM cart WHERE userID='$userID'";
               $runQuery = mysqli_query($conn, $cartSelect);
               if($runQuery){
                    while($cartrow = mysqli_fetch_array($runQuery)){
                         $partID = $cartrow['productid'];
                         $partQty = $cartrow['quantity'];
                         $pcID = 0;
                         $insertorder = "INSERT INTO orders VALUES(NULL, '$ordernumber', '$userID', '$pcID', '$partID', '$partQty', '$paymentMethod', '$subTotal', '$shippingCharge', '$taxCharge', '$total', NOW(), 'Pending')";
                         $insertcheck = mysqli_query($conn, $insertorder);
                         if($insertcheck){
                              $selectpart = "SELECT * FROM pcpart WHERE pcPartID='$partID'";
                              $query = mysqli_query($conn, $selectpart);
                              // print($partID);
                              while($selectPCpart = mysqli_fetch_array($query)){
                                   $qty = $selectPCpart['qty'];
                                   $updateQty = $qty - $partQty;
                                   $updatecheck = "UPDATE pcpart SET qty='$updateQty' WHERE  pcPartID='$partID'";
                                   $updatequery = mysqli_query($conn, $updatecheck);
                                   if($updatequery){
                                        $deletecart = "DELETE FROM cart WHERE productid='$partID'";
                                        $rundelete = mysqli_query($conn, $deletecart);
                                   }
                              }
                         }
                    }
               }
               $cartSelect = "SELECT * FROM pccart WHERE userID='$userID'";
               $runQuery = mysqli_query($conn, $cartSelect);
               if($runQuery){
                    while($cartrow = mysqli_fetch_array($runQuery)){
                         $pcID = $cartrow['pcid'];
                         $pcQty = 1;
                         $partID = 0;
                         if(empty($paymentMethod)){
                              header("LOCATION: payment.php?payment=false");
                         }
                         else{
                              $insertorder = "INSERT INTO orders VALUES(NULL, '$ordernumber', '$userID', '$pcID', '$partID', '$pcQty', '$paymentMethod', '$subTotal', '$shippingCharge', '$taxCharge', '$total', NOW(), 'Pending')";
                              $insertcheck = mysqli_query($conn, $insertorder);
                              if($insertcheck){
                                   $selectpart = "SELECT * FROM pc_details WHERE pc_id='$pcID'";
                                   $query = mysqli_query($conn, $selectpart);
                                   // print($partID);
                                   while($selectPCpart = mysqli_fetch_array($query)){
                                        $qty = $selectPCpart['pcQty'];
                                        $updateQty = $qty - $pcQty;
                                        $updatecheck = "UPDATE pc_details SET pcQty='$updateQty' WHERE  pc_id='$pcID'";
                                        $updatequery = mysqli_query($conn, $updatecheck);
                                        if($updatequery){
                                             $deletecart = "DELETE FROM pccart WHERE pcid='$pcID'";
                                             $rundelete = mysqli_query($conn, $deletecart);
                                        }
                                   }
                              }
                         }
                    }
               }
          }
          $txnid = $_POST['txnid'];
          $pid = $_POST['payuMoneyId'];
          $amount = $_POST['amount'];
          $productinfo = $_POST['productinfo'];
          if($txnid != 0){
               $insert = "INSERT INTO payu VALUES (NULL, '$ordernumber', '$userID', '$txnid', '$amount', '$productinfo', NOW(), '$pid')";
               $checkpayu = mysqli_query($conn, $insert);
          }
          
     }
     if(isset($_GET['sbsuccess'])){
          $paymentMethod = "online";
          $ordernumber = rand();
          if($paymentMethod == "online"){
               $sbName = $_GET['sbname'];
               //print($sbName);
               $shippingCharge = $_SESSION['shippingCharge'];
               $taxCharge = $_SESSION['taxCharge'];
               $userID = $_SESSION['userId'];
               $cartSelect = "SELECT * FROM systembuild WHERE userID='$userID'";
               $runQuery = mysqli_query($conn, $cartSelect);
               if($runQuery){
                    while($cartrow = mysqli_fetch_array($runQuery)){
                         $subTotal = $cartrow['partPrice'];
                         $total = $taxCharge + $subTotal + $shippingCharge;
                         $partID = $cartrow['partID'];
                         $grandTotal = $grandTotal + $subTotal;
                         $partQty = 1;
                         $pcID = 0;
                         if(empty($paymentMethod)){
                              header("LOCATION: payment.php?payment=false");
                         }
                         else{
                              $insertorder = "INSERT INTO sborders VALUES(NULL, '$ordernumber', '$userID', '$sbName', '$partID', '$partQty', '$paymentMethod', '$subTotal', '$shippingCharge', '$taxCharge', '$total', NOW(), 'Pending')";
                              $insertcheck = mysqli_query($conn, $insertorder);
                              if($insertcheck){
                                   // $insertquery = "INSERT INTO sbpc VALUES(NULL, '$ordernumber', '$sbName', '$grandTotal', '$userID', '$paymentMethod', NOW(), 'Pending')";
                                   // $inserCheck = mysqli_query($conn, $insertquery);
                                   $deletecart = "DELETE FROM systembuild WHERE partID='$partID'";
                                   $rundelete = mysqli_query($conn, $deletecart);
                              }
                         }
                    }
                    // print($grandTotal);
                         $packing = $_SESSION['packingtype'];
                         $insertquery = "INSERT INTO sbpc VALUES(NULL, '$ordernumber', '$sbName', '$grandTotal', '$userID', '$paymentMethod', NOW(), '$packing', 'Pending')";
                         $inserCheck = mysqli_query($conn, $insertquery);
                         $delete = "DELETE FROM sbpc WHERE amount=0";
                         $check = mysqli_query($conn, $delete);
               }
          }
          $txnid = $_POST['txnid'];
          $pid = $_POST['payuMoneyId'];
          $amount = $_POST['amount'];
          $productinfo = $_POST['productinfo'];
          if($txnid != 0 ){
               $insert = "INSERT INTO sbpayu VALUES (NULL, '$ordernumber', '$userID', '$txnid', '$amount', '$productinfo', NOW(), '$pid')";
               $checkpayu = mysqli_query($conn, $insert);
          }
          
     }
?>

<!DOCTYPE html>
     <head>
          <meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <title>Computer-Store | Order</title>
          <meta name="description" content="">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="shortcut icon" type="image/png" href="../../img/favicon.png" >
        <link rel="stylesheet" href="../../style.css">
        <link rel="stylesheet" href="../../customstyle.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css" integrity="sha384-rtJEYb85SiYWgfpCr0jn174XgJTn4rptSOQsMroFBPQSGLdOC5IbubP6lJ35qoM9" crossorigin="anonymous">
        <script>
             function printlayer(layer){
                  var generator = window.open(",'name,");
                  var layetext = document.getElementById(layer);
                  generator.document.write(layetext.innerHTML.replace("Print Me"));

                  generator.document.close();
                  generator.print();
                  generator.close();
             }
        </script>
     </head>
     <body>
          <!-- NavBar Starts -->
               <div style="position:sticky;top:0px;z-index:1;height:8%;" class="d-flex flex-col w-100 white shadow-sm">
                    <div class="d-flex jcsb">
                         <div class="d-flex flex-row">
                              <div>
                              <img class="img1" src="../../img/cpu.png" alt="">
                              </div>
                              <div class="hamburger">
                              <div class="line"></div>
                              <div class="line"></div>
                              <div class="line"></div>
                              </div>
                              <div class="menu">
                              <ul class="ls-none active current-item">
                                   <li class="p-1"><a class="pl-1 text-deco-none text-black nav" href="../../index.php">Home</a></li>
                                   <li class="p-1"><a class="pl-1 text-deco-none text-black nav" href="../../builds/system-build.php">SystemBuild</a></li>
                                   <li class="p-1"><a class="pl-1 text-deco-none text-black nav" href="../../builds/completed_build.php">CompletedBuild</a></li>
                                   <li class="p-1"><a class="pl-1 text-deco-none text-black nav" href="../../about.php">About</a></li>
                                   <li class="p-1"><a class="pl-1 text-deco-none text-black nav" href="../../contact.php">Contact</a></li>
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
                                   <div style="font-size:30px;" class="nav-icon"><a href="../../cart/cart.php"><i style="color:black;" class="fas fa-cart-plus"></i></a></div>
                                   <div class="cart-items">'?><?php cartcount(); echo'</div>
                                   </div>
                                   <div style="font-size:30px; padding:0 15px;" class="text-black"><a class="text-black" href="../../account/myAccount.php?acc"><div class="mx-1" ><i class="fas fa-user-circle"></i></div></a></div>
                                   <div style="margin-top:10px;"><a class="text-deco-none signup-button-field mr-2 text-black pr-1" href="../includes/logout.inc.php" name="logout-submit">Logout</a></div>
                                   </div>
                                   </form>';
                              }
                              else{
                                   echo'
                                   <div class="container d-flex flex-row jcfe">
                                        <div style="margin-top:3px;"><a class="text-deco-none signup-button-field mr-2 text-black pr-1" href="../../signup.php">Signup</a></div>
                                        <div style="margin-top:3px;"><a class="text-deco-none text-black pr-1 mr-2 nav loginphp" href="../../login.php">Login</a></div>
                                   </div>
                                   ';
                              }
                              ?>
                         </div>
                    </div>
               </div>
          <!-- Navbar Ends -->
          
          <!-- Content Starts -->
          <div class="primary bg-color md-pt-1">
               <div class="container acc-container pt-1">
                    <div style=" height:45px; font-size:18px;" class="py-sm pl-2 my-1 b-rad-2 shadow-sm white text-left"><a style="color:#28AB87;" class="text-deco-none" href="../../index.php">Home</a>  > My Cart</div>
                    
                    <div class="d-flex jcc md-d-flex md-flex-col">
                         <div class="p-1 white text-center mb-1 min-w-50">
                              <div style="vertical-align: middle;">
                                   <button id="print" onclick="javascript:printlayer('print-order-page')" class="px-1 py-sm"><i class="fa fa-print pr-sm"></i>Print Page</button>
                              </div>
                         </div>
                         <div class="d-flex jcc md-d-flex md-flex-col" id="print-order-page">
                              <div class="p-1 white text-center mb-1 min-w-50">
                                   <div class="m-sm"><h1>Thanks for your order</h1></div>
                                   <div class="mx-3"><hr></div>
                                   <div class="">
                                        <div class="container">
                                             <div class="mt-1 text-left">
                                                  <div class="d-flex jcsa">
                                                       <div>
                                                            <table style="color:gray">
                                                                 <tbody>
                                                                      <tr>
                                                                           <td class="text-left">Order number</td>
                                                                           <td class="text-right"><?php echo $ordernumber; ?></td>
                                                                      </tr>
                                                                      <tr>
                                                                           <td class="text-left">Order Date</td>
                                                                           <td class="text-right"><?php echo date("l, F jS Y");?></td>
                                                                      </tr>
                                                                      <?php
                                                                           $userID = $_SESSION['userId'];
                                                                           $selct = "SELECT * FROM users WHERE isUsers='$userID'";
                                                                           $query = mysqli_query($conn, $selct);
                                                                           while($row = mysqli_fetch_array($query)){
                                                                                $userName = $row['uidUsers'];
                                                                           }
                                                                      ?>
                                                                      <tr>
                                                                           <td class="text-left">Customer Name</td>
                                                                           <td class="text-right"><?php echo $userName; ?></td>
                                                                      </tr>
                                                                      <?php
                                                                           if(isset($_GET['success']) || isset($_GET['sbsuccess'])){
                                                                                echo"
                                                                                <tr>
                                                                                     <td class='text-left'>Transactin ID</td>
                                                                                     <td class='text-right'>"?><?php echo $pid; ?><?php echo"</td>
                                                                                </tr>
                                                                                ";
                                                                           }
                                                                      ?>
                                                                 </tbody>
                                                            </table>
                                                       </div>
                                                  </div>
                                                  <div class="py-1">
                                                       <i style="color:#28AB87;" class="fa fa-map-marker"></i>
                                                       <b>
                                                            Please keep the above number for your refernces. We'll also send a confirmation to the email address you used for this order.
                                                       </b>
                                                  </div>
                                                  <div class=" d-flex jcsa">
                                                       <div style="width:300px;">
                                                            <p class="pb-sm"><b>Shipping Address</b></p>
                                                            <p>
                                                                 2467 Mission Street, SAN FRANSISCO, CA 942323-2348
                                                                 US 412378478
                                                            </p>
                                                            <p>agnelselvan007@gamil.com</p>
                                                       </div>
                                                       <div>
                                                            <p class="pb-sm"><b>Payment Method</b></p>
                                                            <p>
                                                                 <?php
                                                                      if(isset($_GET['success'])){
                                                                           echo"Online payment";
                                                                      }
                                                                      else{
                                                                           echo"COD";
                                                                      }
                                                                 ?>
                                                            </p>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div style="min-width:30%" class="ml-1 mb-1 white acc-container min-w-30">
                                   <div style="background:#e0e0e0;" class="p-1 text-black">
                                        Order Summary
                                   </div>
                                   <div class="p-1">
                                        <div class="d-flex jcsb m-sm">
                                             <div>SubTotal</div>
                                             <?php
                                                  if(isset($_GET['sb'])){
                                                       $subtotal = $subTotal;
                                                  }
                                                  else{
                                                       $subtotal = $_SESSION['grandtotal'];
                                                  }
                                             ?>
                                             <div class="mr-1">&#8377;<?php echo $subtotal; ?></div>
                                        </div>
                                        <div class="mx-sm">
                                             <hr>
                                        </div>
                                        <div class="d-flex jcsb m-sm">
                                             <div>Shipping</div>
                                             <?php $shipping=$_SESSION['shippingCharge']; ?>
                                             <div class="mr-1">&#8377; <?php echo $shipping; ?></div>
                                        </div>
                                        <div class="mx-sm">
                                             <hr>
                                        </div>
                                        <div class="d-flex jcsb m-sm">
                                             <div>Discount</div>
                                             <div class="mr-1">
                                                  <?php
                                                       if(isset($_GET['sb'])){
                                                            $discount = $discount;
                                                            echo $discount;
                                                       }
                                                       else{
                                                            $discount = 0;
                                                            echo $discount;
                                                       }
                                                  ?>
                                             </div>
                                        </div>
                                        <div class="mx-sm">
                                             <hr>
                                        </div>
                                        <div class="d-flex jcsb m-sm">
                                             <div> Estimated Tax</div>
                                             <?php $taxCharge=$_SESSION['taxCharge']; ?>
                                             <div class="mr-1">&#8377; <?php echo $taxCharge; ?></div>
                                        </div>
                                        <div class="mx-sm">
                                             <hr>
                                        </div>
                                        <div class="d-flex jcsb m-sm">
                                             <div>Order Total</div>
                                             <?php
                                                  if(isset($_GET['sb'])){
                                                       $total = $total;
                                                  }
                                                  else{
                                                       $total=$_SESSION['total'];
                                                  }
                                             ?>
                                             <div class="mr-1">&#8377; <?php echo $total ?></div>
                                        </div>
                                        <div class="mx-sm">
                                             <hr>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="d-flex md-d-flex md-flex-col">
                         <div class="min-w-70 acc-container">
                              <div class="mt-1">
                                   <div style="" class="white b-rad-1 shadow-sm p-1  acc-container2">
                                        <b> Products You may also like</b>
                                   </div>
                              </div>
                              <div class="d-flex flex-wrap jcsa">
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
                                             <img class='img2 mt-1' src='../../admin/upload/".$row['image']."'/>
                                        </div>
                                        <div style='font-size:20px;' class='text-center'>";
                                             echo"<h4 class='m-1'>{$row['partTitle']}</h4></a><br>";
                                             echo"<div class='text-primary'>
                                                            <b></b>
                                                            <div class='m-1 text-black'><b>&#8377;{$row['price']}/-</b></div>
                                                  </div>
                                                  <div class='mx-sm'>
                                                  <div class='mb-3 mt-2 md-mt-2 d-flex jcsa md-flex-col'>
                                                            <div class='md-mb-2'><a style='background:#28AB87' class='button-field text-deco-none shadow-md' href='../../details.php?part_det={$partID}'>Details</a></div>
                                                  </div>
                                                  </div>
                                        </div>
                                        </div>
                                        ";
                              }
                                   ?>
                              </div>
                         </div>
                         
                         <div class="mt-1 ml-1 min-w-30 acc-container mr-1">
                              <div class="white text-deco-none shadow-md b-rad-1">
                                   <div style="background:#eee;" class="p-1 b-rad-1">
                                        Need Help?
                                   </div>
                                   <div class="container">
                                        <div class="p-1">
                                             <ul class="ls-none">
                                                  <li class="p-sm"><a class="text-deco-none" href="../../contact.php">Send feedback</a></li>
                                                  <li class="p-sm"><a class="text-deco-none" href="">Ordering Information</a></li>
                                                  <li class="p-sm"><a class="text-deco-none" href="">Chat with us</a></li>
                                             </ul>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
          </div>
          <!-- Content Ends -->
     </div>
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
          <?php require'../../footer.php';?>
     </body>
</html>