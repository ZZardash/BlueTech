<?php
    require '../includes/dbh.inc.php';
    
    if(isset($_POST['delete-account'])){
          $userID = $_SESSION['userId'];
          $orderdelete = "DELETE FROM orders WHERE userID='$userID'";
          $checkorderdelete = mysqli_query($conn, $orderdelete);
          $userdelete = "DELETE FROM users WHERE isUsers='$userID'";
          $checkuserdelete = mysqli_query($conn, $userdelete);
          if($checkuserdelete){
               header("LOCATION: ../includes/logout.inc.php");
               header("LOCATION: index.php");
          }
    }
    else{
          header("LOCATION: myAccount.php?not");
    }
?>
<div>
     <h1>Are you sure want to delete your account?</h1>
     <div class="mt-1">
          <div class="container">
               <form action="" method="POST">
                    <div class="d-flex jcsa">
                         <button type="submit" name="delete-account" style="padding:10px 14px;margin-top:20px;background:#28AB87;font-size:20px; border:none; color:white;" class="b-rad-1 shadow-md">
                              <i class="fa fa-check pr-sm"></i>
                              Yes
                         </button>
                         <a href="myAccount.php?myorders" style="color:white; background:red;" class="mt-1 py-sm px-1 b-rad-1 text-deco-none shadow-md" >
                              <i class="fa fa-close pr-sm"></i>
                              No
                         </a>
                    </div>
               </form>
          </div>
     </div>
</div>