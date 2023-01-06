<?php
     require "../includes/dbh.inc.php";
     include('../functions/functions.php');
     session_start();
     $userID=$_SESSION['userId'];
     if(isset($_POST['uploadpart'])){
          $file = $_FILES['file'];
          //print_r($file);
          $fileName = $_FILES['file']['name'];
          $fileTmpName = $_FILES['file']['tmp_name'];
          //print_r($fileTmpName);

          $folder = "2ndproduct/part".$fileName;
          move_uploaded_file($fileTmpName, $folder);

          $partTitle = $_POST['productTitle'];
          $partKeyword = $_POST['ComponentName'];
          $partDesc = $_POST['description'];
          $qty = $_POST['qty'];
          $price = $_POST['price'];
          $insertQuery = "INSERT INTO secndpart VALUES(NULL, '$userID', '$partTitle', '$folder', '$partKeyword', '$partDesc', '$qty', '$price');";
          $checkInsert = mysqli_query($conn, $insertQuery);
          if($checkInsert){
               echo'<script>alert("Upload Successfull")</script>';
          }
          else{
               echo'<script>alert("Upload Successfull")</script>';

          }
     }
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
     <title>Computer-Store | Sell </title>
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
                              <div style="width:100%;" class="container d-flex md-flex md-flex-col acc-container">
                                   <div class="m-1">
                                        <div style="font-size:24px;" class="white w-100 text-left b-rad-2 shadow-md p-4">
                                             <div class="d-flex flex-col jcc">
                                                  <div class="mt-2 mb-sm">
                                                       <a style="color:#28AB87" class="text-deco-none  font-change" href="sellproduct.php?sellpart">
                                                            <pre><i style="padding-right:20px; color:#28AB87" class="fas fa-list"></i>Sell Part</pre>
                                                       </a>
                                                  </div>
                                                  <div class="mt-2 mb-sm">
                                                       <a style="color:#28AB87" class="text-deco-none  font-change" href="sellproduct.php?sellpc">
                                                            <pre><i style="padding-right:20px; color:#28AB87" class="fas fa-exchange-alt"></i> Sell PC</pre>
                                                       </a>
                                                  </div>
                                                  <div class="mt-2 mb-sm">
                                                       <a style="color:#28AB87" class="text-deco-none  font-change" href= "view.php?view">
                                                            <pre><i style="padding-right:20px; color:#28AB87" class="fas fa-edit"></i>View Products</pre>
                                                       </a>
                                                  </div>
                                                  <div class="mt-2 mb-sm">
                                                       <a style="color:#28AB87" class="text-deco-none font-change" href="sellproduct.php?update">
                                                            <pre><i style="padding-right:20px; color:#28AB87" style="padding-right:24px;" class="fas fa-refresh"></i>Update Products</pre>
                                                       </a>
                                                  </div>
                                                  <div class="mt-2 mb-sm">
                                                       <a style="color:#28AB87" class="text-deco-none  font-change" href="sellproduct.php?delete">
                                                            <pre><i style="padding-right:20px; color:#28AB87" style="padding-right:24px;" class="fas fa-trash"></i>Delete Products</pre>
                                                       </a>
                                                  </div>
                                                  <div class="mt-2 mb-sm">
                                                       <a style="color:#28AB87" class="text-deco-none  font-change" href="myaccount.php">
                                                            <pre><i style="padding-right:20px; color:#28AB87" style="padding-right:24px;" class="fas fa-back"></i>Back to account</pre>
                                                       </a>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="m-1">
                                        <div style="font-size:24px;" class="white w-100 shadow-md b-rad-2 text-left h-100 p-4">
                                             <?php
                                                  if(isset($_GET['sellpart'])){
                                             ?>
                                             <div class="d-flex flex-col jcc">
                                                  <div class=" text-left">
                                                       <div class="  p-2 b-rad-2">
                                                            <h3 class="text-center">Upload PC Part Details</h3>
                                                            <?php
                                                                 if(isset($_GET['data'])){
                                                                      if($_GET['data'] == "success"){
                                                                           echo"<p style='color:green; font-size:12px;'>Upload successfull!</p>";
                                                                      }
                                                                      else{
                                                                           echo"<p style='color:red; font-size:12px;'>Upload unsuccessfull!</p>";
                                                                      }
                                                                 }
                                                                 if(isset($_GET['error'])){
                                                                      if($_GET['error'] == "emptyfield"){
                                                                           echo"<p style='color:red; font-size:12px;'>Please do fill all required details</p>";
                                                                      }
                                                                 }
                                                            ?>
                                                            <div class="pt-2">
                                                                 <form method="POST" enctype="multipart/form-data">
                                                                      <table>
                                                                           <tr>
                                                                                <th style="font-size:16px;"><b>Choose a file:</b></th>
                                                                                <th>
                                                                                <input type="hidden" name="size" value="1000000">
                                                                                <div class="p-1">
                                                                                     <input class="chse_file" type="file" name="file">
                                                                                </div>
                                                                           </th>
                                                                           </tr>
                                                                           <tr>
                                                                                <th style="font-size:16px;"><b>Product Keyword : </b></th>
                                                                                <th>
                                                                                     <select name="ComponentName" id="" style="margin-bottom:10px; border-radius:5px; background: #181818;color: #fff;padding: 10px;margin-left:20px;height:35px;font-size: 12px;outline: none;">
                                                                                     <option value="selectAnOption">selectAnOption</option>
                                                                                     <?php
                                                                                          $query = "SELECT * FROM pcpartcomp;";
                                                                                          $check = mysqli_query($conn, $query);
                                                                                          if($check){
                                                                                               while($row = mysqli_fetch_array($check)){
                                                                                                    $pcPartID = $row['pcPartID'];
                                                                                                    echo"<option value='$pcPartID'>{$row['pcPartComponents']}</option>";
                                                                                               }
                                                                                          }
                                                                                          else{
                                                                                               echo"<p style='color:red; font-size:12px;'>Somthing went wrong! Please try again</p>";
                                                                                          }
                                                                                     ?>
                                                                                     </select>
                                                                                </th>
                                                                           </tr>
                                                                           <tr>
                                                                                <th style="font-size:16px;"><b>Product Title:</b></th>
                                                                                <th>
                                                                                     <input class="input-field-l" type="text" name="productTitle" placeholder="Enter product title...">
                                                                                </th>
                                                                           </tr>
                                                                           <tr>
                                                                                <th style="font-size:16px;"><b>Product description:</b></th>
                                                                                <th class="pl-1">
                                                                                     <textarea rows="5" cols="50" class="input-field-l" name="description" placeholder="Enter the description..."></textarea>
                                                                                </th>
                                                                           </tr>
                                                                           <tr>
                                                                                <th style="font-size:16px;"><b>Enter Quantity</b></th>
                                                                                <th><input class="input-field-l" type="number" name="qty" placeholder="Enter Quantity..."></th>
                                                                           </tr>
                                                                           <tr>
                                                                                <th style="font-size:16px;">Enter Price:</th>
                                                                                <th><input class="input-field-l" type="number" name="price" placeholder="Enter Price..."></th>
                                                                           </tr>
                                                                      </table>
                                                                      <div class="text-center mt-1">
                                                                           <input class="btn button-field text-deco-none" type="submit" name="uploadpart" value="Upload">
                                                                      </div>
                                                                 </form>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>
                                             <?php
                                                  }
                                                  
                                                  else{
                                                       ?>
                                                            <div>
                                                                 <pre>Welcome <?php echo $name;?>! Start selling your products here</pre>
                                                                 <div class="mt-1 text-center">
                                                                 <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="350px" height="350px" viewBox="0 0 510 510" style="enable-background:new 0 0 510 510;" xml:space="preserve"><g><g>
                                                                           <g id="mood">
                                                                                <path d="M255,0C114.75,0,0,114.75,0,255s114.75,255,255,255s255-114.75,255-255S395.25,0,255,0z M344.25,153    c20.4,0,38.25,17.85,38.25,38.25s-17.85,38.25-38.25,38.25S306,211.65,306,191.25S323.85,153,344.25,153z M165.75,153    c20.4,0,38.25,17.85,38.25,38.25s-17.85,38.25-38.25,38.25s-38.25-17.85-38.25-38.25S145.35,153,165.75,153z M255,408    c-66.3,0-122.4-43.35-142.8-102h285.6C377.4,364.65,321.3,408,255,408z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#28AB87"/>
                                                                           </g>
                                                                      </g></g>
                                                                 </svg>
                                                                 </div>
                                                            </div>
                                                       <?php
                                                  }
                                             ?>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
          
</body>
</html>
<?php
     require"../footer.php";
?>