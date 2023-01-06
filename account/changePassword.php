<?php
    require "../includes/dbh.inc.php";
    include('../functions/functions.php');
    session_start();
    $userID = $_SESSION['userId'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <style>
     </style>
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
     <title>Computer Store| Change Password</title>
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
     <div class="py-2 bg-color">
          <div class="container">
               <div class="container b-rad-2 shadow-sm white">
                    <?php
                         if(isset($_POST['update'])){
                              $userID = $_SESSION['userId'];
                              $pass = $_POST['pass'];
                              $repPass = $_POST['reppass'];

                              if($pass == $repPass){
                                   $hashedPwd = password_hash($pass, PASSWORD_DEFAULT);
                                   $update= "UPDATE users SET pwdUsers='$hashedPwd' WHERE isUsers='$userID';";
                                   $check = mysqli_query($conn, $update);
                                   if($check){
                                        header("LOCATION: changePassword.php?update=success");
                                   }
                                   else{
                                        header("LOCATION: changePassword.php?update=unsuccess");
                                   }
                              }
                              else{
                                   header("LOCATION: changePassword.php?pass=wrong");
                              }
                         }
                    ?>
                    <div class="p-2">
                         <div class="container">
                              <h1 style="color:#00342; font-size:20px;"  class="text-center">Change Passowrd?</h1>
                         </div>
                         <?php
                              if(isset($_GET['pass'])){
                                   if($_GET['pass'] == 'wrong'){
                                        echo'<div style="color:red; font-size:14px;" class="pt-1 text-center">Password incorrect!</div>';
                                   }
                              }
                              elseif(isset($_GET['update'])){
                                   if($_GET['update'] == 'success'){
                                        echo'<div style="color:green; font-size:14px;" class="pt-1 text-center">Password update sucessfull!</div>';
                                   }
                              }

                         ?>
                         <div style="font-size:18px;" class=" container">
                              <?php
                                   $selectuser = "SELECT * FROM users WHERE isUsers='$userID'";
                                   $check = mysqli_query($conn, $selectuser);
                                   while($row = mysqli_fetch_array($check)){
                                   $userName = $row['uidUsers'];
                                   // print($userName);
                                   ?>
                                   <form action="changePassword.php" method="POST" enctype="multipart/form-data">
                                        <div class="mt-2">
                                             <div class="text-center">
                                                  <input type="password" name="pass" placeholder="Enter your Password..." class="input-field-f b-rad-2">
                                             </div>
                                             <div class="text-center">
                                                  <input type="password" name="reppass" placeholder="Confirm your Password..." class="input-field-f b-rad-2">
                                             </div>
                                             <div class="text-center">
                                                  <button type="submit" name="update" class="b-rad-2 shadow-md editsubmit"><pre><img style="padding-right:5px;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAQAAABKfvVzAAAAAmJLR0QA/4ePzL8AAAFTSURBVDgRvcG9TpNhGADQx69pGaxu3ETLPagjDkRJ4RaIWqjsumLD0oRd04hyJ14ACgpVxi4QBq1DCdgjxe9Nf6LEiXPipilZtuPAz/gfFh3JRc5IK8bJbBratabiduQkrZhkE30rspjgjw8xySL67sUlFW0nuppKEYZ+GZiPESVHWIkwq+1C0oxAyyo6CpFYxq7MkmPjuhFaEW7ZRy0SO1iLsOTYuG7krOJtJA5RiUtmtV1IXkVOFZ1I/MCdyKloO9HVVIqcMnqR6KEc13AX3yNxiEpcwxwOIvEejbiiasu+np59W6pxxTq2I7GMj7IIL50bd+5FhII91CJR8g1PZN6Y9lqmjo5ijHiMvvsydaeSU89kHjgzsBCTNNH3VMGMhxoa5s0oqDvDRkyTaRr65LmqsrI56/YwsCGLv/HIV9M6FuLfFNW880VPz2fbaopxw34Dr2y+yb2Py6cAAAAASUVORK5CYII=">Update Now</pre></button>
                                             </div>
                                        </div>
                                   </form>
                              <?php  }?>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <!-- Content Ends -->

     <!-- Footer Starts  -->
     <?php require'../footer.php';?>
     <!-- Footer Ends -->
</body>
</html>
