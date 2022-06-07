<?php
    function isAuthorzied(){
        if(isset($_SESSION["username"])){
            if($_SESSION["role"]!="admin"){
                header("location:http://localhost:7882/guzo");
            }
        }
    }
    function isAuthenticated(){
        if(!isset($_SESSION["username"])){
            header("location:http://localhost:7882/guzo/view/shared/login.php");
        }
    }
    

?>