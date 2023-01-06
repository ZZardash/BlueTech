<?php
     error_reporting(0);
     session_start();
     $adminID = $_SESSION['adminID'];
     require("../includes/dbh.inc.php");
     $count = 0;
     $selectcount = "SELECT * FROM orders";
     $check = mysqli_query($conn, $selectcount);
     $row = mysqli_num_rows($check);
     $count = $count + $row;
     
     $selectcount = "SELECT * FROM sbpc";
     $check = mysqli_query($conn, $selectcount);
     $row = mysqli_num_rows($check);
     $count = $count + $row;

     if($count > 9){
          $count = "9+";
     }
     // print($adminID);
     if(isset($_GET['logout'])){
          session_unset($_SESSION['adminID']);
          session_unset($_SESSION['adminName']);
          session_destroy($_SESSION['adminID']);
          session_destroy($_SESSION['adminName']);
          header("Location: admin.php");
          // print($_SESSION['adminID']);
     }
     $adminID = $_SESSION['adminID'];
     // print($adminID);
     $selectadmin = "SELECT * FROM admins WHERE adminID='$adminID';";
     $checkadmin = mysqli_query($conn, $selectadmin);
     if($row = mysqli_fetch_array($checkadmin)){
          $adminName = $row['adminName'];
          $adminEmail = $row['adminEmail'];
          $adminImage = $row['adminImage'];
     }
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="shortcut icon" type="image/png" href="img/favicon.png" >
     <link rel="stylesheet" href="../style.css">
     <link rel="stylesheet" href="../customstyle.css">
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css" integrity="sha384-rtJEYb85SiYWgfpCr0jn174XgJTn4rptSOQsMroFBPQSGLdOC5IbubP6lJ35qoM9" crossorigin="anonymous">
     <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
     <title>Computer-Store | Admin Panel</title>
     <style>
          body{
               font-family: Verdana, Geneva, Tahoma, sans-serif;
               overflow-x: hidden;
          }
          *{
               margin: 0px;
               padding: 0px;
          }
          .admin-font{
               font-size:24px;
               font-weight:bold
          }
          .page{
               display: grid;
               grid-template-columns: 20vw auto;
          }
          .sidebar{
               top: 3rem;
               min-height:100vh;
               position: fixed;
               width: 15vw;
               color: white;
               letter-spacing: 2px;
               background: #28AB87;
          }
          .main{
               grid-column-start: 2;
          }
          .sidebar-divider{
               border-top: 1px solid rgba(255,255,255,.15);
          }
          .slidebar-font{
               font-size: 18px;
          }
          .navbar{
               min-width: 100vw;
               background: white;
               height: 8vh;
          }
          .profile-img{
               width:50px;
               height:50px;
          }
          .res-nav-icon{
               font-size:28px;
          }
          .res-cart-items{
               font-size: 16px;
               position: absolute;
               top: -6px;
               right: -10px;
               background: #28AB87;
               padding: 2px 5px;
               border-radius: 30%;
               color: white;
          }
          #accordion section .collapsable-content{
               display: none;
               text-align: center;
               transition: 0.3s; 
          }
          #accordion section:target .collapsable-content{
               display: block;
          }
          @media screen and (max-width:600px){
               .profile-img{
                    width:35px;
                    height:35px;
               }
               .res-nav-icon{
                    font-size:20px;
               }
               .res-cart-items{
                    font-size: 12px;
                    position: absolute;
                    top: -6px;
                    right: -10px;
                    background: #28AB87;
                    padding: 0px 3px;
                    border-radius: 30%;
                    color: white;
               }
               .admin-font{
                    font-size:16px;
                    font-weight:bold;
               }
               
               .sidebar{
                    min-height:100vh;
                    font-size:16px !important;
                    width: 10rem;
                    color: white;
                    letter-spacing: 2px;
                    background: #28AB87;
               }
          }
     </style>
</head>
<body class="bg-color">
     <main class="bg-color">
          <div class="d-flex">
               <!-- Slidebar -->
                    <div class="sidebar pt-1">
                         <div class="text-center admin-font mt-2">
                              <a href="dashboard.php" class="text-deco-none text-white"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" focusable="false" width="0.97em" height="1em" style="-ms-transform: rotate(360deg); -webkit-transform: rotate(360deg); transform: rotate(360deg);" preserveAspectRatio="xMidYMid meet" viewBox="0 0 496 512"><path d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm141.4 389.4c-37.8 37.8-88 58.6-141.4 58.6s-103.6-20.8-141.4-58.6C68.8 359.6 48 309.4 48 256s20.8-103.6 58.6-141.4C144.4 76.8 194.6 56 248 56s103.6 20.8 141.4 58.6c37.8 37.8 58.6 88 58.6 141.4s-20.8 103.6-58.6 141.4zM328 164c-25.7 0-55.9 16.9-59.9 42.1-1.7 11.2 11.5 18.2 19.8 10.8l9.5-8.5c14.8-13.2 46.2-13.2 61 0l9.5 8.5c8.5 7.4 21.6.3 19.8-10.8-3.8-25.2-34-42.1-59.7-42.1zm-160 60c17.7 0 32-14.3 32-32s-14.3-32-32-32-32 14.3-32 32 14.3 32 32 32zm194.4 64H133.6c-8.2 0-14.5 7-13.5 15 7.5 59.2 58.9 105 121.1 105h13.6c62.2 0 113.6-45.8 121.1-105 1-8-5.3-15-13.5-15z" fill="#fff"/></svg>ADMIN PANEL</a>
                         </div>
                         <div class="slidebar-font mt-3">
                              <div class="sidebar-divider m-1"></div>
                              <!-- Dashboard Starts -->
                                   <div class="ml-1 text-left">
                                   <i class="fas fa-tachometer-alt pr-sm"></i><a class="text-deco-none text-white" href="dashboard.php">Dashboard</a>
                                   </div>
                              <!-- Dashboard Ends -->
                              <div class="sidebar-divider m-1"></div>
                              <!-- Order Request Starts -->
                                   <div class="ml-1" id="accordion">
                                        <section id="order">
                                             <a class="text-deco-none text-white" href="#order"><i class="fa fa-shopping-cart pr-sm"></i>Order Request</a>
                                             <div class="collapsable-content white px-1 mr-1 mt-sm b-rad-2">
                                                  <div class="py-1 text-left">
                                                       <a style="color: #28AB87;" class="text-deco-none" href="dashboard.php?partorder">Part Order</a>
                                                  </div>
                                                  <div class="pb-1 text-left">
                                                       <a style="color: #28AB87;" class="text-deco-none" href="dashboard.php?pcorder">PC Order</a>
                                                  </div>
                                                  <div class="pb-1 text-left">
                                                       <a style="color: #28AB87;" class="text-deco-none" href="dashboard.php?sborder">Systembuild Order</a>
                                                  </div>
                                             </div>
                                        </section>
                                   </div>
                              <!-- Order Request Endss -->
                              <div class="sidebar-divider m-1"></div>
                              <!-- Order Request Starts -->
                                   <div class="ml-1" id="accordion">
                                        <section id="delivered">
                                             <a class="text-deco-none text-white" href="#delivered"><i class="fa fa-shopping-cart pr-sm"></i>Delivered Order</a>
                                             <div class="collapsable-content white px-1 mr-1 mt-sm b-rad-2">
                                                  <div class="py-1 text-left">
                                                       <a style="color: #28AB87;" class="text-deco-none" href="dashboard.php?deliveredpart">Delivered Part</a>
                                                  </div>
                                                  <div class="pb-1 text-left">
                                                       <a style="color: #28AB87;" class="text-deco-none" href="dashboard.php?deliveredpc">Delivered PC</a>
                                                  </div>
                                                  <div class="pb-1 text-left">
                                                       <a style="color: #28AB87;" class="text-deco-none" href="dashboard.php?deliveredsb">Delivered Systembuild</a>
                                                  </div>
                                             </div>
                                        </section>
                                   </div>
                              <!-- Order Request Endss -->
                              <div class="sidebar-divider m-1"></div>
                              <!-- Upload Product Starts -->
                                   <div class="ml-1" id="accordion">
                                        <section id="upload">
                                             <a class="text-deco-none text-white" href="#upload"><i class="fa fa-edit mr-sm"></i>Upload Products</a>
                                             <div class="collapsable-content white px-1 mr-1 mt-sm b-rad-2">
                                                  <div class="py-1 text-left">
                                                       <a style="color: #28AB87;" class="text-deco-none" href="dashboard.php?uploadpcpart">Upload PC Parts</a>
                                                  </div>
                                                  <div class="pb-1 text-left">
                                                       <a style="color: #28AB87;" class="text-deco-none" href="dashboard.php?uploadpc">Upload PC</a>
                                                  </div>
                                             </div>
                                        </section>
                                   </div>
                              <!-- Upload Product Ends -->
                              <div class="sidebar-divider m-1"></div>
                              <!-- Delete Product Starts -->
                                   <div class="ml-1 " id="accordion">
                                        <section id="delete">
                                             <a class="text-deco-none text-white" href="#delete"><i class="fa fa-trash mr-sm"></i>Delete Products</a>
                                             <div class="collapsable-content white px-1 mr-1 mt-sm b-rad-2">
                                                  <div class="py-1 text-left">
                                                       <a style="color: #28AB87;" class="text-deco-none" href="dashboard.php?delpcpart">Delete PC Parts</a>
                                                  </div>
                                                  <div class="pb-1 text-left">
                                                       <a style="color: #28AB87;" class="text-deco-none" href="dashboard.php?delpc">Delete PC</a>
                                                  </div>
                                             </div>
                                        </section>
                                   </div>
                              <!-- Delete Product Endss -->
                              <div class="sidebar-divider m-1"></div>
                              <!-- Update Starts -->
                                   <div class="ml-1" id="accordion">
                                        <section id="update">
                                             <a class="text-deco-none text-white" href="#update"><i class="fa fa-edit mr-sm"></i>Update Products</a>
                                             <div class="collapsable-content white px-1 mr-1 mt-sm b-rad-2">
                                                  <div class="py-1 text-left">
                                                       <a style="color: #28AB87;" class="text-deco-none" href="dashboard.php?updatepcpart">Update PC Parts</a>
                                                  </div>
                                             </div>
                                        </section>
                                   </div>
                              <!-- Update Ends -->
                              <div class="sidebar-divider m-1"></div>
                              <!-- View Starts-->
                                   <div class="ml-1" id="accordion">
                                        <section id="view">
                                             <a class="text-deco-none text-white" href="#view"><i class="fa fa-eye mr-sm"></i>View Products</a>
                                             <div class="collapsable-content white px-1 mr-1 mt-sm b-rad-2">
                                                  <div class="py-1 text-left">
                                                       <a style="color: #28AB87;" class="text-deco-none" href="dashboard.php?pcpart">View PC Parts</a>
                                                  </div>
                                                  <div class="pb-1 text-left">
                                                       <a style="color: #28AB87;" class="text-deco-none" href="dashboard.php?pc">View PC</a>
                                                  </div>
                                                  <div class="pb-1 text-left">
                                                       <a style="color: #28AB87;" class="text-deco-none" href="dashboard.php?secpart">View 2ND Part</a>
                                                  </div>
                                             </div>
                                        </section>
                                   </div>
                              <!-- View Ends -->
                              <div class="sidebar-divider m-1"></div>
                              <!-- Dashboard Starts -->
                                   <div class="ml-1 text-left">
                                        <a class="text-deco-none text-white" href="dashboard.php?onlinetransaction"><pre><i class="fa fa-credit-card mr-sm" aria-hidden="true"></i>Online Transaction</pre></a>
                                   </div>
                              <!-- Dashboard Ends -->
                         </div>
                    </div>
               <!-- Slidebar Ends-->
               <div>
                    <!-- Navbar Starts-->
                         <div style="position:sticky;top:0px;z-index:1;" class="navbar shadow-sm p-sm">
                              <div class="d-flex jcfe aic">
                                   <div class="d-flex flex-row">
                                        <div class="px-1 mt-sm">
                                             <div class="cart-btn">
                                                  <div class="nav-icon res-nav-icon" ><a style="color:gray" class="text-deco-none" href="dashboard.php?partorder"><i class="fa fa-bell"></i></a></div>
                                                  <div class="res-cart-items"><?php echo $count; ?></div>
                                             </div>
                                        </div>
                                        <div class="mx-sm"><div style="min-height:5vh; border:1px solid #e0e0e0 "></div></div>
                                        <div id="accordion">
                                             <section id="account">
                                                  <a class="text-deco-none" href="#account">
                                                       <div class="d-flex flex-row">
                                                            <div class="mx-1 mt-sm">
                                                                 <b style="color: #28AB87;"><?php echo $adminName; ?></b>
                                                            </div>
                                                            <div class="mx-1 sm-m-0">
                                                                 <?php
                                                                      if(empty($adminImage)){
                                                                           ?>
                                                                                <img class="b-rad-rnd profile-img" src="../img/unknown.png" alt="Unknown">
                                                                           <?php
                                                                      }
                                                                      else{
                                                                           ?>
                                                                           <img class="b-rad-rnd profile-img" src="./img/<?php echo $adminImage ?>" alt="">
                                                                           <?php
                                                                      }
                                                                 ?>
                                                            </div>
                                                       </div>
                                                  </a>
                                                  <div class="collapsable-content white px-1 mr-1 mt-1 shadow-lg b-rad-2" style="font-size:18px;">
                                                       <div class="py-1 text-left">
                                                            <a style="color: #28AB87;" class="text-deco-none" href="dashboard.php?setting&adminprofile"><i class="fa fa-cog pr-sm"></i> Settings</a>
                                                       </div>
                                                       <div class="pb-1 text-left">
                                                            <a style="color: #28AB87;" class="text-deco-none" href="dashboard.php?logout"><i class="fas fa-sign-out-alt pr-sm"></i>Log Out</a>
                                                       </div>
                                                  </div>
                                             </section>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    <!-- Navbar Ends-->
                    <div class="page">
                         <div class="main">
                              <?php
                                   if(isset($_GET['pcpart']) || isset($_GET['pc']) || isset($_GET['secpart'])){
                                        include("view.php");
                                   }
                                   elseif(isset($_GET['delpcpart']) || isset($_GET['delpc'])){
                                        include("delete.php");
                                   }
                                   elseif(isset($_GET['updatepcpart']) || isset($_GET['updatepc'])){
                                        include("update.php");
                                   }
                                   elseif(isset($_GET['uploadpcpart']) || isset($_GET['uploadpc'])){
                                        include("upload.php");
                                   }
                                   elseif(isset($_GET['deliveredpart']) || isset($_GET['deliveredpc']) || isset($_GET['deliveredsb'])){
                                        include("delivered.php");
                                   }
                                   elseif(isset($_GET['partorder']) || isset($_GET['pcorder']) || isset($_GET['sborder']) ){
                                        include("order.php");
                                   }
                                   elseif(isset($_GET['setting'])){
                                        include("setting.php");
                                   }
                                   elseif(isset($_GET['onlinetransaction'])){
                                        include("onlinetrans.php");
                                   }
                                   else{
                                        include("dashboardcopy.php");
                                   }
                              ?>
                         </div>
                    </div>
               </div>

          </div>
     </main>
</body>
</html>