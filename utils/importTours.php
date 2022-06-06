
<?php
    include "../config/config.php";

   if(isset($_FILES['tourFile'])){
      $errors= array();
      $file_name = $_FILES['tourFile']['name'];
      $file_size =$_FILES['tourFile']['size'];
      $file_tmp =$_FILES['tourFile']['tmp_name'];
      $file_type=$_FILES['tourFile']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['tourFile']['name'])));
      $extensions= array("csv","txt",);
      
      if(in_array($file_ext,$extensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
    
      if(empty($errors)==true){
         if(move_uploaded_file($file_tmp,"upLoadedFiles/".$file_name)){
            $CSVfp = fopen("upLoadedFiles/".$file_name, "r");
            if($CSVfp !== FALSE) {
                while(! feof($CSVfp)) {
                    $data = fgetcsv($CSVfp, 1000, ",");
                    $duration  = (int)$data[2];
                    $group_size = (int)$data[4];
                    $price = (double)$data[5];
                    $discount_price = (double)$data[6];
                    $sql = "INSERT INTO tour (tour_name, duration, difficulty, group_size,  price, discount)
                    VALUES ('$data[1]', '$duration', '$data[3]', '$group_size', '$price', '$discount_price')";
                    
                    if(mysqli_query($conn, $sql)){
                        $sql2 = "INSERT INTO address (tour_id,region,direction,town) VALUES (LAST_INSERT_ID(),'$data[8]','$data[9]','$data[10]')";
                        if(mysqli_query($conn, $sql2)){
                            echo '<script>alert("The data imported successfully")</script>';
                        }
                    }
                    else {
                        echo "<h3>Error: " . $sql . "<br>" . mysqli_error($conn)."</h3>";
                      }   
                }
            }
             fclose($CSVfp);
         }  
      }
      else{
         print_r($errors);
      }
   }
?>
<html>
   <body>
      
      <form action="" method="POST" enctype="multipart/form-data">
         <input type="file" name="tourFile" />
         <input type="submit"/>
      </form>
      
   </body>
</html>