<?php
session_start();
include 'connect.php';

if(!isset($_SESSION['user_id'])){
    header("Location: Login_Page.html");
    exit;
}

if($_SESSION['role'] != 'admin'){
    header("Location: Login_Page.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="th">
    <head>
        <meta charset="UTF-8">
        <Title>Dasboard Thesis Admin</Title>
        <link rel="stylesheet" href="admin.css">
    </head>
    <body>
        <div class="navbar">
            <h1>thesis</h1>
            <div class="navbar-right">
                <button class="bell">🔔Notifily</button>
            </div>
            <div class="admin-manu">
                <img src="profile.jpg" alt="admin">
                <span>Admin</span>
                <!-- dropdown-->
                <div class="dropdown">
                    <a href="profile.php">ข้อมูลของฉัน</a>
                    <a href="logout.php">Log out</a>
                </div>
            </div>
        
        </div>
            
        <div class="container">
            <!-- Sidebar -->
            <div class="sidebar">
                <a onclick="showSection('score')">ให้คะแนน Thesis</a>
                <a onclick="showSection('log')">log การดาวน์โหลด</a>
                <a onclick="showSection('user')">จัดการข้อมูล User</a>
            </div>

            <!-- Content -->
            <div class="content">
                <div class="search-bar">
                    <input type="text" placeholder="ค้นหา Thesis">
                    <button>Search</button>
                </div>
                <!-- ให้คะแนน Thesis -->
                 <div id="section-score">
                <h2>ให้คะแนน Thesis</h2>
                <table>
                    <thead>
                        <tr>
                            <th>ชื่อ Thesis</th>
                            <th>นักศึกษา</th>
                            <th>คะแนน</th>
                            <th>สถานะ</th>
                            <th>จัดการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'connect.php';
                        
                        $sql = "SELECT * FROM thesis";
                        $result = mysqli_query($conn,$sql);

                        while($row = mysqli_fetch_assoc($result)){
                            echo "<tr>";
                            echo "<td>" . $row['title'] . "</td>";
                            echo "<td>" . $row['student_id'] . "</td>";
                            echo "<td><input type='number' min='0' max='100' placeholder='0 - 100'></td>";
    
                            // เพิ่มคอลัมน์สถานะ
                            if($row['status'] == 'public'){
                                echo "<td><button onclick=\"toggleStatus(" . $row['id'] . ", 'private')\">Public</button></td>";
                            }
                            else {
                                echo "<td><button onclick=\"toggleStatus(" . $row['id'] . ", 'public')\">Private</button></td>";
                            }
                            echo "<td><button>บันทึกคะแนน</button></td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                </div>
            <!-- section log -->
            <div id="section-log" style="display:none;">
                <h2>log การดาวน์โหลด</h2>
            </div>

            <!-- section user -->
            <div id="section-user" style="display:none;">
                <h2>จัดการข้อมูล User</h2>
            </div>
        </div>
        <script>
        function showSection(name) {
            document.getElementById('section-score').style.display = 'none';
            document.getElementById('section-log').style.display = 'none';
            document.getElementById('section-user').style.display = 'none';
            document.getElementById('section-' + name).style.display = 'block';
        }
        function toggleStatus(id, status) {
            fetch('UpdateStatus.php', {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify({id: id, status: status})
        })
        .then(response => response.json())
        .then(data => {
        if(data.success){
            location.reload();
        }
    });
}
        </script>
    </body>
</HTML>