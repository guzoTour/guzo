<?php
function uploadImage($path,$type){
    echo "hello world";
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];    
    $folder = $path.$filename;       
    include('../../config/config.php');

    $user_name = $_SESSION["username"];
    $tour_name = $_SESSION["tour_name"];
        $sql = "";
        if($type=="coverImage"){
            $sql = " UPDATE tour SET cover_image = '$filename' WHERE tour_name = '$tour_name'";
        }
        else if($type=="tourImage"){
            $sql = " UPDATE tour SET imags = '$filename' WHERE tour_name = '$tour_name'";
        }
        else if($type=="profileImage"){
            $sql = " UPDATE user SET photo = '$filename' WHERE username = '$user_name'";
        }
        else{
            echo  '<script> window.alert("Tour is deleted sucessfuly")</script>';
        }
        // Get all the submitted data from the form
        echo "tosso tana madda";
        $file3 = fopen('../../files/queryReport.log','a');
        $query = "\n".date("Y/m/d:h:i")."   User  Note    ".$user_name." has changed profile image";
        if($file3){
            fwrite($file3,$query);
            fclose($file3);   
        }
        
        // Execute query
        try{

            if(mysqli_query($conn, $sql)){
                echo $filename;
            };
        }
        catch(Exception $err){
            echo $err;
        }
          
        // Now let's move the uploaded image into the folder: image
        if (move_uploaded_file($tempname, $folder))  {
            $msg = "Image uploaded successfully";
            header("location:#");
            
        }else{
            $msg = "Failed to upload image";
        }
}
?>