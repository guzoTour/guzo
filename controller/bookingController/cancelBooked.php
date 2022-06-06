<?php
header("Content-Type:application/json");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $data=json_decode(file_get_contents("php://input"), true);
    handleCancel($data);
}else{
    $res['success'] = true;
    echo json_encode($res);
}
function handleCancel($data){
    $tour_id = $data['tour_id'];
    $user_id = $data['user_id'];
    include('../../config/config.php');
    $sql = "DELETE FROM booking WHERE booking.user_id='$user_id' and booking.tour_id='$tour_id'";
    if (mysqli_query($conn, $sql)) {
        $res['success'] = true;
    } else {
        $res['success'] = true;
    }
    echo json_encode($res);
}

?>