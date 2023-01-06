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
        <link rel="shortcut icon" type="image/png" href="../img/favicon.png" >
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
     <title>Computer Store| Edit Account</title>
</head>
<body>
     <!-- Navbar Starts -->
          <div style="position:sticky;top:0px;z-index:1;height:8%;" class="d-flex flex-col w-100 white">
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
                                   $username = $_POST['username'];
                                   $email = $_POST['email'];
                                   $address = $_POST['address'];
                                   $city = $_POST['city'];
                                   $country = $_POST['country'];
                                   $mobnumber = $_POST['mobnumber'];
                                   $state = $_POST['state'];

                                   $file = $_FILES['file'];
                                   //print($file);
                                   $fileName = $_FILES['file']['name'];
                                   //print($fileName);
                                   // print($country);
                                   // print($username);
                                   // print($email);
                                   // print($address);
                                   // print($mobnumber);
                                   $fileTmpName = $_FILES['file']['tmp_name'];
                                   $folder = "user/userimages/".$fileName;
                                   move_uploaded_file($fileTmpName, "../".$folder);

                                   $update= "UPDATE users SET uidUsers='$username',emailUsers='$email', mobNumber='$mobnumber', address='$address', country='$country',
                                        state='$state', userImage='$folder' WHERE isUsers='$userID';
                                   ";
                                   $check = mysqli_query($conn, $update);
                                   if($check){
                                        header("LOCATION: myAccount.php?editAccount?update=success");
                                   }
                                   else{
                                        header("LOCATION: myAccount.php?editAccount?update=unsuccess");
                                   }
                              }
                         ?>
                         <div class="p-2">
                              <div class="container">
                                   <h1 style="color:#00342; font-size:20px;"  class="text-center">Edit Your Account</h1>
                              </div>
                              <div style="font-size:18px;" class=" container">
                                   <?php
                                        $selectuser = "SELECT * FROM users WHERE isUsers='$userID'";
                                        $check = mysqli_query($conn, $selectuser);
                                        while($row = mysqli_fetch_array($check)){
                                        $userName = $row['uidUsers'];
                                        // print($userName);
                                        ?>
                                        <form action="editaccount.php" method="POST" enctype="multipart/form-data">
                                             <div class="mt-2">
                                                  <input type="hidden" name="size" value="1000000">
                                                  <div class="mb-2 text-center">
                                                       <input type="file" name="file" value="<?php echo $row['userImage'] ?>">
                                                  </div>
                                                  <div class="text-center">
                                                       <input type="text" name="username" placeholder="Enter your name..." value="<?php echo $userName; ?>" class="input-field-f b-rad-2">
                                                  </div>
                                                  <div class="text-center">
                                                       <input type="text" name="email" placeholder="Enter your email..." value="<?php echo $row['emailUsers']; ?>" class="input-field-f b-rad-2">
                                                  </div>
                                                  <div class="text-center">
                                                       <textarea name='address' placeholder="Enter your Address..." class="input-field-f b-rad-2"><?php echo $row['address']; ?></textarea>
                                                  </div>
                                                  <div class="text-center">
                                                       <input type="text" name="country" placeholder="Enter your Country..." value="<?php echo $row['country']; ?>" class="input-field-f b-rad-2">
                                                  </div>
                                                  <div class="text-center">
                                                       <input type="text" name="state" placeholder="Enter your State..." value="<?php echo $row['state']; ?>" class="input-field-f b-rad-2">
                                                  </div>
                                                  <div class="text-center">
                                                       <input type="text" name="mobnumber" placeholder="Enter your Mobile number..." value="<?php echo $row['mobNumber']; ?>" class="input-field-f b-rad-2">
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
     <!-- Footer Ends -->
</body>
</html>
