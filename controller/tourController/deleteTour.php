<?php
    session_start();
    if(isset($_SESSION["username"])){
        if($_SESSION["role"]!="admin"){
            header("location:../../index.php");
        }
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
                if($file3){
                    fwrite($file3,$query);
                    fclose($file3);
            
                    echo  '<script> window.alert("Tour is deleted sucessfuly")</script>';  
                
                }
            }
           
            
        }catch(Exception $err){
            echo $err;
        }
    }else{
        header("location:../../view/shared/login.php");
    }

?>