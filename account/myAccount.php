<?php
    require "../includes/dbh.inc.php";
    include('../functions/functions.php');
    session_start();
    $userID=$_SESSION['userId'];
?>
<!DOCTYPE html>
     <head>
          <meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <title>Computer-Store | My Account</title>
          <meta name="description" content="">
          <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/png" href="../img/favicon.png" >
        <link rel="stylesheet" href="../style.css">
        <link rel="stylesheet" href="../customstyle.css">
        <style>
             @media screen and (max-width:1680px){
               .big-container{
                    font-size:12px;
               }
             }
        </style>
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
     <!-- Navbar Starts -->
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

          <?php
               $userID=$_SESSION['userId'];
               $user_det = "SELECT * FROM users WHERE isUsers='$userID';";
               $run = mysqli_query($conn, $user_det);
               while($row = mysqli_fetch_array($run)){
                    $name = $row['uidUsers'];
                    $userImage = $row['userImage'];
                    $userEmail = $row['emailUsers'];
                    $userMobile = $row['mobNumber'];
               }
               ?>
          <div class="primary bg-color">
               <div class="container acc-container">
                    <div style=" height:45px; font-size:18px;" class="py-sm pl-2 my-1 b-rad-2 shadow-sm white text-left"><a style="color:#28AB87;" class="text-deco-none" href="../index.php">Home</a> > My Account</div>
                    <div class="d-flex sm-d-flex sm-flex-col ">
                         <div class="acc-container big-container container mr-1 ">
                              <?php
                                   if(isset($_GET['deleteAccount'])){
                                        echo'
                                        <div class="white shadow-sm p-1 mb-1">
                                             <div class="container">
                                                  <div style="font-size:16px;">Are you sure want to delete this account?</div>
                                                  <div class="container">
                                                       <div class="d-flex jcsa">
                                                            <div style="background:#28AB87;" class="px-1 py-sm mt-1  b-rad-1 shadow-sm"><a style="color:white;" class=" text-deco-none" href="../index.php?delaccount">Yes</a></div>
                                                            <div style="background:red;" class="px-1 py-sm mt-1  b-rad-1 shadow-sm"><a style="color:white;" class=" text-deco-none" href="myAccount.php">No</a></div>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>';
                                   }
                              ?>
                              <div style="width:100%;" class="container d-flex md-flex md-flex-col acc-container b-rad-2 shadow-sm ">
                                   <div style="background:#eeeeee; font-size:16px;" class="b-rad-2 pb-1"> 
                                        <div class="pt-1  text-center"><img style="width:90%;" class="b-rad-2 text-center" src="
                                             <?php
                                                  $selectimage = "SELECT * FROM users WHERE isUsers='$userID'";
                                                  $query = mysqli_query($conn, $selectimage);
                                                  while($row = mysqli_fetch_array($query)){
                                                       $pass = $row['pwdUsers'];
                                                       $image = $row['userImage'];
                                                       if(empty($pass)){
                                                            echo $row['userImage'];
                                                       }
                                                       else{
                                                            echo"../".$userImage;
                                                       }
                                                  }
                                             ?>" 
                                             alt="My photo"/>
                                        </div>
                                        <div class="text-left text-black pl-1">
                                             <div class="m-1 "><i style="padding-right:10px;" class="fas fa-user"></i>Name: <?php echo $name; ?> </div>
                                             <div class="m-1"><i style="padding-right:10px;" class="fas fa-envelope"></i>Email: <?php echo $userEmail; ?></div>
                                             <div class="m-1 "><i style="padding-right:10px;" class="fas fa-mobile"></i>Mobile: <?php echo $userMobile; ?> </div>
                                        </div>
                                   </div>
                                   <div style="font-size:24px;" class="white w-100 text-left p-lg">
                                        <div class="d-flex flex-col jcc">
                                             <div class="mt-2 mb-sm">
                                                  <a style="color:#28AB87" class="text-deco-none  font-change" href="myorders.php?order">
                                                       <i style="padding-right:20px; color:#28AB87" class="fas fa-list"></i> MyOrders
                                                  </a>
                                             </div>
                                             <div class="mt-2 mb-sm">
                                                  <a style="color:#28AB87" class="text-deco-none  font-change" href="sellproduct.php">
                                                       <i style="padding-right:20px; color:#28AB87" class="fas fa-exchange-alt"></i> Sell Second hand products
                                                  </a>
                                             </div>
                                             <div class="mt-2 mb-sm">
                                                  <a style="color:#28AB87" class="text-deco-none  font-change" href= "editaccount.php">
                                                       <i style="padding-right:20px; color:#28AB87" class="fas fa-edit"></i>Edit Account
                                                  </a>
                                             </div>
                                             <div class="mt-2 mb-sm">
                                                  <a style="color:#28AB87" class="text-deco-none  font-change" href="changePassword.php">
                                                       <pre><i style="padding-right:20px; color:#28AB87" class="fa fa-lock"></i>Change password</pre>
                                                  </a>
                                             </div>
                                             <div class="mt-2 mb-sm">
                                                  <a style="color:#28AB87" class="text-deco-none font-change" href="myAccount.php?deleteAccount">
                                                       <i style="padding-right:20px; color:#28AB87" style="padding-right:24px;" class="fas fa-trash"></i>Delete account
                                                  </a>
                                             </div>
                                             <div class="mt-2 mb-2">
                                                  <a style="color:#28AB87" class="text-deco-none font-change" href="../includes/logout.inc.php">
                                                       <i style="padding-right:20px; color:#28AB87" class="fa fa-sign-out"></i> Logout
                                                  </a>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                          </div>
                    </div>
               </div>
          </div>
          <script src="" async defer></script>
<?php require'../footer.php';?>
     </body>
</html>
