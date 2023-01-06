<?php
    require "../includes/dbh.inc.php";
    include("../functions/functions.php");
    session_start();
?>
<?php
    if(isset($_GET['addPart'])){
        $partID = $_GET['addPart'];
        $partPrice = $_GET['price'];
        $partKeyword = $_GET['keyword'];
        $userID = $_SESSION['userId'];
        $discount = $partPrice * 0.25;
        if($userID == 0){
            header("LOCATION: ../login.php?login=notlogin");
        }
        else{
            $insert = "INSERT INTO systembuild VALUES(NULL, '$userID', '$partKeyword', '$partID', '$partPrice', '$discount')";
            $check = mysqli_query($conn, $insert);
            if($check){
                header("LOCATION: system-build.php");
            }
        }
    }
    if(isset($_GET['delPart'])){
        $partID = $_GET['delPart'];
        $partKeyword = $_GET['keyword'];
        $userID = $_SESSION['userId'];
        $delete = "DELETE FROM systembuild WHERE partID='$partID'";
        $check = mysqli_query($conn, $delete);
        if($check){
            header("LOCATION: system-build.php");
        }
    }
    if(isset($_GET['delsb'])){
        $userID = $_SESSION['userId'];
        $deletesb = "DELETE FROM systembuild WHERE userID='$userID'";
        $deletequery = mysqli_query($conn, $deletesb);
        if($deletequery){
            header("LOCATION: system-build.php");
        }
    }
?>

<!DOCTYPE html>
 <html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Computer-Store | System-Build</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/png" href="../img/favicon.png" >
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
                                <li class="p-1"><a class="pl-1 text-deco-none text-black nav" href="system-build.php">SystemBuild</a></li>
                                <li class="p-1"><a class="pl-1 text-deco-none text-black nav" href="completed_build.php">CompletedBuild</a></li>
                                <li class="p-1">
                                    <div class="dropdown">
                                        <a style="cursor:pointer" class="pl-1 text-deco-none text-black nav" onclick="showHide()">Catergories</a>
                                        <div style="display:none;" id="dropdown-content" class="dropdown-content shadow-sm text-center mr-2">
                                                <div class="d-flex flex-wrap p-sm">
                                                    <div style="background:#e0e0e0;" class="m-1" >
                                                        <a href="../index.php?showpart=2">
                                                            <div class="d-flex flex-col">
                                                                <img width="100" src="../img/nav-cpu.png" alt="cpu">
                                                                <p class="text-center">CPU</p>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div style="background:#e0e0e0" class="m-1" >
                                                        <a href="../index.php?showpart=1">
                                                            <div class="d-flex flex-col">
                                                                <img width="100" src="../img/nav-case.png" alt="case">
                                                                <p class="text-center">Case</p>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div style="background:#e0e0e0" class="m-1" >
                                                        <a href="../index.php?showpart=5">
                                                            <div class="d-flex flex-col">
                                                                <img width="100" src="../img/nav-memory.png" alt="ram">
                                                                <p class="text-center">RAM</p>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div style="background:#e0e0e0" class="m-1" >
                                                        <a href="../index.php?showpart=9">
                                                            <div class="d-flex flex-col">
                                                                <img width="100" src="../img/nav-ssd.png" alt="ssd">
                                                                <p class="text-center">Harddisk</p>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div style="background:#e0e0e0" class="m-1" >
                                                        <a href="../index.php?showpart=6">
                                                            <div class="d-flex flex-col">
                                                                <img width="100" src="../img/nav-videocard.png" alt="videocard">
                                                                <p class="text-center">Graphics Card</p>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div style="background:#e0e0e0" class="m-1" >
                                                        <a href="../index.php?showpart=7">
                                                            <div class="d-flex flex-col">
                                                                <img width="100" height="100" src="../img/nav-mouse.png" alt="mouse">
                                                                <p class="text-center">Mouse</p>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div style="background:#e0e0e0" class="m-1" >
                                                        <a href="../index.php?showpart=8">
                                                            <div class="d-flex flex-col">
                                                                <img width="140" height="100" src="../img/nav-keyboard.png" alt="keyboard">
                                                                <p class="text-center">Keyboard</p>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div style="background:#e0e0e0" class="m-1" >
                                                        <a href="../index.php?showpart=4">
                                                            <div class="d-flex flex-col">
                                                                <img width="140" height="100" src="../img/nav-monitor.png" alt="monitor">
                                                                <p class="text-center">Monitor</p>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <div style="background:#e0e0e0" class="m-1" >
                                                        <a href="../index.php?showpart=3">
                                                            <div class="d-flex flex-col">
                                                                <img width="140" height="100" src="../img/nav-motherboard.png" alt="motherboard">
                                                                <p class="text-center">Motherboard</p>
                                                            </div>
                                                        </a>
                                                    </div>
                                                </div>
                                            
                                        </div>
                                    </div>
                                </li>
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
                                <div style="font-size:30px; padding:0 15px;" class="text-black"><a class="text-black" href="../account/myAccount.php?acc"><div class="mx-1" ><i class="fas fa-user-circle"></i></div></a></div>
                                <div style="margin-top:10px;"><a class="text-deco-none signup-button-field mr-2 text-black pr-1" href="../includes/logout.inc.php" name="logout-submit">Logout</a></div>
                                </div>
                                </form>';
                            }
                            else{
                                echo'
                                <div class="container d-flex flex-row jcfe">
                                    <div style="margin-top:3px;"><a class="text-deco-none signup-button-field mr-2 text-black pr-1" href="../signup.php">Signup</a></div>
                                    <div style="margin-top:3px;"><a class="text-deco-none text-black pr-1 mr-2 nav loginphp" href="../login.php">Login</a></div>
                                </div>
                                ';
                            }
                        ?>
                    </div>
                </div>
            </div>
        <!-- Navbar Ends -->

        <!-- Content Starts -->
        <div class="primary bg-color pb-lg">
            <div class="d-flex flex-row jcs">
                <div class="m-0 p-0 w-min-100">
                    <div class="container">
                        <div style=" height:45px; font-size:18px;" class="py-sm pl-2 my-1 b-rad-2 shadow-sm white text-left"><a style="color:#28AB87;" class="text-deco-none" href="../index.php">Home</a> > System Builds</div>
                    </div>
                    <div class="container responsive-container white p-3 b-rad-2 shadow-md">
                        <div class="">
                            <h1 style="font-size:30px;" class="text-black pb-0.5 ">System Parts</h1>
                        </div>
                        
                        <div class="">
                            <div class="d-flex text-black flex-col mt-1">
                                <table style="color:gray" style='width:100%'>
                                    <tr>
                                        <td style='width:70%'>Selection</td>
                                        <td class="text-center">Price</td>
                                        <td class="text-right">Discount</td>
                                        <td class="text-center">Remove</td>
                                    </tr>
                                </table>
                                <hr>
                                <!-- CASE -->
                                <div class="my-1">
                                    <b> Case: </b>
                                    <?php
                                        $query = "SELECT * FROM systembuild WHERE partKeyword=1";
                                        $connect = mysqli_query($conn, $query);
                                        if(mysqli_num_rows($connect) > 0){
                                            while($row = mysqli_fetch_array($connect)){
                                                $discount = $row['partDiscount'];
                                                $pcpartID = $row['partID'];
                                                $select = "SELECT * FROM pcpart WHERE pcPartID='$pcpartID'";
                                                $connect = mysqli_query($conn, $select);
                                                while($row = mysqli_fetch_array($connect)){
                                                    echo"
                                                        <table style='width:100%'>
                                                        <tr>
                                                            <td style='width:70%'>
                                                            <div  class='d-flex md-flex-col'>
                                                                <img class='img1' src='../admin/upload/".$row['image']."' >
                                                                <a style='color:#28AB87;font-size:16px;' class='text-deco-none' href='../details.php?part_det=".$row['pcPartID']."'>".$row['partTitle']."
                                                                </a>
                                                                </div>
                                                            </td>
                                                            <td class='p-1'>&#8377; ".$row['price']."</td>
                                                            <td class='p-1'>&#8377; $discount</td>
                                                            <td class='p-1'>
                                                                <a style='background:red; color:white;' class='px-1 py-sm text-deco-none b-rad-1 shadow-md' href='system-build.php?delPart=".$row['pcPartID']."&keyword=1'>
                                                                    <i class='fa fa-trash'></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    ";
                                                }
                                            }
                                        }
                                        else{
                                            echo'
                                                <div class="my-1 mx-2 d-flex jcc">
                                                    <form action="" method="POST" >
                                                        <button class="text-deco-none signup-button-field text-black pr-1 b-0" name="case" >+ Choose a Case</button>
                                                    </form>
                                                </div>
                                            ';
                                        }
                                    ?>
                                    
                                    <div class="">
                                        <?php
                                            if(isset($_POST['case'])){
                                                echo"
                                                    <table style='width:90%' class='text-left'>
                                                        <thead>
                                                            <tr>
                                                                <th>Product</th>
                                                                <th>Price</th>
                                                                <th>Add</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                ";
                                                $query = 'SELECT * FROM pcpart WHERE partKeyword="1";';
                                                $check = mysqli_query($conn, $query);
                                                if($check){
                                                    while($row = mysqli_fetch_array($check)){
                                                        echo"
                                                                    <tr>
                                                                        <td class='p-1'>
                                                                            <img class='img1' src='../admin/upload/".$row['image']."' >
                                                                            <a style='color:#28AB87;font-size:16px;' class='text-deco-none' href='../details.php?part_det=".$row['pcPartID']."'>".$row['partTitle']."
                                                                            </a>
                                                                        </td>
                                                                        <td class='p-1'>&#8377; ".$row['price']."</td>
                                                                        <td class='p-1'><a style='padding:10px 14px;margin-top:20px;background:#28AB87; border:none; color:white;font-size:16px;' class='text-deco-none b-rad-2 shadow-md' href='system-build.php?addPart=".$row['pcPartID']."&keyword=1&price=".$row['price']."'>Add</a></td>
                                                                    </tr>
                                                        ";
                                                    }
                                                }
                                                echo"
                                                </tbody>
                                            </table>";
                                            }
                                        ?>
                                    </div>
                                </div>
                                <hr>
                                <!-- CPU -->
                                <div class="text-left my-1">
                                    <b> CPU:</b>
                                    <?php
                                        $query = "SELECT * FROM systembuild WHERE partKeyword=2";
                                        $connect = mysqli_query($conn, $query);
                                        if(mysqli_num_rows($connect) > 0){
                                            while($row = mysqli_fetch_array($connect)){
                                                $discount = $row['partDiscount'];
                                                $pcpartID = $row['partID'];
                                                $select = "SELECT * FROM pcpart WHERE pcPartID='$pcpartID'";
                                                $connect = mysqli_query($conn, $select);
                                                while($row = mysqli_fetch_array($connect)){
                                                    echo"
                                                        <table style='width:100%'>
                                                        <tr>
                                                            <td style='width:70%'>
                                                            <div  class='d-flex md-flex-col'>
                                                                <img class='img1' src='../admin/upload/".$row['image']."' >
                                                                <a style='color:#28AB87;font-size:16px;' class='text-deco-none' href='../details.php?part_det=".$row['pcPartID']."'>".$row['partTitle']."
                                                                </a>
                                                                </div>
                                                            </td>
                                                            <td class='p-1'>&#8377; ".$row['price']."</td>
                                                            <td class='p-1'>&#8377; $discount</td>
                                                            <td class='p-1 text-right'>
                                                                <a style='background:red; color:white;' class='px-1 py-sm text-deco-none b-rad-1 shadow-md' href='system-build.php?delPart=".$row['pcPartID']."&keyword=1'>
                                                                    <i class='fa fa-trash'></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    ";
                                                }
                                            }
                                        }
                                        else{
                                            echo'
                                            <div class="my-1 mx-2 d-flex jcc"> 
                                                <form action="" method="POST" >
                                                    <button class="text-deco-none signup-button-field text-black pr-1" name="cpu" >+ Choose a CPU</button>
                                                </form>
                                            </div>
                                            ';
                                        }
                                    ?>
                                    
                                    <div class="">
                                    <?php
                                            if(isset($_POST['cpu'])){
                                                echo"
                                                    <table style='width:90%' class='text-left'>
                                                        <thead>
                                                            <tr>
                                                                <th>Product</th>
                                                                <th>Price</th>
                                                                <th>Add</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                ";
                                                $query = 'SELECT * FROM pcpart WHERE partKeyword="2";';
                                                $check = mysqli_query($conn, $query);
                                                if($check){
                                                    while($row = mysqli_fetch_array($check)){
                                                        echo"
                                                                    <tr>
                                                                        <td class='p-1'>
                                                                            <img class='img1' src='../admin/upload/".$row['image']."' >
                                                                            <a style='color:#28AB87;font-size:16px;' class='text-deco-none' href='../details.php?part_det=".$row['pcPartID']."'>".$row['partTitle']."
                                                                            </a>
                                                                        </td>
                                                                        <td class='p-1'>&#8377; ".$row['price']."</td>
                                                                        <td class='p-1'>
                                                                            <a style='padding:10px 14px;margin-top:20px;background:#28AB87; border:none; color:white;font-size:16px;' class='text-deco-none b-rad-2 shadow-md' href='system-build.php?addPart=".$row['pcPartID']."&keyword=2&price=".$row['price']."'>
                                                                                Add
                                                                            </a>
                                                                        </td>
                                                                    </tr>
                                                        ";
                                                    }
                                                }
                                                echo"
                                                </tbody>
                                            </table>";
                                            }
                                        ?>
                                    </div>
                                </div>
                                <hr>
                                <!-- MOTHERBOARD -->
                                <div class="text-left my-1">
                                    <b> Motherboard: </b>
                                    <?php
                                        $query = "SELECT * FROM systembuild WHERE partKeyword=3";
                                        $connect = mysqli_query($conn, $query);
                                        if(mysqli_num_rows($connect) > 0){
                                            while($row = mysqli_fetch_array($connect)){
                                                $discount = $row['partDiscount'];
                                                $pcpartID = $row['partID'];
                                                $select = "SELECT * FROM pcpart WHERE pcPartID='$pcpartID'";
                                                $connect = mysqli_query($conn, $select);
                                                while($row = mysqli_fetch_array($connect)){
                                                    echo"
                                                        <table style='width:100%'>
                                                        <tr>
                                                            <td style='width:70%'>
                                                                <img class='img1' src='../admin/upload/".$row['image']."' >
                                                                <a style='color:#28AB87;font-size:16px;' class='text-deco-none' href='../details.php?part_det=".$row['pcPartID']."'>".$row['partTitle']."
                                                                </a>
                                                            </td>
                                                            <td class='p-1'>&#8377; ".$row['price']."</td>
                                                            <td class='p-1'>&#8377; $discount</td>
                                                            <td class='p-1'>
                                                                <a style='background:red; color:white;' class='px-1 py-sm text-deco-none b-rad-1 shadow-md' href='system-build.php?delPart=".$row['pcPartID']."&keyword=1'>
                                                                    <i class='fa fa-trash'></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    ";
                                                }
                                            }
                                        }
                                        else{
                                            echo'
                                            <div class="my-1 mx-2 d-flex jcc"> 
                                                <form action="" method="POST" >
                                                    <button class="text-deco-none signup-button-field text-black pr-1" name="motherboard" >+ Choose a Motherboard</button>
                                                </form>
                                            </div>
                                            ';
                                        }
                                    ?>
                                    
                                    <div class="">
                                    <?php
                                            if(isset($_POST['motherboard'])){
                                                echo"
                                                    <table style='width:90%' class='text-left'>
                                                        <thead>
                                                            <tr>
                                                                <th>Product</th>
                                                                <th>Price</th>
                                                                <th>Add</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                ";
                                                $query = 'SELECT * FROM pcpart WHERE partKeyword="3";';
                                                $check = mysqli_query($conn, $query);
                                                if($check){
                                                    while($row = mysqli_fetch_array($check)){
                                                        echo"
                                                                    <tr>
                                                                        <td class='p-1'>
                                                                            <img class='img1' src='../admin/upload/".$row['image']."' >
                                                                            <a style='color:#28AB87;font-size:16px;' class='text-deco-none' href='../details.php?part_det=".$row['pcPartID']."'>".$row['partTitle']."
                                                                            </a>
                                                                        </td>
                                                                        <td class='p-1'>&#8377; ".$row['price']."</td>
                                                                        <td class='p-1'><a style='padding:10px 14px;margin-top:20px;background:#28AB87; border:none; color:white;font-size:16px;' class='text-deco-none b-rad-2 shadow-md' href='system-build.php?addPart=".$row['pcPartID']."&keyword=3&price=".$row['price']."'>Add</a></td>
                                                                    </tr>
                                                        ";
                                                    }
                                                }
                                                echo"
                                                </tbody>
                                            </table>";
                                            }
                                        ?>
                                    </div>
                                </div>
                                <hr>
                                <!-- RAM -->
                                <div class="text-left my-1">
                                    <b> RAM: </b>
                                    <?php
                                        $query = "SELECT * FROM systembuild WHERE partKeyword=5";
                                        $connect = mysqli_query($conn, $query);
                                        if(mysqli_num_rows($connect) > 0){
                                            while($row = mysqli_fetch_array($connect)){
                                                $discount = $row['partDiscount'];
                                                $pcpartID = $row['partID'];
                                                $select = "SELECT * FROM pcpart WHERE pcPartID='$pcpartID'";
                                                $check = mysqli_query($conn, $select);
                                                while($rowpart = mysqli_fetch_array($check)){
                                                    echo"
                                                        <table style='width:100%'>
                                                        <tr>
                                                            <td style='width:70%'>
                                                            <div  class='d-flex md-flex-col'>
                                                                <img class='img1' src='../admin/upload/".$rowpart['image']."' >
                                                                <a style='color:#28AB87;font-size:16px;' class='text-deco-none' href='../details.php?part_det=".$rowpart['pcPartID']."'>".$rowpart['partTitle']."
                                                                </a>
                                                                </div>
                                                            </td>
                                                            <td class='p-1'>&#8377; ".$rowpart['price']."</td>
                                                            <td class='p-1'>&#8377; $discount</td>
                                                            <td class='p-1'>
                                                                <a style='background:red; color:white;' class='px-1 py-sm text-deco-none b-rad-1 shadow-md' href='system-build.php?delPart=".$rowpart['pcPartID']."&keyword=1'>
                                                                    <i class='fa fa-trash'></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    ";
                                                }
                                            }
                                            echo"
                                            <div class='my-1 mx-2 d-flex jcc'> 
                                                <form action='' method='POST' >
                                                        <button class='text-deco-none signup-button-field text-black pr-1' name='ram' >+ Choose a additional</button>
                                                </form>
                                            </div>
                                            ";
                                        }
                                        else{
                                            echo'
                                            <div class="my-1 mx-2 d-flex jcc"> 
                                                <form action="" method="POST" >
                                                        <button class="text-deco-none signup-button-field text-black pr-1" name="ram" >+ Choose a RAM</button>
                                                </form>
                                            </div>
                                            ';
                                        }
                                    ?>
                                    
                                    <div class="">
                                    <?php
                                            if(isset($_POST['ram'])){
                                                echo"
                                                    <table style='width:90%' class='text-left'>
                                                        <thead>
                                                            <tr>
                                                                <th>Product</th>
                                                                <th>Price</th>
                                                                <th>Add</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                ";
                                                $query = 'SELECT * FROM pcpart WHERE partKeyword="5";';
                                                $check = mysqli_query($conn, $query);
                                                if($check){
                                                    while($row = mysqli_fetch_array($check)){
                                                        echo"
                                                                    <tr>
                                                                        <td class='p-1'>
                                                                            <img class='img1' src='../admin/upload/".$row['image']."' >
                                                                            <a style='color:#28AB87;font-size:16px;' class='text-deco-none' href='../details.php?part_det=".$row['pcPartID']."'>".$row['partTitle']."
                                                                            </a>
                                                                        </td>
                                                                        <td class='p-1'>&#8377; ".$row['price']."</td>
                                                                        <td class='p-1'><a style='padding:10px 14px;margin-top:20px;background:#28AB87; border:none; color:white;font-size:16px;' class='text-deco-none b-rad-2 shadow-md' href='system-build.php?addPart=".$row['pcPartID']."&keyword=5&price=".$row['price']."'>Add</a></td>
                                                                    </tr>
                                                        ";
                                                    }
                                                }
                                                echo"
                                                </tbody>
                                            </table>";
                                            }
                                        ?>
                                    </div>
                                </div>
                                <hr>
                                <!-- GRAPHICS CARD -->
                                <div class="text-left my-1">
                                    <b>  GraphicsCard: </b>
                                    <?php
                                        $query = "SELECT * FROM systembuild WHERE partKeyword=6";
                                        $connect = mysqli_query($conn, $query);
                                        if(mysqli_num_rows($connect) > 0){
                                            while($row = mysqli_fetch_array($connect)){
                                                $discount = $row['partDiscount'];
                                                $pcpartID = $row['partID'];
                                                $select = "SELECT * FROM pcpart WHERE pcPartID='$pcpartID'";
                                                $connect = mysqli_query($conn, $select);
                                                while($row = mysqli_fetch_array($connect)){
                                                    echo"
                                                        <table style='width:100%'>
                                                        <tr>
                                                            <td style='width:70%'>
                                                            <div  class='d-flex md-flex-col'>
                                                                <img class='img1' src='../admin/upload/".$row['image']."' >
                                                                <a style='color:#28AB87;font-size:16px;' class='text-deco-none' href='../details.php?part_det=".$row['pcPartID']."'>".$row['partTitle']."
                                                                </a>
                                                                </div>
                                                            </td>
                                                            <td class='p-1'>&#8377; ".$row['price']."</td>
                                                            <td class='p-1'>&#8377; $discount</td>
                                                            <td class='p-1'>
                                                                <a style='background:red; color:white;' class='px-1 py-sm text-deco-none b-rad-1 shadow-md' href='system-build.php?delPart=".$row['pcPartID']."&keyword=1'>
                                                                    <i class='fa fa-trash'></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    ";
                                                }
                                            }
                                        }
                                        else{
                                            echo'
                                        <div class="my-1 mx-2 d-flex jcc"> 
                                            <form action="" method="POST" >
                                                <button class="text-deco-none signup-button-field text-black pr-1" name="graphics" >+ Choose a GraphicsCard</button>
                                            </form>
                                        </div>
                                            ';
                                        }
                                    ?>
                                    
                                    <div class="">
                                    <?php
                                            if(isset($_POST['graphics'])){
                                                echo"
                                                    <table style='width:90%' class='text-left'>
                                                        <thead>
                                                            <tr>
                                                                <th>Product</th>
                                                                <th>Price</th>
                                                                <th>Add</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                ";
                                                $query = 'SELECT * FROM pcpart WHERE partKeyword="6";';
                                                $check = mysqli_query($conn, $query);
                                                if($check){
                                                    while($row = mysqli_fetch_array($check)){
                                                        echo"
                                                                    <tr>
                                                                        <td class='p-1'>
                                                                            <img class='img1' src='../admin/upload/".$row['image']."' >
                                                                            <a style='color:#28AB87;font-size:16px;' class='text-deco-none' href='../details.php?part_det=".$row['pcPartID']."'>".$row['partTitle']."
                                                                            </a>
                                                                        </td>
                                                                        <td class='p-1'>&#8377; ".$row['price']."</td>
                                                                        <td class='p-1'><a style='padding:10px 14px;margin-top:20px;background:#28AB87; border:none; color:white;font-size:16px;' class='text-deco-none b-rad-2 shadow-md' href='system-build.php?addPart=".$row['pcPartID']."&keyword=6&price=".$row['price']."'>Add</a></td>
                                                                    </tr>
                                                        ";
                                                    }
                                                }
                                                echo"
                                                </tbody>
                                            </table>";
                                            }
                                        ?>
                                    </div>
                                </div>
                                <hr>
                                    <!-- HRAD Disk -->
                                <div class="text-left my-1">
                                    <b> HardDisk: </b>
                                    <?php
                                        $query = "SELECT * FROM systembuild WHERE partKeyword=9";
                                        $connect = mysqli_query($conn, $query);
                                        if(mysqli_num_rows($connect) > 0){
                                            while($row = mysqli_fetch_array($connect)){
                                                $discount = $row['partDiscount'];
                                                $pcpartID = $row['partID'];
                                                $select = "SELECT * FROM pcpart WHERE pcPartID='$pcpartID'";
                                                $connect = mysqli_query($conn, $select);
                                                while($row = mysqli_fetch_array($connect)){
                                                    echo"
                                                        <table style='width:100%'>
                                                        <tr>
                                                            <td style='width:70%'>
                                                            <div  class='d-flex md-flex-col'>
                                                                <img class='img1' src='../admin/upload/".$row['image']."' >
                                                                <a style='color:#28AB87;font-size:16px;' class='text-deco-none' href='../details.php?part_det=".$row['pcPartID']."'>".$row['partTitle']."
                                                                </a>
                                                                </div>
                                                            </td>
                                                            <td class='p-1'>&#8377; ".$row['price']."</td>
                                                            <td class='p-1'>&#8377; $discount</td>
                                                            <td class='p-1'>
                                                                <a style='background:red; color:white;' class='px-1 py-sm text-deco-none b-rad-1 shadow-md' href='system-build.php?delPart=".$row['pcPartID']."&keyword=1'>
                                                                    <i class='fa fa-trash'></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    ";
                                                }
                                            }
                                        }
                                        else{
                                            echo'
                                            <div class="my-1 mx-2 d-flex jcc"> 
                                            <form action="" method="POST" >
                                                <button class="text-deco-none signup-button-field text-black pr-1" name="harddisk" >+ Choose a HardDisk</button>
                                            </form>                                    
                                            </div>
                                            ';
                                        }
                                    ?>
                                    
                                    <div class="">
                                    <?php
                                            if(isset($_POST['harddisk'])){
                                                echo"
                                                    <table style='width:90%' class='text-left'>
                                                        <thead>
                                                            <tr>
                                                                <th>Product</th>
                                                                <th>Price</th>
                                                                <th>Add</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                ";
                                                $query = 'SELECT * FROM pcpart WHERE partKeyword="9";';
                                                $check = mysqli_query($conn, $query);
                                                if($check){
                                                    while($row = mysqli_fetch_array($check)){
                                                        echo"
                                                                    <tr>
                                                                        <td class='p-1'>
                                                                            <img class='img1' src='../admin/upload/".$row['image']."' >
                                                                            <a style='color:#28AB87;font-size:16px;' class='text-deco-none' href='../details.php?part_det=".$row['pcPartID']."'>".$row['partTitle']."
                                                                            </a>
                                                                        </td>
                                                                        <td class='p-1'>&#8377; ".$row['price']."</td>
                                                                        <td class='p-1'><a style='padding:10px 14px;margin-top:20px;background:#28AB87; border:none; color:white;font-size:16px;' class='text-deco-none b-rad-2 shadow-md' href='system-build.php?addPart=".$row['pcPartID']."&keyword=9&price=".$row['price']."'>Add</a></td>
                                                                    </tr>
                                                        ";
                                                    }
                                                }
                                                echo"
                                                </tbody>
                                            </table>";
                                            }
                                        ?>
                                    </div>
                                </div>
                                <hr>
                                    <!-- MONITOR -->
                                <div class="text-left my-1">
                                    <b>Monitor: </b>
                                    <?php
                                        $query = "SELECT * FROM systembuild WHERE partKeyword=4";
                                        $connect = mysqli_query($conn, $query);
                                        if(mysqli_num_rows($connect) > 0){
                                            while($row = mysqli_fetch_array($connect)){
                                                $discount = $row['partDiscount'];
                                                $pcpartID = $row['partID'];
                                                $select = "SELECT * FROM pcpart WHERE pcPartID='$pcpartID'";
                                                $connect = mysqli_query($conn, $select);
                                                while($row = mysqli_fetch_array($connect)){
                                                    echo"
                                                        <table style='width:100%'>
                                                        <tr>
                                                            <td  style='width:70%'>
                                                            <div  class='d-flex md-flex-col'>
                                                                <img class='img1' src='../admin/upload/".$row['image']."' >
                                                                <a style='color:#28AB87;font-size:16px;' class='text-deco-none' href='../details.php?part_det=".$row['pcPartID']."'>".$row['partTitle']."
                                                                </a>
                                                                </div>
                                                            </td>
                                                            <td class='p-sm'>&#8377; ".$row['price']."</td>
                                                            <td class='p-sm'>&#8377; $discount</td>
                                                            <td class='p-1'>
                                                                <a style='background:red; color:white;' class='px-1 py-sm text-deco-none b-rad-1 shadow-md' href='system-build.php?delPart=".$row['pcPartID']."&keyword=1'>
                                                                    <i class='fa fa-trash'></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    ";
                                                }
                                            }
                                        }
                                        else{
                                            echo'
                                            <div class="my-1 mx-2 d-flex jcc"> 
                                        <form action="" method="POST" >
                                            <button class="text-deco-none signup-button-field text-black pr-1" name="monitor" >+ Choose a Monitor</button>
                                        </form>
                                    </div>
                                            ';
                                        }
                                    ?>
                                    
                                    <div class="">
                                    <?php
                                            if(isset($_POST['monitor'])){
                                                echo"
                                                    <table style='width:90%' class='text-left'>
                                                        <thead>
                                                            <tr>
                                                                <th>Product</th>
                                                                <th>Price</th>
                                                                <th>Add</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                ";
                                                $query = 'SELECT * FROM pcpart WHERE partKeyword="4";';
                                                $check = mysqli_query($conn, $query);
                                                if($check){
                                                    while($row = mysqli_fetch_array($check)){
                                                        echo"
                                                                    <tr>
                                                                        <td class='p-1'>
                                                                            <img class='img1' src='../admin/upload/".$row['image']."' >
                                                                            <a style='color:#28AB87;font-size:16px;' class='text-deco-none' href='../details.php?part_det=".$row['pcPartID']."'>".$row['partTitle']."
                                                                            </a>
                                                                        </td>
                                                                        <td class='p-1'>&#8377; ".$row['price']."</td>
                                                                        
                                                                        <td class='p-1'><a style='padding:10px 14px;margin-top:20px;background:#28AB87; border:none; color:white;font-size:16px;' class='text-deco-none b-rad-2 shadow-md' href='system-build.php?addPart=".$row['pcPartID']."&keyword=4&price=".$row['price']."'>Add</a></td>
                                                                    </tr>
                                                        ";
                                                    }
                                                }
                                                echo"
                                                </tbody>
                                            </table>";
                                            }
                                        ?>
                                    </div>
                                </div>
                                <hr>
                                            <!-- MOUSE -->
                                <div class="text-left my-1">
                                    <b>Mouse: </b>
                                    <?php
                                        $query = "SELECT * FROM systembuild WHERE partKeyword=7";
                                        $connect = mysqli_query($conn, $query);
                                        if(mysqli_num_rows($connect) > 0){
                                            while($row = mysqli_fetch_array($connect)){
                                                $discount = $row['partDiscount'];
                                                $pcpartID = $row['partID'];
                                                $select = "SELECT * FROM pcpart WHERE pcPartID='$pcpartID'";
                                                $connect = mysqli_query($conn, $select);
                                                while($row = mysqli_fetch_array($connect)){
                                                    echo"
                                                        <table style='width:100%'>
                                                        <tr>
                                                            <td style='width:70%'>
                                                            <div  class='d-flex md-flex-col'>
                                                                <img class='img1' src='../admin/upload/".$row['image']."' >
                                                                <a style='color:#28AB87;font-size:16px;' class='text-deco-none' href='../details.php?part_det=".$row['pcPartID']."'>".$row['partTitle']."
                                                                </a>
                                                                </div>
                                                            </td>
                                                            <td class='p-1'>&#8377; ".$row['price']."</td>
                                                            <td class='p-1'>&#8377; $discount</td>
                                                            <td class='p-1'>
                                                                <a style='background:red; color:white;' class='px-1 py-sm text-deco-none b-rad-1 shadow-md' href='system-build.php?delPart=".$row['pcPartID']."&keyword=1'>
                                                                    <i class='fa fa-trash'></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    ";
                                                }
                                            }
                                        }
                                        else{
                                            echo'
                                            <div class="my-1 mx-2 d-flex jcc"> 
                                            <form action="" method="POST" >
                                                <button class="text-deco-none signup-button-field text-black pr-1" name="mouse" >+ Choose a Mouse</button>
                                            </form>                                    
                                        </div>
                                            ';
                                        }
                                    ?>
                                    
                                    <div class="">
                                    <?php
                                            if(isset($_POST['mouse'])){
                                                echo"
                                                    <table style='width:90%' class='text-left'>
                                                        <thead>
                                                            <tr>
                                                                <th>Product</th>
                                                                <th>Price</th>
                                                                <th>Add</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                ";
                                                $query = 'SELECT * FROM pcpart WHERE partKeyword="7";';
                                                $check = mysqli_query($conn, $query);
                                                if($check){
                                                    while($row = mysqli_fetch_array($check)){
                                                        echo"
                                                                    <tr>
                                                                        <td class='p-1'>
                                                                            <img class='img1' src='../admin/upload/".$row['image']."' >
                                                                            <a style='color:#28AB87;font-size:16px;' class='text-deco-none' href='../details.php?part_det=".$row['pcPartID']."'>".$row['partTitle']."
                                                                            </a>
                                                                        </td>
                                                                        <td class='p-1'>&#8377; ".$row['price']."</td>
                                                                        <td class='p-1'><a style='padding:10px 14px;margin-top:20px;background:#28AB87; border:none; color:white;font-size:16px;' class='text-deco-none b-rad-2 shadow-md' href='system-build.php?addPart=".$row['pcPartID']."&keyword=7&price=".$row['price']."'>Add</a></td>
                                                                    </tr>
                                                        ";
                                                    }
                                                }
                                                echo"
                                                </tbody>
                                            </table>";
                                            }
                                        ?>
                                    </div>
                                </div>
                                <hr>
                                            <!-- KEYBOARD -->
                                <div class="text-left my-1">
                                    <b>Keyboard: </b>
                                    <?php
                                        $query = "SELECT * FROM systembuild WHERE partKeyword=8";
                                        $connect = mysqli_query($conn, $query);
                                        if(mysqli_num_rows($connect) > 0){
                                            while($row = mysqli_fetch_array($connect)){
                                                $discount = $row['partDiscount'];
                                                $pcpartID = $row['partID'];
                                                $select = "SELECT * FROM pcpart WHERE pcPartID='$pcpartID'";
                                                $connect = mysqli_query($conn, $select);
                                                while($row = mysqli_fetch_array($connect)){
                                                    echo"
                                                        <table style='width:100%'>
                                                        <tr>
                                                            <td style='width:70%'>
                                                            <div  class='d-flex md-flex-col'>
                                                                <img class='img1' src='../admin/upload/".$row['image']."' >
                                                                <a style='color:#28AB87;font-size:16px;' class='text-deco-none' href='../details.php?part_det=".$row['pcPartID']."'>".$row['partTitle']."
                                                                </a>
                                                                </div>
                                                            </td>
                                                            <td class='p-1'>&#8377; ".$row['price']."</td>
                                                            <td class='p-1'>&#8377; $discount</td>
                                                            <td class='p-1'>
                                                                <a style='background:red; color:white;' class='px-1 py-sm text-deco-none b-rad-1 shadow-md' href='system-build.php?delPart=".$row['pcPartID']."&keyword=1'>
                                                                    <i class='fa fa-trash'></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    ";
                                                }
                                            }
                                        }
                                        else{
                                            echo'
                                            <div class="my-1 mx-2 d-flex jcc"> 
                                        <form action="" method="POST" >
                                            <button class="text-deco-none signup-button-field text-black pr-1" name="keyboard" >+ Choose a Keyboard</button>
                                        </form>
                                    </div>
                                            ';
                                        }
                                    ?>
                                    
                                    <div class="">
                                    <?php
                                            if(isset($_POST['keyboard'])){
                                                echo"
                                                    <table style='width:90%' class='text-left'>
                                                        <thead>
                                                            <tr>
                                                                <th>Product</th>
                                                                <th>Price</th>
                                                                <th>Add</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                ";
                                                $query = 'SELECT * FROM pcpart WHERE partKeyword="8";';
                                                $check = mysqli_query($conn, $query);
                                                if($check){
                                                    while($row = mysqli_fetch_array($check)){
                                                        echo"
                                                                    <tr>
                                                                        <td class='p-1'>
                                                                            <img class='img1' src='../admin/upload/".$row['image']."' >
                                                                            <a style='color:#28AB87;font-size:16px;' class='text-deco-none' href='../details.php?part_det=".$row['pcPartID']."'>".$row['partTitle']."
                                                                            </a>
                                                                        </td>
                                                                        <td class='p-1'>&#8377; ".$row['price']."</td>
                                                                        <td class='p-1'><a style='padding:10px 14px;margin-top:20px;background:#28AB87; border:none; color:white;font-size:16px;' class='text-deco-none b-rad-2 shadow-md' href='system-build.php?addPart=".$row['pcPartID']."&keyword=8&price=".$row['price']."'>Add</a></td>
                                                                    </tr>
                                                        ";
                                                    }
                                                }
                                                echo"
                                                </tbody>
                                            </table>";
                                            }
                                        ?>
                                    </div>
                                </div>
                                <hr>
                                <?php
                                    $baseTotal = 0;
                                    $userID = $_SESSION['userId'];
                                    $priceQuery = "SELECT * FROM systembuild WHERE userID='$userID'";
                                    $priceCheck = mysqli_query($conn, $priceQuery);
                                    while($row = mysqli_fetch_array($priceCheck)){
                                        $baseTotal += $row['partPrice'];
                                        $discount += $row['partDiscount'];
                                    }
                                ?>
                                <table style='width:100%' class="my-1">
                                    <tr>
                                        <td style='width:72%'>Base Total:</td>
                                        <td><?php echo "&#8377;".$baseTotal; ?></td>
                                        <td><?php echo "&#8377;".$discount; ?></td>
                                        <td style='width:12%'></td>
                                    </tr>
                                </table>
                                <div class="container">
                                    <div class="container">
                                        <div class="d-flex jcc">
                                            <?php
                                                $Total = $baseTotal-$discount;
                                            ?>
                                            Total Price:&#8377; <?php echo $Total; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="my-3">
                                    <div class="d-flex jcsb sm-flex-col sm-d-flex sm-jcc sm-m-1">
                                        <div class="sm-ml-3 sm-my-1">
                                            <a href="../index.php" style="padding:10px 14px;margin-top:20px;background:#28AB87; border:none; color:white;font-size:16px;" class="text-deco-none b-rad-2 shadow-md">
                                                <i class="fas fa-step-backward pr-sm"></i>ContinueShopping
                                            </a>
                                        </div>
                                        <div class="sm-ml-lg sm-my-1">
                                            <a href="system-build.php?delsb" style="padding:10px 14px;margin-top:20px;background:red; border:none; color:white;" class="text-deco-none b-rad-2 shadow-md">
                                                DeleteAll
                                            </a>
                                        </div>
                                        <div class="sm-my-1 sm-ml-3">
                                                    <a href="../cart/order/proceedcheckout.php?sb" style="padding:10px 14px;margin-top:20px;background:#28AB87; border:none; color:white;" class="text-deco-none b-rad-2 shadow-md">
                                                        ProceedCheckout <i class="fas fa-fast-forward"></i>
                                                    </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Content Ends -->

            <!-- Footer -->
                <div class=" text-center">
                    <div style="background:gray" class=" pt-3 pb-3 d-flex flex-col">
                    <div class="d-flex jcc">
                        <div style="width:200px;" class="mr-2 mb-2">
                            <h3 align='left'>Categories</h3>
                            <div class='b-1 text-white mb-1'></div>
                            <div class="d-flex flex-col">
                                <a class="text-deco-none py-sm text-black footer-hover" align="left" href="#">System build</a>
                                <a class="text-deco-none py-sm text-black footer-hover" align="left" href="#">Completed build</a>
                                <a class="text-deco-none py-sm text-black footer-hover" align="left" href="#">Browse Product</a>
                            </div>
                        </div>
                        <div style="width:200px;" class="mr-2 mb-2">
                            <h3 align='left'>Company</h3>
                            <div class='b-1 text-white mb-1'></div>
                            <div class="d-flex flex-col">
                                <a class="text-deco-none py-sm text-black footer-hover" align="left" href="about.php">About</a>
                                <a class="text-deco-none py-sm text-black footer-hover" align="left"  href="#">Contact Us</a>
                                <a class="text-deco-none py-sm text-black footer-hover" align="left"  href="#">Terms & Policy</a>
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
          </div>
    </body>
</html>