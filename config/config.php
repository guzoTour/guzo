<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "guzo_tour";

$conn = mysqli_connect($servername, $username, $password,"guzo_tour");

if(!$conn){
    die("Connection Lost!");
}
?>