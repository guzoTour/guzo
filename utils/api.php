<?php
header("Content-Type:application/json");
if (isset($_GET['req'])) {
    $data = $_GET['req'];
	response($data,200,"Successful");
}else{
	response(false,400,"Invalid Request");
	}

function response($req, $status, $message){
    include('../config/config.php');
    $cntArr = array();
	
 for($i = 1; $i <= 12; $i++){
   try{
     $sql = "SELECT * from booking where month(Created_at) = $i";
     $val = mysqli_query($conn, $sql);
   }catch(Exception $err){
     echo $err;
   }
   $cnt = 0;
   while($row = mysqli_fetch_assoc($val)){
     $cnt += 1;
   }
   array_push($cntArr, $cnt);
 }
 $dataPoints = array(
     array("label"=> "Jan", "y"=> $cntArr[0]),
     array("label"=> "Feb", "y"=> $cntArr[1]),
     array("label"=> "Mar", "y"=> $cntArr[2]),
     array("label"=> "Apr", "y"=> $cntArr[3]),
     array("label"=> "May", "y"=> $cntArr[4]),
     array("label"=> "June", "y"=> $cntArr[5]),
     array("label"=> "July", "y"=> $cntArr[6]),
     array("label"=> "Aug", "y"=> $cntArr[7]),
     array("label"=> "Sept", "y"=> $cntArr[8]),
     array("label"=> "Oct", "y"=> $cntArr[9]),
     array("label"=> "Nov", "y"=> $cntArr[10]),
     array("label"=> "Dec", "y"=> $cntArr[11])
 
 );
  $sqln = "SELECT * FROM booking INNER JOIN address ON booking.tour_id = address.tour_id WHERE direction = 'North'";
  $sqls = "SELECT * FROM booking INNER JOIN address ON booking.tour_id = address.tour_id WHERE direction = 'South'";
  $sqle = "SELECT * FROM booking INNER JOIN address ON booking.tour_id = address.tour_id WHERE direction = 'East'";
  $sqlc = "SELECT * FROM booking INNER JOIN address ON booking.tour_id = address.tour_id WHERE direction = 'Center'";
  $sqlw = "SELECT * FROM booking INNER JOIN address ON booking.tour_id = address.tour_id WHERE direction = 'West'";
  $resultn = mysqli_query($conn, $sqln);
  $results = mysqli_query($conn, $sqls);
  $resulte = mysqli_query($conn, $sqle);
  $resultw = mysqli_query($conn, $sqlw);
  $resultc = mysqli_query($conn, $sqlc);

  $cntn = 0;
  $cnts = 0;
  $cnte = 0;
  $cntw = 0;
  $cntc = 0;

  while($row = mysqli_fetch_assoc($resultn)){
    $cntn += 1;
  }
  while($row = mysqli_fetch_assoc($results)){
    $cnts += 1;
  }
  while($row = mysqli_fetch_assoc($resulte)){
    $cnte += 1;
  }
  while($row = mysqli_fetch_assoc($resultw)){
    $cntw += 1;
  }
  while($row = mysqli_fetch_assoc($resultc)){
    $cntc += 1;
  }

  $dataPoints1 = array(
    array("label"=> "North", "y"=> $cntn),
    array("label"=> "South", "y"=> $cnts),
    array("label"=> "East", "y"=> $cnte),
    array("label"=> "West", "y"=> $cntw),
    array("label"=> "Center", "y"=> $cntc)
  );
	$response['monthData'] = $dataPoints;
  $response['locationData'] = $dataPoints1;
	$response['response_code'] = $status;
	$response['response_desc'] = $message;
	
	$json_response = json_encode($response);
	echo $json_response;
}
?>