<?php
$host="localhost";
$username="root";
$password ="";
$database="projectthesis";
$conn = mysqli_connect($host,$username,$password,$database );
//เช็คการเชื่อมต่อ
if (!$conn) {
    die("เชื่อมต่อไม่ได้: " . mysqli_connect_error());
}
?>