<?php
session_start();
require 'dbConfig.php'; // เชื่อมต่อฐานข้อมูล

// ตรวจสอบว่าผู้ใช้เข้าสู่ระบบหรือไม่
if (!isset($_SESSION['user_id'])) {
    echo '<!DOCTYPE html>
    <html lang="th">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>แจ้งเตือน</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                text-align: center;
                padding: 50px;
                background-color: #f9f9f9;
            }
            .message-box {
                display: inline-block;
                padding: 20px;
                border: 2px solid #ff0000;
                background-color: #fff4f4;
                color: #ff0000;
                border-radius: 5px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
        </style>
    </head>
    <body>
        <div class="message-box">
            <h1>กรุณา Login เพื่อเข้าสู่ระบบ</h1>
            <p>ระบบจะนำคุณไปยังหน้าแรกใน 2 วินาที...</p>
        </div>
    </body>
    </html>
    ';
    header('refresh:2;index.html');
    exit();
}

// คำสั่ง SQL ที่ดึงข้อมูลชื่อ รูปโปรไฟล์ และคะแนน
$sql = "SELECT u.username, u.profile_picture, s.score 
        FROM users u
        JOIN students s ON u.id = s.user_id
        WHERE u.role = 'student'";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>แถบเมนูด้านซ้ายและโปรไฟล์</title>
    <style>
        /* ตั้งค่าทั่วไป */
        body {
            font-family: Noto Sans Thai;
            margin: 0;
            display: flex;
            height: 100vh;
            overflow: hidden;
            background: linear-gradient(135deg, #f3f4f6, #a2c7e5);
        }

        /* แถบเมนูด้านซ้าย */
        .sidebar {
            width: 250px;
            background-color: rgb(0, 89, 124);
            color: white;
            height: 100%;
            padding: 20px 10px;
            box-sizing: border-box;
            position: fixed;
            left: 0;
            top: 0;
            transition: width 0.3s ease;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .sidebar.hidden {
            width: 60px;
            /* ย่อขนาดแถบเมนูเมื่อปิด */
        }

        /* ปุ่มสามขีด */
        .toggle-button {
            background-color: transparent;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 24px;
            align-self: flex-end;
            transition: transform 0.3s ease;
            padding: 0;
            margin-bottom: 30px;
        }

        .toggle-button:hover {
            color: rgb(79, 209, 183);
        }

        /* รายการเมนู */
        .menu {
            list-style: none;
            padding: 0;
            margin: 0;
            width: 100%;
            flex-grow: 1;
        }

        .menu li {
            margin: 15px 0;
            width: 100%;
            display: flex;
            align-items: center;
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .menu li a {
            text-decoration: none;
            color: white;
            display: flex;
            align-items: center;
            width: 100%;
            padding: 10px;
            border-radius: 4px;
            transition: background-color 0.3s ease;
            overflow: hidden;
            /* ตัดพื้นที่ที่เกินขอบ */
        }

        .menu li a:hover {
            background-color: rgb(0, 107, 150);
        }

        /* ไอคอนเมนู */
        .menu li a .icon {
            margin-right: 15px;
            font-size: 18px;
            width: 25px;
            text-align: center;
        }

        /* ตัวหนังสือเมนู */
        .menu li a .text {
            white-space: nowrap;
            opacity: 1;
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        /* ซ่อนตัวหนังสือเมื่อแถบเมนูถูกปิด */
        .sidebar.hidden .menu li a .text {
            opacity: 0;
            transform: translateX(-20px);
        }

        /* เนื้อหา */
        .content {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
            box-sizing: border-box;
            transition: margin-left 0.3s ease, width 0.3s ease;
            overflow-y: auto;
            /* เพิ่มเพื่อให้เลื่อนขึ้นลงได้ */
            height: 100vh;
            /* ให้เนื้อหายืดเต็มหน้าจอ */
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .item {
            width: 200px;
            height: 300px;
            text-align: center;
            cursor: pointer;
            overflow: hidden;
            /* ทำให้ไม่เกิดการ overflow ถ้าใช้ effect ที่ขยายรูป */
            border-radius: 10px;
            /* ขอบมน */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            /* เงา */
            background: linear-gradient(135deg, rgb(242, 244, 247), rgb(192, 211, 228));
            transition: transform 0.3s ease;
        }

        .thumbnail {
            width: 100%;
            height: 150px;
            object-fit: cover;
            margin-bottom: 10px;
            /* เพิ่ม transition เพื่อให้การขยายมีความนุ่มนวล */
        }

        .item:hover {
            transform: scale(1.1);
            /* ขยายรูปเป็น 1.1 เท่าเมื่อเมาส์ชี้ */
        }

        .sidebar.hidden~.content {
            margin-left: 60px;
            width: calc(100% - 60px);
        }

        /* สไตล์รูปโปรไฟล์ */
        .profile-icon {
            width: 60px;
            height: 60px;
            transition: width 0.3s ease, height 0.3s ease;
            margin: 10px 0;
            border-radius: 50%;
            background-image: url('images/profile.png');
            /* กำหนดภาพพื้นหลัง */
            background-size: cover;
            object-fit: cover;
            /* ให้รูปภาพพอดีกับขอบวงกลม */
            /* ปรับขนาดภาพให้พอดี */
            background-repeat: no-repeat;
            /* ป้องกันการซ้ำของภาพ */
            cursor: pointer;
            position: fixed;
            top: 10px;
            /* ระยะห่างจากด้านบน */
            right: 10px;
            /* ระยะห่างจากด้านขวา */
            overflow: hidden;
            /* ตัดส่วนที่เกินออก */
        }

        /* เมนูย่อย (dropdown) */
        .dropdown-menu {
            visibility: hidden;
            /* ซ่อนเมนูเริ่มต้น */
            position: absolute;
            top: 80px;
            right: 0;
            background-color: #fff;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            min-width: 100px;
            border-radius: 5px;
            z-index: 1;
            transform: translateY(-10px);
            /* เริ่มต้นที่เลื่อนขึ้นไปเล็กน้อย */
            opacity: 0;
            /* เริ่มต้นด้วยความโปร่งใส */
            transition: transform 0.3s ease, opacity 0.3s ease, visibility 0s linear 0.3s;
            /* การเคลื่อนไหว */
            /* การเคลื่อนไหวของตำแหน่งและความโปร่งใส */
        }

        /* เมื่อเมนูเปิด */
        .dropdown-menu.show {
            visibility: visible;
            /* ทำให้เมนูมองเห็น */
            transform: translateY(0);
            /* เลื่อนลงมา */
            opacity: 1;
            /* ทำให้เห็น */
            transition: transform 0.3s ease, opacity 0.3s ease;
            /* รักษาการเคลื่อนไหวเมื่อเปิดเมนู */
        }

        /* รายการในเมนู */
        .dropdown-menu a {
            display: block;
            padding: 10px 8px;
            text-decoration: none;
            color: black;
            transition: background-color 0.2s;
        }

        /* เปลี่ยนสีเมื่อ hover */
        .dropdown-menu a:hover {
            background-color: #ddd;
        }


        /* Responsive: ปรับขนาดให้เหมาะสมกับหน้าจอเล็ก */
        @media (max-width: 768px) {
            .content {
                margin-left: 125px;
                width: calc(100% - 125px);
            }

            .sidebar {
                width: 125px;
            }

            .profile-icon {
                width: 40px;
                height: 40px;
            }

            .dropdown-menu {
                top: 60px;
            }
        }

        table {
            background-color: white;
            /* พื้นหลังสีขาวเฉพาะตาราง */
            width: 80%;
            border-collapse: collapse;
            margin: 50px auto;
            border: 2px solid black;
            /* เส้นรอบขอบตาราง */
        }

        tr:nth-child(even) {
            background-color: #D6EEEE;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border: 1px solid black;
            /* เส้นระหว่างแถวและคอลัมน์ */
        }

        img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
        }
    </style>
</head>

<body>

    <!-- แถบเมนูด้านซ้าย -->
    <div class="sidebar" id="sidebar">
        <!-- ปุ่มสามขีด -->
        <button class="toggle-button" id="toggleButton" onclick="toggleSidebar()">☰</button>

        <!-- รายการเมนู -->
        <ul class="menu">
            <li>
                <a href="#">
                    <span class="icon">🏠</span>
                    <span class="text">หน้าแรก</span>
                </a>
            </li>
            <!-- <li>
        <a href="#">
          <span class="icon">ℹ️</span>
          <span class="text">เกี่ยวกับ</span>
        </a>
      </li>
      <li>
        <a href="#">
          <span class="icon">🛠️</span>
          <span class="text">บริการ</span>
        </a>
      </li> -->
            <li>
                <a href="#"> <!-- onclick="window.location.href='contact.html'" -->
                    <span class="icon">📞</span>
                    <span class="text">ติดต่อเรา</span>
                </a>
            </li>
        </ul>
    </div>

    <div class="content">
        <table>
            <thead>
                <tr>
                    <th>Profile Picture</th>
                    <th>Username</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // ถ้ามีข้อมูลในฐานข้อมูล
                if ($result->num_rows > 0) {
                    // แสดงข้อมูลแต่ละแถว
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td><img src='uploads/" . $row['profile_picture'] . "' alt='Profile Picture'></td>";
                        echo "<td>" . $row['username'] . "</td>";
                        echo "<td>" . $row['score'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No data found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>

<?php
// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
?>

<div>
    <!-- รูปโปรไฟล์ (สามารถแทนที่ด้วยรูปจริงได้) -->
    <img src="uploads/<?php echo htmlspecialchars($profile_picture); ?>" alt=" " class="profile-icon" id="profileIcon" onclick="toggleDropdown()">
</div>

<!-- เมนูย่อย -->
<div class="dropdown-menu" id="dropdownMenu">
    <a href="#" onclick="window.location.href='profile.php'">โปรไฟล์</a>
    <a href="#" onclick="window.location.href='editPro.php'">แก้ไขโปรไฟล์</a>
    <a href="#" onclick="window.location.href='loginOutUp/logout.php'">ออกจากระบบ</a>
</div>
<!-- JavaScript -->
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('hidden');
    }

    function toggleDropdown() {
        const dropdownMenu = document.getElementById('dropdownMenu');
        dropdownMenu.classList.toggle('show'); // สลับการแสดง/ซ่อนเมนู
    }

    // ปิดเมนูเมื่อคลิกที่ไหนก็ได้ภายนอกเมนู
    window.onclick = function(event) {
        if (!event.target.matches('.profile-icon') && !event.target.closest('.dropdown-menu')) {
            const dropdownMenu = document.getElementById('dropdownMenu');
            if (dropdownMenu.classList.contains('show')) {
                dropdownMenu.classList.remove('show');
            }
        }
    }
</script>
</body>

</html>