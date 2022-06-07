<?php
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
         $discount = $row["discount"];
         $region = $row["region"];
         $town = $row["town"];
         $direction = $row["direction"];
         $start_date = $row["start_date"];

         $raters=$row["rating_quantity"];
         $rating=$row["rating"];

?>
