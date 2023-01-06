<?php
error_reporting(0);
     require_once "config.inc.php";
     if(isset($_GET['code'])){
          $token = $gClient->fetchAccessTokenWithAuthCode($_GET['code']);
          // print($token);
          $_SESSION['access_token'] = $token;
     }
     else{
          header('location: ../login.php');
          exit();
     }
     
     $oAuth = new Google_Service_Oauth2($gClient);
     $userData = $oAuth->userinfo_v2_me->get();

     // echo"<pre>";
     // var_dump($userData);

     $_SESSION['email'] = $userData['email'];
     $_SESSION['picture'] = $userData['picture'];
     $_SESSION['familyName'] = $userData['familyName'];
     $_SESSION['givenName'] = $userData['givenName'];

     header('location: ../googlelogin.php?google');
     exit();
     

?>