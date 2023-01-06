<?php
    include('../functions/functions.php');
    session_start();
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
     
     <?php
          if(isset($_GET['pcpart'])){
               echo'<div>
                    <div class="min-w-full m-2 p-1 white b-rad-1 shadow-sm">
                         <div class="d-flex jcsb">
                              <div>Components</div>
                              <div>Description</div>
                              <div>Price</div>
                         </div>
                    </div>
               </div>
               <div class="mb-4 mx-2">
                    <div class="d-flex flex-col jcc  white">'?>
                    <?php
                    $query = "SELECT * FROM pcpart;";
                    $check = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($check)) {
                              $partname = $row['partKeyword'];
                              $partID = $row['pcPartID'];
                              echo "
                              <div style='min-width:90%;' class='b-rad-2 my-1'>
                                   <div style='font-size:20px;'>
                                        <div class='d-flex jcsa'>
                                             <div class='text-center single-img3'>
                                                  <img class='img3 mt-1' src='upload/".$row['image']."'/>
                                             </div>
                                             <div style='width:300px;' ><h4 style='color:#28AB87' class='m-1'>{$row['partTitle']}</h4></div>
                                             <div style='width:500px;'>{$row['partDesc']}</div>
                                             <div class='text-primary'>
                                                  <div class='m-1 text-black'><b>&#8377;{$row['price']}/-</b></div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class='divider mx-2'></div>
                              ";
                    }
                    ?>
               <?php echo'</div></div>'?>
          <?php } 
          elseif(isset($_GET['pc'])){
               echo'
               <div class="b-1 text-white mr-3 ml-2"></div>
               <div class="d-flex flex-wrap jcc">'?>
                       <?php
                           $query = "SELECT * FROM pc_details;";
                           global $conn;
                           $check = mysqli_query($conn, $query);
                           while ($row = mysqli_fetch_assoc($check)) {
                                $p_id = $row['pc_id'];
                                echo "
                                <div style='width:270px;' class='fade-in shadow-md text-center white m-1 p-1 b-rad-2 shadow-md'>
                                     <img class='img2 mt-1' src='../admin/upload/".$row['pc_image']."'/><br>
                                     <h3  style='color:#28AB87' style='margin-top:20px;'>{$row['pcName']}</h3>
                                     <div style='font-size:14px;' class='text-primary p-1'>
                                          <b>Desktop Type:</b>{$row['PC_Type']}
                                          <p align='left'><b>Motherboard:</b>{$row['motherboard']}</p><p align='left'>
                                          <b>Processor:</b>{$row['processor']}</p>
                                          <p align='left'><b>
                                          Price:&#8377;</b>{$row['pcPrice']}</p><p align='left'><b>
                                          Harddisk Volume:</b> {$row['hardDisk']}GB</p><p align='left'><b>
                                          Monitor Company:</b> {$row['monitor']}</p><p align='left'><b>
                                          Monitor Display:</b> {$row['monitor_display']}''</p><p align='left'><b>
                                          Graphics Card Type:</b> {$row['graphics_card_type']}<p align='left'><b>
                                          GC Capacity:</b> {$row['graphics_card']}GB</p><p align='left'><b>
                                          Keyboard Company:</b>{$row['keyboard_company']}</p><p align='left'><b>
                                          Mouse Company:</b>{$row['mouse_company']}</p><p align='left'><b>
                                          Speaker Company:</b> {$row['speakers']}</p><p align='left'><b>
                                          Ram Type:</b> {$row['ram_type']}</p><p align='left'><b>
                                          Ram Company:</b> {$row['ram_company']}</p><p align='left'><b>
                                          Ram Capacity:</b> {$row['ram_capacity']}GB</p>
                                          <div style='font-size:24px;'  class='text-black p-1'>
                                               <b>&#8377;  {$row['pcPrice']}</b>
                                          </div>
                                     </div>
                                </div>"
                                ;} 
                       ?><?php echo'
                   </div>
               </div>
               ';
          }
          elseif(isset($_GET['secpart'])){
               ?>
                <?php
                         echo'<div>
                         <div class="min-w-full mx-2 mt-2 p-1 white shadow-sm">
                              <div class="d-flex jcsb">
                                   <div>Components</div>
                                   <div>Description</div>
                                   <div>Price</div>
                              </div>
                         </div>
                    </div>
                    
                    <div class="divider mx-2"></div>
                         <div class="mb-4 mx-2">
                              <div class="d-flex flex-col jcc shadow-md white">'?>
                              <?php
                              $query = "SELECT * FROM secndpart";
                              $check = mysqli_query($conn, $query);
                              while ($row = mysqli_fetch_assoc($check)) {
                                        $partname = $row['partKeyword'];
                                        $partID = $row['pcPartID'];
                                        echo "
                                        <div style='min-width:90%;' class='b-rad-2 my-1'>
                                             <div style='font-size:20px;'>
                                                  <div class='d-flex jcsa'>
                                                       <div class='text-center single-img3'>
                                                            <img class='img3 mt-1' src='../account/".$row['image']."'/>
                                                       </div>
                                                       <div style='width:300px;' ><h4 style='color:#28AB87' class='m-1'>{$row['partTitle']}</h4></div>
                                                       <div style='width:500px;'>{$row['partDesc']}</div>
                                                       <div class='text-primary'>
                                                            <div class='m-1 text-black'><b>&#8377;{$row['price']}/-</b></div>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                        <div class='divider mx-2'></div>
                                        ";
                              }
                              ?>
                         <?php echo'</div></div>'?>
               <?php
          }
          
          ?>
</body>
</html>