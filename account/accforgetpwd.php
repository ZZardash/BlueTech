<?php
    require '../includes/dbh.inc.php';
    
    if(isset($_POST['update-submit'])){
          $password = $_POST['up-pwd'];
          $passwordCheck = $_POST['up-pwd-repeat'];
          $userID = $_SESSION['userId'];
          if($password != $passwordCheck){
               header("location: myAccount.php?changePassword&error=passwordwrong");
          }
          else{
               $hashedUpdatedPwd = password_hash($password, PASSWORD_DEFAULT);
               $query = "UPDATE users SET pwdUsers='$hashedUpdatedPwd' WHERE isUsers='$userID';";
               $connect = mysqli_query($conn, $query);
               if($connect){
                    header("LOCATION: myAccount.php?haha");
               }
               else{
                    header("LOCATION: myAccount.php?changePassword&update=unsuccess");
               }
        }
    }
    else{
          header("LOCATION: myAccount.php?not");
    }
?>
<style>
     .input-field-f{
          border:1px solid #28AB87;
          padding: 15px;
          margin: 10px;
          width: 400px;
          outline: none;
     }
     .input-field-f:hover{
          border:2px solid #28AB87;
          outline: none;
     transition: ease-in-out, width .35s ease-in-out;
     }
     .input-field-f:focus{
          width: 450px;
          border:2px solid #28AB87;
          outline: none;
     }
</style>
<div>
     <h1 style="color:#28AB87">Change Password</h1>
     <div style="padding:60px;">
          <form action="" method="POST">
               <input style="" name="up-pwd" type="password" placeholder="Enter a password..." class="input-field-f b-rad-2"><br>
               <input type="password" name="up-pwd-repeat" placeholder="Confirm your password..." class="input-field-f b-rad-2"><br>
               <button type="submit" name="update-submit" style="padding:10px 14px;margin-top:20px;width:170px;background:#28AB87; border:none; color:white;" class="b-rad-2 shadow-md">
                    <i class="fa fa-refresh pr-sm"></i>
                    Update Now
               </button>
          </form>
     </div>
</div>