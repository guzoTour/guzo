<?php
 include("../../config/config.php");
session_start();
$user_id = "";
        $url = $_SERVER["REQUEST_URI"];
        $components = parse_url($url);
        parse_str($components['query'], $results);
        $tour_id = $results['tour_id'];
        $tour_name = $results['tour_name'];
        $user_name = $_SESSION["username"];
        $sql1 = "SELECT* FROM user WHERE username = '$user_name'";
        try{
            $mydata = mysqli_query($conn, $sql1);
            $row = $mydata->fetch_assoc();
            $user_id = $row["user_id"];

        }catch(Exception $err){
            echo $err;
        }



        
    if(isset($_POST["comment"])){
       $comment=$_POST["comments"];
       $rating=$_POST["rating1"];
      //  echo $rating;
  
       $comsql="INSERT INTO `review` (`review`, `created_at`, `user_id`, `tour_id`,`rating`) VALUES ('$comment', current_timestamp(), '$user_id', '$tour_id','$rating');";

       



       try{
                   mysqli_query($conn, $comsql);

            $sql3 =  "select  count(tour_id) 'rquantity', AVG(rating) 'rating' from review  where tour_id = $tour_id";
           $mydata = mysqli_query($conn, $sql3);
           $row = $mydata->fetch_assoc();
           $rating = $row["rating"];
           $rquantity = $row["rquantity"];
           

           $sql4 = "UPDATE `tour` SET `rating_quantity` = '$rquantity', `rating` = '$rating' WHERE `tour`.`tour_id` = $tour_id;";
           if(mysqli_query($conn, $sql4)){
            
           }
                    echo '<script>alert("Thanks for your comment")</script>'.$tour_name;
                      header("location:../../view/public/tour.php?tour_name=$tour_name&bool=true");


                    
                  }catch(Exception $err){

                    $updatesql="UPDATE `review` SET `review` = '$comment' ,`rating` = '$rating' WHERE `review`.`user_id` = '$user_id'&& `review`.`tour_id`=$tour_id;";



                    try{
          
                      mysqli_query($conn, $updatesql);
                      echo '<script>alert("updated")</script>';
                      header("location:../../view/public/tour.php?tour_name=$tour_name&bool=true");
          $sql3 =  "select  count(tour_id) 'rquantity', AVG(rating) 'rating' from review  where tour_id = $tour_id";
           $mydata = mysqli_query($conn, $sql3);
           $row = $mydata->fetch_assoc();
           $rating = $row["rating"];
           $rquantity = $row["rquantity"];
           

           $sql4 = "UPDATE `tour` SET `rating_quantity` = '$rquantity', `rating` = '$rating' WHERE `tour`.`tour_id` = $tour_id;";
  if(mysqli_query($conn, $sql4)){
            
           }
                    }catch(Exception $err){

                      

                    }


                     
      

                         }
      


    }


      


?>