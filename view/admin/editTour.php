<?php
    session_start();
   $_SESSION["display"] = false;
  $booking = " ";
  $profile = " ";
  $logout = " ";
  $login = "Login";
  $signup = "Sign up";
    //  if($_SESSION["role"]!="admin"){
    //     header("location:../index.php");
    // }

     include "../../config/config.php";

 if(isset($_SESSION["username"])){
      $booking = "Booking";
      $profile = "Profile";
      $logout = "Log Out";
      $login = "";
      $signup = "";
        $user_name = $_SESSION["username"];
        $user_role= $_SESSION["role"];
        $sql = "SELECT* FROM user WHERE username = '$user_name'";
        
    try{
      $mydata = mysqli_query($conn, $sql);
      $row = $mydata->fetch_assoc();
      $user_id=$row["user_id"];
      $user_name = $row["username"];
      $first_name = $row["first_name"];
      $last_name = $row["last_name"];
      $email = $row["email"];
      $phone_number = $row["phone_number"];
      $photo = $row["photo"];
  }catch(Exception $err){
      echo $err;
  }
    }

    if(isset($_SERVER["REQUEST_URI"])){

   $url = $_SERVER["REQUEST_URI"];
   $components = parse_url($url);
   parse_str($components['query'], $results);
   $tour_id = $results['id'];
    $tour_id =(int) $tour_id ;

        include('../../config/config.php');
        $sql = "SELECT * FROM tour INNER JOIN address ON tour.tour_id = address.tour_id WHERE tour.tour_id =$tour_id;";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);
            $tour_id = $row["tour_id"];
            $_SESSION["tour_id"] = $tour_id;
            $tour_name = $row["tour_name"];
            $duration = $row["duration"];
            $difficulty = $row["difficulty"];
            $group_size = $row["group_size"];
            $summary = $row["summary"];
            $price = $row["price"];
            $discount = "232";
            $region = $row["region"];
            $town = $row["town"];
            $direction = $row["direction"];
            $_SESSION["display"] = true; 
        }
        else{
             echo "Ther is no Tour with this name";
        }
    }
    if (isset($_POST['upload1'])) {
      include "../../utils/uploadImage.php";
      uploadImage("../../multimedia/img/users/","profileImage");
    }
    if (isset($_POST['upload2'])) {
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

    <title>Guzo Tour</title>
  </head>
<body>
<header class="header">



  <nav class="nav nav--tours">
        <a href="../../index.php" class="nav__el">All tours</a>
         
           
     
      </nav>
      <div class="header__logo">
        <img src="../../multimedia/img/logo-white.png" alt="Natours logo" />
      </div>
      <nav class="nav nav--user">
        <!-- <a href="#" class="nav__el"><?php echo $booking?></a> -->
        <a href="./view/profile.php" class="nav__el">
        <?php 
        if(isset($_SESSION["username"])){
          $filepath = "<img src = "."../../multimedia/img/users/".$photo." class='nav__user-img'.".">";
          //alt="User photo" class="nav__user-img"
          echo $filepath;
        }
        ?>
        </a>
        <a href="../../controller/authController/log_out.php" class="nav__el"><?php echo $logout?></a>
        <!-- <a href="../shared/login.php" class="nav__el"><?php echo $login?>ghg</a>
        <a href="../shared/register.php" class="nav__el"><?php echo $signup?>fg</a>       -->
      </nav>
 </header>
    <style>
        /* body{
            font-size: 30px;
            font-weight: 500;
            background-color: white;
            color: blue;
        }
        form#add-tour-form{
            width: 45%;
            margin: auto;
        }
        #data{
            width: 50%;

        }
        form#change{
            width: 45%;
            margin-right: 0px;
            position: absolute;
            left:800px;
            top:200px; */
        /* } */
    </style>
<body>
    <div class="section-reviewsss"></div>
    <div id="edit-tour"  >
     
      
        
            <?php
            if($_SESSION["display"]){
                $s2=<<<EOT
                <form class="tourInfo" action="../../controller/tourController/editTour.php?id=$tour_id" method="post">
                <div class="mainTour">
                <div><label for="name">Name</label><input   name="name" id="name" value="$tour_name"  type="text"></div>
                <div><label for="duration">Duration</label><input   name="duration" id="duration" value="$duration"  type="text"></div>
                <div><label for="price">Price</label><input   name="price" id="price" value="$price"  type="text"></div>
                <div><label for="group">Group size</label><input   name="group" id="group" value="$group_size"  type="text"></div>
                <div><label for="town">Town</label><input   name="town" id="town" value="$town"  type="text"></div>
                </div>
                <div class="mainTour">
                <div><label for="region">Region</label><input   name="region" id="region" value="$region"  type="text"></div>
                <div><label for="direction">Direction</label><input   name="direction" id="direction" value="$direction"  type="text"></div>
                <div><label for="summary">summary</label><textarea id="story" name="summary" rows="5" cols="60">$summary 
                </textarea>
                </div><button id="submit" class="upload" type="submit" name = "form2" >submit</button></div>
                <div>
                </div>
                </form>
                EOT;
                echo "$s2";
            }
           
            ?>
        </div>
        <div>
    </div>
    <div class="section-reviewss"></div>

    <form  method="POST" action="#" enctype="multipart/form-data" id = "photo">
      <input type="file" name="uploadfile"  id = "fileupload1" style = "display:none"value="" required/>
        
      <div>Upload Cover Image
          <button type="submit" name="upload" value ="true" id = "filee" onclick = "diplayImageForm('filee')" >UPLOAD</button>
        </div>
        <div>
          <button type="submit" name="upload" value ="true" style = "display:none" id = "filebtn2" >Submit</button>
        </div>
  </form> 
  <form  method="POST" action="#" enctype="multipart/form-data" id = "photo">
      <input type="file" name="uploadfile"  id = "fileupload2" style = "display:none"value="" required/>
        
      <div> Upload Image
          <button type="submit" name="upload1" value ="true" id = "fileee" onclick = "diplayImageForm('fileee')" >UPLOAD</button>
        </div>
        <div>
          <button type="submit" name="upload2" value ="true" style = "display:none" id = "filebtn2" >Submit</button>
        </div>
  </form> 

  <script>
     function diplayImageForm(id){
    document.getElementById(id).style.display = "none";
      if(id=='filee'){
        document.getElementById('fileupload1').click();
        document.getElementById('filebtn1').style.display = "block";
      }
      else if(id=='fileee'){
        document.getElementById('fileupload2').click();
        document.getElementById('filebtn2').style.display = "block";
      }
  
    
 
}

  </script>

    <style>
#summary{
width: 00px;
height: 200px;

}
.mainTour{
width: 30%;
margin-top: 80px;
margin-left: 80px;
display: flex;
flex-direction: column;

}
.tourInfo{
    width: 100%;
    display: flex;
    justify-content: center;
}
.mainTour div{
    display: flex;
    justify-content: space-between;
   width: 100%;
   margin-bottom: 10px;



}
.upload{
 background-image: linear-gradient(to right bottom, #7dd56f, #28b487);
 padding: 7px;
 border-radius: 4px;
 border: #7dd56f solid 2px;
 width: 100px;
}

.section-reviewss {
  margin-top: 0px;
  width: 100%;
  height: 20vh;
  position: relative;
  z-index: 1000;
  background: -webkit-gradient(
    linear,
    left top,
    right bottom,
    from(#7dd56f),
    to(#28b487)
  );
  background: linear-gradient(to right bottom, #7dd56f, #28b487);
  clip-path:polygon(100% 100%, 100% 0, 0 100%);;
  -webkit-clip-path:polygon(100% 100%, 100% 0, 0 100%);;
}

.section-reviewsss {
  margin-top: 0px;
  width: 100%;
  height: 20vh;
  position: relative;
  z-index: 1000;
  background: -webkit-gradient(
    linear,
    left top,
    right bottom,
    from(#7dd56f),
    to(#28b487)
  );
  background: linear-gradient(to right bottom, #7dd56f, #28b487);
  clip-path:polygon(100% 0, 0 0, 0 100%);
  -webkit-clip-path:polygon(100% 0, 0 0, 0 100%);;
}
#edit-tour{
    height: 48vh;
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
 background-color:rgb(230, 230, 230);

    /* align-items: center; */
}
 p,a,.names,input,button,label,textarea{
  border: none;
  outline: none;
  font-size: 20px;
  color: #444;
  font-weight:600;
}
input{
  padding: 10px;
}
label{
    margin: 0 10px;
}
    </style>
</body>
</html>
