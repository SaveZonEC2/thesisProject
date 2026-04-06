<?php
session_start();
include 'connect.php';
$username = $_POST['inputUsername'];
$password = $_POST['inputPassword'];

$sql = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($conn,$sql);
$user = mysqli_fetch_assoc($result);
if($user && password_verify($password,$user['userpassword'])){
    header("Location: Main_Page.html");
}
else{
    echo "กรุณาตรวจสอบชื่อบัญชีผู้ใช้กับรหัสผ่าน" . mysqli_error($conn);
}
?>  