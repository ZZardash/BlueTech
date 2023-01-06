<?php
    require "./includes/dbh.inc.php";
    include('./functions/functions.php');
    session_start();
    $userID = $_SESSION['userId'];
    // print($userID);
    
    $selectQuery = "SELECT * FROM cart WHERE userID='$userID'";
    $check = mysqli_query($conn, $selectQuery);
    while ($row = mysqli_fetch_array($check)) {
        $partID = $row['productid'];
        $partquery = "SELECT * FROM pcpart WHERE pcPartID='$partID'";
        $checkpart = mysqli_query($conn, $partquery);
        $count = mysqli_num_rows($checkpart);
        while($partrow = mysqli_fetch_array($checkpart)){
            $grandTotal += $partrow['price'];
        }
    }

    $getCart = "SELECT * FROM pccart WHERE userid='$userID'";
    $runGetCart = mysqli_query($conn, $getCart);
    while($row = mysqli_fetch_array($runGetCart)){
        
        $productID = $row['pcid'];
        $quantity = 1;
        $getproduct = "SELECT * FROM pc_details WHERE pc_id='$productID'";
        $rungetProduct = mysqli_query($conn, $getproduct);
        while($productrow = mysqli_fetch_array($rungetProduct)){
                $grandTotal += $_SESSION['grandtotal'];
        }
    }

    if(isset($_GET['delaccount'])){
        $deleteaccount = "DELETE FROM users WHERE isUsers='$userID';";
        $check = mysqli_query($conn, $deleteaccount);

        $deleteorder = "DELETE FROM orders WHERE userID='$userID';";
        $checkorder = mysqli_query($conn, $deleteorder);

        $deletecart = "DELETE FROM cart WHERE userID='$userID'";
        $checkcart = mysqli_query($conn, $deletecart);

        $deletesb = "DELETE FROM sborders WHERE userID='$userID'";
        $checksb = mysqli_query($conn, $deletesb);

        $deletesbpc = "DELETE FROM sbpc WHERE userID='$userID'";
        $checksbpc = mysqli_query($conn, $deletesbpc);
        if($check and $checkorder and $checkcart and $checksb and $checksbpc){
            header("LOCATION: includes/logout.inc.php");
        }
        else{
            header("LOCATION: ./index.php");
        }
    }
?>
<!DOCTYPE html>
 <html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Computer-Store</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/png" href="img/favicon.png" >
        <link rel="stylesheet" href="./style.css">
        <link rel="stylesheet" href="./customstyle.css">
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
            function showHide(){
                var click = document.getElementById("dropdown-content");
                if(click.style.display === "none"){
                    click.style.display = "block";
                }
                else{
                    click.style.display = "none";
                }
                
            }
            function currentDiv(n) {
                showDivs(slideIndex = n);
            }
        </script>
    </head>
    <body>
        <!-- Navbar -->
            <div style="position:sticky;top:0px;z-index:1;height:8%;" class="d-flex flex-col w-100 white shadow-sm">
                <div class="d-flex  jcsb">
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
                                <li class="p-1"><a class="pl-1 text-deco-none text-black nav" href="index.php?home">Home</a></li>
                                <li class="p-1"><a class="pl-1 text-deco-none text-black nav" href="builds/system-build.php">SystemBuild</a></li>
                                <li class="p-1"><a class="pl-1 text-deco-none text-black nav" href="builds/completed_build.php">CompletedBuild</a></li>
                                <li class="p-1">
                                    <div class="dropdown">
                                        <a style="cursor:pointer" class="pl-1 text-deco-none text-black nav" onclick="showHide()">Catergories</a>
                                        <div style="display:none;" id="dropdown-content" class="dropdown-content shadow-sm text-center mr-2">
                                                <div class="d-flex flex-wrap p-sm">
                                                    <div style="background:#e0e0e0;" class="m-1" >
                                                        <a href="index.php?showpart=2">
                                                            <div class="d-flex flex-col">
                                                                <img width="100" src="./img/nav-cpu.png" alt="cpu">
                                                                <p class="text-center">CPU</p>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div style="background:#e0e0e0" class="m-1" >
                                                        <a href="index.php?showpart=1">
                                                            <div class="d-flex flex-col">
                                                                <img width="100" src="./img/nav-case.png" alt="case">
                                                                <p class="text-center">Case</p>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div style="background:#e0e0e0" class="m-1" >
                                                        <a href="index.php?showpart=5">
                                                            <div class="d-flex flex-col">
                                                                <img width="100" src="./img/nav-memory.png" alt="ram">
                                                                <p class="text-center">RAM</p>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div style="background:#e0e0e0" class="m-1" >
                                                        <a href="index.php?showpart=9">
                                                            <div class="d-flex flex-col">
                                                                <img width="100" src="./img/nav-ssd.png" alt="ssd">
                                                                <p class="text-center">Harddisk</p>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div style="background:#e0e0e0" class="m-1" >
                                                        <a href="index.php?showpart=6">
                                                            <div class="d-flex flex-col">
                                                                <img width="100" src="./img/nav-videocard.png" alt="videocard">
                                                                <p class="text-center">Graphics Card</p>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div style="background:#e0e0e0" class="m-1" >
                                                        <a href="index.php?showpart=7">
                                                            <div class="d-flex flex-col">
                                                                <img width="100" height="100" src="./img/nav-mouse.png" alt="mouse">
                                                                <p class="text-center">Mouse</p>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div style="background:#e0e0e0" class="m-1" >
                                                        <a href="index.php?showpart=8">
                                                            <div class="d-flex flex-col">
                                                                <img width="140" height="100" src="./img/nav-keyboard.png" alt="keyboard">
                                                                <p class="text-center">Keyboard</p>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div style="background:#e0e0e0" class="m-1" >
                                                        <a href="index.php?showpart=4">
                                                            <div class="d-flex flex-col">
                                                                <img width="140" height="100" src="./img/nav-monitor.png" alt="monitor">
                                                                <p class="text-center">Monitor</p>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div style="background:#e0e0e0" class="m-1" >
                                                        <a href="index.php?showpart=3">
                                                            <div class="d-flex flex-col">
                                                                <img width="140" height="100" src="./img/nav-motherboard.png" alt="motherboard">
                                                                <p class="text-center">Motherboard</p>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    
                                                </div>
                                                <div class="d-flex jcsa">
                                                    <div class="text-left m-1">
                                                        <a style="color:#28AB87" href="index.php?secpart">Second Hand Parts</a>
                                                    </div>
                                                    <div class="text-left m-1">
                                                        <a style="color:#28AB87" href="index.php?secpc">Second Hand PC</a>
                                                    </div>
                                                    
                                                </div>
                                        </div>
                                    </div>
                                </li>
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
            
                <div style=" background:gray">
                    <?php
                        $userName = $_SESSION['userUid'];
                        if($_SESSION['userId']){
                            echo'
                                <div class="p-sm '?><?php if(isset($_GET["close"])){echo "close";} echo'">
                                    <div style="">
                                        <div class="container d-flex flex-row jcc">
                                            <div style="background:#28AB87" class="text-white p-sm b-rad-2">
                                                Welcome! &nbsp; '?><?php echo $userName; echo'
                                            </div>
                                            '?>
                                            <?php
                                            if ($count == 0){
                                                echo'
                                                            <div class="text-white m-sm">Fill ur Bucket'?><?php echo $userName; echo'  ! Many offers are on!! </div>
                                                            <div class=" ml-2">
                                                                <a href="index.php?close">
                                                                    <button class="" style="padding:6px;color:#28AB87;" name="close">&#10006;</button>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                ';
                                            }
                                            else{
                                                echo'
                                                <div class="text-white m-sm">
                                                    '?><?php cartcount(); echo' Items in your cart
                                                </div>
                                                <div style="border:1px solid white; height:20px; margin:10px;"></div>
                                                <div class="text-white my-sm">
                                                    Total Price: &#8377; '?><?php echo $grandTotal; echo'
                                                </div>
                                                <div class=" ml-2">
                                                    <a href="index.php?close">
                                                        <button class="" style="padding:6px;color:#28AB87;" name="close">&#10006;</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                ';
                            }
                        }
                    ?>
                </div>
            </div>
        <!-- Navbar -->
        
        <!-- Content -->
            <div class="primary bg-color md-m-0 md-p-0 pt-1 sm-p-0">
                <div class="d-flex flex-col jcc">
                    <div class=" min-w-100 m-auto p-auto">
                    </div>
                    <div class="m-0 p-0 w-100">
                        <?php
                            if(isset($_GET['showpart'])){
                                $partKeyword = $_GET['showpart'];
                                $selectPartName = "SELECT * FROM pcpartcomp WHERE pcPartID='$partKeyword'";
                                $check = mysqli_query($conn, $selectPartName);
                                WHILE($row = mysqli_fetch_array($check)){
                                    $partName = $row['pcPartComponents'];
                                }
                        ?>
                        <h1 align="left" style="font-size:30px;" class="text-black pl-2 pb-0.5 pt-2"><b><?php echo $partName?></b></h1>
                        <div class="b-1 text-white mr-3 ml-2"></div>
                        <div class="d-flex flex-wrap jcc responsive-container">
                            <?php
                                $showpart = "SELECT * FROM pcpart WHERE partKeyword='$partKeyword'";
                                $check = mysqli_query($conn, $showpart);
                                while($row = mysqli_fetch_array($check)){
                                    $partID = $row['pcPartID'];
                                    echo "
                                        <div style='width:220px;' class='shadow-md responsive-card white b-rad-2 card-hover'>
                                            <a style='color:#28AB87' class='text-deco-none' href='details.php?part_det=".$partID."'>
                                            <div class='single-img'>
                                                <img class='img2 mt-1' src='admin/upload/".$row['image']."'/>
                                            </div>
                                            <div style='font-size:20px;' class='text-center'>";
                                                echo"<h4 class='m-1'>{$row['partTitle']}</h4></a><br>";
                                                echo"<div class='text-primary'>
                                                            <b></b>
                                                            <div class='m-1 text-black'><b>&#8377;{$row['price']}/-</b></div>
                                                    </div>
                                                    <div class='mx-sm'>
                                                    <div class='mb-3 mt-2 md-mt-2 d-flex jcsa md-flex-col'>
                                                            <div class='md-mb-2'><a style='background:#28AB87' class='button-field text-deco-none shadow-sm' href='details.php?part_det={$partID}'>Details</a></div>
                                                            <div><a style='background:#28AB87'  class='button-field text-deco-none shadow-sm' href='index.php?add_cart={$partID}'>AddToCart</a></div>
                                                    </div>
                                                    </div>
                                            </div>
                                        </div>
                                    ";
                                }
                            }
                            ?>
                        </div>
                    </div>
                    <div class="m-0 p-0 w-100">
                        <?php
                            if(isset($_GET['parts'])){
                                ?>
                                <h1 align="left" style="font-size:30px;" class="text-black pl-2 pb-0.5 pt-2"><b>System Parts</b></h1>
                                <div class="b-1 text-white mr-3 ml-2"></div>
                                <div class="d-flex flex-wrap jcc responsive-container">
                                <?php
                                    $query = "SELECT * FROM pcpart ORDER BY RAND() LIMIT 0,14;";
                                    $check = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_assoc($check)) {
                                         $partname = $row['partKeyword'];
                                         $partID = $row['pcPartID'];
                                         $discount = $row['price']*2;
                                         echo "
                                         <div style='width:250px;' class='d-flex responsive-card  flex-col mx-sm mt-1 white p-sm b-rad-1 shadow-md '>
                                              <div class='text-center single-img'>
                                                   <a style='color:#28AB87' class='text-deco-none transparent' href='details.php?part_det=".$partID."'>
                                                        <img width='200' height='200' src='admin/upload/".$row['image']."'/>
                                                   </a>
                                              </div>
                                              <div class='text-center p-1 ' >
                                                   <b><p style='color:gray;' class=''>{$row['partTitle']}</p></b>
                                                   <p style='font-size:18px;color:rgb(40,171,135)' class='my-sm'>&#8377;{$row['price']} <strike class='pl-1'>&#8377;{$discount}</strike></p>
                                                        <div class='d-flex jcc my-sm'>
                                                             <p style='font-size:16px;background:rgb(40,171,135);color:white' class='mr-sm px-1 py-sm b-rad-1 shadow-md'><a href='details.php?part_det={$partID}' class='text-deco-none text-white'>Details</a></p>
                                                             <p style='font-size:16px;background:rgb(40,171,135);color:white' class='mr-sm px-1 py-sm b-rad-1 shadow-md'><a class='text-deco-none text-white' href='index.php?add_cart={$partID}'>AddToCart</a></p>
                                                        </div>
                                              </div>
                                         </div>
                                         
                                         ";
                                    }
                                header("LOCATION: index.php");
                            }
                            elseif(isset($_GET['complete'])){
                                ?>
                                <h1 align="left" style="font-size:30px;" class="text-black px-3 pt-3 "><b>Completed Builds</b></h1>
                                <div class="b-1 text-white mr-3 ml-2"></div>
                                <div class="d-flex flex-wrap jcc">
                                <?php
                                $query = "SELECT * FROM pc_details ORDER BY RAND();";
                                $check = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($check)) {
                                     $p_id = $row['pc_id'];
                                     $discount = $row['pcPrice']*2;
                                     echo "
                                     <div style='width:250px;' class='d-flex responsive-card  flex-col mx-sm mt-1 white p-sm b-rad-1 shadow-md'>
                                          <a style='color:#28AB87' class='text-deco-none single-img' href='details.php?pc_det=".$p_id."'>
                                               <img class='img2 mt-1' src='./admin/upload/".$row['pc_image']."'/>
                                          </a>
                                          <p style='color:gray;' class='mt-1'>{$row['pcName']}</p>
                                          <p style='font-size:18px;color:rgb(40,171,135)' class='my-sm'>&#8377;{$row['pcPrice']} <strike class='pl-1'>&#8377;{$discount}</strike></p>
                                          
                                          <div class='d-flex jcc my-1'>
                                                <p style='font-size:16px;background:rgb(40,171,135);color:white' class='mr-sm px-1 py-sm b-rad-1'><a href='details.php?pc_det={$p_id}' class='text-deco-none text-white'>Details</a></p>
                                                <p style='font-size:16px;background:rgb(40,171,135);color:white' class='mr-sm px-1 py-sm b-rad-1'><a class='text-deco-none text-white' href='index.php?addpc_cart={$p_id}'>Add to cart<a></p>
                                          </div>
                                     </div>"
                                     ;} 
                            }
                            elseif(isset($_GET['secpart'])){
                                ?>
                                <h1 align="left" style="font-size:30px;" class="text-black pl-2 pb-0.5 pt-2"><b>2nd Parts</b></h1>
                                <div class="b-1 text-white mr-3 ml-2"></div>
                                <div class="d-flex flex-wrap jcc responsive-container">
                                <?php
                                    $query = "SELECT * FROM secndpart ORDER BY RAND() LIMIT 0,14;";
                                    $check = mysqli_query($conn, $query);
                                    while ($row = mysqli_fetch_assoc($check)) {
                                         $partname = $row['partKeyword'];
                                         $partID = $row['pcPartID'];
                                         $discount = $row['price']*2;
                                         echo "
                                         <div style='width:250px;' class='d-flex responsive-card  flex-col mx-sm mt-1 white p-sm b-rad-1 shadow-md '>
                                              <div class='text-center single-img'>
                                                   <a style='color:#28AB87' class='text-deco-none transparent' href='details.php?part_det=".$partID."'>
                                                        <img width='200' height='200' src='./account/".$row['image']."'/>
                                                   </a>
                                              </div>
                                              <div class='text-center p-1 ' >
                                                   <b><p style='color:gray;' class=''>{$row['partTitle']}</p></b>
                                                   <p style='font-size:18px;color:rgb(40,171,135)' class='my-sm'>&#8377;{$row['price']}</p>
                                                        <div class='d-flex jcc my-sm'>
                                                             <p style='font-size:16px;background:rgb(40,171,135);color:white' class='mr-sm px-1 py-sm b-rad-1 shadow-md'><a href='details.php?part_det={$partID}' class='text-deco-none text-white'>Details</a></p>
                                                             <p style='font-size:16px;background:rgb(40,171,135);color:white' class='mr-sm px-1 py-sm b-rad-1 shadow-md'><a class='text-deco-none text-white' href='index.php?add_cart={$partID}'>AddToCart</a></p>
                                                        </div>
                                              </div>
                                         </div>
                                         
                                         ";
                                    }
                                header("LOCATION: index.php");
                            }
                            else{
                        ?>
                        <h1 align="left" style="font-size:30px;" class="text-black pl-2 pb-0.5 pt-2"><b>System Parts</b></h1>
                        <div class="b-1 text-white mr-3 ml-2"></div>
                        <div class="d-flex flex-wrap jcc responsive-container">
                            <?php
                                $query = "SELECT * FROM pcpart ORDER BY RAND() ;";
                                $check = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($check)) {
                                        $partname = $row['partKeyword'];
                                        $partID = $row['pcPartID'];
                                        echo "
                                        <div style='width:270px;border:1px solid #D8D8D8' class='d-flex flex-col mx-sm mt-1 white p-sm b-rad-1 shadow-sm'>
                                            <div class='text-center'>
                                                <a style='color:#28AB87' class='text-deco-none transparent' href='details.php?part_det=".$partID."'>
                                                <div class='single-img'>
                                                        <img width='200' height='200' src='admin/upload/".$row['image']."'/>
                                                        </div>
                                                </a>
                                            </div>
                                            <div class='text-center p-1' >
                                                <p style='color:gray;' class=''>{$row['partTitle']}</p>
                                                <div class='m-1 text-black'><b>&#8377;{$row['price']}/-</b></div>
                                                <div class='mt-2'>
                                                        <div style='' class='d-flex  jcsa'>
                                                            <div class='md-mb-2'><a style='background:#28AB87' class='button-field text-deco-none shadow-sm' href='details.php?part_det={$partID}'>Details</a></div>
                                                            <div><a style='background:#28AB87'  class='button-field text-deco-none shadow-sm' href='index.php?add_cart={$partID}'>AddToCart</a></div>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        ";
                                }
                            ?>
                        </div>
                    </div>
                    <div class="ml-1 mr-1 p-0 w-100">
                        <h1 align="left" style="font-size:30px;" class="text-black px-3 pt-3 "><b>Completed Builds</b></h1>
                        <div class="b-1 text-white mr-3 ml-2"></div>
                            <div class="d-flex flex-wrap jcc">
                                    <?php
                                        getCompleteBuilts();
                                        }
                                    ?>
                            </div>
                        </div>
                    </div>
            </div>
      
<?php
    require "footer.php";
?>
<?php
    if (isset($_GET['add_cart'])) {
        $userID = $_SESSION['userId'];
        if($userID == 0){
            echo "<script>window.open('login.php?login=notlogin','_self')</script>";
        }
        else{
            $p_id = $_GET['add_cart'];
            $check_product = "SELECT * FROM cart WHERE userID='$userID' AND productid='$p_id';";
            $run_product = mysqli_query($conn, $check_product);
            $part_qty = 1;
            if (mysqli_fetch_array($run_product) > 0) {
                echo"<script>alert('This product has already added in cart')</script>";
                echo"<script>window.open('index.php','_self')</script>";
            } else {
                $query = "INSERT INTO cart(cID, userID, productid, quantity) VALUES (null, '$userID', '$p_id','$part_qty');";
                $check = mysqli_query($conn, $query);
                if($check){
                            echo"<script>window.open('index.php','_self')</script>";
                    
                }
            }
        }
    }
   if (isset($_GET['addpc_cart'])) {
    $userID=$_SESSION['userId'];
    $p_id = $_GET['addpc_cart'];
    $check_product = "SELECT * FROM pccart WHERE userid='$userID' AND pcid='$p_id';";
    $run_product = mysqli_query($conn, $check_product);
    if (mysqli_fetch_array($run_product) > 0) {
         echo"<script>alert('This product has already added in cart')</script>";
         echo"<script>window.open('index.php?pro_id=$p_id','_self')</script>";
    } else {
    $query = "INSERT INTO pccart VALUES (null, '$p_id', '$userID');";
    $check = mysqli_query($conn, $query);
    if($check){
         echo"<script>window.open('index.php?part_det='$p_id'','_self')</script>";
         }
    }
}
?>

<!-- <div style='width:220px;' class='shadow-md responsive-card white b-rad-2 card-hover'>
                                            <a style='color:#28AB87' class='text-deco-none' href='details.php?part_det=".$partID."'>
                                            <div class='single-img'>
                                                <img class='img2 mt-1' src='admin/upload/".$row['image']."'/>
                                            </div>
                                            <div style='font-size:20px;' class='text-center'>";
                                                echo"<h4 class='m-1'>{$row['partTitle']}</h4></a><br>";
                                                echo"<div class='text-primary'>
                                                            <b></b>
                                                            <div class='m-1 text-black'><b>&#8377;{$row['price']}/-</b></div>
                                                    </div>
                                                    <div class='mx-sm'>
                                                    <div class='mb-3 mt-2 md-mt-2 d-flex jcsa md-flex-col'>
                                                            <div class='md-mb-2'><a style='background:#28AB87' class='button-field text-deco-none shadow-sm' href='details.php?part_det={$partID}'>Details</a></div>
                                                            <div><a style='background:#28AB87'  class='button-field text-deco-none shadow-sm' href='index.php?add_cart={$partID}'>AddToCart</a></div>
                                                    </div>
                                                    </div>
                                            </div>
                                        </div> -->