<?php
include 'connect.php';
//รับค่า
$Username = $_POST['username'];
$Password = $_POST['password'];
$Student_ID = $_POST['studentID'];
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];

$Confirm = $_POST['InputConfirm'];
if($Password != $Confirm){
    echo "รหัสผ่านไม่ตรงกัน!";
    exit;
}

//แปลงรหัสผ่าน
$hashed_password = password_hash($Password, PASSWORD_DEFAULT);

$sql_user = "INSERT INTO users(username,userpassword,email,role) VALUES('$Username', '$hashed_password', '$email', 'student')";

if(mysqli_query($conn, $sql_user)){
    $user_id = mysqli_insert_id($conn);
    
    $sql_student = "INSERT INTO students(user_id,student_id,first_name,last_name) 
                    VALUES('$user_id','$Student_ID','$firstname','$lastname')";
    mysqli_query($conn, $sql_student);
    
    header("Location: Login_Page.html");
} else {
    echo "เกิดข้อผิดพลาด: " . mysqli_error($conn);
}
?>