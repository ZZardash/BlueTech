<?php
error_reporting(0);
     if(isset($_GET['partorder'])){
          if($_GET['partorder'] == "dispatched"){
               $status = "Dispatched";
               $partID = $_GET['partID'];
               //print($partID);
               //print($status);
               $updateorder = "UPDATE orders SET sttus='$status' WHERE partID='$partID' ";
               $check = mysqli_query($conn, $updateorder);
               if($check){
                    header("LOCATION: dashboard.php?partorder");
               }
          }
          
     }elseif(isset($_GET['pcorder'])){
          if($_GET['pcorder'] == "dispatched"){
               $status = "Dispatched";
               $pcID = $_GET['pcID'];
               //print($partID);
               //print($status);
               $updateorder = "UPDATE orders SET sttus='$status' WHERE pcID='$pcID' ";
               $check = mysqli_query($conn, $updateorder);
               if($check){
                    header("LOCATION: dashboard.php?pcorder");
               }
          }
     }elseif(isset($_GET['sborder'])){
          if($_GET['sborder'] == "dispatched"){
               $status = "Dispatched";
               $sbpcID = $_GET['sbpcID'];
               //print($partID);
               //print($status);
               $updatesborder = "UPDATE sbpc SET sttus='$status' WHERE sbPCID='$sbpcID' ";
               $check = mysqli_query($conn, $updatesborder);
               if($check){
                    header("LOCATION: dashboard.php?sborder");
               }
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
               if(isset($_GET['partorder'])){
                         $checkselect = "SELECT * FROM orders WHERE partID !=0 ";
                         $check = mysqli_query($conn, $checkselect);
                         $countrow = mysqli_num_rows($check);
                         // print($countrow);
                         if($countrow == 0){
                              echo "<div class='text-center '><b>No items in Your orders List</b></div>";
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
                                        <th>Dispatch</th>
                                   </tr>
                              </thead>
                              <tbody class="text-left">
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
                                                                                if($status == "Pending"){
                                                                                echo'<div style="background:#28AB87" class="py-sm px-1 b-rad-1 shadow-sm">
                                                                                     <a class="text-deco-none text-white" href="dashboard.php?partorder=dispatched&partID='.$partID.'">Confirm</a>
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
                                        else{
                                             echo"Sql Connection problem";
                                        }
                                   ?>
                              </tbody>
                         </table>
                    <?php }
                    }elseif(isset($_GET['pcorder'])){
                    $checkselect = "SELECT * FROM orders WHERE pcID !=0 ";
                    $check = mysqli_query($conn, $checkselect);
                    $countrow = mysqli_num_rows($check);
                    // print($countrow);
                    if($countrow == 0){
                         echo "<div class='text-center '><b>No items in Your orders List</b></div>";
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
                                        <th>Status</th>
                                   </tr>
                              </thead>
                              <tbody class="text-left">
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
                                                                                if($pcstatus == "Pending"){
                                                                                echo'<div style="background:#28AB87" class="py-sm px-1 b-rad-1 shadow-sm">
                                                                                     <a class="text-deco-none text-white" href="dashboard.php?pcorder=dispatched&pcID='.$pcID.'">Confirm</a>
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
                                        else{
                                             echo"Sql Connection problem";
                                        }

                                   ?>
                              </tbody>
                         </table>
                                   <?php }
               }elseif(isset($_GET['sborder'])){
                    $checkselect = "SELECT * FROM sborders ";
                    $check = mysqli_query($conn, $checkselect);
                    $countrow = mysqli_num_rows($check);
                    // print($countrow);
                    if($countrow == 0){
                         echo "<div class='text-center '><b>No items in Your orders List</b></div>";
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
                                   </tr>
                              </thead>
                              <tbody class="text-left">
                                   <?php
                                        $order = "SELECT * FROM sborders";
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
                                                       $status = $orderrow['status'];

                                                       $selectpart = "SELECT * FROM pcpart WHERE pcPartID='$partID'";
                                                       $checkselect = mysqli_query($conn, $selectpart);
                                                       while($order = mysqli_fetch_array($checkselect)){
                                                            $partName = $order["partTitle"];
                                                            echo'
                                                                 <tr>
                                                                      <th>'.$orderNumber.'</th>
                                                                      <th>'.$userID.'</th>
                                                                      <th>'.$partName.'</th>
                                                                      <th>'.$partQty.'</th>
                                                                      <th>'.$totalAmount.'</th>
                                                                      <th>'.$orderDate.'</th>
                                                                      <th>'.$payment.'</th>
                                                                 </tr>
                                                            ';
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
                         <table class="content-table">
                              <thead>
                                   <tr>
                                        <th>Order Number:</th>
                                        <th>User ID</th>
                                        <th>PC Name:</th>
                                        <th>Amount:</th>
                                        <th>Order Date:</th>
                                        <th>Payment:</th>
                                        <th>Packing Type:</th>
                                        <th>Status:</th>
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
                                                  $packing = $orderrow['PackingType'];
                                                  $grandTotal = $orderrow['amount'];
                                                  echo"
                                                       <tr>
                                                            <th>".$orderNumber."</th>
                                                            <th>".$userID."</th>
                                                            <th>".$pcName."</th>
                                                            <th>".$grandTotal."</th>
                                                            <th>".$orderDate."</th>
                                                            <th>".$payment."</th>
                                                            <th>".$packing."</th>
                                                            <th>";?>
                                                            <?php 
                                                                 if($status == "Pending"){
                                                                 echo'<div style="background:#28AB87" class="py-sm px-1 b-rad-1 shadow-sm">
                                                                      <a class="text-deco-none text-white" href="dashboard.php?sborder=dispatched&sbpcID='.$sbpcID.'">Confirm</a>
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