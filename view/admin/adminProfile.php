<?php

// if (isset($_POST['upload'])) {
   
// }
  session_start();
  $booking = " ";
  $profile = " ";
  $logout = " ";
  $login = "Login";
  $signup = "Sign up";
     include "../../config/config.php";

$Toursql="SELECT `tour_name` , `group_size` FROM `tour`";

$result = mysqli_query($conn, $Toursql);
$Torus=array();
$group=array();
$total=0;
$totalbookspace=0;
if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    $tour_name = $row["tour_name"];
    $group_size = $row["group_size"];
    array_push($Torus,$tour_name);
    array_push($group,$group_size);
    $totalbookspace=$totalbookspace+ $group_size;
    $total++;
    //$date=$row["created_at"];

    // $duration = $row["duration"];
    // $difficulty = $row["difficulty"];
    // $summary = $row["summary"];
    // $price = $row["price"];
    // $region = $row["region"];
    // $town = $row["town"];
    // $direction = $row["direction"];
    // $name = $row["tour_name"];


  }}
  //  current_timestamp()
    $date= date("Y \- m \- d") ;

    $todays=" SELECT COUNT(*) FROM `booking` WHERE Created_at='$date';";
    $cResultto = mysqli_query($conn, $todays); 
   $datas=mysqli_fetch_assoc($cResultto);
    $countday= $datas['COUNT(*)'];

    $count="SELECT COUNT(*) FROM booking";
    $cResult = mysqli_query($conn, $count);
    $data=mysqli_fetch_assoc($cResult);
    $count= $data['COUNT(*)'];
   
   if(isset($_POST["edit"])){
       
        include "../../utils/uploadImage.php";
        uploadImage("../../multimedia/img/users/","profileImage");
        $firstname = $_POST['first_name'];
        $lastname = $_POST["last_name"];
        $phone=$_POST["phone"];
        $user_name = $_SESSION["username"];
        $sql="UPDATE `user` SET `first_name` = '$firstname', `last_name` = '$lastname', `phone_number` = '$phone' WHERE `user`.`username` = '$user_name'";
        if (mysqli_query($conn, $sql)) {

        }
   }
   if (isset($_POST['upload'])) {
    include "../../utils/uploadImage.php";
    uploadImage("../../multimedia/img/users/","profileImage");
  }

    if(isset($_SESSION["username"])){
    $booking = "Booking";
    $profile = "Profile";
    $logout = "Log Out";
    $login = "";
    $signup = "";



        include "../../config/config.php";
        $user_name = $_SESSION["username"];
        $sql = "SELECT* FROM user WHERE username = '$user_name'";
        $BOOKING;
        try{
            $mydata = mysqli_query($conn, $sql);
            $row = $mydata->fetch_assoc();
            $user_name = $row["username"];
            $first_name = $row["first_name"];
            $last_name = $row["last_name"];
            $email = $row["email"];
            $phone_number = $row["phone_number"];
            $photo = $row["photo"];
            $role = $row["role"];
            
        }catch(Exception $err){
            echo $err; mysqli_error($conn);        }
    }
    else{
        header("location:../view/login.php");
    }
       
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link
      href="https://fonts.googleapis.com/css?family=Lato:300,300i,700"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="../../css/style.css" />
    <link rel="stylesheet" href="../../css/adminStyle.css" />
    <link rel="shortcut icon" type="image/png" href="../../multimedia/img/favicon.png" />

   

    <title>Guzo Tour</title>
  </head>
<body style="min-height:100vh;">
<header class="header">



  <nav class="nav nav--tours">
        <a href="../../index.php" class="nav__el">All tours</a>
          <li class="hov">  <button class="nav__search-btn">
           
      </nav>
      <div class="header__logo">
        <img src="../../multimedia/img/logo-white.png" alt="Natours logo" />
      </div>
      <nav class="nav nav--user">
        <!-- <a href="#" class="nav__el"><?php echo $booking?></a> -->
        <!-- <a href="./view/profile.php" class="nav__el">
        <?php 
        if(isset($_SESSION["username"])){
          $filepath = "<img src = "."../../multimedia/img/users/".$photo." class='nav__user-img'.".">";
          //alt="User photo" class="nav__user-img"
          echo $filepath;
        }
        ?>
        </a> -->
        <a href="../../controller/authController/log_out.php" class="nav__el"><?php echo $logout?></a>
        <a href="./view/shared/login.php" class="nav__el"><?php echo $login?></a>
        <a href="./view/shared/register.php" class="nav__el"><?php echo $signup?></a>
         
      </nav>
 </header>


  <div class="mainProfile">


    <div class="profileImg">
  <div class="leftD">

 
    <ul>
      <li>
        <button class="upload disablers" id="goto-edit-profile"><a href="#">Dashboard</a></button>
      </li>
      <li>

        <button class="upload rbtn disablers" id="goto-edit-profile"><a href="#">Profile</a></button>;
      </li>
     
       <li>

        <button class="upload disablers" id="goto-edit-profile"><a href="./addTour.php">Add Tour</a></button>;
      </li>
      <li>

        <button class="upload disablers" id="goto-edit-profile"><a href="../../utils/exportTours.php">Export </a></button>;
      </li>
      

      
    </ul>
      <div>
       
     </div>
      
   </div>
</div>
      <div class="editInfo">
        <div>
    <div class="tourTotalIfo">

      <div class="TotalTour">
     <h1> <i class="fa-solid fa-van-shuttle"></i> Total Tour</h1> <h1><?php echo "$total  Tour are active";  ?></h1>
     </div>
     
     <div class="Totalbookingspace">
    <h1><i class="fa-brands fa-servicestack"></i>Total book space</h1>
    <h1><?php echo "$totalbookspace  applicants can apply";  ?></h1>
     </div>
      <div class="TotalApplicant">
      <h1> <i class="fa-solid fa-people-group"></i>Total Applicant</h1>
      <h1><?php echo "$count applicants applied" ?></h1>
      </div>
       <div class="Remaining">
      <h1><i class="fa-solid fa-hourglass"></i>Remaining Book space</h1>
      <h1><?php $remain= $totalbookspace-$count
      ;  echo "$remain space remain" ?></h1>

      </div>
       <div class="Todaycustomers">
      <h1><i class="fa-solid fa-door-open"></i>Todays customers</h1>
        <h1><?php 
      ;  echo "$countday booking order" ?></h1>
      </div>
     
    </div>
    
    <div class="tourGraph">  
     <table id="keywords" cellspacing="0" cellpadding="0">
    <thead>
      <tr>
        <th><span>Tour Name</span></th>
        <th><span>Group Size</span></th>
        <th><span>Applicants </span></th>
        <th><span>Remain</span></th>
        <th><span>price</span></th>
        <th><span>Duration</span></th>
        <th><span>Start data</span></th>
        <th><span>Edit</span></th>
      </tr>
    </thead>
    <tbody>
     
    <?php 
$Toursql="SELECT * FROM `tour`";
    
    $result = mysqli_query($conn, $Toursql);
  $totalbookspace=0;
if (mysqli_num_rows($result) > 0) {
 
  while($row = mysqli_fetch_assoc($result)) {
    $tour_id=$row["tour_id"];
    $tour_name = $row["tour_name"];
    $group_size = $row["group_size"];
    $date=$row["start_date"];
    $duration = $row["duration"];
    $price = $row["price"];
    $count="SELECT COUNT(*) FROM booking WHERE tour_id=$tour_id;";
    $cResult = mysqli_query($conn, $count);
    $data=mysqli_fetch_assoc($cResult);
   $count= $data['COUNT(*)'];
   $remain=$group_size-$count;

 $s2=<<<DDD
    <tr>
        <td class="lalign">$tour_name</td>
        <td>$group_size</td>
        <td> $count</td>
        <td>$remain</td> 
        <td>$price ETB</td>
        <td> $duration days</td>
        <td>$date</td>
        <td> <a class="edit" href="editTour.php?id=$tour_id">EDIT</a></td>
      </tr>
    DDD;

    echo $s2;
  }}
    
    
    ?>
       
  </table>

  
    </div>
<div id="chartContainer">
  <div id="month-chart"></div>
  <div id="location-chart"></div>
</div>
<div class="space"></div> 
</div>   
</div>  


<div class="profileInfo">
  <div class="prof">
    <div>
    <div class="xbtn"><button>X</button></div>
     <div class="imgSize">
              <?php   
        $filepath = "<img class='imags' src = "."../../multimedia/img/users/".$photo.">";
        echo $filepath;
        ?>  
        <div class="up">
        </div>
   </div>
    <form  method="POST" action="#" enctype="multipart/form-data" id = "photo">
      <input type="file" name="uploadfile"  id = "fileupload" style = "display:none"value="" required/>
        
      <div>
          <button class="upup" type="submit" name="upload" value ="true" id = "filee" onclick = "diplayImageForm('filee')" >UPLOAD</button>
        </div>
        <div>
          <button class="upup"  type="submit" name="upload" value ="true" style = "display:none" id = "filebtn" >Submit</button>
        </div>
  </form>
  </div>
 
  <form action="#"  method="post">
          <div>
            
   <p>First Name:   <?php  $first_name="<input class='editInput' name='first_name' type='text' value='$first_name' disabled=true>";
      echo $first_name ?> </p>
     <p>Last Name: <?php  $last_name="<input class='editInput' name='last_name' type='text' value='$last_name' disabled=true>";
      echo $last_name ?> </p>
    
    <p>Phone: <?php  $phone_number="<input name='phone' class='editInput' type='text' value='$phone_number' disabled=true>";
      echo $phone_number?>  </p>
       <p>email:  <?php  $email="<input name='email' class='editInput' type='text' size='27' value='$email' disabled=true>";
      echo "  ".$email?>  </p>
        <p> username:<?php echo $user_name ?> </p>
        <button class="upload disabler uploads" id="goto-edit-profile">Edit Profile</button>
        <input class="upload editProfile"  type="submit" name="edit" value="Save" id="">
      </div>
    </form>

   
    <!-- <?php
 

 
 ?> -->
     
<   </div>
   
    
  </div>
</div>
 
  
  <script src="../../javascript/ap.js"></script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  <!-- <script src="../../javascript/ap.js"></script> -->
<script>
  function diplayImageForm(id){
  //console.log(2345665);
    document.getElementById(id).style.display = "none";
    document.getElementById('filebtn').style.display = "block";
    document.getElementById('fileupload').click();
  //  document.getElementById('fileupload').style.display = "inline";
}
var btn=document.querySelector(".disabler");
var inputs=document.querySelectorAll('.editInput');

btn.addEventListener('click',function(e){

   e.preventDefault();

for(var i=0;i<3;i++){
  inputs[i].disabled=false;
}
})

var rbtn=document.querySelector(".rbtn");
var xbtn=document.querySelector(".xbtn");
var dis=document.querySelector(".profileInfo");

xbtn.addEventListener("click", function(e){
  dis.style.display="none";

})

rbtn.addEventListener("click", function(e){
  dis.style.display="flex";

})

</script>

 
</body>
</html>