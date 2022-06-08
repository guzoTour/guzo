<?php
    session_start();
    include "../../utils/prevent.php";
    isAuthenticated();
    isAuthorzied();
  if(isset($_POST["form2"])){    
        $url = $_SERVER["REQUEST_URI"];
        $components = parse_url($url);
        parse_str($components['query'], $results);
        $tour_id = $results['id'];
        $tour_id =(int) $tour_id ;
        $tour_name = $_POST["name"];
        $duration = $_POST["duration"];
        $group_size = $_POST["group"];
        $summary = $_POST["summary"];
        $price = $_POST["price"];
        $region = $_POST["region"];
        $town = $_POST["town"];
        $direction = $_POST["direction"];
        $sql="UPDATE `tour` SET `tour_name` = '$tour_name', `duration` = '$duration', `group_size` = '$group_size', `price` = '$price', `summary` = '$summary' WHERE `tour`.`tour_id` = $tour_id" ;       
        try{
            include('../../config/config.php');
            
        if (mysqli_query($conn, $sql)){
             
         header("location:../../view/admin/adminProfile.php");
           
        } else {
                echo "Error updating record: " . $conn->error;
              }
        }
        catch(Exception $err){
            echo $err;
        }
    }

?>