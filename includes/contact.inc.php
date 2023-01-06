<?php
     if(isset($_POST["contact-submit"])){
          $name = $_POST["c-name"];
          $email = $_POST["c-email"];
          $subject = $_POST["c-subject"];
          $message = $_POST["c-message"];
          // print($name);
          // print($email);
          // print($subject);
          // print($message);
          
          $mailTo = "agnelselvan007@yahoo.com";
          $headers = "From: ".$email;
          $body = "You have received a mail from ".$name.".\n\n".$message;

          // print($mailTo);
          // print($headers);
          // print($body);
          // print($subject);
          if(mail($mailTo, $subject, $body, $headers )){
               header("LOCATION: ../contact.php?mail=success");
          }
          else{
               header("LOCATION: ../contact.php?mail=unsuccess");
          }
          
     }
     else{
          header("Location: ../login.php");
          exit();
      
     }
?>