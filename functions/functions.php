<?php
error_reporting(0);
include('../includes/dbh.inc.php');
session_start();

//begin getRealIpUser ///

function getRealIpUser(){
     switch(true){
          case(!empty($_SERVER['HTTP_X_REAL_IP'])) : return $_SERVER['HTTP_X_REAL_IP'];
          case(!empty($_SERVER['HTTP_CLIENT_IP'])): return $_SERVER['HTTP_CLIENT_IP'];
          case(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])): return $_SERVER['HTTP_X_FORWARDED_FOR'];

          default: return $_SERVER['REMOTE_ADDR'];
     }
}

//End getRealIpUser ///


// Begin Add Cart//

//End Add Cart


// function getpcPart(){
//      global $conn;
//      $query = "SELECT * FROM pcpart;";
//      $check = mysqli_query($conn, $query);
//      while ($row = mysqli_fetch_assoc($check)) {
//           $partname = $row['partKeyword'];
//           $partID = $row['pcPartID'];
//           echo "
//           <div style='width:13%;'  class='mt-2 mr-2 fade-in shadow-md white b-rad-5'>
//                <img class='img2 mt-1' src='admin/upload/".$row['image']."'/>
//                <div style='font-size:20px;' class='text-center'>";
//                $q = "SELECT * FROM pcpartcomp WHERE pcPartID = '$partname';";
//                $connect = mysqli_query($conn, $q);
//                if($connect){
//                     while($partrow = mysqli_fetch_row($connect)){
                         
//                     }
                    
//                }
//                echo"<h4 class='m-1'>{$row['partTitle']}</h4><br>";
//                echo"<div class='text-primary'>
//                          <b></b>
//                          <p>Quantity:{$row['qty']}</p>
//                          <div class='m-1'><b style='color:#28AB87'>&#8377;{$row['price']}/-</b></div>
//                     </div>
//                     <div class='mb-3 mt-2'>
//                          <a class='button-field text-deco-none shadow-md' href='details.php?part_det={$partID}'>Details</a>
//                          <a class='button-field text-deco-none shadow-md' href='index.php?add_cart={$partID}'>Add to cart</a>
//                     </div>
//           </div>
//           </div>
//           ";
//      }
     
// }
function getCompleteBuilts(){
     $query = "SELECT * FROM pc_details;";
     global $conn;
     $check = mysqli_query($conn, $query);
     while ($row = mysqli_fetch_assoc($check)) {
          $p_id = $row['pc_id'];
          echo "
          <div style='width:240px;' class='shadow-md responsive-card text-center white m-1 p-1 b-rad-2 card-hover'>
          <a style='color:#28AB87' class='text-deco-none' href='details.php?pc_det=".$p_id."'>
               <div class='single-img'>
               <img class='img2 mt-1' src='./admin/upload/".$row['pc_image']."'/><br>
               </div>
               <h3 class='m-1'>{$row['pcName']}</h3></a>
               <div style='font-size:24px;'  class='text-black p-1'>
                    <b>&#8377;  {$row['pcPrice']}</b>
               </div>
               <div class='my-1'>
               <a style='background:#28AB87' class='button-field text-deco-none shadow-md' href='details.php?pc_det={$p_id}'>Details<a>
               <a style='background:#28AB87' class='button-field text-deco-none shadow-md' href='index.php?addpc_cart={$p_id}'>Add to cart<a></div>
          </div>"
          ;} 
}

function loginORnot(){
     if(isset($_SESSION['userId'])){
          echo'<form action="includes/logout.inc.php" method="post">
          <div class="d-flex jcfe">
          <div class="cart-btn">
               <div style="font-size:30px;" class="nav-icon"><a href="./cart/cart.php"><i style="color:black;" class="fas fa-cart-plus"></i></a></div>
               <div class="cart-items">'?><?php cartcount(); echo'</div>
          </div>
          <div style="font-size:30px; padding:0 15px;" class="text-black"><a class="text-black" href="account/myAccount.php?acc"><div class="mx-1" ><i class="fas fa-user-circle"></i>a</div></a></div>
          <div style="margin-top:10px;"><a class="text-deco-none signup-button-field mr-2 text-black pr-1" href="includes/logout.inc.php" name="logout-submit">Logout</a></div>
          </div>
          </form>';
      }
      else{
          echo'
          <div class="container d-flex flex-row jcfe">
              <div style="margin-top:10px;"><a class="text-deco-none signup-button-field mr-2 text-black pr-1" href="signup.php">Signup</a></div>
              <div style="margin-top:10px;"><a class="text-deco-none text-black pr-1 mr-2 nav loginphp" href="login.php">Login</a></div>
          </div>
          ';
      }
}


function getMainPageCompletedBuilds(){
     
     $query = "SELECT * FROM pc_details;";
     global $conn;
     $check = mysqli_query($conn, $query);
     while ($row = mysqli_fetch_assoc($check)) {
          $p_id = $row['pc_id'];
          echo "
          <div style='width:270px;' class='fade-in shadow-md text-center white m-1 p-1 b-rad-5'>
               <img class='img2 mt-1' src='../admin/upload/".$row['pc_image']."'/><br>
               <a style='color:#28AB87' class='text-deco-none' href='../details.php?pc_det=".$p_id."'><h3 style='margin-top:20px;'>{$row['pcName']}</h3></a>
               <div style='font-size:14px;' class='text-primary p-1'>
                    <b>Desktop Type:</b>{$row['PC_Type']}
                    <p align='left'><b>Motherboard:</b>{$row['motherboard']}</p><p align='left'>
                    <b>Processor:</b>{$row['processor']}</p>
                    <p align='left'><b>
                    Price:&#8377;</b>{$row['pcPrice']}</p><p align='left'><b>
                    Harddisk Volume:</b> {$row['hardDisk']}GB</p><p align='left'><b>
                    Monitor Company:</b> {$row['monitor']}</p><p align='left'><b>
                    Monitor Display:</b> {$row['monitor_display']}''</p><p align='left'><b>
                    Graphics Card Type:</b> {$row['graphics_card_type']}<p align='left'><b>
                    GC Capacity:</b> {$row['graphics_card']}GB</p><p align='left'><b>
                    Keyboard Company:</b>{$row['keyboard_company']}</p><p align='left'><b>
                    Mouse Company:</b>{$row['mouse_company']}</p><p align='left'><b>
                    Speaker Company:</b> {$row['speakers']}</p><p align='left'><b>
                    Ram Type:</b> {$row['ram_type']}</p><p align='left'><b>
                    Ram Company:</b> {$row['ram_company']}</p><p align='left'><b>
                    Ram Capacity:</b> {$row['ram_capacity']}GB</p>
                    <div style='font-size:24px;'  class='text-black p-1'>
                         <b>&#8377;  {$row['pcPrice']}</b>
                    </div>
               </div>
               <div class='my-1'>
               <a style='background:#28AB87' class='button-field text-deco-none shadow-md' href='../details.php?pc_det={$p_id}'>Details<a>
               <a style='background:#28AB87' class='button-field text-deco-none shadow-md' href='./completed_build.php?addpc_cart={$p_id}'>Add to cart<a>
               </div>
          </div>"
          ;} 
}

//getcartcount

function cartcount(){
     global $conn;
     $userID=$_SESSION['userId'];
     $selectQuery = "SELECT * FROM cart WHERE userID='$userID'";
     $runQuery = mysqli_query($conn, $selectQuery);
     $count = mysqli_num_rows($runQuery);
     
     $countCart = "SELECT * FROM pccart WHERE userid='$userID'";
     $countQuery = mysqli_query($conn, $countCart);
     $count += mysqli_num_rows($countQuery);
     echo $count;
}

//finish

?>