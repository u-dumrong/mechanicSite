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
      background-color:rgb(0, 89, 124);
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
      color:rgb(79, 209, 183);
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
      background-color:rgb(0, 107, 150);
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
      background: linear-gradient(135deg,rgb(242, 244, 247),rgb(192, 211, 228));
    }

    .thumbnail {
      width: 100%;
      height: 150px;
      object-fit: cover;
      margin-bottom: 10px;
      transition: transform 0.3s ease;
      /* เพิ่ม transition เพื่อให้การขยายมีความนุ่มนวล */
    }

    .thumbnail:hover {
      transform: scale(1.1);
      /* ขยายรูปเป็น 1.1 เท่าเมื่อเมาส์ชี้ */
    }

    .sidebar.hidden~.content {
      margin-left: 60px;
      width: calc(100% - 60px);
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
    }

    /* สไตล์รูปโปรไฟล์ */
    .profile-icon {
      width: 40px;
      height: 40px;
      margin: 10px;
      border-radius: 50%;
      background-color: #888;
      cursor: pointer;
      position: relative;
    }

    /* เมนูย่อย (dropdown) */
    .dropdown-menu {
      display: none;
      position: absolute;
      top: 50px;
      right: 0;
      background-color: #fff;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
      min-width: 160px;
      border-radius: 5px;
      z-index: 1;
    }

    /* รายการในเมนู */
    .dropdown-menu a {
      display: block;
      padding: 12px 16px;
      text-decoration: none;
      color: black;
      transition: background-color 0.2s;
    }

    /* เปลี่ยนสีเมื่อ hover */
    .dropdown-menu a:hover {
      background-color: #ddd;
    }

    /* เมื่อเมนูเปิด */
    .dropdown-menu.show {
      display: block;
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

  <!-- เนื้อหา -->
  <div class="content">
    <div class="item" onclick="window.location.href='chapter1/chapter1.html'">
      <img src="moe1.jpg" alt="Item 1" class="thumbnail">
      <h3>บทที่ 1</h3>
      <p>รายละเอียดของบทที่ 1</p>
    </div>
    <div class="item" onclick="window.location.href='chapter2/chapter2.html'">
      <img src="moe2.jpg" alt="Item 2" class="thumbnail">
      <h3>บทที่ 2</h3>
      <p>รายละเอียดของบทที่ 2</p>
    </div>
    <div class="item" onclick="window.location.href='chapter3/chapter3.html'">
      <img src="moe3.jpg" alt="Item 3" class="thumbnail">
      <h3>บทที่ 3</h3>
      <p>รายละเอียดของบทที่ 3</p>
    </div>
    <!-- เพิ่มรายการอื่นๆ ที่ต้องการ -->
  </div>

  <div class="profile-icon" id="profileIcon" onclick="toggleDropdown()">
    <!-- รูปโปรไฟล์ (สามารถแทนที่ด้วยรูปจริงได้) -->
  <?php require 'profile_picture.php'; ?>
    <img src="uploads/<?php echo htmlspecialchars($profile_picture); ?>" alt="Profile Picture" width="100">
  </div>

  <!-- เมนูย่อย -->
  <div class="dropdown-menu" id="dropdownMenu">
    <a href="#" onclick="window.location.href='profile.php'">โปรไฟล์</a>
    <a href="#" onclick="window.location.href='editPro.php'">แก้ไขโปรไฟล์</a>
    <a href="#" onclick="window.location.href='logout.php'">ออกจากระบบ</a>
  </div>
  <?php require 'profile_picture.php'; ?>
  <?php $profile_picture = isset($profile_picture) ? $profile_picture : 'moe2.jng'; ?>
  <img src="uploads/<?php echo htmlspecialchars($profile_picture); ?>" alt="Profile Picture" width="100">
  <!-- JavaScript -->
  <script>
    function toggleSidebar() {
      const sidebar = document.getElementById('sidebar');
      sidebar.classList.toggle('hidden');
    }

    function toggleDropdown() {
      const dropdownMenu = document.getElementById('dropdownMenu');
      dropdownMenu.classList.toggle('show');
    }

    // ปิดเมนูเมื่อคลิกที่ไหนก็ได้ภายนอกเมนู
    window.onclick = function (event) {
      if (!event.target.matches('.profile-icon')) {
        const dropdownMenu = document.getElementById('dropdownMenu');
        if (dropdownMenu.classList.contains('show')) {
          dropdownMenu.classList.remove('show');
        }
      }
    }
  </script>
</body>

</html>