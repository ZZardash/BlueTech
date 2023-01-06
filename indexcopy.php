<?php
require "./includes/dbh.inc.php";
include('./functions/functions.php');
session_start();
$userID = $_SESSION['userId'];
?>
<!DOCTYPE html>
<html>
     <head>
          <link rel="stylesheet" href="style.css">
          <link rel="stylesheet" href="customstyle.css">
          <meta name="viewport" content="width=device-width, initial-scale=1">
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
          <style>
               body{
                    background: #e0e0e0;
               }
               
               img {vertical-align: middle;}

               .transparent1{
                    background-image:linear-gradient(40deg, rgba(0,0,0, 0.1)50%,rgba(40,171,135, 0.9)50%),url(img/test1.jpg);
                    background-size: cover;
                    height: 30vh;
                    width: 30vh;
               }
               .transparent2{
                    background-image:linear-gradient(40deg, rgba(0,0,0, 0.1)50%,rgba(40,171,135, 0.9)50%),url(img/test2.jpg);
                    background-size: cover;
                    height: 30vh;
                    width: 30vh;
               }
               .transparent3{
                    background-image:linear-gradient(40deg, rgba(0,0,0, 0.1)50%,rgba(40,171,135, 0.9)50%),url(img/test3.jfif);
                    background-size: cover;
                    height: 30vh;
                    width: 30vh;
               }
               .test{
                    position: relative;
                    top: 5%;
                    left: 10%;
                    color: white;
                    letter-spacing: 2px;
               }
               .link-active{
                    color: rgb(40,171,135);
               }
               .cool-link::after{
                    content: '';
                    display: block;
                    width: 0;
                    height:2px;
                    background: rgb(40,171,135);
               }
               .cool-link:hover::after{
                    width:100%;
                    transition: width .3s;
               }
               .td{
                    font-size: 12px;
               }
               .info .td{
                    font-size:28px;
               }
               .timecss{
                    color: white;
                    background: rgb(40,171,135);
                    margin: 10px;
                    display: flex;
                    align-items: center;
                    width:70px;
                    height:70px;
                    padding: 10px;
                    border-radius: 50%;
               }
          </style>
     </head>
     <body>
          <!-- Navbar -->
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
          <div>
               <div class="container ">
                         <div class="d-flex flex-col">
                              <div class="d-flex jcc">
                                   <div class="transparent1 mx-1 mt-3">
                                        <div class="test">
                                             Computer Parts <br>
                                             Collection <br>
                                             <a style="font-size: 14px;" href="index.php?parts" class="text-deco-none text-white">Shop Now<i class="fa fa-arrow-right pl-sm" aria-hidden="true"></i></a>
                                        </div>
                                   </div>
                                   <div class="transparent2 mx-1 mt-3">
                                        <div class="test">
                                             Built Computer <br>
                                             Collection <br>
                                             <a style="font-size: 14px;" href="index.php?complete" class="text-deco-none text-white">Shop Now<i class="fa fa-arrow-right pl-sm" aria-hidden="true"></i></a>
                                        </div>
                                   </div>
                                   <div class="transparent3 mx-1 mt-3">
                                        <div class="test">
                                             System Build <br>
                                             Start your build <br>
                                             <a style="font-size: 12px;" href="./builds/system-build.php" class="text-deco-none text-white"><i class="fa fa-arrow-right pl-sm" aria-hidden="true"></i></a>
                                        </div>
                                   </div>
                              </div>
                              <div class="d-flex jcsb">
                                   <div class="p-1 mt-1">
                                        <b style="letter-spacing:2px;">NEW PRODUCTS</b>
                                   </div>
                                   <div class="">
                                        <div class="cont">
                                             <ul class="ls-none d-flex">
                                                  <li><p class="p-1 mt-1"><a href="indexcopy.php?parts" style="text-transform: uppercase; color: rgb(40,171,135);" class="text-deco-none cool-link text-black <?php if(isset($_GET['parts'])){echo'link-active';} ?> ">Parts</a></p></li>
                                                  <li><p class="p-1 mt-1" style="float:right;"><a href="indexcopy.php?complete" style="text-transform: uppercase; color: rgb(40,171,135);" class="text-deco-none text-black cool-link <?php if(isset($_GET['complete'])){echo'link-active';} ?>">Completed Build</a></p></li>
                                             </ul>
                                        </div>
                                   </div>
                              </div>
                              <hr>
                              <div class="d-flex flex-wrap jcsa">
                                   <?php
                                        if(isset($_GET['complete'])){
                                             $query = "SELECT * FROM pc_details ORDER BY RAND() LIMIT 0,4 ;";
                                             $check = mysqli_query($conn, $query);
                                             while ($row = mysqli_fetch_assoc($check)) {
                                                  $p_id = $row['pc_id'];
                                                  $discount = $row['pcPrice']*2;
                                                  echo "
                                                  <div style='width:270px;' class='d-flex flex-col mx-sm mt-1 white p-sm b-rad-1 shadow-sm'>
                                                       <div class='d-flex jcfe'>
                                                            <p class='text' style='padding:2px 8px;color:red;border: 1px solid red'>-50%</p>
                                                       </div>
                                                       <a style='color:#28AB87' class='text-deco-none single-img' href='details.php?pc_det=".$p_id."'>
                                                            <img class='img2 mt-1' src='./admin/upload/".$row['pc_image']."'/>
                                                       </a>
                                                       <p style='color:gray;' class='mt-1'>{$row['pcName']}</p>
                                                       <p style='font-size:16px;color:rgb(40,171,135)' class='my-sm'>&#8377;{$row['pcPrice']} <strike class='pl-1'>&#8377;{$discount}</strike></p>
                                                       
                                                       <div class='d-flex jcc'>
                                                            <p style='font-size:16px;background:rgb(40,171,135);color:white' class='mr-sm px-1 py-sm b-rad-1'><a href='details.php?pc_det={$p_id}' class='text-deco-none text-white'>Details</a></p>
                                                       </div>
                                                  </div>"
                                                  ;} 
                                        }
                                        else{
                                             $query = "SELECT * FROM pcpart ORDER BY RAND() LIMIT 0,4 ;";
                                             $check = mysqli_query($conn, $query);
                                             while ($row = mysqli_fetch_assoc($check)) {
                                                  $partname = $row['partKeyword'];
                                                  $partID = $row['pcPartID'];
                                                  $discount = $row['price']*2;
                                                  echo "
                                                  <div style='width:270px;' class='d-flex flex-col mx-sm mt-1 white p-sm b-rad-1 shadow-sm'>
                                                       <div class='d-flex jcfe'>
                                                            <p class='text' style='padding:2px 8px;color:red;border: 1px solid red'>-50%</p>
                                                       </div>
                                                       <div class='text-center'>
                                                            <a style='color:#28AB87' class='text-deco-none transparent single-img' href='details.php?part_det=".$partID."'>
                                                                 <img width='200' height='200' src='admin/upload/".$row['image']."'/>
                                                            </a>
                                                       </div>
                                                       <div class='text-center p-1' >
                                                            <p style='color:gray;' class=''>{$row['partTitle']}</p>
                                                            <p style='font-size:16px;color:rgb(40,171,135)' class='my-sm'>&#8377;{$row['price']} <strike class='pl-1'>&#8377;{$discount}</strike></p>
                                                            <div style=''>
                                                                 <div style='' class='d-flex jcc'>
                                                                      <p style='font-size:16px;background:rgb(40,171,135);color:white' class='mr-sm px-1 py-sm b-rad-1'><a href='details.php?part_det={$partID}' class='text-deco-none text-white'>Details</a></p>
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
               </div>
               <div class="white my-2 py-1">
                    <div class="container">
                         <div class="d-flex jcsa">
                              <div>
                                   <img width="400" src="img/p-17.png" alt="">
                              </div>
                              <div>
                                   <div class="d-flex mt-2">
                                        <div class="d-flex flex-col timecss text-center mt-1 px-sm">
                                             <p class="info" id="days">120</p>
                                             <p class="td">Days</p>
                                        </div>
                                        <div class="d-flex flex-col timecss text-center mt-1 px-sm">
                                             <p class="info" id="hours">20</p>
                                             <p class="td">Hours</p>
                                        </div>
                                        <div class="d-flex flex-col timecss text-center mt-1 px-sm">
                                             <p class="info" id="minutes">26</p>
                                             <p class="td">Minutes</p>
                                        </div>
                                        <div class="d-flex flex-col timecss text-center mt-1 px-sm">
                                             <p class="info" id="seconds">1</p>
                                             <p class="td">Seconds</p>     
                                        </div>
                                   </div>
                                   <div class="text-center mt-2">
                                        <p class="my-sm"><b>HOT DEALS THIS WEEK</b></p>
                                        <p>NEW COLLECTIONS UPTO 50% OFF</p>
                                   </div>
                                   <div class="mt-1 d-flex jcfe">
                                        <p style="background:rgb(40,171,135)" class="px-1 py-sm b-rad-1 shadow-sm"><a href="index.php" class="text-deco-none text-white">Shop Now</a></p>
                                   </div>
                              </div>
                              <div>
                                   <img width="400" src="img/p-19.jpg" alt="">
                              </div>
                         </div>
                    </div>
               </div>
          </div>
          <script type="text/javascript">
               countdown();
               function countdown(){
                    var now = new Date();
                    var eventDate = new Date(2019, 10, 29);

                    var currentTime = now.getTime();
                    var eventTime = eventDate.getTime();

                    var remTime = eventTime - currentTime;

                    var s = Math.floor(remTime / 1000);
                    var m = Math.floor(s / 60);
                    var h = Math.floor(m / 60);
                    var d = Math.floor(h / 24);

                    h %= 24;
                    m %= 60;
                    s %= 60;

                    h = (h < 10) ? "0" + h : h;
                    m = (m < 10) ? "0" + m : m;
                    s = (s < 10) ? "0" + s : s;

                    document.getElementById("days").textContent = d;
                    document.getElementById("days").innerText = d;

                    document.getElementById("hours").textContent = h;
                    document.getElementById("minutes").textContent = m;
                    document.getElementById("seconds").textContent = s;

                    setTimeout(countdown, 1000);
               }
          </script>
          <?php
               require("footer.php");
          ?>
     </body>
</html>