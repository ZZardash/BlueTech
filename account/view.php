<?php
     require "../includes/dbh.inc.php";
     include('../functions/functions.php');
     session_start();
     $userID=$_SESSION['userId'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
     <title>Computer-Store | View </title>
</head>
<body class="bg-color">
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
     <div class="mx-2 mt-2">
          <div class="white p-sm w-100">
               <pre><a href="../index.php" class="text-deco-none" style="color:#28AB87">Home</a> > <a href="myaccount.php" class="text-deco-none" style="color:#28AB87">Account</a> > <a href="sellproduct.php" class="text-deco-none" style="color:#28AB87">2nd products</a> > View</pre>
          </div>
     </div>
     <?php
          if(isset($_GET['view'])){
               ?>
                    <?php
                         echo'<div>
                         <div class="min-w-full mx-2 mt-2 p-1 white shadow-sm">
                              <div class="d-flex jcsb">
                                   <div>Components</div>
                                   <div>Description</div>
                                   <div>Price</div>
                              </div>
                         </div>
                    </div>
                    
                    <div class="divider mx-2"></div>
                         <div class="mb-4 mx-2">
                              <div class="d-flex flex-col jcc shadow-md white">'?>
                              <?php
                              $query = "SELECT * FROM secndpart WHERE userID='$userID';";
                              $check = mysqli_query($conn, $query);
                              while ($row = mysqli_fetch_assoc($check)) {
                                        $partname = $row['partKeyword'];
                                        $partID = $row['pcPartID'];
                                        echo "
                                        <div style='min-width:90%;' class='b-rad-2 my-1'>
                                             <div style='font-size:20px;'>
                                                  <div class='d-flex jcsa'>
                                                       <div class='text-center single-img3'>
                                                            <img class='img3 mt-1' src='".$row['image']."'/>
                                                       </div>
                                                       <div style='width:300px;' ><h4 style='color:#28AB87' class='m-1'>{$row['partTitle']}</h4></div>
                                                       <div style='width:500px;'>{$row['partDesc']}</div>
                                                       <div class='text-primary'>
                                                            <div class='m-1 text-black'><b>&#8377;{$row['price']}/-</b></div>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                        <div class='divider mx-2'></div>
                                        ";
                              }
                              ?>
                         <?php echo'</div></div>'?>
               
               <?php
          }
     ?>
</body>
</html>