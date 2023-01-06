<?php
     include('./functions/functions.php');
     require"./includes/dbh.inc.php";
?>
<?php
     if(isset($_GET['part_det']) || isset($_GET['add_cart']) || isset($_GET['qty'])){
          if(isset($_GET['part_det'])){
               $productID = $_GET['part_det'];
          }
          else{
               $productID = $_GET['add_cart'];
          }
          $selQuery = "SELECT * FROM pcpart WHERE pcPartID='$productID'";
          $runQuery = mysqli_query($conn, $selQuery);
          $row = mysqli_fetch_array($runQuery);
          $image = $row['image'];
          $desc = $row['partDesc'];
          $qty = $row['qty'];
          $price = $row['price'];
          $partTitle = $row['partTitle'];
          $partName = $row['partKeyword'];
          $fetchQuery = "SELECT * FROM pcpartcomp WHERE pcPartID='$partName'";
          $fetchQuery = mysqli_query($conn, $fetchQuery);
          $fetchRow = mysqli_fetch_array($fetchQuery);
          $compName = $fetchRow['pcPartComponents'];
     }
     
     if (isset($_GET['add_cart'])) {
          $userID=$_SESSION['userId'];
          $part_qty = $_POST['quantity'];
          $p_id = $_GET['add_cart'];
          // print($p_id);
          if($userID == 0){
               header("LOCATION: login.php?login=notlogin");
          }
          else{
               $checkqty = "SELECT * FROM pcpart WHERE pcPartID='$p_id'";
               $checkqtypcpart = mysqli_query($conn, $checkqty);
               while($qtyrow = mysqli_fetch_array($checkqtypcpart)){
                    if($qtyrow['qty'] < $part_qty){
                         header("LOCATION: details.php?part_det=$p_id&outofstock");
                    }
                    else{
                         if($part_qty == 0){
                              header("LOCATION: details.php?part_det=$p_id&qty=no");
                         }
                         else{
                              $check_product = "SELECT * FROM cart WHERE userID='$userID' AND productid='$p_id';";
                              $run_product = mysqli_query($conn, $check_product);
                              if (mysqli_fetch_array($run_product) > 0) {
                                   echo"<script>alert('This product has already added in cart')</script>";
                                   echo"<script>window.open('details.php?part_det=$p_id','_self')</script>";
                              } else {
                              $query = "INSERT INTO cart VALUES (null, '$userID', '$p_id','$part_qty');";
                              $check = mysqli_query($conn, $query);
                              if($check){
                                   echo"<script>window.open('details.php?part_det='$p_id'','_self')</script>";
                                   }
                              }
                         }
                    }
               }
          }
     }
?>
<?php
     if(isset($_GET['pc_det']) || isset($_GET['addpc_cart'])){
          if(isset($_GET['pc_det'])){
               $productID = $_GET['pc_det'];
          }
          else{
               $productID = $_GET['addpc_cart'];
          }
          $selQuery = "SELECT * FROM pc_details WHERE pc_id='$productID'";
          $runQuery = mysqli_query($conn, $selQuery);
          $row = mysqli_fetch_array($runQuery);
          $image = $row['pc_image'];
          $partTitle = $row['pcName'];
          $price = $row['pcPrice'];
     }
     
     if (isset($_GET['addpc_cart'])) {
          $userID=$_SESSION['userId'];
          $p_id = $_GET['addpc_cart'];
          if($userID == 0){
               header("LOCATION: login.php?login=notlogin");
          }
          else{
               $check_product = "SELECT * FROM pccart WHERE userid='$userID' AND pcid='$p_id';";
               $run_product = mysqli_query($conn, $check_product);
               if (mysqli_fetch_array($run_product) > 0) {
                    echo"<script>alert('This product has already added in cart')</script>";
                    echo"<script>window.open('index.php?pro_id=$p_id','_self')</script>";
               } else {
               $query = "INSERT INTO pccart VALUES (null, '$p_id', '$userID');";
               $check = mysqli_query($conn, $query);
               if($check){
                    echo"<script>window.open('details.php?part_det='$p_id'','_self')</script>";
                    }
               }
          }
     }
     
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css" integrity="sha384-rtJEYb85SiYWgfpCr0jn174XgJTn4rptSOQsMroFBPQSGLdOC5IbubP6lJ35qoM9" crossorigin="anonymous">
     <link rel="stylesheet" type="text/css" href="js/jquery.exzoom.css" >
     <link rel="shortcut icon" type="image/png" href="img/favicon.png" >
     <title>Computer-Store | Details</title>
        <link rel="stylesheet" href="./style.css">
        <link rel="stylesheet" href="./customstyle.css">
        <style>
             .max-width-50{
               width: 400px;
             }
        </style>
</head>
<body>
     <div style="position:sticky;top:0px;z-index:1;height:8%;" class="d-flex flex-col w-100 white shadow-sm">
          <div class="d-flex jcsb">
               <div class="d-flex flex-row">
                    <div>
                         <a href="indexcopy.php"><img class="img1" src="img/cpu.png" alt=""></a>
                    </div>
                    <div class="hamburger">
                         <div class="line"></div>
                         <div class="line"></div>
                         <div class="line"></div>
                    </div>
                    <div class="menu">
                         <ul class="ls-none active current-item">
                              <li class="p-1"><a class="pl-1 text-deco-none text-black nav" href="index.php">Home</a></li>
                              <li class="p-1"><a class="pl-1 text-deco-none text-black nav" href="builds/system-build.php">SystemBuild</a></li>
                              <li class="p-1"><a class="pl-1 text-deco-none text-black nav" href="builds/completed_build.php">CompletedBuild</a></li>
                              <li class="p-1"><a class="pl-1 text-deco-none text-black nav" href="about.php">About</a></li>
                              <li class="p-1"><a class="pl-1 text-deco-none text-black nav" href="contact.php">Contact</a></li>
                         </ul>
                    </div>
                    <div>
                         <a class="toggle-nav" href="#">&#9776;</a>
                    </div>
               </div>
               <div class="mt-sm">
                    <?php
                         loginORnot();
                    ?>
               </div>
          </div>
     </div>
     <div class="container acc-container">
          <div class="w-min-100">
               <div style=" height:45px; font-size:18px;" class="py-sm pl-2 my-1 b-rad-2 shadow-sm white text-left"><a style="color:#28AB87;" class="text-deco-none" href="./index.php">Home</a> > Details > <a href="" style="color:#28AB87;" class="text-deco-none"><?php if(isset($_GET['part_det'])){ echo $compName ;} ?></a><a href="./builds/completed_build.php" style="color:#28AB87;" class="text-deco-none"><?php if(isset($_GET['pc_det']) || isset($_GET['addpc_cart'])){ echo "Completed Builds" ;} ?></a>   > <?php echo $partTitle;  ?></div>
          </div>
          <div class=" acc-container">
                    <div style="width:100%" class="d-flex flex-row md-d-flex md-flex-col">
                         <div class="d-flex mb-1 jcc">
                              <div style="max-width:100%;" class="text-left">
                                   <div class="exzoom" id="exzoom">
                                        <div class="exzoom_img_box">
                                             <ul class='exzoom_img_ul'>
                                                  <li><img class="max-width-50" src="admin/upload/<?php echo $image ; ?>" alt=""></li>
                                             </ul>
                                        </div>
                                   </div>
                              </div>
                              
                         </div>
                         <div style="width:100%" class="white shadow-md">
                              <div class=" white pt-1">
                                   <?php
                                        
                                   ?>
                                   <?php
                                        if(isset($_GET['qty'])){
                                             echo"<div class='text-center' style='color:red;font-size:14px;'>Enter some quantity!</div>";
                                        }
                                        if(isset($_GET['outofstock'])){
                                             echo"<div class='text-center' style='color:red;font-size:14px;'>Out of Stock!</div>";
                                        }
                                   ?>
                                   <h3 class=""><b><?php echo $partTitle; ?></b></h3>
                              </div>
                              <div class="mx-1 pb-1" style="font-size:18px;">
                                   <p><?php if(isset($_GET['part_det']) || isset($_GET['add_cart'])){ echo "
                                        <div class='text-left p-2'>$desc</div>
                                        <div style='color:gray;font-size:20px;' class='p-sm'><b>MRP: &#8377;$price</b></div>
                                        <div style='color:gray;font-size:20px;' class=' p-sm'>You Save:<strike>"?><?php echo $price/2; ?><?php echo"</strike></div>
                                        <div style='font-size:20px;'  class='p-sm'><b>Quantity:$qty</b></div>
                                        "; }?></p>
                                   <p class="text-left">
                                        <?php
                                             if(isset($_GET['pc_det']) || isset($_GET['addpc_cart'])){
                                                  echo"
                                                       <div class='pt-1 px-1'>
                                                            <h3 class='p-sm' style='background:#28AB87; color:white;'>Products Details</h3>
                                                       </div>
                                                       <table class='w-100 content-table text-left'>
                                                            <tr>
                                                                 <th class='p-sm'>PC Type</th>
                                                                 <th>{$row['PC_Type']}</th>
                                                            </tr>
                                                            <tr>
                                                                 <th class='p-sm'>Motherboard</th>
                                                                 <th>{$row['motherboard']}</th>
                                                            </tr>
                                                            <tr>
                                                                 <th class='p-sm'>Processor</th>
                                                                 <th>{$row['processor']}</th>
                                                            </tr>
                                                            <tr>
                                                                 <th class='p-sm'>Hard Disk</th>
                                                                 <th>{$row['hardDisk']}</th>
                                                            </tr>
                                                            <tr>
                                                                 <th class='p-sm'>RAM type</th>
                                                                 <th>{$row['ram_type']}</th>
                                                            </tr>
                                                            <tr>
                                                                 <th class='p-sm'>Ram Company</th>
                                                                 <th>{$row['ram_company']}</th>
                                                            </tr>
                                                            <tr>
                                                                 <th class='p-sm'>RAM Capacity</th>
                                                                 <th>{$row['ram_capacity']}</th>
                                                            </tr>
                                                            
                                                            <tr>
                                                                 <th class='p-sm'>Graphics Card</th>
                                                                 <th>{$row['graphics_card_type']}</th>
                                                            </tr>
                                                            <tr>
                                                                 <th class='p-sm'>Graphics Capacity</th>
                                                                 <th>{$row['graphics_card']}</th>
                                                            </tr>
                                                            <tr>
                                                                 <th class='p-sm'>Monitor</th>
                                                                 <th>{$row['monitor']}</th>
                                                            </tr>
                                                            <tr>
                                                                 <th class='p-sm'>Monitor Display Size(in INCH)</th>
                                                                 <th>{$row['monitor_display']}''</th>
                                                            </tr>
                                                            <tr>
                                                                 <th class='p-sm'>Keyboard Company</th>
                                                                 <th>{$row['keyboard_company']}</th>
                                                            </tr>
                                                            <tr>
                                                                 <th class='p-sm'>Mouse Company</th>
                                                                 <th>{$row['mouse_company']}</th>
                                                            </tr>
                                                            <tr>
                                                                 <th class='p-sm'>Speaker Company</th>
                                                                 <th>{$row['speakers']}</th>
                                                            </tr>
                                                       </table>

                                                  ";
                                             }
                                        ?>
                                   </p>
                                   <div class="p-1 aic">
                                   <div class="white p-sm">
                                        <div class="mb-1">
                                             <div class="container">
                                                  <h3>Add to cart</h3>
                                             </div>
                                        </div>
                                        <?php
                                        if(isset($_GET['part_det']) || isset($_GET['add_cart']) || isset($_GET['qty'])){
                                        echo'
                                             <div>
                                                  <form action="details.php?add_cart='?><?php echo $productID; echo'" method="POST">
                                                       <input class="input-field" type="number" name="quantity" placeholder="Enter quantity...">
                                                       <div><button style="background:#28AB87; color:white" class="px-1 py-sm mt-1 b-0 b-rad-1 fas fa-cart-plus">Add to cart</button></div>
                                                  </form>
                                             </div>
                                             
                                             ';
                                             
                                        }
                                        if(isset($_GET['pc_det']) || isset($_GET['addpc_cart'])){
                                             echo'
                                                       <div class="pt-sm">
                                                            &#8377; ';
                                                            echo $price;
                                                            echo'
                                                       </div>
                                                       <div class="m-1">
                                                            <a href="details.php?addpc_cart='.$productID.'" style="background:#28AB87; color:white" class="text-deco-none p-sm b-rad-1 shadow-md">
                                                                 <i style="padding-right:10px;color:white;" class="fas fa-cart-plus"></i>
                                                                 Add to cart
                                                            </a>
                                                       </div>
                                                  ';
                                                  
                                             }
                                        ?>
                                   </div>
                              </div>
                              </div>
                         </div>
                    </div>
               <div style="" class="white mt-1 p-1 b-rad-1 shadow-sm">
                        <b> Products You may also like</b>
               </div>
               <div class="mt-1">
                    <div class="d-flex flex-wrap jcsa">
                                    <?php
                                        if(isset($_GET['part_det'])){
                                             $query = "SELECT * FROM pcpart ORDER BY RAND() LIMIT 0,4";
                                             $check = mysqli_query($conn, $query);
                                             while ($row = mysqli_fetch_assoc($check)) {
                                                  $partname = $row['partKeyword'];
                                                  $partID = $row['pcPartID'];
                                                  echo "
                                                       <div style='width:220px;' class='shadow-md white b-rad-2 card-hover'>
                                                            <a style='color:#28AB87' class='text-deco-none' href='details.php?part_det=".$partID."'>
                                                            <div class='single-img'>
                                                                 <img class='img2 mt-1' src='admin/upload/".$row['image']."'/>
                                                            </div>
                                                            <div style='font-size:20px;' class='text-center'>
                                                                 <h4 class='m-1'>{$row['partTitle']}</h4></a><br>
                                                                 <div class='text-primary'>
                                                                      <div class='m-1 text-black'><b>&#8377;{$row['price']}/-</b></div>
                                                                 </div>
                                                                 <div class='mx-sm'>
                                                                 <div class='mb-3 mt-2 md-mt-2 d-flex jcsa md-flex-col'>
                                                                      <div class='md-mb-2'><a style='background:#28AB87' class='button-field text-deco-none shadow-md' href='details.php?part_det={$partID}'>Details</a></div>
                                                                      <div><a style='background:#28AB87'  class='button-field text-deco-none shadow-md' href='index.php?add_cart={$partID}'>AddToCart</a></div>
                                                                 </div>
                                                                 </div>
                                                       </div>
                                                       </div>
                                                  ";
                                             }
                                        }
                                    ?>
                    <?php
                         if(isset($_GET['pc_det'])){
                              $query = "SELECT * FROM pc_details ORDER BY RAND() LIMIT 0,4;";
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
                    ?>
               </div>
               </div>
          </div>
     </div>
     <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
     <script src="js/jquery.exzoom.js"></script>
     <script>
               $(function(){

                    $("#exzoom").exzoom({
                    "autoPlay":true,
                    "navWidth": 60,
                    "navHeight": 60,
                    "navItemNum": 5,
                    "navItemMargin": 7,
                    "navBorder": 1,
                    "autoPlayTimeout": 2000

                    });

          });
     </script>
<?php
     require"footer.php";
?>