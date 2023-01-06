<?php
    require "./includes/dbh.inc.php";
    include("./functions/functions.php");
    session_start();
?>
<!DOCTYPE html>
 <html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Computer-Store | About</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/png" href="img/favicon.png" >
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css" integrity="sha384-rtJEYb85SiYWgfpCr0jn174XgJTn4rptSOQsMroFBPQSGLdOC5IbubP6lJ35qoM9" crossorigin="anonymous">
        <style>
            @media screen and (max-width:600px){
                .responsive-container{
                    margin: 0px;
                    padding:0px;
                    display: flex;
                    flex-direction: column;
                    min-width: 80vw;
                }
            }
        </style>
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
                <div class="mt-1">
                    <?php
                        loginORnot();
                    ?>
                </div>
            </div>
        </div>
        <div class="">
            <div class="container  responsive-container">
                <div style=" height:45px; font-size:18px;" class="py-sm pl-2 my-1 b-rad-2 shadow-sm white text-left"><a style="color:#28AB87;" class="text-deco-none" href="../index.php">Home</a> > About</div>
            </div>
            <div class="container  responsive-container b-rad-2 shadow-md pt-2 pb-3 white">
                <h1 style="font-size:32px;" class="my-1 slide-in">ABOUT</h1>
                <div class="container fade-in">
                                <div class="my-2">
                                    <h3 align="left">Pick Parts. Build Your PC. Compare And Share.</h3>
                                    <div class="b-1 text-black mb-1"></div>
                                    <p align="left">PCPartPicker provides computer part selection, compatibility, and pricing guidance for do-it-yourself computer builders. Assemble your virtual part lists with PCPartPicker and we'll provide compatibility guidance with up-to-date pricing from dozens of the most popular online retailers. We make it easy to share your part list with others, and our community forums provide a great place to discuss ideas and solicit feedback.</p>
                                </div>
                                <div class="my-2">
                                    <h3 align="left">Simplified Building</h3>
                                    <div class="b-1 text-black mb-1"></div>
                                    <p align="left">Part lists broken out by filterable categories to ensure you include all the necessary components.
                                    Automatic compatibility guidance limits choices to parts known to be compatible, and warns you if you pick incompatible parts.
                                    Easy sharing through Twitter, Facebook, part list permalinks, as well as auto-generated markup text for Reddit and many forums.</p> 
                                </div>
                                <div class="my-2">
                                    <h3 align="left">Price Tracking</h3>
                                    <div class="b-1 text-black mb-1"></div>
                                    <p align="left">Continuously updated prices from dozens of the most popular online retailers.
                                    Configurable mail-in rebates and sales tax rates - easily enable/disable mail-in rebates and per-retailer tax rates in price calculations.
                                    Price history charts for both parts and part lists.
                                    Price trending on a part category basis lets you see what is happening to prices on a macro level.</p>
                                </div>
                                <div class="my-2">
                                    <h3 align="left">Price Alerts</h3>
                                    <div class="b-1 text-black mb-1"></div>
                                    <p align="left">Part price alerts let you set price thresholds on specific parts - get notified by email when a retailer offers a price lower than your set amount.Parametric price alerts let you set price alerts on an entire product category with customizable filters.</p>
                                </div>
                                <div class="my-2">
                                    <h3 align="left">Community</h3>
                                    <div class="b-1 text-black mb-1"></div>
                                    <p align="left">Forums provide a great place to solicit ideas and part list feedback.
            Completed Builds posted by users let you see a range of builds, filterable by part types.</p>
                                </div>
                    </div>
                </div>
                
        </div>
    </body>
 </html>
<?php
     require "./footer.php";
?>