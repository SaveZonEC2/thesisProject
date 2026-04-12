<?php
session_start();
include 'connect.php';

if(!isset($_SESSION['user_id'])){
    header("Location: Login_Page.html");
    exit;
}

if($_SESSION['role'] != 'student'){
    header("Location: Login_Page.html");
    exit;
}
?>
<!DOCTYPE html>
    <head>
        <meta charset="UTF-8">
        <Title>Dasboard Thesis Admin</Title>
        <link rel="stylesheet" href="admin.css">
    </head>
    <body>
        <!--navber-->
        <div class='navbar'>
            <h1>thesis</h1>
            <div class="navbar-right">
                <button class="bell">🔔Notifily</button>
            </div>
            <div class="admin-manu">
                <img src="profile.jpg" alt="Student">
                <span>Student</span>
                <!-- dropdown-->
                <div class="dropdown">
                    <a href="profile.php">ข้อมูลของฉัน</a>
                    <a href="logout.php">Log out</a>
                </div>
            </div>
        </div>

        <div class='container'>
            <!--sidebar-->
            <div class='sidebar'>
                <a onclick="showSection('main')">หน้าหลัก</a>
                <a onclick="showSection('mythesis')">Thesis ของฉัน</a>
            </div>
            <!-- Content -->
             <div class="content">
                <div class="search-bar">
                    <input type="text" placeholder="ค้นหา Thesis">
                    <button>Search</button>
                </div>
                <div id='section-main'>
                    <h2>รายการ Thesis</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>ชื่อThesis</th>
                                <th>ผู้จัดทำ</th>
                                <th>Download</th>
                                <th>ดูข้อมูลเพิ่มเติม</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include 'connect.php';
                        
                                $sql = "SELECT * FROM thesis WHERE status = 'public'";
                                $result = mysqli_query($conn,$sql);

                                while($row = mysqli_fetch_assoc($result)){
                                    echo "<tr>";
                                    echo "<td>" . $row['title'] . "</td>";
                                    echo "<td>" . $row['student_id'] . "</td>";
                                    echo "<td><a href='" . $row['abstract_file'] . "'><button>Download</button></a></td>";
                                    echo "<td><a href='thesis_detail.php?id=" . $row['id'] . "'><button>คลิก</button></a></td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div id='section-mythesis' style="display:none;">
                    <h2>รายการ Thesis ของฉัน</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>ชื่อThesis</th>
                                <th>ผู้จัดทำ</th>
                                <th>คะแนน</th>
                                <th>Download</th>
                                <th>ดูข้อมูลเพิ่มเติม</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT * FROM thesis WHERE student_id='" . $_SESSION['user_id'] . "'";
                                $result = mysqli_query($conn,$sql);

                                while($row = mysqli_fetch_assoc($result)){
                                    echo "<tr>";
                                    echo "<td>" . $row['title'] . "</td>";
                                    echo "<td>" . $row['student_id'] . "</td>";
                                    echo "<td>" . $row['score'] . "</td>";
                                    echo "<td><a href='" . $row['abstract_file'] . "'><button>Download</button></a></td>";
                                    echo "<td><a href='thesis_detail.php?id=" . $row['id'] . "'><button>คลิก</button></a></td>";
                                    echo "</tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script>
            function showSection(name) {
            document.getElementById('section-main').style.display = 'none';
            document.getElementById('section-mythesis').style.display = 'none';
            document.getElementById('section-' + name).style.display = 'block';
        }
        </script>
    </body>
</HTML>