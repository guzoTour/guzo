<?php 
  session_start();
  if(isset($_SESSION["username"])){

    $user_name = $_SESSION["username"];
    session_unset();
    $file3 = fopen('../../files/queryReport.log','a');
    $query = "\n".date("Y/m/d:h:i")."   User  Note    ".$user_name." has logged out";
    if($file3){
      fwrite($file3,$query);
      fclose($file3);   
    }                      
  }
  header("location:../../index.php");
?>