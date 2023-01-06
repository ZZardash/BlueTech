<?php
    include('../functions/functions.php');
    session_start();
?>
<?php
     if(isset($_GET['updatepcpart'])){
          $partID = $_GET['updatepcpart'];
          $partTitle = $_POST['partTitle'];
          $partDesc = $_POST['partDesc'];
          $partPrice = $_POST['partPrice'];
          $partQuantity = $_POST['quantity'];
          // print($partTitle);
          // print($partDesc);
          // print($partPrice);
          // print($partQuantity);
          $updatepart = "UPDATE pcpart SET partTitle='$partTitle',partDesc='$partDesc',price='$partPrice',qty=$partQuantity WHERE pcPartID='$partID'";
          $check = mysqli_query($conn, $updatepart);
          if($check){
               header("LOCATION: dashboard.php?updatepcpart=success");
          }
          else{
               header("LOCATION: dashboard.php?updatepcpart=unsuccess");
          }
          
     }
?>
<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title></title>
     <style>
          .img3{
               width:170px;
               height: 170px;
          }
          .single-img3:hover img{
               width: auto;
               transition: 0.5s;
               transform: scale(1.2);
               z-index: 0;
               box-shadow: 0 2px 20px #262626;
               opacity: 1;
          }
          .divider{
               border: 1px solid #e0e0e0;
          }
     </style>
</head>
<body>
     <div>
          <div class="min-w-full m-2 p-1 white b-rad-1 shadow-sm">
               Admin-Panel > Update Products
          </div>
     </div>
     <?php
          if(isset($_GET['updatepcpart'])){
               echo'
                    <div class="min-w-full m-2 p-1 white b-rad-1 shadow-sm">
                    <div class="d-flex jcsa">
                         <div></div>
                         <div style="width:600px;">Product Name</div>
                         <div>Part Description</div>
                         <div>Quantity</div>
                         <div>Price</div>
                         <div>Update Product</div>
                    </div>
               </div>
               <div class="mb-4 mx-2">
                    <div class="d-flex flex-col jcc  white">'?>
                    <?php
                         $query = "SELECT * FROM pcpart  ORDER BY RAND();";
                         $check = mysqli_query($conn, $query);
                         while ($row = mysqli_fetch_assoc($check)) {
                                   $partname = $row['partKeyword'];
                                   $partID = $row['pcPartID'];
                                   echo "
                                   <form action='dashboard.php?updatepcpart=".$row['pcPartID']."' method='POST'>
                                        <div style='min-width:90%;' class='b-rad-2 my-1'>
                                             
                                             <div style='font-size:20px;'>
                                                  <div class='d-flex jcsa'>
                                                       <div class='text-center single-img3'>
                                                            <img class='img3 mt-1' src='upload/".$row['image']."'/>
                                                       </div>
                                                       <div class='' >
                                                            <input style='width:300px;height:100px;' name='partTitle' type='text' value='{$row['partTitle']}' >
                                                       </div>
                                                       <div style=''>
                                                            <textarea rows='10' cols='50' name='partDesc' >{$row['partDesc']}</textarea>
                                                       </div>
                                                       <div class='py-4' >
                                                            <input style='width:100px;' type='number' name='quantity' value='{$row['qty']}' >
                                                       </div>
                                                       <div class='text-primary py-4'>
                                                            &#8377;<input style='width:100px;' type='number' name='partPrice' value='{$row['price']}' >/-
                                                       </div>
                                                       <div class='py-4'>
                                                            <button style='background:#28AB87; color:white;' class='px-1 b-none py-sm text-deco-none b-rad-1 shadow-md'>Update Now</button>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </form>
                                   <div class='divider mx-2'></div>
                                   ";
                         }
                    ?>
               <?php echo'</div></div>'?>
          <?php } 
          
          ?>
</body>
</html>