<?php
    session_start();     
    include "../../utils/prevent.php";
    isNotLogged();
if(isset($_POST)){
    if(isset($_SESSION['attempt_again'])){
        $now = time();
        if($now >= $_SESSION['attempt_again']){
            unset($_SESSION['attempt']);
            unset($_SESSION['attempt_again']);
        }
        else{
            echo "Please try again after one hour";
        }
    }
    
    //set login attempt if not set
    if(!isset($_SESSION['attempt'])){
        $_SESSION['attempt'] = 0;
    }

    //check if there are 3 attempts already
    if($_SESSION['attempt'] == 3){
        $_SESSION['error'] = 'Attempt limit reach';
    }
    else{

        include "../../config/config.php";
        $user_name =  filter_var($_POST['user_name'], FILTER_SANITIZE_STRING);
        $password = $_POST['password'];
        $sql = "SELECT* FROM user WHERE username = '$user_name'";
        try{
            $mydata = mysqli_query($conn, $sql);
            $row = $mydata->fetch_assoc();
            if(!isset($row)){
                $reg= "You hava not registerd Please register!!!";
                header("location:../../view/public/404.php?massage=$reg&reg=reg");
                
            }
            else{
                if (password_verify($password, $row["pw"])){
                    unset($_SESSION['attempt']);
                    $_SESSION["username"]=$row["username"];
                    $_SESSION["email"]=$row["email"];
                    $_SESSION["user_id"]=$row["user_id"];
                    $_SESSION["role"]=$row["role"];
                    //Add to log file
                    $file3 = fopen('../../files/queryReport.log','a');
                    $query = "\n".date("Y/m/d:h:i")."   User  Note    ".$user_name." has logged";
                    if($file3){
                        fwrite($file3,$query);
                        fclose($file3);   
                    }
                    if($row["role"]=="admin"){
                        header("location:../../view/admin/adminProfile.php");
                    }
                    else{
                    header("location:../../view/shared/profile.php");
                    }
                }
                else{
                    $_SESSION['attempt'] += 1;
                    $reg= "Your Password is not correct !!";
                    header("location:../../view/public/404.php?massage=$reg&reg=pass");
                    if($_SESSION['attempt']>=3){
                        $_SESSION['attempt_again'] = time() + 60*60;
                        echo "\nSorry please try again after a hour!!";
                        $file3 = fopen('../files/queryReport.log','a');
                        $query = "\n".date("Y/m/d:h:i")."   Unknown  Error    ".$user_name." has attempted to login multiple types";
                        if($file3){
                            fwrite($file3,$query);
                            fclose($file3);   
                        }
                    }

                }
            }           
        }catch(Exception $err){
            echo  $sql . "<br>" . mysqli_error($conn);
        }
    }

}    
?>