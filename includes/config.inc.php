<?php
     session_start();
     require_once realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '../GoogleAPI/vendor/autoload.php');
     // require_once"../GoogleAPI/vendor/autoload.php";

     $gClient = new Google_Client();

     $gClient->setClientId("1013570433050-9ia00aoujinqpt9ub5533ls68l32r5lb.apps.googleusercontent.com");
     $gClient->setClientSecret("Xls-MD9KAqeyBZFAR-QJByXz");

     $gClient->setApplicationName("CPI Login");
     $gClient->setRedirectUri("http://localhost/computer-store/includes/g-callback.inc.php");

     $gClient->addScope("https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email");


?>