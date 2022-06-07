<?php

    session_start();
    if(isset($_POST["submit"])){
        
        if(isset($_SESSION["username"])){
            include "../../config/config.php";
            $user_name = $_SESSION["username"];
            $password = $_POST["password"];
            $new_password = crypt($_POST["new-password"],'$1$rasmusln$');
            $confirm_password = crypt($_POST["confirm-password"],'$1$rasmusln$');
            $sql = "SELECT* FROM user WHERE username = '$user_name'";
            try{
                $mydata = mysqli_query($conn, $sql);
                $row = $mydata->fetch_assoc();
                if(!isset($row)){
                   echo "You hava not registerd Please register!!!";
                }
                else{
                    
                    if (password_verify($password, $row["pw"])){
                        
                        $sql2 = "UPDATE  user set pw = '$new_password' where username = '$user_name'";
                        echo $sql2;
                        if(mysqli_query($conn, $sql2)){
                            
                            $file3 = fopen('../../files/queryReport.log','a');
                            $query = "\n".date("Y/m/d:h:i")."   User  Note    ".$user_name." has changed password";
                            if($file3){
                                fwrite($file3,$query);
                                fclose($file3);   
                            }
                            $_SESSION['changedPassword'] = true;

                            if($_SESSION['role']=="admin"){
                                header("location:../../view/admin/adminProfile.php");
                            }
                            else{

                                header("location:../../view/shared/profile.php");
                            }

                        }
                           
                    }
                    else{
                        echo "Your Password is not correct!!";
                    }
                }           
            }catch(Exception $err){
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
        else{
            
        }
}
   