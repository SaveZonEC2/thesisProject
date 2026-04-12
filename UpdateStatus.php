<?php
    include 'connect.php';
    $data=json_decode(file_get_contents('php://input'),TRUE);
    $id=$data['id'];
    $status=$data['status'];

    $sql = "UPDATE thesis SET status='$status' WHERE id = '$id'";

    if(mysqli_query($conn,$sql)){
        echo json_encode(['success'=>TRUE]);
    }
    else{
        echo json_encode(['success'=>FALSE]);
    }
?>