<?php
     error_reporting(0);
     if(isset($_GET['deliveredpart'])){
          if($_GET['deliveredpart'] == "delivered"){
               $partID = $_GET['partID'];
               $deleteorder = "DELETE FROM orders WHERE partID='$partID'";
               $check = mysqli_query($conn, $deleteorder);
          }
     }
     elseif(isset($_GET['deliveredsb'])){
          if($_GET['deliveredsb'] == "delivered"){
               $sbpcID = $_GET['sbpcID'];
               $select = "SELECT * FROM sbpc WHERE sbPCID='$sbpcID'";
               $selectcheck = mysqli_query($conn, $select);
               while($row = mysqli_fetch_array($selectcheck)){
                    $orderNumber = $row['orderNumber'];
                    $deletesb = "DELETE FROM sborders WHERE ordernumber='$orderNumber'";
                    $deletecheck = mysqli_query($conn, $deletesb);
                    $deleteorder = "DELETE FROM sbpc WHERE sbPCID='$sbpcID'";
                    $check = mysqli_query($conn, $deleteorder);
               }
          }
     }
     elseif(isset($_GET['deliveredpc'])){
          if($_GET['deliveredpc'] == "delivered"){
               $pcID = $_GET['pcID'];
               $deleteorder = "DELETE FROM orders WHERE pcID='$pcID'";
               $check = mysqli_query($conn, $deleteorder);
          }
     }
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Computer-Store</title>
     <style>
          .content-table{
                  border-collapse: collapse;
                  margin: 25px 0;
                  font-size: 0.9rem;
                  min-width: 400px;
                  width: 90%;
                  height:50%;
             }
             .content-table thead tr{
                  background: #009879;
                  color: white;
                  text-align: left;
                  font-weight: bold;
             }
             .content-table th,
             .content-table td{
                    padding: 12px 15px;
             }
             .content-table tbody tr{
                  border-bottom: 1px solid #dddddd;
             }
             .content-table tbody tr:nth-last-of-type(even){
                  background: #f3f3f3;
             }
             .content-table tbody tr:last-of-type{
               border-bottom: 2px solid #009879;
             }
          @media screen and (max-width:767.98px){
               .acc-table{
                    max-width: 100%;
               }
               .content-table{
                    border-collapse: collapse;
                    margin: 0;
                    font-size: 0.56rem;
                    min-width: 40%;
                    height:50%;
               }
               .content-table thead tr{
                  background: #009879;
                  color: white;
                  text-align: left;
                  font-weight: bold;
             }
             .content-table th,
             .content-table td{
                    padding: 12px 15px;
             }
             .content-table tbody tr{
                  border-bottom: 1px solid #dddddd;
             }
             .content-table tbody tr:nth-last-of-type(even){
                  background: #f3f3f3;
             }
             .content-table tbody tr:last-of-type{
               border-bottom: 2px solid #009879;
             }
          }
     </style>
</head>
<body>
     <div class="mt-4"></div>
     <div class=" container">
          <?php
               if(isset($_GET['deliveredpart'])){
                    $checkselect = "SELECT * FROM orders WHERE partID !=0 and sttus='Dispatched'";
                    $check = mysqli_query($conn, $checkselect);
                    $countrow = mysqli_num_rows($check);
                    // print($countrow);
                    if($countrow == 0){
                         echo "<div class='text-center '><b>All items Delivered !</b></div>";
                    }
                    else{
                    ?>
                         <table class="content-table">
                              <thead>
                                   <tr>
                                        <th>Order Number:</th>
                                        <th>User ID</th>
                                        <th>Product Name:</th>
                                        <th>Quantity:</th>
                                        <th>Amount:</th>
                                        <th>Order Date:</th>
                                        <th>Payment</th>
                                        <th>Delivered</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php
                                        $order = "SELECT * FROM orders";
                                        $check = mysqli_query($conn, $order);
                                        if($check){
                                             while($orderrow = mysqli_fetch_array(($check))){
                                                  if($orderrow['partID'] != 0){
                                                       $orderNumber = $orderrow['ordernumber'];
                                                       $userID = $orderrow['userID'];
                                                       $partID = $orderrow['partID'];
                                                       $partQty = $orderrow['partQty'];
                                                       $payment = $orderrow['paymentMethod'];
                                                       $totalAmount = $orderrow['totalAmount'];
                                                       $orderDate = $orderrow['date'];
                                                       $status = $orderrow['sttus'];

                                                       $selectpart = "SELECT * FROM pcpart WHERE pcPartID='$partID'";
                                                       $checkselect = mysqli_query($conn, $selectpart);
                                                       while($order = mysqli_fetch_array($checkselect)){
                                                            $partName = $order["partTitle"];
                                                            if($status == "Dispatched"){
                                                                 echo'
                                                                      <tr>
                                                                           <th>'.$orderNumber.'</th>
                                                                           <th>'.$userID.'</th>
                                                                           <th>'.$partName.'</th>
                                                                           <th>'.$partQty.'</th>
                                                                           <th>'.$totalAmount.'</th>
                                                                           <th>'.$orderDate.'</th>
                                                                           <th>'.$payment.'</th>
                                                                           <th>';?>
                                                                                <?php 
                                                                                     if($status == "Dispatched"){
                                                                                     echo'<div style="background:#28AB87" class="py-sm px-1 b-rad-1 shadow-sm">
                                                                                          <a class="text-deco-none text-white" href="dashboard.php?deliveredpart=delivered&partID='.$partID.'">Confirm</a>
                                                                                     </div>
                                                                                     ';}
                                                                                     else{
                                                                                     ?><?php
                                                                                          echo"Confirmed";
                                                                                     }
                                                                                     echo'
                                                                           </th>
                                                                      </tr>
                                                                 ';
                                                            }
                                                       }
                                                  }
                                             }
                                        }
                                        else{
                                             echo"Sql Connection problem";
                                        }
                                   ?>
                              </tbody>
                         </table>
                    <?php }
               }elseif(isset($_GET['deliveredpc'])){
                    $checkselect = "SELECT * FROM orders WHERE pcID != 0 and sttus='Dispatched'";
                    $check = mysqli_query($conn, $checkselect);
                    $countrow = mysqli_num_rows($check);
                    // print($countrow);
                    if($countrow == 0){
                         echo "<div class='text-center '><b>All items Delivered!</b></div>";
                    }
                    else{
                    ?>
                         <table class="content-table">
                              <thead>
                                   <tr>
                                        <th>Order Number:</th>
                                        <th>User ID</th>
                                        <th>PC Name:</th>
                                        <th>Quantity:</th>
                                        <th>Amount:</th>
                                        <th>Order Date:</th>
                                        <th>Payment</th>
                                        <th>Delivered</th>
                                   </tr>
                              </thead>
                              <tbody>
                                   <?php
                                        $order = "SELECT * FROM orders";
                                        $check = mysqli_query($conn, $order);
                                        if($check){
                                             while($orderrow = mysqli_fetch_array(($check))){
                                                  if($orderrow['pcID'] != 0){
                                                       $orderNumber = $orderrow['ordernumber'];
                                                       $userID = $orderrow['userID'];
                                                       $pcID = $orderrow['pcID'];
                                                       $partQty = $orderrow['partQty'];
                                                       $payment = $orderrow['paymentMethod'];
                                                       $totalAmount = $orderrow['totalAmount'];
                                                       $orderDate = $orderrow['date'];
                                                       $pcstatus = $orderrow['sttus'];

                                                       $selectpc = "SELECT * FROM pc_details WHERE pc_id='$pcID'";
                                                       $checkselect = mysqli_query($conn, $selectpc);
                                                       while($order = mysqli_fetch_array($checkselect)){
                                                            $pcName = $order["pcName"];
                                                            if($pcstatus == "Dispatched"){
                                                                 echo'
                                                                      <tr>
                                                                           <th>'.$orderNumber.'</th>
                                                                           <th>'.$userID.'</th>
                                                                           <th>'.$pcName.'</th>
                                                                           <th>'.$partQty.'</th>
                                                                           <th>'.$totalAmount.'</th>
                                                                           <th>'.$orderDate.'</th>
                                                                           <th>'.$payment.'</th>
                                                                           <th>';?>
                                                                                <?php 
                                                                                     if($pcstatus == "Dispatched"){
                                                                                     echo'<div style="background:#28AB87" class="py-sm px-1 b-rad-1 shadow-sm">
                                                                                          <a class="text-deco-none text-white" href="dashboard.php?deliveredpc=delivered&pcID='.$pcID.'">Confirm</a>
                                                                                     </div>
                                                                                     ';}
                                                                                     else{
                                                                                     ?><?php
                                                                                          echo"Confirmed";
                                                                                     }
                                                                                     echo'
                                                                           </th>
                                                                      </tr>
                                                                 ';
                                                            }
                                                       }
                                                  }
                                             }
                                        }
                                        else{
                                             echo"Sql Connection problem";
                                        }

                                   ?>
                              </tbody>
                         </table>
                    <?php }
               }elseif(isset($_GET['deliveredsb'])){
                    $checkselect = "SELECT * FROM sborders WHERE partID !=0 ";
                    $check = mysqli_query($conn, $checkselect);
                    $countrow = mysqli_num_rows($check);
                    // print($countrow);
                    if($countrow == 0){
                         echo "<div class='text-center '><b>All items Delivered!</b></div>";
                    }
                    else{
                    ?>
                         <table class="content-table">
                              <thead>
                                   <tr>
                                        <th>Order Number:</th>
                                        <th>User ID</th>
                                        <th>PC Name:</th>
                                        <th>Amount:</th>
                                        <th>Order Date:</th>
                                        <th>Payment:</th>
                                        <th>Delivered:</th>
                                   </tr>
                              </thead>
                              <tbody class="text-left">
                                   <?php
                                        $order = "SELECT * FROM sbpc";
                                        $check = mysqli_query($conn, $order);
                                        if($check){
                                             while($orderrow = mysqli_fetch_array(($check))){
                                                  $sbpcID = $orderrow['sbPCID'];
                                                  $orderNumber = $orderrow['orderNumber'];
                                                  $userID = $orderrow['userID'];
                                                  $pcName = $orderrow['pcName'];
                                                  $payment = $orderrow['paymentMethod'];
                                                  $orderDate = $orderrow['date'];
                                                  $status = $orderrow['sttus'];
                                                  $grandTotal = $orderrow['amount'];
                                                  echo"
                                                       <tr>
                                                            <th>".$orderNumber."</th>
                                                            <th>".$userID."</th>
                                                            <th>".$pcName."</th>
                                                            <th>".$grandTotal."</th>
                                                            <th>".$orderDate."</th>
                                                            <th>".$payment."</th>
                                                            <th>";?><?php 
                                                                                     if($status == "Dispatched"){
                                                                                     echo'<div style="background:#28AB87" class="py-sm px-1 b-rad-1 shadow-sm">
                                                                                          <a class="text-deco-none text-white" href="dashboard.php?deliveredsb=delivered&sbpcID='.$sbpcID.'">Confirm</a>
                                                                                     </div>
                                                                                     ';}
                                                                                     else{
                                                                                     ?><?php
                                                                                          echo"Confirmed";
                                                                                     }
                                                                 echo"</th>
                                                       </tr>
                                                  ";
                                             }
                                        }
                                        else{
                                             echo"Sql Connection problem";
                                        }

                                   ?>
                              </tbody>
                         </table>
                    <?php }
               }
          ?>
     </div>
</body>
</html>