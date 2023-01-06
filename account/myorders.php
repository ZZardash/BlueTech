<?php
    require "../includes/dbh.inc.php";
    include('../functions/functions.php');
    session_start();
    $userID = $_SESSION['userId'];
    if(isset($_GET['delpartID'])){
         $partID = $_GET['delpartID'];
     //     echo $partID;
          $delete = "DELETE FROM orders WHERE partID='$partID' and userID='$userID'";
          $query = mysqli_query($conn, $delete);
          header("LOCATION: myorders.php?order");
    }
    if(isset($_GET['delpcID'])){
          $pcID = $_GET['delpcID'];
     //     echo $pcID;
          $delete = "DELETE FROM orders WHERE pcID='$pcID' and userID='$userID'";
          $query = mysqli_query($conn, $delete);
          header("LOCATION: myorders.php?order");
     }
     if(isset($_GET['delsbID'])){
          $sbID = $_GET['delsbID'];
          //echo $pcID;
          $select = "SELECT * FROM sbpc WHERE sbPCID='$sbID' and userID='$userID'";
          $query = mysqli_query($conn, $select);
          while($row = mysqli_fetch_array($query)){
               $orderNumber = $row['orderNumber'];
          }
          $delete = "DELETE FROM sbpc WHERE sbPCID='$sbID' and userID='$userID'";
          $query = mysqli_query($conn, $delete);
          // echo $orderNumber;
          $deletesborder = "DELETE FROM sborders WHERE ordernumber='$orderNumber' and userID='$userID'";
          $query = mysqli_query($conn, $deletesborder);
          header("LOCATION: myorders.php?order");
     }
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <style>
          .content-table{
                  border-collapse: collapse;
                  margin: 25px 0;
                  font-size: 0.9rem;
                  min-width: 400px;
                  width: 90%;
                  height:50%;
             }
             .content-table thead tr{
                  background: #009879;
                  color: white;
                  text-align: left;
                  font-weight: bold;
             }
             .content-table th,
             .content-table td{
                    padding: 12px 15px;
             }
             .content-table tbody tr{
                  border-bottom: 1px solid #dddddd;
             }
             .content-table tbody tr:nth-last-of-type(even){
                  background: #f3f3f3;
             }
             .content-table tbody tr:last-of-type{
               border-bottom: 2px solid #009879;
             }
          @media screen and (max-width:767.98px){
               .acc-table{
                    max-width: 100%;
               }
               .content-table{
                    border-collapse: collapse;
                    margin: 0;
                    font-size: 0.56rem;
                    min-width: 40%;
                    height:50%;
               }
               .content-table thead tr{
                  background: #009879;
                  color: white;
                  text-align: left;
                  font-weight: bold;
             }
             .content-table th,
             .content-table td{
                    padding: 12px 15px;
             }
             .content-table tbody tr{
                  border-bottom: 1px solid #dddddd;
             }
             .content-table tbody tr:nth-last-of-type(even){
                  background: #f3f3f3;
             }
             .content-table tbody tr:last-of-type{
               border-bottom: 2px solid #009879;
             }
          }
     </style>
     <link rel="stylesheet" href="../style.css">
     <link rel="stylesheet" href="../customstyle.css">
        <link rel="shortcut icon" type="image/png" href="../img/favicon.png" >
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css" integrity="sha384-rtJEYb85SiYWgfpCr0jn174XgJTn4rptSOQsMroFBPQSGLdOC5IbubP6lJ35qoM9" crossorigin="anonymous">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
     <title>Computer Store| My Orders</title>
</head>
<body>
     <!-- Navbar Starts -->
          <div style="position:sticky;top:0px;z-index:1;height:8%;" class="d-flex flex-col w-100 white shadow-sm">
               <div class="d-flex jcsb">
                    <div class="d-flex flex-row">
                         <div>
                              <img class="img1" src="../img/cpu.png" alt="">
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
                                   <div style="font-size:30px; padding:0 15px;" class="text-black"><a class="text-black" href="myAccount.php?acc"><div class="mx-1" ><i class="fas fa-user-circle"></i></div></a></div>
                                   <div style="margin:10px 0;"><a class="text-deco-none signup-button-field mr-2 text-black pr-1" href="../includes/logout.inc.php" name="logout-submit">Logout</a></div>
                                   </div>
                                   </form>';
                                   }
                                   else{
                                   echo'
                                   <div class="container d-flex flex-row jcfe">
                                        <div ><a class="text-deco-none signup-button-field mr-2 text-black pr-1" href="../signup.php">Signup</a></div>
                                        <div><a class="text-deco-none text-black pr-1 mr-2 nav loginphp" href="../login.php">Login</a></div>
                                   </div>
                                   ';
                                   }
                         ?>
                    </div>
               </div>
          </div>
     <!-- Navbar Ends -->

     <!-- Content Starts -->
          <div style="" class="bg-color py-3">
               <div class="container">
                    <div class="sm-d-flex sm-flex-col sm-jcc white b-rad-2">
                         <div class="sm-ml-lg text-center sm-mt-2 pt-1"><h1 style="font-size:30px;color:#003426;">My Orders</h1> </div>
                         <p style="color:gray; margin:30px;" class=" text-center">If u have any question, feel free to <a href="../contact.php">Contact us</a>. Our Customer service work <strong>24 &#10006; 7</strong> </p>
                         <div class="mx-4">
                              <hr>
                         </div>
                    </div>
                    <div>
                         <div class="pt-2 pl-3 white  b-rad-2  ">
                              <div class="acc-table p-1">
                                   <div class="container">
                                        <?php
                                             $query = "SELECT * FROM orders WHERE userID='$userID'";
                                             $checkall = mysqli_query($conn, $query);
                                             $count = mysqli_num_rows($checkall);
                                             $countall = $count;
                                             $query = "SELECT * FROM sbpc WHERE userID='$userID'";
                                             $checkall = mysqli_query($conn, $query);
                                             $count = mysqli_num_rows($checkall);
                                             $countsb += $count;
                                             // print($countall);
                                             if($countall > 0 or $countsb > 0){
                                        ?>
                                             
                                             <?php
                                                  $countquery = "SELECT * FROM orders WHERE userID='$userID' and partID!=0;";
                                                  $check = mysqli_query($conn, $countquery);
                                                  $countpartorder = mysqli_num_rows($check);
                                                  //print($countpartorder);
                                             ?>
                                             <?php if($countpartorder != 0){?>
                                                  <div><b> Part Order(s) </b></div>
                                                  <div class="mr-4 mt-sm">
                                                       <hr>
                                                  </div>
                                                  <!-- Part Orders Starts-->
                                                  <table class="content-table w-100 shadow-sm">
                                                       <thead>
                                                            <tr>
                                                                 <th>Order Number:</th>
                                                                 <th>Part Name:</th>
                                                                 <th>Quantity:</th>
                                                                 <th>Amount:</th>
                                                                 <th>Order Date:</th>
                                                                 <th>Payment</th>
                                                                 <th>Status</th>
                                                                 <th>Cancel Item</th>
                                                            </tr>
                                                       </thead>
                                                       <tbody class="text-left">
                                                            <?php
                                                                 $order = "SELECT * FROM orders WHERE userID='$userID'";
                                                                 $check = mysqli_query($conn, $order);
                                                                 if($check){
                                                                      while($orderrow = mysqli_fetch_array(($check))){
                                                                           if($orderrow['partID'] != 0){
                                                                                $orderNumber = $orderrow['ordernumber'];
                                                                                $userID = $orderrow['userID'];
                                                                                $partID = $orderrow['partID'];
                                                                                $partQty = $orderrow['partQty'];
                                                                                $payment = $orderrow['paymentMethod'];
                                                                                $totalAmount = $orderrow['totalAmount'];
                                                                                $orderDate = $orderrow['date'];
                                                                                $date = strtotime($orderDate);
                                                                                $date = date("d/m/Y", $date);
                                                                                $status = $orderrow['sttus'];

                                                                                $selectpart = "SELECT * FROM pcpart WHERE pcPartID='$partID'";
                                                                                $checkselect = mysqli_query($conn, $selectpart);
                                                                                while($order = mysqli_fetch_array($checkselect)){
                                                                                     $partName = $order["partTitle"];
                                                                                     echo'
                                                                                          <tr>
                                                                                               <th>'.$orderNumber.'</th>
                                                                                               <th>'.$partName.'</th>
                                                                                               <th>'.$partQty.'</th>
                                                                                               <th>'.$totalAmount.'</th>
                                                                                               <th>'.$date.'</th>
                                                                                               <th>'.$payment.'</th>
                                                                                               <th>'.$status.'</th>
                                                                                               <th class="text-center"><a style="background:red;padding:7px 10px;border-radius:50%" href="myorders.php?order&delpartID='.$partID.'"><i class="fas fa-times text-white"></i></a></th>
                                                                                          </tr>
                                                                                     ';
                                                                                }
                                                                           }
                                                                      }
                                                                 }
                                                                 else{
                                                                      echo"Sql Connection problem";
                                                                 }
                                                            ?>
                                                       </tbody>
                                                  </table>
                                             <?php }?>

                                             <?php
                                                  $countquery = "SELECT * FROM orders WHERE userID='$userID' and pcID!=0;";
                                                  $check = mysqli_query($conn, $countquery);
                                                  $countpcorder = mysqli_num_rows($check);
                                                  //print($countpcorder);
                                             ?>
                                             <?php if($countpcorder != 0){?>
                                                  <!-- Part Orders Ends-->
                                                  <div><b>PC Order(s)</b></div>
                                                  <div class="mr-4 mt-sm">
                                                       <hr>
                                                  </div>
                                                  <!-- PC Orders Starts -->
                                                  <table class="content-table w-100 shadow-sm">
                                                       <thead>
                                                            <tr>
                                                                 <th>Order Number:</th>
                                                                 <th>PC Name:</th>
                                                                 <th>Quantity:</th>
                                                                 <th>Amount:</th>
                                                                 <th>Order Date:</th>
                                                                 <th>Payment</th>
                                                                 <th>Status</th>
                                                                 <th>Cancel Item</th>
                                                            </tr>
                                                       </thead>
                                                       <tbody class="text-left">
                                                            <?php
                                                                 $order = "SELECT * FROM orders WHERE userID='$userID'";
                                                                 $check = mysqli_query($conn, $order);
                                                                 if($check){
                                                                      while($orderrow = mysqli_fetch_array(($check))){
                                                                           if($orderrow['pcID'] != 0){
                                                                                $orderNumber = $orderrow['ordernumber'];
                                                                                $userID = $orderrow['userID'];
                                                                                $pcID = $orderrow['pcID'];
                                                                                $partQty = $orderrow['partQty'];
                                                                                $payment = $orderrow['paymentMethod'];
                                                                                $totalAmount = $orderrow['totalAmount'];
                                                                                $orderDate = $orderrow['date'];
                                                                                $date = strtotime($orderDate);
                                                                                $date = date("d/m/Y", $date);
                                                                                $pcstatus = $orderrow['sttus'];

                                                                                $selectpc = "SELECT * FROM pc_details WHERE pc_id='$pcID'";
                                                                                $checkselect = mysqli_query($conn, $selectpc);
                                                                                while($order = mysqli_fetch_array($checkselect)){
                                                                                     $pcName = $order["pcName"];
                                                                                     echo'
                                                                                          <tr>
                                                                                               <th>'.$orderNumber.'</th>
                                                                                               <th>'.$pcName.'</th>
                                                                                               <th>'.$partQty.'</th>
                                                                                               <th>'.$totalAmount.'</th>
                                                                                               <th>'.$date.'</th>
                                                                                               <th>'.$payment.'</th>
                                                                                               <th>'.$pcstatus.'</th>
                                                                                               <th class="text-center"><a style="background:red;padding:7px 10px;border-radius:50%" href="myorders.php?order&delpcID='.$pcID.'"><i class="fas fa-times text-white"></i></a></th>
                                                                                          </tr>
                                                                                     ';
                                                                                }
                                                                           }
                                                                      }
                                                                 }
                                                                 else{
                                                                      echo"Sql Connection problem";
                                                                 }

                                                            ?>
                                                       </tbody>
                                                  </table>
                                                  <!-- PC Orders Ends-->
                                             <?php }?>

                                             <?php
                                                  $countquery = "SELECT * FROM sbpc WHERE userID='$userID';";
                                                  $check = mysqli_query($conn, $countquery);
                                                  $countsborder = mysqli_num_rows($check);
                                                  //print($countsborder);
                                             ?>
                                             <?php if($countsborder != 0){?>
                                                  <div><b>System Builds Order(s)</b></div>
                                                  <div class="mr-4 mt-sm">
                                                       <hr>
                                                  </div>
                                                  <!-- Systembuild Order List -->
                                                  <table class="content-table w-100 shadow-sm">
                                                            <thead>
                                                                 <tr>
                                                                      <th>Order Number:</th>
                                                                      <th>User ID</th>
                                                                      <th>PC Name:</th>
                                                                      <th>Amount:</th>
                                                                      <th>Order Date:</th>
                                                                      <th>Payment:</th>
                                                                      <th>Status:</th>
                                                                      <th>Cancel Item</th>
                                                                 </tr>
                                                            </thead>
                                                            <tbody class="text-left">
                                                                 <?php
                                                                      $order = "SELECT * FROM sbpc";
                                                                      $check = mysqli_query($conn, $order);
                                                                      if($check){
                                                                           while($orderrow = mysqli_fetch_array(($check))){
                                                                                $sbpcID = $orderrow['sbPCID'];
                                                                                $orderNumber = $orderrow['orderNumber'];
                                                                                $userID = $orderrow['userID'];
                                                                                $pcName = $orderrow['pcName'];
                                                                                $payment = $orderrow['paymentMethod'];
                                                                                $orderDate = $orderrow['date'];
                                                                                $status = $orderrow['sttus'];
                                                                                $grandTotal = $orderrow['amount'];
                                                                                echo"
                                                                                     <tr>
                                                                                          <th>".$orderNumber."</th>
                                                                                          <th>".$userID."</th>
                                                                                          <th>".$pcName."</th>
                                                                                          <th>".$grandTotal."</th>
                                                                                          <th>".$orderDate."</th>
                                                                                          <th>".$payment."</th>
                                                                                          <th>".$status."</th>
                                                                                          <th class='text-center'><a style='background:red;padding:7px 10px;border-radius:50%' href='myorders.php?order&delsbID=".$sbpcID."'><i class='fas fa-times text-white'></i></a></th>
                                                                                     </tr>
                                                                                ";
                                                                           }
                                                                      }
                                                                      else{
                                                                           echo"Sql Connection problem";
                                                                      }

                                                                 ?>
                                                            </tbody>
                                                  </table>
                                                  <!-- Systembuild Order List -->
                                             <?php }?>
                                        <?php }else{?>
                                             <div class="p-1">Not yet ordered</div>
                                             <div style="color:gray" class="p-1">Click here to start your order,<a style='background:#28AB87'  class='ml-1 button-field text-deco-none shadow-sm' href='../index.php'>Shop Now</a></div>
                                             <div></div>
                                             <?php }?>
                                        
                                   
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     <!-- Content Ends -->

     <!-- Footer Starts  -->
          <div class="text-center">
               <div style="background:gray" class="pt-3 pb-3 d-flex flex-col">
                    <div class="d-flex jcc">
                         <div style="width:200px;" class="mr-2 mb-2">
                              <h3 align='left'>Categories</h3>
                              <div class='b-1 text-white mb-1'></div>
                              <div class="d-flex flex-col">
                                   <a class="text-deco-none py-sm text-black footer-hover" align="left" href="./builds/system-build.php">System build</a>
                                   <a class="text-deco-none py-sm text-black footer-hover" align="left" href="./builds/completed_build.php">Completed build</a>
                                   <a class="text-deco-none py-sm text-black footer-hover" align="left" href="#">Browse Product</a>
                              </div>
                         </div>
                         <div style="width:200px;" class="mr-2 mb-2">
                              <h3 align='left'>Company</h3>
                              <div class='b-1 text-white mb-1'></div>
                              <div class="d-flex flex-col">
                                   <a class="text-deco-none py-sm text-black footer-hover" align="left" href="about.php">About</a>
                                   <a class="text-deco-none py-sm text-black footer-hover" align="left"  href="contact.php">Contact Us</a>
                                   <a class="text-deco-none py-sm text-black footer-hover" align="left"  href="#">Terms & Policy</a>
                              </div>
                         </div>
                         <div style="width:300px;" class="mr-2 mb-2">
                              <h3 align='left'>Get the News</h3>
                              <div class='b-1 text-white mb-1'></div>
                              <div class="d-flex flex-col">
                                   <div style=" font-size:20px;" align='left'>Don't miss our latest update</div>
                                   <div>
                                        <form action="" method="post">
                                             <input type="text" placeholder="Enter your email..." style="border:none; padding:10px;margin-top:10px; border-radius:10px; float:left">
                                             <input type="submit" style="border:none; padding:10px;margin-top:10px; border-radius:10px;color:white; background:black; width:80px;">
                                        </form>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="b-1 text-white w-max-50 ml-50 mb-3"></div>
                    <div class="p-1">
                         <a class="m-1 b-1 b-rad-2 text-white p-1 footer-link" href="https://www.instagram.com/__mr.useless_404__/"><i class="fa fa-instagram"></i></a> 
                         <a class="m-1 b-1 b-rad-2 text-white p-1 footer-link" href="https://www.facebook.com/agnel.selv"><i class="fa fa-facebook"></i></a> 
                         <a class="m-1 b-1 b-rad-2 text-white p-1 footer-link" href="https://twitter.com/Agnel04454713"><i class="fa fa-twitter"></i></a> 
                         <a class="m-1 b-1 b-rad-2 text-white p-1 footer-link" href="https://www.youtube.com/channel/UCsj3TXPOn0Xn3XYTq-YBd8w?view_as=subscriber"><i class="fa fa-youtube"></i></a> 
                    </div>
                    <div>
                         <b><p class="mt-2 mb-1">&copy;2019 CompPicker, LLC All rights reserved.</p></b>
                         <b>Delveloped By: Mr.Use!ess, Myron, Elvis</b>
                         </div>
               </div>
          </div>
     <!-- Footer Ends -->
</body>
</html>