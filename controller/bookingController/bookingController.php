<?php 
  include("../../config/config.php");
  session_start();
$url = $_SERVER["REQUEST_URI"];
   $components = parse_url($url);
   parse_str($components['query'], $results);
   $tour_id = $results['tour_id'];
  if(isset($_POST["sub"])){
    if(isset($_SESSION['user_id'])){
     $user_id=$_SESSION['user_id'];
     $user_id= (Int)$user_id;
     $tour_id= (Int)$tour_id;
                  $bookSql="INSERT INTO `booking` (`tour_id`, `user_id`, `piad`, `Created_at`) VALUES ('$tour_id', '$user_id', '1', current_timestamp());";
                  
                  try{
                   mysqli_query($conn, $bookSql);

                   $_SESSION["booked"]="book";
                    // echo '<script>alert("Booking is done  Thank You")</script>';
                     header("location:../../index.php");

                  }catch(Exception $err){
               
                    $_SESSION["booked"]="book";

                     header("location:../../index.php");


                         }


                }

                else{
                   
                   $_SESSION["notlogged"]="unbook";
                   header("location:../../view/shared/login.php");
                   

                

                }


            } 


?>