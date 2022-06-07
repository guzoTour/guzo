<?php

    session_start();
    include "../../config/config.php";
    $booking = " ";
    $profile = " ";
    $logout = " ";
    $login = "Login";
    $signup = "Sign up";
     $user_role="";
     $user_id="";
     if(isset($_SESSION["role"])){
       $role=$_SESSION["role"];
     }
     else{
     $role="none";

     }
    if(isset($_SESSION["username"])){
      $booking = "Booking";
      $profile = "Profile";
      $logout = "Log Out";
      $login = "";
      $signup = "";
    
        $user_name = $_SESSION["username"];
        $user_role = $_SESSION["role"];
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

   $url = $_SERVER["REQUEST_URI"];
   $bools="f";
   $components = parse_url($url);
   parse_str($components['query'], $results);
   $tour_name = $results['tour_name'];
   $bools = $results['bool'];
   
   //echo gettype($tour_id);
   $sql = "SELECT * FROM tour INNER JOIN address ON tour.tour_id = address.tour_id WHERE tour_name = '$tour_name'";
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
      //  $discount = $row["discount"];
       $region = $row["region"];
       $town = $row["town"];
       $direction = $row["direction"];
       $start_date = $row["start_date"];
       $raters=$row["rating_quantity"];
       $rating=$row["rating"];

       $_SESSION["display"] = true;

    $count="SELECT COUNT(*) FROM booking WHERE tour_id=$tour_id;";
    $cResult = mysqli_query($conn, $count);
    $data=mysqli_fetch_assoc($cResult);
    $count= $data['COUNT(*)'];

   }
   else{
        echo "Ther is no Tour with this name";
   }

 
     header("#comments");
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <link rel="stylesheet" href="../../css/rate_style.css">
    <link
      href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700"
      rel="stylesheet"
    />

    <link rel="stylesheet" href="../../css/style.css" />
    <link rel="shortcut icon" type="image/png" href="../../../multimedia/img/favicon.png" />

    <title>Guzo Tours | <?php echo $tour_name?></title>

    <script src="https://api.mapbox.com/mapbox-gl-js/v0.50.0/mapbox-gl.js"></script>
    <link
      href="https://api.mapbox.com/mapbox-gl-js/v0.50.0/mapbox-gl.css"
      rel="stylesheet"
    />
  </head>
  <body>
    <header class="header">
      <nav class="nav nav--tours">
        <a href="../../index.php" class="nav__el">All tours</a>
        <form class="nav__search">
         <!-- <button class="nav__search-btn">
            <svg>
              <use xlink:href="../../multimedia/img/icons.svg#icon-search"></use>
            </svg>
          </button>
          <input
            type="text"
            placeholder="Search tours"
            class="nav__search-input"
          />-->
        </form>
      </nav>
      <div class="header__logo">
        <img src="../../multimedia/img/logo-white.png" alt="Natours logo" />
      </div>
      <nav class="nav nav--user">
        <!-- <a href="#" class="nav__el"><?php echo $booking?></a> -->
        
        <?php 


      if($role=="admin"){
        echo '<a href="../admin/adminProfile.php" class="nav__el">';

      }
      else{
        echo '<a href="../shared/profile.php" class="nav__el">';

      }
        if(isset($_SESSION["username"])){
          
          $filepath = "<img src = "."../../multimedia/img/users/".$photo." class='nav__user-img'.".">";
          echo $filepath;
        }
        ?>
        </a>
        <a href="../../controller/authController/log_out.php" class="nav__el"><?php echo $logout?></a>
        <a href="../shared/login.php" class="nav__el"><?php echo $login?></a>
        <a href="../shared/register.php" class="nav__el"><?php echo $signup?></a>        
      </nav>
    </header>
    <section class="section-header">
      
      <div class="heading-box">
        <h1 class="heading-primary">
        
          <span
            ><?php echo $tour_name?> <br />
            </span
          >
        </h1>
        
        <div class="heading-box__group">
          <div class="heading-box__detail">
            <i class="fa-solid fa-clock"></i>
            <svg class="heading-box__icon">
            </svg>
            <span class="heading-box__text"> <?php echo $duration;?>  days</span>
          </div>
          <div class="heading-box__detail">
            <i class="fa-solid fa-map-location-dot"></i>

            <svg class="heading-box__icon">
            </svg>
            <span class="heading-box__text"><?php echo $region." ".$town?> </span>
          </div>
        </div>
      </div>
    </section>

    <section class="section-description">
      <div class="overview-box">
        <div>
          <div class="overview-box__group">
            <h2 class="heading-secondary ma-bt-lg">Quick facts</h2>
            <div class="overview-box__detail">
              <svg class="overview-box__icon">
                <use xlink:href="../../multimedia/img/icons.svg#icon-calendar"></use>
              </svg>
              <span class="overview-box__label">Start At </span>
              <span class="overview-box__text"><?php echo $start_date?> </span>
            </div>
            <div class="overview-box__detail">
              <svg class="overview-box__icon">
                <use xlink:href="../../multimedia/img/icons.svg#icon-trending-up"></use>
              </svg>
              <span class="overview-box__label">Difficulty</span>
              <span class="overview-box__text"><?php echo $difficulty?> </span>
            </div>
            <div class="overview-box__detail">
              <svg class="overview-box__icon">
                <use xlink:href="../../multimedia/img/icons.svg#icon-user"></use>
              </svg>
              <span class="overview-box__label">Participants</span>
              <span class="overview-box__text"> <?php echo  $group_size?>  people</span>
            </div>
            <div class="overview-box__detail">
              <svg class="overview-box__icon">
                <use xlink:href="img/icons.svg#icon-star"></use>
              </svg>
              <span class="overview-box__label">Rating</span>
              <span class="overview-box__text"><?php  echo $rating."/".$raters; ?></span>
            </div>
          </div>

        </div>
      </div>

      <div class="description-box">
        <h2 class="heading-secondary ma-bt-lg">About the <?php echo $tour_name ?> tour</h2>
        <p class="description__text">
          <?php
           echo    $summary;
          
          ?>
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
          eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad
          minim veniam, quis nostrud exercitation ullamco laboris nisi ut
          aliquip ex ea commodo consequat. Duis aute irure dolor in
          reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
          pariatur.
        </p>
 
      </div>
    </section>

    <section class="section-pictures">
      <div class="picture-box">
        <img
          class="picture-box__img picture-box__img--1"
          src="../../multimedia/img/tour-5-1.jpg"
          alt="The Park Camper Tour 1"
        />
      </div>
      <div class="picture-box">
        <img
          class="picture-box__img picture-box__img--2"
          src="../../multimedia/img/tour-5-2.jpg"
          alt="The Park Camper Tour 1"
        />
      </div>
      <div class="picture-box">
        <img
          class="picture-box__img picture-box__img--3"
          src="../../multimedia/img/tour-5-3.jpg"
          alt="The Park Camper Tour 1"
        />
      </div>
    </section>

    <section class="section-map">
      <div id="map"></div>
      <script>
        mapboxgl.accessToken ='pk.eyJ1Ijoiam9uYXNzY2htZWR0bWFubiIsImEiOiJjam54ZmM5N3gwNjAzM3dtZDNxYTVlMnd2In0.ytpI7V7w7cyT1Kq5rT9Z1A';

        const geojson = {
          type: 'FeatureCollection',
          features: [
            {
              type: 'Feature',
              geometry: {
                type: 'Point',
                coordinates: [37.86177611132169,6.9549559875248885]
              },
              properties: {
                description: 'soddo'
              }
            },
             {
              type: 'Feature',
              geometry: {
                type: 'Point',
                coordinates: [ 38.74896017704448,8.994029814442744]
              },
              properties: {
                description: 'Addis Ababa'
              }
            },
          ]
        };

        const map = new mapboxgl.Map({
          container: 'map',
          style: 'mapbox://styles/jonasschmedtmann/cjnxfn3zk7bj52rpegdltx58h',
          scrollZoom: false
        });

        const bounds = new mapboxgl.LngLatBounds();

        geojson.features.forEach(function(marker) {
          var el = document.createElement('div');
          el.className = 'marker';

          new mapboxgl.Marker({
            element: el,
            anchor: 'bottom'
          })
            .setLngLat(marker.geometry.coordinates)
            .addTo(map);

          new mapboxgl.Popup({
            offset: 30,
            closeOnClick: false
          })
            .setLngLat(marker.geometry.coordinates)
            .setHTML('<p>' + marker.properties.description + '</p>')
            .addTo(map);

          bounds.extend(marker.geometry.coordinates);
        });

        map.fitBounds(bounds, {
          padding: {
            top: 200,
            bottom: 150,
            left: 50,
            right: 50
          }
        });

        map.on('load', function() {
          map.addLayer({
            id: 'route',
            type: 'line',
            source: {
              type: 'geojson',
              data: {
                type: 'Feature',
                properties: {},
                geometry: {
                  type: 'LineString',
                  coordinates: [
                    [37.86177611132169,6.9549559875248885],
                    [38.74896017704448,8.994029814442744],
                
                  ]
                }
              }
            },
            layout: {
              'line-join': 'round',
              'line-cap': 'round'
            },
            paint: {
              'line-color': '#55c57a',
              'line-opacity': 0.6,
              'line-width': 3
            }
          });
        });
      </script>
    </section>

    <section class="hidden section-reviews">
       <div class="reviews">

    <?php 
    $sq1="SELECT * FROM review WHERE tour_id=$tour_id ORDER BY id DESC LIMIT 4;";
    try{
    $result =mysqli_query($conn, $sq1);
  
    if(mysqli_num_rows($result)>=2){
      
    while($row=mysqli_fetch_assoc($result)){

      $comment=$row['review'];
      $ratings=$row['rating'];
      $user_ids=$row["user_id"];
     $sql = "SELECT * FROM user WHERE user_id = '$user_ids';"; 
     $results =mysqli_query($conn, $sql);
     $rows=mysqli_fetch_assoc($results);
     $f_name=$rows["first_name"];
     $l_name=$rows["last_name"];
     $user_image=$rows["photo"];
     
     $str=<<<DDD
       
        <div class="reviews__card">
          <div class="reviews__avatar">
            <img
              src="../../multimedia/img/users/$user_image"
              alt="Jim Brown"
              class="reviews__avatar-img"
            />
            <h6 class="reviews__user">$f_name $l_name</h6>
          </div>
          <p class="reviews__text">$comment
           
          </p>
           <div class="reviews__rating">
           
          
        
         
    
DDD;

echo $str;

   for( $x=0; $x<$ratings; $x++){
     echo '<svg class="reviews__star reviews__star--active"><use xlink:href="../../../multimedia/img/icons.svg#icon-star"></use></svg>';

   }
echo '</div> </div>';


    }




    }
      


    }catch(Exception $e){

    }

    
    
    ?>
    </div> 
    </section>

    <section class="section-cta">
      <div class="cta">
        <div class="cta__img cta__img--logo">
          <img src="../../multimedia/img/logo-white.png" alt="Natours logo" class="" />
        </div>
        <img src="../../multimedia/img/tours/tour-1-1.jpg" alt="" class="cta__img cta__img--1" />
        <img src="../../multimedia/img/tours/tour-1-2.jpg" alt="" class="cta__img cta__img--2" />


        <div class="cta__content" id="comments">


         
          <div>
            <?php
            if($bools=="true"){
             
            echo '<script>alert("Thanks for your comment")</script>';
              

            }

 

            if($role=="admin"){
              echo "<h2 class='heading-secondary'>This all about tour</h2>";
            }

            else{
              echo "<h2 class='heading-secondary'>What are you waiting for?</h2>";
            
            }


           
            ////////////////////booking controller//////////////////////
            ///////////////////////////////////////////////////////
            ///////////////////////////////////////////////////////
            /////////////////////booking controller/////////////////
            

          
?>
              
            
            <form action="" method="post"></form>

          <?php  
          if($user_role!="admin"){
          
          if($count!=$group_size){
            $left =  $group_size-$count;
          
               echo '<p class="cta__text">'.$duration .'days. 1 adventure. Infinite memories. Make it yours today!</p>';
               echo '<p class="cta__text">---'.$left.' place left</p>';
               echo ' <form action="../../controller/bookingController/bookingController.php?tour_id='.$tour_id.'" method="post"><button name="sub" class="btn btn--green span-all-rows">Book tour now!</button></form>';      
          }   
          
            else{
                echo '<p class="cta__text" >sorry the is no space to book</p>';
            }
     
          }  
            

                       ?>
          </div>
          
        </div>
      </div>

    <?php 

if($role!="admin"){
 $str=<<<EOT
    <div class="cta review">
    
        <div class="cta__content">
          <h2 class="heading-secondary">Comment Now</h2>
          <form action=../controller/reviewController/review.php?tour_id=$tour_id&tour_name=$tour_name method='post'>
             
       <textarea name="comments" id="comment" cols="30" rows="10"></textarea>
        <h2 class="heading-secondary">Rate Now</h2>
  <span class="star-rating">
  <input type="radio" name="rating1" value="1"><i></i>
  <input type="radio" name="rating1" value="2"><i></i>
  <input type="radio" name="rating1" value="3"><i></i>
  <input type="radio" name="rating1" value="4"><i></i>
  <input type="radio" name="rating1" value="5"><i></i>
</span>
      <button name="comment" class="btn btn--green span-all-rows">submit comment</button>
           </form>
          
          
        </div>
      </div>



EOT;

echo $str;

}

    

    
    ?>


     
    </section>

    <div class="footer">
      <div class="footer__logo">
        <div class="footerLogo">
        <img src="../../multimedia/img/logo-green-round.png" class="flogoimg" style="width: 70px; height: 70px;" alt="Natours logo" />
        <span style="font-size: 30px ;"> GUZ TOUR</span>
      </div></div>
      <ul class="footer__nav">
        <li><a href="#">About us</a></li>
        <li><a href="#">Download apps</a></li>
        <li><a href="#">Become a guide</a></li>
        <li><a href="#">Careers</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
      <p class="footer__copyright">
        &copy;By AASTU Students. All rights reserved.
      </p>
    </div>
  </body>

  <style>
 /* Hide scrollbar for Chrome, Safari and Opera */
.section-reviews::-webkit-scrollbar {
  display: none;
}
.review{
  width: 500px;
  
}

/* Hide scrollbar for IE, Edge and Firefox */
.section-reviews {
  -ms-overflow-style: none;  /* IE and Edge */
  scrollbar-width: none;  /* Firefox */
}
 .cta__text{
  padding:0 ,10px;

 }
    .section-map{

-ms-overflow-style: none;
scrollbar-width: none;      
    }
.footerLogo{
display: flex;
justify-content: center;
align-items: center;

}
.flogoimg{
  margin-right: 10px;
}

.section-cta{
display: flex;

}

  </style>
</html>
