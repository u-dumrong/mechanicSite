<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อสอบทฤษฎีช่างกล</title>
    <link rel="stylesheet" href="../styles.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            /* แนวตั้ง */
            justify-content: flex-start;
            /* ด้านบน */
            align-items: center;
            /* กลาง แนวนอน */
            height: 100vh;
            /* ความสูงเต็มหน้าจอ */
            margin: 0;
            /* ลบ margin ของ body */
        }

        .login-container form {
            text-align: left;
        }
    </style>
</head>

<body>
    <button onclick="window.location.href='chapter1.html'">บทที่ 1</button>
    <div class="login-container">
        <h1>ข้อสอบทฤษฎีช่างกล</h1>
        <form id="quizForm">
            <!-- ข้อที่ 1 -->
            <div class="question">
                <img src="moe1.jpg" alt="Item 1" class="thumbnail">
                <p>1. การเคลื่อนที่แบบฮาร์มอนิกอย่างง่าย (SHM) เกิดขึ้นเมื่อใด?</p>
                <label><input type="radio" name="q1" value="1"> ก. มีแรงเสียดทานมาก</label><br>
                <label><input type="radio" name="q1" value="2"> ข. มีแรงคืนตัวแปรผันตามการกระจัด</label><br>
                <label><input type="radio" name="q1" value="3"> ค. มีแรงโน้มถ่วงเท่านั้น</label><br>
                <label><input type="radio" name="q1" value="4"> ง. ไม่มีแรงกระทำ</label>
            </div>
            <!-- ข้อที่ 2 -->
            <div class="question">
                <p>2. กำลัง (Power) มีหน่วยเป็นอะไร?</p>
                <label><input type="radio" name="q2" value="1"> ก. นิวตัน</label><br>
                <label><input type="radio" name="q2" value="2"> ข. วัตต์</label><br>
                <label><input type="radio" name="q2" value="3"> ค. จูล</label><br>
                <label><input type="radio" name="q2" value="4"> ง. เมตร</label>
            </div>
            <!-- ข้อที่ 3 -->
            <div class="question">
                <p>3. แรงดันในของไหลที่จุดหนึ่งเรียกว่าอะไร?</p>
                <label><input type="radio" name="q3" value="1"> ก. แรงโน้มถ่วง</label><br>
                <label><input type="radio" name="q3" value="2"> ข. แรงดันสัมบูรณ์</label><br>
                <label><input type="radio" name="q3" value="3"> ค. แรงปฏิกิริยา</label><br>
                <label><input type="radio" name="q3" value="4"> ง. แรงเสียดทาน</label>
            </div>
            <!-- ข้อที่ 4 -->
            <div class="question">
                <p>4. หน่วยของโมเมนต์ความเฉื่อยคืออะไร?</p>
                <label><input type="radio" name="q4" value="1"> ก. กิโลกรัม</label><br>
                <label><input type="radio" name="q4" value="2"> ข. นิวตัน-เมตร</label><br>
                <label><input type="radio" name="q4" value="3"> ค. กิโลกรัม-เมตร²</label><br>
                <label><input type="radio" name="q4" value="4"> ง. เมตร/วินาที</label>
            </div>
            <!-- ข้อที่ 5 -->
            <div class="question">
                <p>5. ระบบเครื่องกลที่มีประสิทธิภาพสูงสุดคือระบบใด?</p>
                <label><input type="radio" name="q5" value="1"> ก. ระบบที่ไม่มีแรงเสียดทาน</label><br>
                <label><input type="radio" name="q5" value="2"> ข. ระบบที่ใช้พลังงานน้อยที่สุด</label><br>
                <label><input type="radio" name="q5" value="3"> ค. ระบบที่ทำงานต่อเนื่อง</label><br>
                <label><input type="radio" name="q5" value="4"> ง. ระบบที่มีการบำรุงรักษา</label>
            </div>
            <!-- ข้อที่ 6 -->
            <div class="question">
                <p>6. เครื่องยนต์สันดาปภายในทำงานโดยใช้อะไรเป็นพลังงานหลัก?</p>
                <label><input type="radio" name="q6" value="1"> ก. น้ำ</label><br>
                <label><input type="radio" name="q6" value="2"> ข. น้ำมันเชื้อเพลิง</label><br>
                <label><input type="radio" name="q6" value="3"> ค. ไฟฟ้า</label><br>
                <label><input type="radio" name="q6" value="4"> ง. แรงแม่เหล็ก</label>
            </div>
            <!-- ข้อที่ 7 -->
            <div class="question">
                <p>7. ข้อใดคือกฎข้อที่ 2 ของนิวตัน?</p>
                <label><input type="radio" name="q7" value="1"> ก. F = ma</label><br>
                <label><input type="radio" name="q7" value="2"> ข. วัตถุอยู่นิ่งถ้าไม่มีแรงกระทำ</label><br>
                <label><input type="radio" name="q7" value="3"> ค. แรงมีขนาดเท่ากันและทิศทางตรงกันข้าม</label><br>
                <label><input type="radio" name="q7" value="4"> ง. วัตถุเคลื่อนที่ด้วยความเร็วคงที่</label>
            </div>
            <!-- ข้อที่ 8 -->
            <div class="question">
                <p>8. ข้อใดคือแรงเสียดทานที่ไม่ทำงาน?</p>
                <label><input type="radio" name="q8" value="1"> ก. แรงเสียดทานคงที่</label><br>
                <label><input type="radio" name="q8" value="2"> ข. แรงเสียดทานกลิ้ง</label><br>
                <label><input type="radio" name="q8" value="3"> ค. แรงเสียดทานลื่นไถล</label><br>
                <label><input type="radio" name="q8" value="4"> ง. แรงเสียดทานสถิต</label>
            </div>
            <!-- ข้อที่ 9 -->
            <div class="question">
                <p>9. กระบวนการใดในระบบเทอร์โมไดนามิกที่ไม่มีการแลกเปลี่ยนความร้อน?</p>
                <label><input type="radio" name="q9" value="1"> ก. กระบวนการคงปริมาตร</label><br>
                <label><input type="radio" name="q9" value="2"> ข. กระบวนการอิสโทปิค</label><br>
                <label><input type="radio" name="q9" value="3"> ค. กระบวนการอะเดียแบติก</label><br>
                <label><input type="radio" name="q9" value="4"> ง. กระบวนการอุณหภูมิคงที่</label>
            </div>
            <!-- ข้อที่ 10 -->
            <div class="question">
                <p>10. เครื่องมือวัดระยะทางในหน่วยมิลลิเมตรที่แม่นยำที่สุดคืออะไร?</p>
                <label><input type="radio" name="q10" value="1"> ก. ไม้บรรทัด</label><br>
                <label><input type="radio" name="q10" value="2"> ข. เวอร์เนียคาลิปเปอร์</label><br>
                <label><input type="radio" name="q10" value="3"> ค. ไมโครมิเตอร์</label><br>
                <label><input type="radio" name="q10" value="4"> ง. เทปวัดระยะ</label>
            </div>
        </form>
        <button type="button" id="checkAnswers">ส่งคำตอบ</button>
    </div>
    <!-- <p id="result"></p> -->
    <script src="test.js" defer></script>
</body>

</html>