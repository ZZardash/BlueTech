<?php
error_reporting(0);
     if(isset($_POST['uploadpart'])){
          $file = $_FILES['file'];
          //print_r($file);
          $fileName = $_FILES['file']['name'];
          $fileTmpName = $_FILES['file']['tmp_name'];
          //print_r($fileTmpName);

          $folder = "upload/uploadedimages/".$fileName;
          $folderhaha = "uploadedimages/".$fileName;
          move_uploaded_file($fileTmpName, $folder);

          $partTitle = $_POST['productTitle'];
          $partKeyword = $_POST['ComponentName'];
          $partDesc = $_POST['description'];
          $qty = $_POST['qty'];
          $price = $_POST['price'];
          $insertQuery = "INSERT INTO pcpart VALUES(NULL, '$partTitle', '$folderhaha', '$partKeyword', '$partDesc', '$qty', '$price');";
          $checkInsert = mysqli_query($conn, $insertQuery);
          if($checkInsert){
               echo'<script>alert("Upload Successfull")</script>';
          }
          else{
               echo'<script>alert("Upload Successfull")</script>';

          }
     }
     if(isset($_POST['upload'])){
          global    $conn;
  
          $file = $_FILES['file'];
          $fileName = $_FILES['file']['name'];
          $fileTmpName = $_FILES['file']['tmp_name'];
          $folder = "upload/uploadedimages/".$fileName;
          $folderhaha = "uploadedimages/".$fileName;
          move_uploaded_file($fileTmpName, $folder);
  
          $compName = $_POST['compName'];
          $compType = $_POST['comp_type'];
          $motherboard = $_POST['motherboard'];
          $processor = $_POST['processor'];
          $pcDetailPrice = $_POST['pcDetailPrice'];
          $harddisk = $_POST['harddisk'];
          $monitor_company = $_POST['monitorCompany'];
           $monitor_display = $_POST['monitorDisplay'];
           $graphics_card_type = $_POST['graphicsCardType'];
           $graphics_card = $_POST['graphicsCard'];
           $keyboard_company = $_POST['keyboardCompany'];
           $mouse_company = $_POST['mouseCompany'];
           $speaker_company = $_POST['speakerCompany'];
           $ram_type = $_POST['ramType'];
           $ram_company = $_POST['ramCompany'];
           $ram_capacity = $_POST['ramCapacity'];
           $Qty = $_POST['qty'];

  
            if(empty($compType) || empty($motherboard) || empty($processor) || empty($pcDetailPrice) || empty($harddisk) || empty($monitor_company) || empty($monitor_display) || empty($graphics_card_type) || empty($graphics_card) || empty($keyboard_company) || empty($mouse_company) || empty($speaker_company) || empty($ram_type) || empty($ram_company) || empty($ram_capacity)){
              header("location: upload_pc_details.php?error=emptyfield");
            }
            else{
              $query = "INSERT INTO pc_details VALUES(NULL,'$folderhaha','$compName', '$compType', '$motherboard', '$processor','$pcDetailPrice' , '$harddisk', '$monitor_company', '$monitor_display', '$graphics_card_type', '$graphics_card', '$keyboard_company', '$mouse_company', '$speaker_company', '$ram_type', '$ram_company', '$ram_capacity', '$Qty') ;";
              
              $check = mysqli_query($conn, $query);
              if($check){
                  
               echo'<script>alert("Upload Successfull")</script>';
                  
              }
              else{
               echo'<script>alert("Upload Successfull")</script>';
  
              }
            }
      }
?>

<!DOCTYPE html>
<html class="no-js">
     <head>
          <meta charset="utf-8">
          <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <title></title>
          <meta name="description" content="">
          <meta name="viewport" content="width=device-width, initial-scale=1">
          <link rel="stylesheet" href="../../style.css">
          <link rel="stylesheet" href="../../customstyle.css">
     </head>
     <body>
          <div class="mt-2"></div>
          <?php
               if(isset($_GET['uploadpcpart'])){
                    ?>
                    <div class="container text-left">
                         <div class=" container white p-2 b-rad-2 shadow-md">
                              <h3 class="text-center">Upload PC Part Details</h3>
                              <?php
                                   if(isset($_GET['data'])){
                                        if($_GET['data'] == "success"){
                                             echo"<p style='color:green; font-size:12px;'>Upload successfull!</p>";
                                        }
                                        else{
                                             echo"<p style='color:red; font-size:12px;'>Upload unsuccessfull!</p>";
                                        }
                                   }
                                   if(isset($_GET['error'])){
                                        if($_GET['error'] == "emptyfield"){
                                             echo"<p style='color:red; font-size:12px;'>Please do fill all required details</p>";
                                        }
                                   }
                              ?>
                              <div class="pt-2">
                                   <form method="POST" enctype="multipart/form-data">
                                        <table>
                                             <tr>
                                                  <th><b>Choose a file:</b></th>
                                                  <th>
                                                  <input type="hidden" name="size" value="1000000">
                                                  <div class="p-1">
                                                       <input class="chse_file" type="file" name="file">
                                                  </div>
                                             </th>
                                             </tr>
                                             <tr>
                                                  <th><b>Product Keyword : </b></th>
                                                  <th>
                                                       <select name="ComponentName" id="" style="margin-bottom:10px; border-radius:5px; background: #181818;color: #fff;padding: 10px;margin-left:20px;height:35px;font-size: 12px;outline: none;">
                                                       <option value="selectAnOption">selectAnOption</option>
                                                       <?php
                                                            $query = "SELECT * FROM pcpartcomp;";
                                                            $check = mysqli_query($conn, $query);
                                                            if($check){
                                                                 while($row = mysqli_fetch_array($check)){
                                                                      $pcPartID = $row['pcPartID'];
                                                                      echo"<option value='$pcPartID'>{$row['pcPartComponents']}</option>";
                                                                 }
                                                            }
                                                            else{
                                                                 echo"<p style='color:red; font-size:12px;'>Somthing went wrong! Please try again</p>";
                                                            }
                                                       ?>
                                                       </select>
                                                  </th>
                                             </tr>
                                             <tr>
                                                  <th><b>Product Title:</b></th>
                                                  <th>
                                                       <input class="input-field-l" type="text" name="productTitle" placeholder="Enter product title...">
                                                  </th>
                                             </tr>
                                             <tr>
                                                  <th><b>Product description:</b></th>
                                                  <th class="pl-1">
                                                       <textarea rows="20" cols="50" class="input-field-l" name="description" placeholder="Enter the description..."></textarea>
                                                  </th>
                                             </tr>
                                             <tr>
                                                  <th><b>Enter Quantity</b></th>
                                                  <th><input class="input-field-l" type="number" name="qty" placeholder="Enter Quantity..."></th>
                                             </tr>
                                             <tr>
                                                  <th>Enter Price:</th>
                                                  <th><input class="input-field-l" type="number" name="price" placeholder="Enter Price..."></th>
                                             </tr>
                                        </table>
                                        <div class="text-center mt-1">
                                             <input class="btn button-field text-deco-none" type="submit" name="uploadpart" value="Upload">
                                        </div>
                                   </form>
                              </div>
                         </div>
                    </div>
                    <?php
               }
               elseif(isset($_GET['uploadpc'])){
                    ?>
                    <div class="container">
                         <div class="container text-center">
                              <div class="p-3 b-rad-5 white mt-lg">
                        <h2 class="text-left">Upload Completed Builds</h2>
                        <div class="b-1 mb-2"></div>
                        <?php
                            if(isset($_GET['data'])){
                                if($_GET['data'] == "success"){
                                    echo"<p style='color:green; font-size:12px;'>Upload successfull!</p>";
                                }
                                else{
                                    echo"<p style='color:red; font-size:12px;'>Upload unsuccessfull!</p>";
                                }
                            }
                            if(isset($_GET['error'])){
                                if($_GET['error'] == "emptyfield"){
                                    echo"<p style='color:red; font-size:12px;'>Please do fill all required details</p>";
                                }
                            }
                        ?>
                        <form method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="size" value="1000000">
                            <div class="p-1">
                                <input class="chse_file" type="file" name="file">
                            </div>
                            <div style="font-size:14px;">
                                <div align="left" style="padding:10px 0px;">
                                    <div><input class="input-field" type="text" name="compName" placeholder="Computer Name..."></div>
                                    <div class="" align="left">
                                        Computer Type:
                                        <select name="comp_type" style="background: #181818;color: #fff;padding: 10px;margin-left:20px;height: 40px;font-size: 12px;box-shadow: 0 5px 25px rgba(0, 0, 0, .4); 
                    outline: none;" id="comp_type">
                                                       <?php
                                                            $query = "SELECT * FROM pctype;";
                                                            $check = mysqli_query($conn, $query);
                                                            if($check){
                                                                 while ($row = mysqli_fetch_assoc($check)) {
                                                                      echo"<option>{$row['pcTypeName']}</option>";
                                                                 }
                                                            }
                                                            else{
                                                                 echo"<p style='color:red; font-size:12px;'>Somthing went wrong! Please try again</p>";
                                                            }
                                                       ?>
                                                       </select>
                                                  </div>
                                             </div>
                                             <div align="left" style="padding:10px 0px;">
                                                  Motherboard details: <!--<input type="text" name="motherboard" class="input-field" placeholder="Enter motherboard type...(AMD or Intel)"> -->
                                                  <!-- <input type="text" name="processor" class="input-field" placeholder="Enter processor..."> -->
                                                  <select name="motherboard" style="background: #181818;color: #fff;padding: 10px;margin-left:20px;height: 40px;font-size: 12px;box-shadow: 0 5px 25px rgba(0, 0, 0, .4); 
                    outline: none;" id="motherboard">
                                                  <?php
                                                       $query = "SELECT * FROM motherboardtype;";
                                                       $check = mysqli_query($conn, $query);
                                                       if($check){
                                                       while ($row = mysqli_fetch_assoc($check)) {
                                                            echo"<option>{$row['motherboardName']}</option>";
                                                       }
                                                       }
                                                       else{
                                                       echo"<p style='color:red; font-size:12px;'>Somthing went wrong! Please try again</p>";
                                                       }
                                                  ?>
                                                  </select>
                                                  <select name="processor" style="background: #181818;color: #fff;padding: 10px;margin-left:20px;height: 40px;font-size: 12px;box-shadow: 0 5px 25px rgba(0, 0, 0, .4); 
                    outline: none;" id="processor">
                                                  <?php
                                                       $query = "SELECT * FROM processorlist;";
                                                       $check = mysqli_query($conn, $query);
                                                       if($check){
                                                       while ($row = mysqli_fetch_assoc($check)) {
                                                            echo"<option>{$row['processorName']}</option>";
                                                       }
                                                       }
                                                       else{
                                                       echo"<p style='color:red; font-size:12px;'>Somthing went wrong! Please try again</p>";
                                                       }
                                                  ?>
                                                  </select>
                                             </div>
                                             
                                             <div align="left" style="padding:10px 0px;">
                                                  Harddisk details:<input class="input-field" type="number" name="harddisk" placeholder="Enter HardDisk capacity...">TB
                                             </div>


                                             <div align="left" style="padding:10px 0px;">
                                                  Monitor details:<!-- <input type="text" name="monitorCompany" class="input-field" placeholder="Enter Monitor Company name..."> -->
                                                  <select name="monitorCompany" style="background: #181818;color: #fff;padding: 10px;margin-left:20px;height: 40px;font-size: 12px;box-shadow: 0 5px 25px rgba(0, 0, 0, .4); 
                    outline: none;" id="monitorCompany">
                                                  <?php
                                                       $query = "SELECT * FROM monitorcompany;";
                                                       $check = mysqli_query($conn, $query);
                                                       if($check){
                                                       while ($row = mysqli_fetch_assoc($check)) {
                                                            echo"<option>{$row['monitorCompName']}</option>";
                                                       }
                                                       }
                                                       else{
                                                       echo"<p style='color:red; font-size:12px;'>Somthing went wrong! Please try again</p>";
                                                       }
                                                  ?>
                                                  </select>
                                                  <input type="number" name="monitorDisplay" class="input-field" placeholder="Enter monitor display size...">INCH
                                             </div>


                                             <div align="left" style="padding:10px 0px;">
                                                  Graphics Card details:<!--<input type="text" name="graphicsCardType" class="input-field" placeholder="Enter graphics card type..."> -->
                                                  <select style="background: gray;color: #fff;padding: 10px;margin-left:20px;height: 40px;font-size: 12px;box-shadow: 0 5px 25px rgba(0, 0, 0, .4); 
                    outline: none;" name="graphicsCardType" id="graphicsCardType">
                                                  <?php
                                                       $query = "SELECT * FROM graphicscardcompany;";
                                                       $check = mysqli_query($conn, $query);
                                                       if($check){
                                                       while ($row = mysqli_fetch_assoc($check)) {
                                                            echo"<option>{$row['graphicsCradComp']}</option>";
                                                       }
                                                       }
                                                       else{
                                                       echo"<p style='color:red; font-size:12px;'>Somthing went wrong! Please try again</p>";
                                                       }
                                                  ?>
                                                  </select>
                                                  <input type="number" name="graphicsCard" placeholder="Enter Graphics card capacity" class="input-field">GB
                                             </div>


                                             <div align="left" style="padding:10px 0px;">
                                                  Keyboard details:<!--<input type="text" name="keyboardCompany" class="input-field" placeholder="Enter keyboard company..."> -->
                                                  <select style="background: #181818;color: #fff;padding: 10px;margin-left:20px;height: 40px;font-size: 12px;box-shadow: 0 5px 25px rgba(0, 0, 0, .4); 
                    outline: none;" name="keyboardCompany" id="keyboardCompany">
                                                  <?php
                                                       $query = "SELECT * FROM iocompany;";
                                                       $check = mysqli_query($conn, $query);
                                                       if($check){
                                                       while ($row = mysqli_fetch_assoc($check)) {
                                                            echo"<option>{$row['CompName']}</option>";
                                                       }
                                                       }
                                                       else{
                                                       echo"<p style='color:red; font-size:12px;'>Somthing went wrong! Please try again</p>";
                                                       }
                                                  ?>
                                                  </select>
                                             </div>

                                             <div align="left" style="padding:10px 0px;">
                                             Mouse details:<!--<input type="text" name="mouseCompany" class="input-field" placeholder="Enter mouse company..."> -->
                                             <select style="background: #181818;color: #fff;padding: 10px;margin-left:20px;height: 40px;font-size: 12px;box-shadow: 0 5px 25px rgba(0, 0, 0, .4); 
                    outline: none;" name="mouseCompany" id="mouseCompany">
                                                  <?php
                                                       $query = "SELECT * FROM iocompany;";
                                                       $check = mysqli_query($conn, $query);
                                                       if($check){
                                                       while ($row = mysqli_fetch_assoc($check)) {
                                                            echo"<option>{$row['CompName']}</option>";
                                                       }
                                                       }
                                                       else{
                                                       echo"<p style='color:red; font-size:12px;'>Somthing went wrong! Please try again</p>";
                                                       }
                                                  ?>
                                                  </select>
                                             </div>

                                             <div align="left" style="padding:10px 0px;">
                                             Speaker details:<!--<input type="text" name="speakerCompany" class="input-field" placeholder="Enter Speaker company..."> -->
                                             <select style="background: #181818;color: #fff;padding: 10px;margin-left:20px;height: 40px;font-size: 12px;box-shadow: 0 5px 25px rgba(0, 0, 0, .4); 
                    outline: none;" name="speakerCompany" id="speakerCompany">
                                                  <?php
                                                       $query = "SELECT * FROM iocompany;";
                                                       $check = mysqli_query($conn, $query);
                                                       if($check){
                                                       while ($row = mysqli_fetch_assoc($check)) {
                                                            echo"<option>{$row['CompName']}</option>";
                                                       }
                                                       }
                                                       else{
                                                       echo"<p style='color:red; font-size:12px;'>Somthing went wrong! Please try again</p>";
                                                       }
                                                  ?>
                                                  </select>
                                             </div>

                                             <div align="left" style="padding:10px 0px;">
                                             RAM details:<input type="text" name="ramType" class="input-field" placeholder="DDR3 or DDR4">
                                                  <!-- <input type="text" name="ramCompany" class="input-field" placeholder="Enter RAM Company..."> -->
                                                  <select style="background: #181818;color: #fff;padding: 10px;margin-left:20px;height: 40px;font-size: 12px;box-shadow: 0 5px 25px rgba(0, 0, 0, .4); 
                    outline: none;" name="ramCompany" id="ramCompany">
                                    <?php
                                        $query = "SELECT * FROM ramcompany;";
                                        $check = mysqli_query($conn, $query);
                                        if($check){
                                            while ($row = mysqli_fetch_assoc($check)) {
                                                echo"<option>{$row['ramCompany']}</option>";
                                            }
                                        }
                                        else{
                                            echo"<p style='color:red; font-size:12px;'>Somthing went wrong! Please try again</p>";
                                        }
                                    ?>
                                    </select>
                                    <input type="number" name="ramCapacity" class="input-field" placeholder="Enter RAM capacity">GB
                                </div>

                                <div align="left" style="padding:10px 0px;">
                                    Enter Price:<input type="number" class="input-field" name="pcDetailPrice" placeholder="Enter Price...">
                                </div>
                                <div>
                                   <b>Enter Quantity</b>
                                   <input class="input-field" type="number" name="qty" placeholder="Enter Quantity...">
                              </div>
                            </div>
                            <div>
                                <input class="btn button-field text-deco-none" type="submit" name="upload" value="Upload">
                            </div>
                        </form>
                    </div> 
                    </div>
                    <?php
               }
          ?>
     </body>
</html>