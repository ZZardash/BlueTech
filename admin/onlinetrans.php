<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <link rel="shortcut icon" type="image/png" href="../img/favicon.png" >
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
                  background: #E0E0E0;
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
     <table class="content-table">
          <thead>
               <tr>
                    <th>Order Number:</th>
                    <th>User ID</th>
                    <th style="width:200px">Product Names:</th>
                    <th>Amount:</th>
                    <th>Order Date:</th>
                    <th>Payu Money ID</th>
               </tr>
          </thead>
          <tbody style="" class="text-left">
          <?php
          $selectonline = "SELECT * FROM payu;";
          $checkonline = mysqli_query($conn, $selectonline);
          $countrow = mysqli_num_rows($checkonline);
          while($row = mysqli_fetch_array($checkonline)){
               
               $orderNumber = $row['orderID'];
               $userID = $row['userID'];
               $productinfo = $row['productinfo'];
               $amount = $row['amount'];
               $date = $row['time'];
               $payMoneyID = $row['payuMoneyID'];
               echo'
                    <tr>
                         <th>'.$orderNumber.'</th>
                         <th>'.$userID.'</th>
                         <th>'.$productinfo.'</th>
                         <th>'.$amount.'</th>
                         <th>'.$date.'</th>
                         <th>'.$payMoneyID.'</th>
                    </tr>
               ';

          }
     
     ?>
</body>
</html>