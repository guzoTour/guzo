<?php
 session_start();
  include "../../utils/prevent.php";
  isNotLogged();
if(isset($_POST["register"])){

    include "../../config/config.php";

    try{
      $first_name = filter_var($_POST['first_name'], FILTER_SANITIZE_STRING);
      $last_name = filter_var($_POST['last_name'], FILTER_SANITIZE_STRING);
      $user_name = filter_var($_POST['user_name'], FILTER_SANITIZE_STRING);
      $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
      $phone = filter_var( $_POST['phone'],FILTER_SANITIZE_STRING);
      $password = crypt($_POST["password"],'$1$rasmusln$');

    }catch(Exception $err){
      echo $err;
    }
    $sql = "INSERT INTO user (last_name, first_name, email, phone_number,pw, username) VALUES ('$last_name','$first_name','$email', '$phone', '$password', '$user_name')";
    if (mysqli_query($conn, $sql)) {
      $to = $email;
      $subject = "Reset Error";
      
      //Add to log file
      $query = "\n".date("Y/m/d:h:i")."   User  Note    ".$user_name." has signuped";
      $file3 = fopen('../../files/queryReport.log','a');
      if($file3){
        fwrite($file3,$query);
        fclose($file3);   
      }    
      $_SESSION["username"]=$user_name;
      $_SESSION["email"]=$email;
      $_SESSION["role"] = "user";
      $users = array();
            array_push($users, $first_name,$last_name,$user_name,$email,$phone);
            $file1 = fopen('../../files/users.csv','a');
            if (!$file1) {
                echo "<p>Unable to open remote file.\n";
                exit;
            }else{
                fputcsv($file1, $users);
                fclose($file1);
            }
      header("location:../../view/shared/profile.php");

    } else {
      echo "<h3>Error: " . $sql . "<br>" . mysqli_error($conn)."</h3>";
      header("location:../../view/shared/register.php");
    }
  }
?>
