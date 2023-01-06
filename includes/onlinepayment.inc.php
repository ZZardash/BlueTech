<?php
error_reporting(0);
     session_start();
     require"../includes/dbh.inc.php";
     $userID = $_SESSION['userId'];
     $amount = 0;
     
     if(isset($_GET['paymentMethodsb'])){
          // print($userID);
          $username = "SELECT * FROM users WHERE isUsers='$userID'";
          $checkuser = mysqli_query($conn, $username);
          while($row = mysqli_fetch_array($checkuser)){
               $userName = $row['uidUsers'];
               $mobNumber = $row['mobNumber'];
               $userEmail = $row['emailUsers'];
               // print($userName);
               // print($userEmail);
               // print($mobNumber);
          }

          $selectcart = "SELECT * FROM systembuild WHERE userID='$userID'";
          $checkcart = mysqli_query($conn, $selectcart);
          while($rowcart = mysqli_fetch_array($checkcart)){
               $amount += $rowcart['partPrice'];
          }
          
          // Echo "Online";
          $sbname = $_GET['sbname'];
          // print($sbname);
               // print($amount);
          // print_r($parts);
          
          $MERCHENT_KEY = "g1KBgJ0S";
          $SALT = "QX6ZaZDlXb";
          $txnid = "8kEpGUhR5mS3XJor+Y6Sk32SbDzZ4W2vs7sYtfC5fVU=";
          $name = $userName;
          $email = $userEmail;
          $amount = $amount;
          $phone = $mobNumber;
          $surl = "http://localhost/computer-store/cart/order/order.php?sbsuccess&sbname=$sbname";
          $furl = "http://localhost/computer-store/cart/order/payment.php?failure";
          $productinfo = $sbname;
          // print($productinfo);

          $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5||||||salt";
          $hashString = $MERCHENT_KEY."|".$txnid."|".$amount."|".$productinfo."|".$name."|".$email."|||||||||||".$SALT;
          $hash = hash("sha512", $hashSequence);
          $hash = strtolower(hash('sha512', $hashString));

     }
     else{
          // print($userID);
          $username = "SELECT * FROM users WHERE isUsers='$userID'";
          $checkuser = mysqli_query($conn, $username);
          while($row = mysqli_fetch_array($checkuser)){
               $userName = $row['uidUsers'];
               $mobNumber = $row['mobNumber'];
               $userEmail = $row['emailUsers'];
               // print($userName);
               // print($userEmail);
               // print($mobNumber);
          }

          $selectcart = "SELECT * FROM cart WHERE userID='$userID'";
          $checkcart = mysqli_query($conn, $selectcart);
          while($rowcart = mysqli_fetch_array($checkcart)){
               $partID = $rowcart['productid'];
               $selectpart = "SELECT * FROM pcpart WHERE pcpartID='$partID'";
               $checkpart = mysqli_query($conn, $selectpart);
               while($rowpart = mysqli_fetch_array($checkpart)){
                    $parts[] = $rowpart['partTitle'];
                    // $amount += $rowpart['price'];
               }
          }
          $amount = $_SESSION['total'];
          // print($amount);
          // print_r($parts);

          $selectpccart = "SELECT * FROM pccart WHERE userid='$userID'";
          $checkpccart = mysqli_query($conn, $selectpccart);
          while($rowpccart = mysqli_fetch_array($checkpccart)){
               $pcID = $rowpccart['pcid'];
               // print($pcID);
               $selectpc = "SELECT * FROM pc_details WHERE pc_id='$pcID'";
               $checkpc = mysqli_query($conn, $selectpc);
               while($rowpc = mysqli_fetch_array($checkpc)){
                    $parts[] = $rowpc['pcName'];
               }
          }
          // print($amount);
          // print_r($parts);
          
          $MERCHENT_KEY = "g1KBgJ0S";
          $SALT = "QX6ZaZDlXb";
          $txnid = "8kEpGUhR5mS3XJor+Y6Sk32SbDzZ4W2vs7sYtfC5fVU=";
          $name = $userName;
          $email = $userEmail;
          $amount = $amount;
          $phone = $mobNumber;
          $surl = "http://localhost/computer-store/cart/order/order.php?success";
          $furl = "http://localhost/computer-store/cart/order/payment.php?failure";
          $productinfo = join(',',$parts);
          // print($productinfo);

          $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5||||||salt";
          $hashString = $MERCHENT_KEY."|".$txnid."|".$amount."|".$productinfo."|".$name."|".$email."|||||||||||".$SALT;
          $hash = hash("sha512", $hashSequence);
          $hash = strtolower(hash('sha512', $hashString));
     }

?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head >
</head>
<body>
<center>  
<h1>PayUMoney Payment Request Form </h1>
<form action="https://sandboxsecure.payu.in/_payment"  name="payuform" method=POST >
<input type="hidden" name="key"value="<?php echo $MERCHENT_KEY; ?>" />
<!-- <input type="hidden" name="hash_string" value="" /> -->
<input type="hidden" name="hash" value="<?php echo $hash; ?>"/>
<input type="hidden" name="txnid" value="<?php echo $txnid; ?>" />
<table>
<tr>
<td>Amount: </td>
<td><input name="amount" value="<?php echo $amount; ?>" readonly/></td>
<td>First Name: </td>
<td><input name="firstname" id="firstname" value="<?php echo $name; ?>" readonly/></td>
</tr>
<tr>
<td>Email: </td>
<td><input name="email" id="email" value="<?php echo $email; ?>" readonly/></td>
<td>Phone: </td>
<td><input name="phone" value="<?php echo $phone; ?>"  /></td>
</tr>
<tr>
<td>Product Info: </td>
<td colspan="3"><textarea rows="7" cols="80" name="productinfo" readonly><?php echo $productinfo ?></textarea></td>
</tr>
<tr>
<td ></td>
<td colspan="3"><input type="hidden" name="surl"  size="64"  value="<?php echo $surl; ?>" /></td>
</tr>
<tr>
<td></td>
<td colspan="3"><input type="hidden" name="furl"  size="64"  value="<?php echo $furl; ?>" /></td>
</tr>
<tr>
<td colspan="3"><input type="hidden" name="service_provider" value="payu_paisa" /></td>
</tr>
<tr>
</tr>
<td colspan="4"><input type="submit" name="payu" value="Submit"  /></td>
</tr>
</table>
</form>
</center>
</body>
</html>