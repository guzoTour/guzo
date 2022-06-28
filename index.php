<?php
  //Controll wheather the user is or not logged
  session_start();
  include "./config/config.php";

  if(isset($_SESSION["booked"])){
    unset($_SESSION["booked"]);
    echo '<script>alert("Booking is done  Thank You")</script>';
  }
  if(isset($_SESSION["bookeds"])){
    unset($_SESSION["bookeds"]);
    echo '<script>alert("u are already booked Thank You")</script>';  
  }
  if(isset($_SESSION["username"])){
  
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
        <li class="hov"> 
          <button class="nav__search-btn">
            <svg><use xlink:href="img/icons.svg#icon-search"></use></svg>
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
        <img src="./multimedia/img/logo-white.png" alt="Guzo tour logo" />
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
          echo $filepath.'</a>';
          echo '<a href="controller/authController/log_out.php" class="nav__el">Logout</a>';
        }else{
          echo '<a href="./view/shared/login.php" class="nav__el">Login</a>';
          echo '<a href="./view/shared/register.php" class="nav__el">Sign Up</a>';
        }
        ?>
    </nav>
 </header>
 <div class="home" id="home">
        <div class="content">
            <h3>Guzo Tour</h3>
            <p>discover new place with us</p>
            <a href="#" class="btn">discover more</a>
        </div>
        <div class="controls">
            <span class="vid-btn active" data-src="multimedia/video/hawassa.mp4"></span>
            <span class="vid-btn" data-src="multimedia/video/afar.mp4"></span>
            <span class="vid-btn" data-src="multimedia/video/afar2.mp4"></span>
            <span class="vid-btn" data-src="multimedia/video/gondar.mp4"></span>
            <span class="vid-btn" data-src="multimedia/video/lalibela.mp4"></span>
        </div>
        <div class="video-container">
            <video src="multimedia/video/hawassa.mp4" id="video-slider" loop autoplay muted></video>
        </div>
        <div class= 'bg'></div>
</div>

<div class = 'book'>
            <h1 class="heading">
                <span>b</span>
                <span>o</span>
                <span>o</span>
                <span>k</span>
                <span class="space"></span>
                <span>n</span>
                <span>o</span>
                <span>w</span>
            </h1>
</div>
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
      @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;700;900&family=Nunito:wght@200;300;400;500;600;700;800;900&display=swap');

:root{
    --orange: #55c57a;
    
}
*{
    font-family: 'Nunito', sans-serif;
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    text-transform: capitalize;
    outline: none;
    border: none;
    text-decoration: none;
    transition: all .2s linear;
}
::selection{
    background:var(--orange);
    color: white;
}
html{
    font-size: 62.5%;
    overflow-x: hidden;
    scroll-padding-top: 6rem;
    scroll-behavior: smooth;
}
section{
    padding: 2rem 9%;
}
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
        border: none;
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
    .home{
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-flow: column;
    position: relative;
    z-index: 0;
    }
    .home .content{
        text-align: center;
    }
    .home .content h3{
        font-size: 4.5rem;
        color: #fff;
        text-transform: uppercase;
        text-shadow: 0 .3rem .5rem rgba(0, 0, 0, .1);
    }

    .home .content p{
        font-size: 2.3rem;
        color: #fff;
        padding: 2rem;
    }
    .home .content a{
        padding: .8rem 2rem;
        font-size: 1.6rem;
        border: .1rem solid var(--orange);
    }
    .home .video-container video{
        position: absolute;
        top: 0;
        left: 0;
        width: 99vw;
        height: 90vh;
        object-fit: cover;
        z-index: -34;
    }
    .home .controls{
        padding: 1rem;
        border-radius: 5rem;
        background: rgba(0, 0, 0, .7);
        position: relative;
        top: 10rem;
    }
    .home .controls .vid-btn{
        height: 2rem;
        width: 2rem;
        display: inline-block;
        border-radius: 50%;
        background: #fff;
        cursor: pointer;
        margin: 0 .5rem;
    }
    .home .controls .vid-btn.active{
        background: var(--orange);
    }
.heading{
    text-align: center;
    padding: 2.5rem 0;
}
.heading{
    text-transform: uppercase;
    width: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
}
.heading span{
    font-size: 3.5rem;
    background: rgba(255, 165, 0, .2);
    color: var(--orange);
    border-radius: .5rem;
    padding: .2rem 1rem;
    margin: .3rem;
}
.heading .space{
    background: none;
}
.bg{
    position: absolute;
    top:0;
    left:0;
    width: 99vw;
    height: 90vh;
    background-color:rgba(0,0,0, 0.5);
    z-index: -3;
  }
    </style>
    <script>
        let searchBtn = document.querySelector('#search-btn');
        let searchBar = document.querySelector('.search-bar-container');
        let loginContainer = document.querySelector('.login-form-container');
        let loginBtn = document.querySelector('#login-btn');
        let closeIcon = document.querySelector("#closeIcon");
        let menuBar = document.querySelector("#menu-bar");
        let navBar = document.querySelector(".navbar");
        let videoControl = document.querySelectorAll('.vid-btn');
        let videoSlider = document.querySelector("#video-slider");
        
        
        window.onscroll = ()=>{
            searchBtn.classList.remove("fa-times")
            loginContainer.classList.remove('active')
            searchBar.classList.remove("active")
            menuBar.classList.remove('fa-times')
            navBar.classList.remove('active')
        }
        
        videoControl.forEach(btn=>{
            btn.addEventListener('click',(e)=>{
                console.log(e.target.dataset.src);
                document.querySelector(".controls .active").classList.remove('active')
                btn.classList.toggle("active")
                videoSlider.src = e.target.dataset.src
            })
        })
        </script>
  </body>
</html>