<?php
    function isAuthorzied(){
        if(isset($_SESSION["username"])){
            if($_SESSION["role"]!="admin"){
                header("location:http://localhost:guzo");
            }
        }
    }
    function isAuthenticated(){
        if(!isset($_SESSION["username"])){
            header("location:http://localhost:guzo/view/shared/login.php");
        }
    }
    
    function isNotLogged(){
        if(isset($_SESSION["username"])){
            if($_SESSION["role"]=="admin"){
                header("location:http://localhost:guzo/view/admin/adminProfile.php");
            }
            else{
                header("location:http://localhost:guzo/view/shared/profile.php");
            }
        }
    }
?>
