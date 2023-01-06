<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <style>
          .admin-pic{
               width:250px;
               height:250px;
          }
     </style>
</head>
<?php
error_reporting(0);
include("../includes/dbh.inc.php");
     $adminID = $_SESSION['adminID'];
     //print($adminID);

     $selectadmin = "SELECT * FROM admins WHERE adminID='$adminID';";
     $checkadmin = mysqli_query($conn, $selectadmin);
     if($row = mysqli_fetch_array($checkadmin)){
          $adminName = $row['adminName'];
          $adminEmail = $row['adminEmail'];
     }
     
     if(isset($_GET['deleteadmin'])){
          // print($adminID);
          session_unset($_SESSION['adminID']);
          session_unset($_SESSION['adminName']);
          session_destroy($_SESSION['adminID']);
          session_destroy($_SESSION['adminName']);
          $deleteAdmin = "DELETE FROM admins WHERE adminID='$adminID'";
          $checkdelete = mysqli_query($conn, $deleteAdmin);
          echo"<script>window.open('admin.php','_self')</script>";
     }
     if(isset($_GET['delacc'])){
          // print($adminID);
          ?>
          <div class="container">
               <div class="container">
                    <div class="white mt-2 p-1">
                         <div class="container">
                              <h3>Are you sure want to delete the account?</h3>
                              <div class="d-flex jcsb">
                                   <a style="padding:10px 14px;margin-top:20px;background:#28AB87;font-size:20px; border:none; color:white;" class="b-rad-1 shadow-md text-deco-none" href="dashboard.php?setting&deleteadmin">
                                        <i class="fa fa-check pr-sm"></i>
                                        Yes
                                   </a>
                                   <a href="dashboard.php?setting" style="color:white; background:red;" class="mt-1 py-sm px-1 b-rad-1 text-deco-none shadow-md" >
                                        <i class="fa fa-times pr-sm"></i>
                                        No
                                   </a>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
          <?php

          
     }
?>
<body>
     <div class="mt-3">
         <div class="container">
               <div class="d-flex flex-col">
                    <div class="container">
                         <div class="d-flex jcsb">
                              <div style="background:#28AB87" class="py-sm px-1 b-rad-1 shadow-sm">
                                   <a class="text-deco-none text-white" href="dashboard.php?setting&adminprofile"><pre>My Profile</pre></a>
                              </div>
                              <div style="background:#28AB87" class="py-sm px-1 b-rad-1 shadow-sm">
                                   <a class="text-deco-none text-white" href="dashboard.php?setting&editacc"><pre>Edit Account</pre></a>
                              </div>
                              <div style="background:#28AB87" class="py-sm px-1 b-rad-1 shadow-sm">
                                   <a class="text-deco-none text-white" href="dashboard.php?setting&updatepwd"><pre>Update Password</pre></a>
                              </div>
                         </div>
                    </div>
                    <div class="my-2" >
                         <div class="container">
                              <?php 
                                   if(isset($_GET['updatepwd'])){
                                        ?>
                                        <center>
                                             <?php
                                                  error_reporting(0);
                                                  if(isset($_POST['update'])){
                                                       $adminID = $_SESSION['adminID'];
                                                       $pass = $_POST['pass'];
                                                       $repPass = $_POST['reppass'];
                                                       if($pass == $repPass){
                                                            $hashedPwd = password_hash($pass, PASSWORD_DEFAULT);
                                                            $update= "UPDATE admins SET adminPassword='$hashedPwd' WHERE adminID='$adminID';";
                                                            $check = mysqli_query($conn, $update);
                                                            if($check){
                                                                 header("LOCATION: dashboard.php?setting&updatepwd&update=success");
                                                            }
                                                            else{
                                                                 header("LOCATION: dashboard.php?setting&updatepwd&update=unsuccess");
                                                            }
                                                       }
                                                       else{
                                                            header("LOCATION: dashboard.php?setting&updatepwd&pass=wrong");
                                                       }
                                                  }
                                             ?>
                                             <div class="white m-1 p-1 shadow-sm b-rad-1">
                                                  <div class="m-1 p-1">
                                                       <b style="">Change Password</b>
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
                                                  <div class="container">
                                                       <form action="" method="POST" enctype="multipart/form-data">
                                                            <div class="mt-2">
                                                                 <div class="text-center">
                                                                      <input type="password" name="pass" placeholder="Enter your Password..." class="input-field-f b-rad-2">
                                                                 </div>
                                                                 <div class="text-center">
                                                                      <input type="password" name="reppass" placeholder="Confirm your Password..." class="input-field-f b-rad-2">
                                                                 </div>
                                                                 <div class="text-center">
                                                                      <button style="background:#28AB87;color:white;" type="submit" name="update" class="b-rad-2 py-sm px-1 shadow-md"><pre><i class="fa fa-pencil-alt pr-sm" aria-hidden="true"></i>Update Now</pre></button>
                                                                 </div>
                                                            </div>
                                                       </form>
                                                  </div>
                                             </div>
                                        </center>
                                        <?php
                                   }
                                   elseif(isset($_GET['editacc'])){
                                        ?>
                                        <?php
                                             if(isset($_POST['updateadmin'])){
                                                  $adminID = $_SESSION['adminID'];
                                                  // print($adminID);
                                                  $name = $_POST['adminname'];
                                                  $email = $_POST['adminemail'];
                                                  // print($name);
                                                  // print($email);
                                                  $file = $_FILES['file'];
                                                  //print($file);
                                                  $fileName = $_FILES['file']['name'];
                                                  $fileTmpName = $_FILES['file']['tmp_name'];
                                                  $folder = $fileName;
                                                  move_uploaded_file($fileTmpName,'img/'.$folder);
                                                  // print($folder);
                                        
                                                  $updateadmin = "UPDATE admins SET adminName='$name', adminEmail='$email', adminImage='$folder' WHERE adminID='$adminID';";
                                                  $checkadmin = mysqli_query($conn, $updateadmin);
                                                  if($checkadmin){
                                                       header("LOCATION: dashboard.php?setting&editacc&update=success");
                                                  }
                                                  else{
                                                       header("LOCATION: dashboard.php?setting&editacc&update=unsuccess");
                                                  }
                                        
                                             }
                                        ?>
                                        <div class="white shadow-sm b-rad-2 p-1">
                                             <h3 class="text-center">Edit Your Account</h3>
                                             <form action="" method="POST" enctype="multipart/form-data">
                                                  <div class="mt-2">
                                                       <input type="hidden" name="size" value="1000000">
                                                       <div class="mb-2 text-center">
                                                            <input type="file" name="file" value="<?php echo $row['adminImage'] ?>">
                                                       </div>
                                                       <div class="text-center">
                                                            <input type="text" name="adminname" placeholder="Enter your name..." value="<?php echo $adminName; ?>" class="input-field-f b-rad-2">
                                                       </div>
                                                       <div class="text-center">
                                                            <input type="text" name="adminemail" placeholder="Enter your email..." value="<?php echo $row['adminEmail']; ?>" class="input-field-f b-rad-2">
                                                       </div>
                                                       <div class="text-center">
                                                            <button style="background:#28AB87;color:white;" type="submit" name="updateadmin" class="b-rad-2 py-sm px-1 shadow-md"><pre><i class="fa fa-pencil-alt pr-sm" aria-hidden="true"></i>Update Now</pre></button>
                                                       </div>
                                                  </div>
                                             </form>
                                        </div>
                                        <?php
                                   }
                                   else{
                                             ?>
                                             <center>
                                                  <div class="white shadow-sm p-1 b-rad-1">
                                                       <div class="py-1 sm-m-0">
                                                            <?php
                                                                 if(empty($adminImage)){
                                                                      ?>
                                                                           <img class="b-rad-rnd admin-pic" src="../img/unknown.png" alt="Unknown">
                                                                      <?php
                                                                 }
                                                                 else{
                                                                      ?>
                                                                      <img class="b-rad-rnd admin-pic" src="./img/<?php echo $adminImage ?>" alt="">
                                                                      <?php
                                                                 }
                                                            ?>
                                                       </div>
                                                       <div class="container">
                                                            <div class="container">
                                                                 <div class="p-sm text-left">
                                                                      <b>Name:</b><?php echo $adminName ?>
                                                                 </div>
                                                                 <div class=" text-left p-sm">
                                                                      <b>Email:</b><?php echo $adminEmail; ?>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </center>
                                             <?php
                                   }
                              ?>
                              <div class="mt-1">
                                   <div class="d-flex jcc">
                                        <div style="background:red" class="py-sm px-1 b-rad-1 shadow-sm">
                                             <a class="text-deco-none text-white" href="dashboard.php?setting&delacc"><pre>Delete Account</pre></a>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
         </div> 
     </div>
</body>
</html>