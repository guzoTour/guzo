<?php

    
    session_start();
    if(!isset($_SESSION["username"])||$_SESSION["role"]!="admin"){
        header("location:../../view/shared/login.php");
    }
    
    if(isset($_POST["submitTour"])){
        echo "Hello world";
        include "../../config/config.php";
        $tour_name = filter_var($_POST['tour_name'], FILTER_SANITIZE_STRING);
        $duration = $_POST["duration"];
        $group_size = $_POST["group_size"];
        $difficulty = $_POST["difficulty"];
        $region = $_POST["region"];
        $direction = $_POST["direction"];
        $town = $_POST["town"];
        $price = $_POST["price"];
        $discount_price = $_POST["discount_price"];
        $summary = $_POST["summary"];
        $description = $_POST["description"];
        $start_date = $_POST["start-date"];
        
        $sql = "INSERT INTO tour (tour_name, duration, group_size, difficulty, price, discount, summary,descriptions)
        VALUES ('$tour_name', $duration, $group_size, '$difficulty', $price, $discount_price, '$summary', '$description')";
        echo $sql;
        try{
            if(mysqli_query($conn, $sql)){

                $sql2 = "INSERT INTO address (tour_id,region,direction,town) VALUES (LAST_INSERT_ID(),'$region','$direction','$town')";
               if( mysqli_query($conn, $sql2)){

                   $query = "\n".date("Y/m/d:h:i")."   Admin   Note added ".$tour_name." tour";
                   $file3 = fopen('../../files/queryReport.txt','a');
                  
                   if($file3){
                       fwrite($file3,$query);
                       fclose($file3);   
                   }
                   header("location:../../view/admin/adminProfile.php");
               }
            }
        }
        catch(Exception $err){
            echo $err;
        }

    }
?>