<?php
  session_start();
  if(isset($_SESSION["booked"])){
      unset($_SESSION["booked"]);
     echo '<script>alert("Booking is done  Thank You")</script>';


  }

  if(isset($_SESSION["bookeds"])){
    unset($_SESSION["bookeds"]);
     echo '<script>alert("u are already booked Thank You")</script>';

     
  }
  $booking = " ";
  $profile = " ";
  $logout = " ";
  $login = "Login";
  $signup = "Sign up";
  if(isset($_SESSION["username"])){
    $booking = "Booking";
    $profile = "Profile";
    $logout = "Log Out";
    $login = "";
    $signup = "";

    include "./config/config.php";
        $user_name = $_SESSION["username"];
        $sql = "SELECT* FROM user WHERE username = '$user_name'";
        
    try{
      $mydata = mysqli_query($conn, $sql);
      $row = $mydata->fetch_assoc();
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

    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <link rel="shortcut icon" type="image/png" href="multimedia/img/favicon.png" />
    <link rel="shortcut icon" type="image/png" href="multimedia/img/favicon.png" />
    <title>Guzo Tour</title>
  </head>
  <body>
  <header class="header">
  <nav class="nav nav--tours">
        <a href="index.php" class="nav__el">All tours</a>
          <li class="hov">  <button class="nav__search-btn">
            <svg>
              <use xlink:href="img/icons.svg#icon-search"></use>
            </svg>
        <form method="get" action="" class="nav__search">
          </button> Search by
        <ul class="seleter">
                  <li><input type="radio" value="tour_name"  checked name="searchBy"/><span >name</span ></li>
                  <li ><input type="radio" value="town" name="searchBy"/><br><span >town</span ></li>
                  <li ><input type="radio" value="location" name="searchBy" /><span >location</span ></li>
                  <li ><input type="radio" value="region" name="searchBy" /><span >region</span ></li>
                  <li ><input type="radio" value="direction" name="searchBy" /><span >direction</span ></li>
                  <li ><input type="radio" value="difficulty" name="searchBy" /><span >difficulty</span ></li>
                  <li ><input type="radio" value="duration" name="searchBy" /><span >duration</span ></li>
                   <li ><label for="region">price</label></li>
                  <li ><input type="radio" id="greater" value=">=" name="searchBy" /><label for="greater">greater </label></li>
                  <li ><input type="radio" id="less" value="<=" name="searchBy" /><label for="less">less</label></li>
        </ul>
  </li>
          </ul>
          <input
            type="text"
            placeholder="Search tours"
            class="nav__search-input"
            name="search_query"
          />

          <button class="btnsub" name="searchbtn" type="submit"><i class="fa-solid fa-magnifying-glass ficon"></i></button>
        </form>
      </nav>
      <div class="header__logo">
        <img src="./multimedia/img/logo-white.png" alt="Natours logo" />
      </div>
      <nav class="nav nav--user">        
        <?php 
        if(isset($_SESSION["username"])){
          $role = $_SESSION["role"];
          if($role=="admin"){
            echo '<a href="view/admin/adminProfile.php" class="nav__el">';
    
          }
          else{
            echo '<a href="view/shared/profile.php" class="nav__el">';
          }
          $filepath = "<img src = "."multimedia/img/users/".$photo." class='nav__user-img'.".">";
          //alt="User photo" class="nav__user-img"
          echo $filepath;
        

        }
        ?>
        </a>
        <a href="controller/authController/log_out.php" class="nav__el"><?php echo $logout?></a>
        <a href="./view/shared/login.php" class="nav__el"><?php echo $login?></a>
        <a href="./view/shared/register.php" class="nav__el"><?php echo $signup?></a>
         
      </nav>
 </header>
    <section class="overview" id="overview">
      <div class="card-container">
        
      <?php

include('./view/public/displayTour.php');

?>
      </div>
    </section>
    <div class="footer">
   
      <div class="footer__logo"> 
        <img src="multimedia/img/logo-green-round.png" alt="Natours logo" />
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

    <script src="./javascrift/js.js"></script>
    <style>
.footer__logo{
display: flex;
justify-content: center;
align-items: center;

}
.footer__logo span{
font-size: 20px;
margin-left: 10px;

}

      .btnsub{
      background: none;
      border: none
      ;

      }
      ul,li{
 
}
.seleter {
background-color: #444;
  
}
.seleter li{
  list-style:none;
  width:100px;
  padding: 2px 7px;
  border: none;
  height: 30px;
  line-height: 30px;
  -webkit-transition: all .5s ease-in-out;
  display: flex;
  /* justify-content: center; */
  align-items: center;
  
}

.seleter li:nth-child(odd){
  
  -webkit-transform-origin: top;
  -webkit-transform: perspective(350px) rotateX(-90deg);
}

.seleter li:nth-child(even){
   margin-top:-65px;
  -webkit-transform-origin: bottom;
  -webkit-transform: perspective(350px) rotateX(90deg);
}

/*.seleter{
  
  -webkit-transition: all .5s ease-in-out;
  -webkit-transform-origin: 50% 0%;
  -webkit-transform: perspective(350px) rotateX(-90deg);
}

.hov:hover .seleter{
  
  -webkit-transform-origin: top;
  -webkit-transform: perspective(350px) rotateX(0deg);
}*/

.hov:hover li:nth-child(odd){
  -webkit-transform-origin: top;
  -webkit-transform: perspective(350px) rotateX(0deg);
  margin-top:0;
}

.hov:hover li:nth-child(even){
  -webkit-transform-origin: bottom;
  -webkit-transform: perspective(350px) rotateX(0deg);
   margin-top:0;
}

.seleter li:first-child{
  margin-top:0;
}
.card-container{
margin-top: 80px;

}

.hov{
  position:relative;
  height: 40px;
  width:112px;
  background:none;
  color: white;
  font-size: 13px;
  font-family: Helvetica;
  font-weight:bold;
  text-align: center;
  line-height: 40px;
  list-style:none;
  z-index:2;
  
}
      #filter{
        display: none;
        background-color: #444;
        padding: 15px;
        list-style-type: none;
      }
      #filter li:hover{
        border-bottom: 1px solid #55c57a;
      }
      #filter li button ,.seleter li button{
        background: none;
        border: none;
        font-size: 15px;
        color: #ddd;
        padding: 5px;
        text-transform: uppercase;
        cursor: pointer;
      }
      .filter-icon{
        margin-left: 10px;
        color: gainsboro;

      }

      .ficon{
  font-size: 25px;
  color: #ddd;

      }
   #filter-btn:hover ul{
        display: block;
        position: absolute;
       
      }
    </style>
  </body>
</html>
