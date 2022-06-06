<?php
    session_start();
    include "../../config/config.php";
    //include "../../controller/userController/editProfileImage.php";
    if(isset($_SESSION["username"])){
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
            echo $err;
        }
    }
    else{
        header("location: login.php");
    }
    
 
   if(isset($_POST["edit"])){
        $firstname = $_POST['first_name'];
        $lastname = $_POST["last_name"];
        $phone=$_POST["phone"];
        $user_name = $_SESSION["username"];
        $sql="UPDATE `user` SET `first_name` = '$firstname', `last_name` = '$lastname', `phone_number` = '$phone' WHERE `user`.`username` = '$user_name'";
        if (mysqli_query($conn, $sql)) {
            echo "Updated succefully";
        }
         else {
            echo "<h3>Error: " . $sql . "<br>" . mysqli_error($conn)."</h3>";
          }

   }
   if (isset($_POST['upload'])) {
    include "../../utils/uploadImage.php";
    uploadImage("../../multimedia/img/users/","profileImage");
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
    <link rel="shortcut icon" type="image/png" href="../../multimedia/img/favicon.png" />

    

    <title>Guzo Tour | Exciting tours for adventurous people</title>
  </head>
<body>
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
        <a href="#" class="nav__el">
        <?php 
        if(isset($_SESSION["username"])){
          $filepath = "<img src = "."../../multimedia/img/users/".$photo." class='nav__user-img'.".">";
          //alt="User photo" class="nav__user-img"
          echo $filepath;
        }
        ?>
        </a>
            
        <?php 
            // if($role=="admin"){
            //     echo  '<a href="./addTour.php" class="nav__el">Add Tour</a>';
            //     echo  '<a href="../controller/editTour.php" class="nav__el">Edit Tour</a>';
            // } 
        ?>
       
        <a href="../../controller/authController/log_out.php" class="nav__el">Log Out</a>
 
      </nav>
 </header>
  <div class="mainProfile">


    <div class="profileImg">
      <div>
        <div class="imgSize"><?php  $filepath = "<img src = "."../../multimedia/img/users/".$photo." class='nav__user-img'.".">";
          //alt="User photo" class="nav__user-img"
          echo $filepath;?>
          
   </div> 

   <form  method="POST" action="#" enctype="multipart/form-data" id = "photo">
      <input type="file" name="uploadfile"  id = "fileupload" style = "display:none"value="" required/>
        
      <div>
          <button type="submit" name="upload" value ="true" id = "filee" onclick = "diplayImageForm('filee')" >UPLOAD</button>
        </div>
        <div>
          <button type="submit" name="upload" value ="true" style = "display:none" id = "filebtn" >Submit</button>
        </div>
  </form>
  <?php

  ?>
      <p>Username:<?php echo $user_name ?> </p>
            </div>
</div>
            
  <div class="profileInfo">
              <div>
        <form action="" name="edit" method="post">
    <div class="names"><span>First Name:   <?php  $first_name="<input class='editInput' name='first_name' type='text' value='$first_name' disabled=true>";
      echo $first_name ?> </span>
     <span>Last Name: <?php  $last_name="<input class='editInput' name='last_name' type='text' value='$last_name' disabled=true>";
      echo $last_name ?> </span>
    </div>
        <p>Phone: <?php  $phone_number="<input name='phone' class='editInput' type='text' value='$phone_number' disabled=true>";
      echo $phone_number?>  </p>
       <p>Email:  <?php  $email="<input name='email' class='editInput' type='text' size='40' value='$email' disabled=true>";
      echo "  ".$email?>  </p>
   
        <button class="upload disabler uploads" id="goto-edit-profile">Edit Profile</button>
        <button class="upload disablers" id="goto-edit-profile"><a href="./editProfileImage.php">Change Password</a></button> 
        <input  class="upload editProfile"  type="submit" name="edit" id="submitbtn">
      </form>
      <?php

            if($role==="admin"){
              $s2=<<<EOT

                <button class="upload disablers" id="goto-edit-profile"><a href="../admin/editTour.php">Edit Tour</a></button>
                <button class="upload disablers" id="goto-edit-profile"><a href="../../utils/exportTours.php">Export</a></button> 
                <button class="upload disablers" id="goto-edit-profile"><a href="../../utils/queryReport.php">Query Report</a></button> 
                
            <div class="dropdown">
              <button class="dropbtn">Add Tour</button>
                <div class="dropdown-content">
                  <a href="../../files/importTours.php">Import</a>
                  <a href="../admin/addTour.php">Add</a>
                </div>
            </div>

            EOT;
          echo "$s2";

        }
         ?>

        </div>
    </div>
</div>
</div>
<div class="footer">
   
      <div class="footer__logo"> 
        <img src="../../multimedia/img/logo-green-round.png" alt="Guzo tour logo" />
        <span> GUZO TOUR </span>
      </div>
      <ul class="footer__nav">
        <li><a href="#">About us</a></li>
        <li><a href="#">Download apps</a></li>
        <li><a href="#">Become a guide</a></li>
        <li><a href="#">Careers</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
      <p class="footer__copyright">
        &copy; By AASTU Students. All rights reserved.
      </p>
     
</div>

</body>

<style>
body{
    background-image: linear-gradient(to right bottom, #7dd56f, #28b487);
}
.mainProfile{
  margin-top:0;
  display:flex;
  justify-content: center;
  flex-wrap: wrap;
  align-items:flex-end;
  max-height: 85vh;
  min-height: 85vh;
  width: 100%;
  margin-bottom:40px;
    /* background-image: linear-gradient(to right bottom, #7dd56f, #28b487);
  opacity: 0.9; */
}
a{
  text-decoration: none;

}
.names span{
  margin-left: 15px;
}
.upload{
 background-image: linear-gradient(to right bottom, #7dd56f, #28b487);
 padding: 7px;
 border-radius: 4px;
 border: #7dd56f solid 2px;
}

.editProfile{
  position: relative;
  right: 0px;
  top: 60px;
  left: 70%;
}
.uploads{
position: relative;
top: 60px;

}
p,a,.names,input,button{
  border: none;
  outline: none;
  font-size: 20px;
  color: #444;
  font-weight:600;
}
input{
  padding: 10px;
}
.profileInfo,.profileImg{
  height: 60vh;
  margin-left:2%;
  background-color:rgb(230, 230, 230);
  padding: 5px;
  border-radius: 20px;
}

.profileInfo{
 width: 60%;
 display: flex;
}
.profileImg{
 width: 30%;
 display: flex;

}

#submitbtn{
  visibility: hidden;
}



.profileInfo p,.profileImg p{
  margin: 20px;
}

.imgSize{
 width: 200px;
 height:200px;
 

}

.disablers{
position: relative;
left: 30%;
margin: 20px;

}
.imgSize img{
 width: 100%;
    height: 100%;
    object-fit: cover;
    overflow: hidden;
    border-radius:50%;
}
.dropbtn {
  background-image: linear-gradient(to right bottom, #7dd56f, #28b487);
 padding: 7px;
 border-radius: 4px;
 border: #7dd56f solid 2px;
  cursor: pointer;
}

.dropdown {
  position: relative;
  display: inline-block;
  margin-left:282px;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover .dropbtn {
  background-color: #3e8e41;
}
#filebtn #filee{
  background-color: #3e8e41;
  border-radius: 5px;
  width: 120px;
  height:35px;
}


</style>
<script src="../../javascript/profileController.js"></script> 
<script>


document.getElementById("goto-edit-profile").addEventListener('click',function(e){
  document.getElementById("submitbtn").style.visibility = "visible";
})

var btn=document.querySelector(".disabler");
var inputs=document.querySelectorAll('.editInput');

btn.addEventListener('click',function(e){
  
  e.preventDefault();
for(var i=0;i<3;i++){
  inputs[i].disabled=false;
}

})

// document.getElementById('filee').addEventListener('click',()=>{
//   document.getElementById('filee').style.display = "none";
//   document.getElementById('filebtn').style.display = "block";
//   document.getElementById('fileupload').click();
       
// })
</script>




</html>