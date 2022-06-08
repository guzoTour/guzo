<?php
include('./config/config.php');

if(isset($_GET["searchbtn"])){
    $search_query = $_GET['search_query'];
    $column=$_GET['searchBy'];
 $sql = "SELECT * FROM tour INNER JOIN address ON tour.tour_id = address.tour_id WHERE $column LIKE '%$search_query%'";
$num=$search_query;

  if($search_query==""){
  $sql = "SELECT * FROM tour INNER JOIN address ON tour.tour_id = address.tour_id;";
  }

 
 if (($column==">="||$column=="<=")&&$search_query!=""){

   $sql = "SELECT * FROM tour INNER JOIN address ON tour.tour_id = address.tour_id WHERE tour.price $column $num;";
  }

}

else{

    $sql = "SELECT * FROM tour INNER JOIN address ON tour.tour_id = address.tour_id;";

}



 $result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {


    $tour_id = $row["tour_id"];
    $tour_name = $row["tour_name"];
    $duration = $row["duration"];
    $difficulty = $row["difficulty"];
    $group_size = $row["group_size"];
    $summary = $row["summary"];
    $price = $row["price"];
    $region = $row["region"];
    $town = $row["town"];
    $direction = $row["direction"];
    $name = $row["tour_name"];
    $start=$row["start_date"];
    $raters=$row["rating_quantity"];
    $rating=$row["rating"];
    $image = $row["images"];
    $cover_image = $row["cover_image"];
    // $region = $row["region"]
    $s2=<<<DDD
    <div class="card">
    <div class="card__header">
    <div class="card__picture">
    <div class="card__picture-overlay">&nbsp;</div>
    <img src="./multimedia/img/tours/$cover_image" alt="$tour_id" class="card__picture-img"
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
            <i class="fa-solid fa-location-dot"> </i><span> $region , $town</span>
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
            <span class="card__footer-value">$rating</span>
            <span class="card__footer-text">rating ($raters)</span>
          </p>
        <a href="./view/public/tour.php?tour_name=$tour_name&bool=false" class="btn btn--green btn--small">Details</a>
        </div>
      </div>

  DDD;
 echo "$s2";
 
  }
} else {
  echo "0 results";
}






?>