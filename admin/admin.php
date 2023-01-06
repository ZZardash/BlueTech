<?php
include"../includes/dbh.inc.php";
?>
<!DOCTYPE html>
 <html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Computer-Store | Admin</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" type="image/png" href="../img/favicon.png" >
        <link rel="stylesheet" href="../style.css">
        <link rel="stylesheet" href="../customstyle.css">
        <style> 
            .flex-container{
                height:100vh;
                display: flex;
                justify-content: center;
                align-items: center;
            }
            .g-bg-color{
                background: #28AB87;
            }
            .admin-input{
                width: 250px;
                height: 45px;
                margin: 10px;
                outline: none;
                border-radius: 10px;
                border: 1px solid gray;
                padding: 10px;
                transition: ease-in-out, width .35s ease-in-out;
            }
            .admin-input:focus{
                width: 270px;
                border: 2px solid #696969;
            }
            #submit{
                margin: 20px;
                width: 100px;
                padding: 10px;
                outline: none;
                background: #28AB87;
                color: white;
                border: none;
                border-radius: 10px;
            }
        </style>
    </head>
    <body class="g-bg-color">
        <div class="flex-container">
            <div class="d-flex md-d-flex md-flex-col white  b-rad-2">
                <div class="p-1 text-center b-rad-2" style="background:#e0e0e0;">
                    <img width="400" height="300" src="../img/hello.jpg" alt="Hello">
                </div>
                <?php
                    error_reporting(0);
                    if(isset($_POST['submit'])){
                        $name = $_POST['login-email'];
                        $password = $_POST['login-password'];
                        // print($name);
                        print($password);
                        $checkadmin = "SELECT * FROM admins WHERE adminName='$name' OR adminEmail='$name'";
                        $check = mysqli_query($conn, $checkadmin);
                        if($row = mysqli_fetch_array($check)){
                            $pwdCheck = password_verify($password, $row['adminPassword']);
                            if($pwdCheck == false){
                                header("Location: ./admin.php?error=wrongpassword");
                                exit();
                            }
                            elseif($pwdCheck == true){
                                session_start();
                                $_SESSION['adminID'] = $row['adminID'];
                                $_SESSION['adminName'] = $row['adminName'];
                                header("Location: ./dashboard.php");
                                exit();
                            }
                        }
                        else{
                            header("LOCATION: ./admin.php?error=noadmin");
                        }
                    }
                    

                ?>
                <!-- Login Form -->
                <div class="min-h-100 white b-rad-2 p-2">
                    <div style="width:400px;">
                        <div class="text-center">
                            <h4 style="color:gray" >Welcome Back!</h4>
                        </div>
                        <div class="mt-2">
                            <?php
                                if(isset($_GET['error'])){
                                    if($_GET['error'] == "noadmin"){
                                        echo"<div style='color:red;font-size:12px;' class='text-center'>No Admin exists</div>";
                                    }
                                    elseif($_GET['error'] == "wrongpassword"){
                                        echo"<div style='color:red;font-size:12px;' class='text-center'>Wrong Password!!</div>";
                                    }
                                }
                            ?>
                            <form action="" method="POST" id="login-form">
                                <div class="text-center">
                                    <input name="login-email" class="admin-input" type="text" placeholder="Enter Email Address...">
                                </div>
                                <div class="text-center">
                                    <input name="login-password" class="admin-input" type="password" placeholder="Password...">
                                </div>
                                <div class="text-center my-1">
                                    <input style="background:#28AB87;color:white" class="btn py-sm px-1 b-rad-1 shadow-sm " name="submit" type="submit">
                                </div>
                            </form>
                            <hr>
                            <div class="text-center mt-1">
                                <a style="color:gray;font-size:16px;" class="text-deco-none" href="../forget-pwd.php?admin">Forget Password?</a>
                            </div>
                            <p style="color:red" class="error text-center"></p>
                        </div>
                    </div>
                </div>
                <!-- Login Ends -->
                
            </div>
        </div>
    </body>
 </html>