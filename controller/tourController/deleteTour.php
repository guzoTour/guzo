<?php
    session_start();
    include "../../utils/prevent.php";
    isAuthenticated();
    isAuthorzied();
    include "../../config/config.php";
    $url = $_SERVER["REQUEST_URI"];
    $components = parse_url($url);
    parse_str($components['query'], $results);
    $tour_id = $results['tour_id'];
    $sql2 = "DELETE From tour WHERE tour_id = $tour_id";
    $sql1 = "SELECT* FROM tour WHERE tour_id = $tour_id";  
    try{
        if( mysqli_query($conn, $sql2)){
            $file3 = fopen('../../files/queryReport.log','a');
            $mydata = mysqli_query($conn, $sql1);
            $row = $mydata->fetch_assoc();
            $tour_name = $row["tour_name"];
            $query = "\n".date("Y/m/d:h:i")."   Admin  Note deleted   ".$tour_name;
            if($file3){
                fwrite($file3,$query);
                fclose($file3); 
            }
            $_SESSION["tourDeleted"] = true;
            header("location:../../view/admin/adminProfile.php");
        }  
    }catch(Exception $err){
        header("location:../../view/admin/adminProfile.php");
    }        

?>