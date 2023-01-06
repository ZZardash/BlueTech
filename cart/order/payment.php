<?php
    require "../../includes/dbh.inc.php";
    include('../../functions/functions.php');
    session_start();
    
?>

<!DOCTYPE html>
     <head>
          <meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <title>Computer-Store | Payment</title>
          <meta name="description" content="">
          <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../../style.css">
        <link rel="stylesheet" href="../../customstyle.css">
        <link rel="shortcut icon" type="image/png" href="../../img/favicon.png" >
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

          <!-- Content -->
          <div class="primary bg-color md-pt-1">
               <div class="container acc-container pt-1">
                    <div style=" height:45px; font-size:18px;" class="py-sm pl-2 my-1 b-rad-2 shadow-sm white text-left"><a style="color:#28AB87;" class="text-deco-none" href="../index.php">Home</a>  > My Cart</div>
                    <div class="d-flex jcc">
                         <div class="container acc-container white text-center mb-1">
                              <div style="background:#e0e0e0" class="p-1"><h1>Payment option</h1></div>
                              <?php
                                   if(isset($_GET['payment'])){
                                        if(isset($_GET['payment']) == "false"){
                                             echo'<div style="font-size:16px;color:red" class="mt-sm">Select a payment method</div>';
                                        }
                                   }
                                   if(isset($_GET['failure'])){
                                        echo'<div style="font-size:16px;color:red" class="mt-sm">
                                                  Online Payment failed! 
                                             </div>';
                                   }
                              ?>
                              
                              <div class="mt-1">
                                   <div class="container text-left">
                                        <div class="container">
                                        <?php 
                                             if(isset($_GET['sb'])){
                                                  $sbname = $_POST['sbname'];
                                                  $packing= $_POST['packing'];
                                                  //echo $packing;
                                                  echo'
                                                  <form action="order.php?sb&sbname='.$sbname.'&packing='.$packing.'" method="POST">
                                                  <div class="p-sm"><input type="radio" name="paymentmethod" value="onlinePayment">Online Payment(Payu)</div><hr>
                                                  <div class="p-sm"><input type="radio" name="paymentmethod" value="cod">Cash on delivery</div><hr>
                                                  <div class="text-center my-1">
                                                       <button name="payment" style="background:#28AB87"  class="button-field text-deco-none shadow-md" type="submit">Place order</button>
                                                  </div>
                                             </form>
                                                  ';
                                             }
                                             else{
                                                  echo'
                                                  <form action="order.php" method="POST">
                                                  <div class="p-sm"><input type="radio" name="paymentmethod" value="onlinePayment">Online Payment(Payu)</div><hr>
                                                  <div class="p-sm"><input type="radio" name="paymentmethod" value="cod">Cash on delivery</div><hr>
                                                  <div class="text-center my-1">
                                                       <button name="payment" style="background:#28AB87;width:200px;"  class="button-field text-deco-none shadow-md" type="submit">PlaceOrder</button>
                                                  </div>
                                             </form>
                                                  ';
                                             }
                                        ?>
                                        
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div>
                         <div class="mt-2">
                              <div style="" class="acc-container2 white p-1">
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
          </div>
          <!-- Content Ends -->
          <?php require'../../footer.php'?>
     </body>
</html>