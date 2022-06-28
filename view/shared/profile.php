<?php
  session_start();
  include "../../utils/prevent.php";
  isAuthenticated();
  if(isset($_SESSION['changedPassword'])){
    echo "<script>alert('Password changed sucessefully')</script>";
    unset($_SESSION['changedPassword']);
  }
  $booking = " ";
  $profile = " ";
  $logout = " ";
  $login = "Login";
  $signup = "Sign up";
     include "../../config/config.php";
   if(isset($_POST["edit"])){
        $firstname = $_POST['first_name'];
        $lastname = $_POST["last_name"];
        $phone=$_POST["phone"];
        $user_name = $_SESSION["username"];
    $sql="UPDATE `user` SET `first_name` = '$firstname', `last_name` = '$lastname', `phone_number` = '$phone' WHERE `user`.`username` = '$user_name'";
if (mysqli_query($conn, $sql)) {


}

   }

        $booking = "Booking";
        $profile = "Profile";
        $logout = "Log Out";
        $login = "";
        $signup = "";
        include "../../config/config.php";
        $user_name = $_SESSION["username"];
        $sql = "SELECT * FROM user WHERE username = '$user_name'";
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
            $id = $row["user_id"];
        }catch(Exception $err){
            echo $err;
        }
  
    if (isset($_POST['upload'])) {
        include "../../utils/uploadImage.php";
        uploadImage("../../multimedia/img/users/","profileImage",34);
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
    <link rel="stylesheet" href="../../css/booked.css">
    <link rel="shortcut icon" type="image/png" href="../../multimedia/img/favicon.png" />

    <title>Natours | Exciting tours for adventurous people</title>
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
       
    
        </a>
        <a href="../../controller/authController/log_out.php" class="nav__el"><?php echo $logout?></a>
        <a href="./view/login.php" class="nav__el"><?php echo $login?></a>
        <a href="./view/register.php" class="nav__el"><?php echo $signup?></a>
         
      </nav>
 </header>


  <div class="mainProfile">

      <div class="profileImg">
        <div>
          <div class="imgSize">
          <?php   
          $filepath = "<img class='imags' src = "."../../multimedia/img/users/".$photo.">";
          echo $filepath;
          ?>   
     </div> 
  
     <form  method="POST" action="#" enctype="multipart/form-data" id = "photo">
      <input type="file" name="uploadfile"  id = "fileupload" style = "display:none"value="" required/>
        
      <div>
          <button type="submit" name="upload" value ="true" id = "filee" class = "upload" onclick = "diplayImageForm('filee')" >UPLOAD</button>
        </div>
        <div>
          <button type="submit" name="upload" value ="true" class = "upload" style = "display:none" id = "filebtn" >Submit</button>
        </div>
  </form>
        <p> username:<?php echo $user_name ?> </p>
              </div>
  </div>
              
    <div class="profileInfo">
                <div>
          <form action="" name="edit" method="post">
      <div class="names"><span>First Name: </span>  <?php  $first_name ="<input class='editInput' name='first_name' type='text' value='$first_name' disabled=true>";
        echo "  ".$first_name ?> 
       <span>Last Name:</span> <?php  $last_name="<input class='editInput' name='last_name' type='text' value='$last_name' disabled=true>";
        echo "  ".$last_name ?> 
      </div>
          <p>Phone: <?php  $phone_number="<input name='phone' class='editInput' type='text' value='$phone_number' disabled=true>";
        echo "  ".$phone_number?>  </p>
         <p>email:  <?php  $email="<input name='email' class='editInput' type='text' size='40' value='$email' disabled=true>";
        echo "  ".$email?>  </p>
     
          <button class="upload uploads" id="goto-edit-profile">Edit Profile</button>
          <input class="upload editProfile"  type="submit" name="edit" id="submitChangeBtn" disabled=true>
        </form>
        <button class="upload rbtn disablers" id="changepassword"><a href="./changePassword.php">Change Password</a></button>;
        <?php
              // if($role==="admin"){
              //     echo '<button class="upload disablers" id="goto-edit-profile"><a href="../controller/editTour.php">Edit Tour</a></button>';
              //     echo '<button class="upload disablers" id="goto-edit-profile"><a href="./add_tour.php">Add Tour</a></button>';
              // }
              ?>
          </div>
    </div>
    <div class="book-container">
    <!-- <h1>Booked Tour</h1> -->
      <?php
        include('../../config/config.php');
        $bookSql = "SELECT * FROM tour INNER JOIN booking ON tour.tour_id = booking.tour_id WHERE booking.user_id='$id';";
        $res = mysqli_query($conn, $bookSql);

        while($row = mysqli_fetch_assoc($res)){
          $tour_id = $row["tour_id"];
    $tour_name = $row["tour_name"];
    $duration = $row["duration"];
    $difficulty = $row["difficulty"];
    $group_size = $row["group_size"];
    $summary = $row["summary"];
    $price = $row["price"];
    // $region = $row["region"];
    // $town = $row["town"];
    // $direction = $row["direction"];
    $name = $row["tour_name"];
    $start=$row["start_date"];
    // $region = $row["region"];
  $s2=<<<DDD
    <div class="card" id="tour-$tour_id">
    <div class="card__header">
    <div class="card__picture">
    <div class="card__picture-overlay">&nbsp;</div>
    <img src="../../multimedia/img/tours/tour-$tour_id-cover.jpg" alt="$tour_id" class="card__picture-img"
              />
             </div>
              <h3 class="heading-tertirary">
            <span>$tour_name</span></h3> </div>
         <div class="card__details">
          <h4 class="card__sub-heading">Easy $duration-day tour</h4>
          <p class="card__text">
            Breathtaking hike through the Canadian Banff National Park
          </p>
          <div class="card__data">
            <svg class="card__icon">
            <i class="fa-solid fa-location-dot"> </i><span> region , town</span>
            </svg>
          </div>
          <div class="card__data">
          <i class="fa-solid fa-calendar-days"></i>
            <span> $start</span>
          </div>
          <div class="card__data">
            <svg class="card__icon">
              <use xlink:href="img/icons.svg#icon-flag"></use>
            </svg>
            <span>From mexico </span>
          </div>
          <div class="card__data">
            <svg class="card__icon">
              <use xlink:href="img/icons.svg#icon-user"></use>
            </svg>
            <span>$group_size people</span>
          </div>
        </div>

        <div class="card__footer">
          <p>
            <span class="card__footer-value">$price ETB</span>
            <span class="card__footer-text">per person</span>
          </p>
          <p class="card__ratings">
            <span class="card__footer-value">4.9</span>
            <span class="card__footer-text">rating (21)</span>
          </p>
        <a onclick="handleCancel($tour_id,$id)" class="btn btn--green btn--small" id="cancelBtn">Cancel Tour</a>
        </div>
      </div>

  DDD;
 echo "$s2";
        }
      ?>
    </div>
      </div>
</div>
</body>
<script src="../../javascript/profileController.js"></script>
<script>

function diplayImageForm(id){
  //console.log(2345665);
    document.getElementById(id).style.display = "none";
    document.getElementById('filebtn').style.display = "block";
    document.getElementById('fileupload').click();
  //  document.getElementById('fileupload').style.display = "inline";
}
  const handleCancel = (tour_id, user_id)=>{
    console.log(tour_id, user_id)
    fetch(`http://localhost/guzo/controller/bookingController/cancelBooked.php`,{
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({user_id, tour_id})
    })
      .then(data=>{
        console.log(data)
        document.getElementById(`tour-${tour_id}`).remove();
      })
      .catch(err=>console.log(err))
  }
  
var btn=document.getElementById("goto-edit-profile");
var inputs = document.querySelectorAll('.editInput');
  
btn.addEventListener('click',function(e){
    e.preventDefault();
    document.getElementById('submitChangeBtn').disabled = false;
    console.log(document.getElementById('submitChangeBtn'))
    for(var i=0;i<3;i++){
        inputs[i].disabled=false;
    }
  
})
</script>

<style>
body{
    background-image: linear-gradient(to right bottom, #7dd56f, #28b487);
}
.mainProfile{
  padding-top: 20px;
  display:flex;
  justify-content: center;
  flex-wrap: wrap;
  align-items: center;
  /* max-height: 85vh; */
  min-height: 85vh;
  width: 100%;
    /* background-image: linear-gradient(to right bottom, #7dd56f, #28b487);
  opacity: 0.9; */
}
a{
  text-decoration: none;

}
.names span{
  margin-left: 20px;
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
  padding: 100px;
  border-radius: 20px;
}

.profileInfo{
 display: flex;
}
.profileImg{
 display: flex;

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
.book-container{
  margin-bottom: 0;
  width: 100%;
  background-color: #fff;
  display: flex;
  justify-content: center;
  padding: 35px 25px;
  margin-top: 25px;
}
.book-container .card{
  max-width: 350px;
  margin: 20px;
  box-shadow: 0 0 17px #555;
  border-radius: 15px;
  overflow: hidden;
}

@media (max-width: 1432px) {
  header.header{
    display: flex;
    justify-content: space-between;
  }
  .main-profile{
    display: flex;
    flex-direction: column;
    background-color: #fff;
  }
  .profileImg{
    margin-bottom: 15px;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-right: 25px;
  }
  .profileInfo{
    margin-bottom: 15px;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-right: 25px;
}}
</style>
</html>