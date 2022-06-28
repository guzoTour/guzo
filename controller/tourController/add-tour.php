<?php
    session_start();
    include "../../utils/prevent.php";
    isAuthenticated();
    isAuthorzied();
    if(isset($_POST["submitTour"])){
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

        if(empty($tour_name)||empty($duration)||empty($group_size)||empty($difficulty)||empty($region)||empty($direction)||empty($town)
        ||empty($price)||empty($discount_price)||empty($summary)||empty($description)||empty($start_date)){
            sendError("Please fill all fields");
        }
        if(!preg_match("/^[a-zA-Z ]*$/",$tour_name)) {
            sendError("Tour name can contain only characters");
        }
        if(!is_integer($duration)||($duration<0||$duration>100)){
            sendError("Inavlid duration");
        }
        if(!is_integer($group_size)||($group_size<0||$group_size>100)) {
            sendError("Inavlid group size");
        }
        if(!preg_match("/^[a-zA-Z ]*$/",$region)) {
            sendError("Inavlid region");
        }
        if(!preg_match("/^[a-zA-Z ]*$/",$town)) {
            sendError("Inavlid town");
        }
        if(!is_double($price)||($price<0||$price>1000000)) {
            sendError("The price must be between 0 and 10000000 birr");
        }
        if(!is_double($discount_price)||($discount_price<0||$discount_price>5000)) {
            sendError("The discount price must be between 0 and 50 birr");
        }
    
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
                   $_SESSION["tourDeleted"] = true;
                   header("location:../../view/admin/adminProfile.php");
               }
            }
        }
        catch(Exception $err){
            echo $err;
        }

    }
    function sendError($err){
        $_SESSION["add_error"] = $err;
        header("location:../../view/admin/addTour.php");

    }
?>