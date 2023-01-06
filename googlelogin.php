<?php
  require_once"./includes/config.inc.php";
  require_once"./includes/dbh.inc.php";
  $loginURL = $gClient->createAuthUrl();
  $userEmail = $_SESSION['email'];
  $userName = $_SESSION['givenName'];
  $userIamge = $_SESSION['picture'];
  // print($userEmail);
  if(isset($_GET['google'])){

    $select = "SELECT * FROM users WHERE emailUsers='$userEmail'";
    $selectcheck = mysqli_query($conn, $select);
    if($rowuser = mysqli_fetch_array($selectcheck)){
      $address = $rowuser['address'];
      $mobNumber = $rowuser['mobNumber'];
      $country = $rowuser['country'];
      $state = $rowuser['state'];

      if(!empty($address) and !empty($mobNumber) and !empty($country) and !empty($state) ){
          session_start();
          $_SESSION['userId'] = $rowuser['isUsers'];
        header("LOCATION: indexcopy.php");
      }
    }
    else{
      $number = mysqli_num_rows($selectcheck);
      if($number == 0){
        $insert = "INSERT INTO users VALUES(NULL, '$userName', '$userEmail', '', '', '', '', '', '$userIamge')";
        $query = mysqli_query($conn, $insert);
        $select = "SELECT * FROM users WHERE emailUsers='$userEmail'";
        $selectcheck = mysqli_query($conn, $select);
        while($row = mysqli_fetch_array($selectcheck)){
          // print($row['isUsers']);
        $_SESSION['userId'] = $row['isUsers'];
      }
      }
    }
  }
  if(isset($_POST['submituser'])){
    $address = $_POST['address'];
    $mobnumber = $_POST['mobnumber'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $userID = $_SESSION['userId'];
    // print($userEmail);
    // print($address);
    // print($mobnumber);
    // print($state);
    // print($country);
    
    $insertdata = "UPDATE users SET mobNumber='$mobnumber',address='$address',country='$country',state='$state' WHERE isUsers='$userID'" ;
    $query = mysqli_query($conn, $insertdata);
    if($query){
      print("Successfull");
      header("LOCATION: indexcopy.php");
    }
    else{
      print("Error");
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {font-family: Arial, Helvetica, sans-serif;}
        form {border: 3px solid #f1f1f1;}

        input[type=text], input[type=password],input[type=number] {
          width: 100%;
          padding: 12px 20px;
          margin: 8px 0;
          display: inline-block;
          border: 1px solid #ccc;
          box-sizing: border-box;
        }

        button {
          background-color: #4CAF50;
          color: white;
          padding: 14px 20px;
          margin: 8px 0;
          border: none;
          cursor: pointer;
          width: 100%;
        }
        .google{
            background-color: red;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }
        .submit{
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }
        .submit:hover {
          opacity: 0.8;
        }

        .cancelbtn {
          width: auto;
          padding: 10px 18px;
          background-color: #f44336;
        }

        .imgcontainer {
          text-align: center;
          margin: 24px 0 12px 0;
        }

        img.avatar {
          width: 40%;
          border-radius: 50%;
        }

        .container {
          padding: 16px;
        }

        span.psw {
          float: right;
          padding-top: 16px;
        }

        /* Change styles for span and cancel button on extra small screens */
        @media screen and (max-width: 300px) {
          span.psw {
            display: block;
            float: none;
          }
          .cancelbtn {
            width: 100%;
          }
        }
    </style>
  </head>
  <body>

  <h2>Login Form</h2>
        <div style="font-size:12px;color:#4CAF50;padding-bottom:20px;">Please fill more details!</div>
  <form action="" method="post">
      <div class="container">
           <?php
              if(isset($_GET['google'])){
              ?>
                <form action="" method="POST">
                  <input type="number" name="mobnumber" placeholder="Enter your mobile number..." required>
                  <input type="text" name="address" placeholder="Enter your address..." required>
                  <input type="text" name="state" placeholder="Enter your state..." required>
                  <input type="text" name="country" placeholder="Enter your country..." required>
                  <input type="submit" name="submituser">
                </form>
              <?php
              }
           ?>
      </div>
      
  </form>

  </body>
</html>
