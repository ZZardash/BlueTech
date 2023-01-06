<?php
require_once realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '../vendor/autoload.php');
require_once 'dbh.inc.php';
     // Create the Transport
     $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
     ->setUsername(EMAIL)
     ->setPassword(PASSWORD)
     ;

     // Create the Mailer using your created Transport
     $mailer = new Swift_Mailer($transport);

     function sendVerificationEmail($userEmail){
          global $mailer;
          $body = '<!DOCTYPE html>
          
               <head>
                    <meta charset="utf-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <title>Verify Email</title>
                    <meta name="description" content="">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <link rel="stylesheet" href="">
               </head>
               <body>
                    <p>
                         Thank you for signing  on our website. Please click on the link below to update you password.
                    </p>
                    <a href="http://localhost/computer-store/update-pwd.php">
                         Verify your Email
                    </a>
                    <script src="" async defer></script>
               </body>
          </html>';
          // Create a message
          $message = (new Swift_Message('Verify your email address'))
          ->setFrom(EMAIL)
          ->setTo($userEmail)
          ->setBody($body, 'text/html')
          ;

          // Send the message
          $result = $mailer->send($message);
          if(!$result){
               header("location: ../forget-pwd.php?mail=notsent");
          }

     }

     function sendAdminVerificationEmail($userEmail){
          global $mailer;
          $body = '<!DOCTYPE html>
          
               <head>
                    <meta charset="utf-8">
                    <meta http-equiv="X-UA-Compatible" content="IE=edge">
                    <title>Verify Email</title>
                    <meta name="description" content="">
                    <meta name="viewport" content="width=device-width, initial-scale=1">
                    <link rel="stylesheet" href="">
               </head>
               <body>
                    <p>
                         Thank you for signing on our website. Please click on the link below to update you password.
                    </p>
                    <a href="http://localhost/computer-store/update-pwd.php?admin">
                         Verify your Email
                    </a>
                    <script src="" async defer></script>
               </body>
          </html>';
          // Create a message
          $message = (new Swift_Message('Verify your email address'))
          ->setFrom(EMAIL)
          ->setTo($userEmail)
          ->setBody($body, 'text/html')
          ;

          // Send the message
          $result = $mailer->send($message);
          if(!$result){
               header("location: ../forget-pwd.php?mail=notsent");
          }

     }

?>