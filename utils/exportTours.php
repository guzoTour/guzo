<?php
    session_start();
    if(isset($_SESSION["username"])){
        if($_SESSION["role"]!="admin"){
            header("location:../index.php");
        }
    }
    else{
        header("location:../index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Export File</title>
    <style>
        body{
            font-size: 20px;
        }
        table#show{
            width: 90%;
            margin-top:50px;
            margin-bottom:50px;

        }
        table#show, th, td {
          border: 1px solid black;
          border-collapse: collapse;
        }
        th{
            color: blue;
        }
        td{
            color: rgb(8, 15, 1);
        }
        input{
            border:none;
            border-style: none;
        }
        .double{
            margin-left:10px;
        }
        #submit{
            font-size:25px;
            color: blue;
            margin-top:10px;
        }
        a:link, a:visited {
            background-color: blue;
            color: white;
           
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size:25px;
        }

        a:hover, a:active {
        background-color: green;
        }
        #search-form{
            /* color:red;
            display:none; */
            margin-left:100px;
            margin-top:20px;
        }
    </style>
</head>
<body>

<!-- <button type="onclick" value = "Submit" name="submit" id="goto-search">Search</button> -->
<form action="" method="post" id="search-form">
        <table>
            <tr>
                <th>Query</th>
                <th>Value</th>
            </tr>
            <tr>
                <td>Name:</td>
                <td><input type="text" name="tour-name"></td>
            </tr>
            <tr>
                <td>Town:</td>
                <td><input type="text" name="town"></td>
            </tr>
            <tr>
                <td>Region:</td>
                <td><input type="text" name="region"></td>
            </tr>
            <tr>
                <td>Direction:</td>
                <td><input type="text" name="direction"></td>
            </tr>
           
            </tr>
            <tr>
                <td>Price:</td>
                <td>Min<input type="number" name="min-price">Max<input type="number" name="max-price"></td>
                <!-- <td>Max<input type="number" name="max-price"></td> -->
            </tr>
    
            <tr>
                <td>Start Date:</td>
                <td>From<input type="date" class  = "double"name="start-begin">To<input type="date" class  = "double" name="start-end"></td>
                <!-- <td>To<input type="date" class  = "double" name="start-end"></td> -->
            </tr>
            
        </table>
        
        <button type="onclick" value = "Submit" name="submit" id="submit">Search</button>
    </form>
    </div>
    <table id="show">
        <tr>
            <th>Tour Id</th>
            <th>Tour Name</th>
            <th>Difficulty</th>
            <th>Duration</th>
            <th>Group Size</th>
            <th>Price</th>
            <th>Discount Price</th>
            <th>Start Date</th>
            <th>Region</th>
            <th>Town</th>
            <th>Dirrection</th>
        </tr>
        <?php

            include('../config/config.php');
            if(isset($_POST["submit"])){
                $sql = "SELECT * FROM tour INNER JOIN address ON tour.tour_id = address.tour_id ";
              
                if($_POST["tour-name"]!=""){
                    $name = $_POST["tour-name"];
                    $sql.= <<<TEXT
                        where tour_name like '%$name%'
                    TEXT; 
                }
                if($_POST["town"]!=""){
                    $town = $_POST["town"];
                    if($_POST["tour-name"]!=""){
                        $sql.= <<<TEXT
                          and address.town like '%$town%'
                        TEXT;
                    }else{
                        $sql.= <<<TEXT
                        where address.town like '$town%'
                    TEXT;
                    }   
                }
                if($_POST["direction"]!=""){
                    $direction = $_POST["direction"];
                    if($_POST["tour-name"]!=""||$_POST["town"]!=""){
                        $sql.= <<<TEXT
                          and address.direction like '%$direction%'
                        TEXT;
                    }else{
                        $sql.= <<<TEXT
                         where address.direction like '%$direction%'
                    TEXT;
                    }   
                }
                if($_POST["region"]!=""){
                    $region = $_POST["region"];
                    if($_POST["tour-name"]!=""||$_POST["town"]!=""||$_POST["direction"]!=""){
                        $sql.= <<<TEXT
                          and address.region like '%$region%'
                        TEXT;
                    }else{
                        $sql.= <<<TEXT
                         where address.region like '%$region%'
                    TEXT;
                    }   
                }
                if($_POST["min-price"]!=""&&$_POST["max-price"]!=""){
                    $min = $_POST["min-price"];
                    $max = $_POST["max-price"];
                    if($_POST["tour-name"]!=""||$_POST["town"]!=""||$_POST["direction"]!=""||$_POST["region"]!=""){
                        $sql.= <<<TEXT
                          and tour.price between  $min and $max
                        TEXT;
                    }else{
                        $sql.= <<<TEXT
                        where tour.price between  $min and $max
                    TEXT;
                    }   
                }
                else if($_POST["min-price"]!=""){
                    $min = $_POST["min-price"];
                    if($_POST["tour-name"]!=""||$_POST["town"]!=""||$_POST["direction"]!=""||$_POST["region"]!=""){
                        $sql.= <<<TEXT
                          and tour.price  >= $min
                        TEXT;
                    }else{
                        $sql.= <<<TEXT
                        where tour.price >= $min
                    TEXT;
                    }   
                }
                else if($_POST["max-price"]!=""){
                    $max = $_POST["max-price"];
                    if($_POST["tour-name"]!=""||$_POST["town"]!=""||$_POST["direction"]!=""||$_POST["region"]!=""){
                        $sql.= <<<TEXT
                          and tour.price  <= $max
                        TEXT;
                    }else{
                        $sql.= <<<TEXT
                       where tour.price <= $max
                    TEXT;
                    }   
                }

                if($_POST["start-begin"]!=""&&$_POST["start-end"]!=""){
                    $min = $_POST["start-begin"];
                    $max = $_POST["start-end"];
                    if($_POST["tour-name"]!=""||$_POST["town"]!=""||$_POST["direction"]!=""||$_POST["region"]!=""){
                        $sql.= <<<TEXT
                          and tour.start_date between  '$min' and '$max'
                        TEXT;
                    }else{
                        $sql.= <<<TEXT
                      where  tour.start_date between  '$min' and '$max'
                    TEXT;
                    echo  $min." ".$max;
                    }   
                }
                else if($_POST["start-begin"]!=""){
                    $min = $_POST["start-begin"];
                    $max = $_POST["start-end"];
                    if($_POST["tour-name"]!=""||$_POST["town"]!=""||$_POST["direction"]!=""||$_POST["region"]!=""){
                        $sql.= <<<TEXT
                          and tour.start_date >='$min'
                        TEXT;
                    }else{
                        $sql.= <<<TEXT
                      where  tour.start_date >='$min'
                    TEXT;
                    
                    }   
                }
                else if($_POST["start-end"]!=""){
                    $min = $_POST["start-begin"];
                    $max = $_POST["start-end"];
                    if($_POST["tour-name"]!=""||$_POST["town"]!=""||$_POST["direction"]!=""||$_POST["region"]!=""){
                        $sql.= <<<TEXT
                          and tour.start_date <='$max'
                        TEXT;
                    }else{
                        $sql.= <<<TEXT
                        where tour.start_date <='$max'
                    TEXT;
                    
                    }   
                }

                

                // else{
                //     //echo $_POST["tour-name"];
                //     $sql = "SELECT * FROM tour INNER JOIN address ON tour.tour_id = address.tour_id";
                // }
                $from = "2022-04-25";
                $to = "2022-04-29";

               // $sql = "SELECT * FROM tour INNER JOIN address ON tour.tour_id = address.tour_id where created_at between '$from' and '$to'";
            }
            else{
               
                  $sql = "SELECT * FROM tour INNER JOIN address ON tour.tour_id = address.tour_id ";
            }

            $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $file1 = fopen('./tours.csv','w');
        while($row = mysqli_fetch_assoc($result)) {
            $tour_id = $row["tour_id"];
            $tour_name = $row["tour_name"];
            $duration = $row["duration"];
            $difficulty = $row["difficulty"];
            $group_size = $row["group_size"];
            $summary = $row["summary"];
            $price = $row["price"];
            $discount_price = $row["discount"];
            $region = $row["region"];
            $town = $row["town"];
            $direction = $row["direction"];
            $start_date=$row["start_date"];
            $tours = array();
            $address = array();
            array_push($tours, $tour_id, $tour_name, $duration, $difficulty, $group_size, $price, $discount_price, $start_date, $town, $region, $direction);
                 if (!$file1) {
                     echo "<p>Unable to open remote file.\n";
                     exit;
                 }else{
                     fputcsv($file1, $tours);
                 }
            $s2=<<<EOT
            
            <tr>
                <td>$tour_id</td>
                <td>$tour_name</td>
                <td>$difficulty</td>
                <td>$duration</td>
                <td>$group_size</td>
                <td>$price</td>
                <td>$discount_price</td>
                <td>$start_date</td>
                <td>$region</td>
                <td>$town</td>
                <td>$direction </td>
            </tr>
            EOT;
            echo "$s2";

        }
        fclose($file1);
        }
        ?>       
    </table>
    <button><a id  = "download" href="downloadFile.php?file=' . urlencode('tours.csv') . '">Download</a></button></p>
    <script>
        // ocument.getElementById("download").addEventListener('click',()=>{
        //     alert("hi");
        //     <?php
        //          $file1 = fopen('./tours.csv','a');
            
        //          if (!$file1) {
        //              echo "<p>Unable to open remote file.\n";
        //              exit;
        //          }else{
        //              fputcsv($file1, $tours);
        //              fclose($file1);
        //          }
        //     ?>
        //     console.log("The file saved");
        // })
        
    document.getElementById("goto-search").addEventListener('click', (e)=>{
        console.log("Hello world");
    //     document.getElementById("goto-search").style.display = 'none';
    //     console.log("Hello world");
    // document.getElementById("search-form").style.display= 'block';
})
    </script>
</body>
   
</html>