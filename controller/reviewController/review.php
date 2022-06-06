<?php
session_start();
    if(isset($_SESSION["username"])){
        // if($_SESSION["role"]!="admin"){
        //     header("location:../index.php");
        // }
        $user_id = "";
        $url = $_SERVER["REQUEST_URI"];
        $components = parse_url($url);
        parse_str($components['query'], $results);
        $tour_id = $results['tour_id'];
        $user_name = $_SESSION["username"];

        include "../config/config.php";
        $review = $_POST["review"]." Cumque dignissimos sint quo commodi corrupti accusantium veniam saepe numquam.";
        $rate = $_POST["rate"];
    

        $sql1 = "SELECT* FROM user WHERE username = '$user_name'";
        try{
            $mydata = mysqli_query($conn, $sql1);
            $row = $mydata->fetch_assoc();
            $user_id = $row["user_id"];

        }catch(Exception $err){
            echo $err;
        }
        $sql2 = "INSERT INTO review (user_id,tour_id,rating,review)
          VALUES ('$user_id', '$tour_id', '$rate', '$review')";
        try{
            mysqli_query($conn, $sql2);
           $sql3 =  "select  count(tour_id) 'rquantity' AVG(rating) 'rating' from review  where tour_id = $tour_id";
           $mydata = mysqli_query($conn, $sql3);
           $row = $mydata->fetch_assoc();
           $rating = $row["rating"];
           $rquantity = $row["rquantity"];
           $sql4 = "update tour set rating = $rating rating_quantity = '$rquantity' where tour_id  = $tour_id";
           if(mysqli_query($conn, $sql4)){
            
           }
            header("location:../index.php");
        }
        catch(Exception $err){
            echo $err;
        }
    }
else{
    header("location:../view/login.php");
}
   
?>