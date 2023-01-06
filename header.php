<?php
    include("./functions/functions.php");
    session_start();
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
        </script>
    </head>
    <body>
    <div style="position:sticky;top:0px;z-index:1;height:7vh;" class="d-flex flex-col w-100 white">
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
                <div class="mt-1">
                    <?php
                        loginORnot();
                    ?>
                </div>
            </div>
        </div>
    