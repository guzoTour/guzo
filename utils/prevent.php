<?php
    function isAuthorzied(){
        if($_SESSION["role"]!="admin"){
            header("location:../../index.php");
        }
    }
    function isAuthenticated(){
        if(!isset($_SESSION["username"])){
            header("location:../../view/shared/login.php");
        }
    }
?>