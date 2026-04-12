<?php
session_start();
include 'connect.php';

$username = $_POST['inputUsername'];
$password = $_POST['inputPassword'];

$sql = "SELECT * FROM users WHERE username='$username'";
$result = mysqli_query($conn,$sql);
$user = mysqli_fetch_assoc($result);
if($user && password_verify($password,$user['userpassword'])){
    $_SESSION['user_id']=$user['id'];
    $_SESSION['username']=$user['username'];
    $_SESSION['role']=$user['role'];
    if($user['role'] == 'admin'){
        header("Location: Main_Page_Admin.php");
    } else if($user['role'] == 'teacher'){
        header("Location: Main_Page_Teacher.php");
    } else {
        header("Location: Main_Page_Student.php");
    }
}
else{
    echo "กรุณาตรวจสอบชื่อบัญชีผู้ใช้กับรหัสผ่าน" . mysqli_error($conn);
}
?>  