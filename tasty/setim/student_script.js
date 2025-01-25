// student_script.js
window.onload = function () {
    var timeDisplay = document.getElementById('timeDisplay');
    var submitBtn = document.getElementById('submitBtn');
    var interval; // ตัวแปรเก็บการทำงานของ setInterval
    var startTime; // เวลาเริ่ม
    var endTime; // เวลาสิ้นสุด
    var hasStarted = false; // ตัวแปรเช็คว่าเริ่มสอบแล้วหรือยัง

    // เรียกข้อมูลเวลาที่ตั้งจาก PHP
    fetch('get_exam_time.php')
        .then((response) => response.json())
        .then((data) => {
            startTime = new Date(data.start_time); // เวลาเริ่ม
            endTime = new Date(data.end_time); // เวลาสิ้นสุด

            // ฟังก์ชันที่ใช้ในการอัปเดตเวลา
            function updateTime() {
                var now = new Date(); // เวลาปัจจุบัน
                if (now < startTime) {
                    // ยังไม่ถึงเวลาเริ่ม
                    var timeUntilStart = startTime - now; // เวลาที่เหลือก่อนเริ่ม
                    var minutesUntilStart = Math.floor(timeUntilStart / 60000); // คำนวณนาที
                    var secondsUntilStart = Math.floor((timeUntilStart % 60000) / 1000); // คำนวณวินาที
                    timeDisplay.innerHTML =
                        "รอเริ่มสอบ: " +
                        minutesUntilStart +
                        " นาที " +
                        secondsUntilStart +
                        " วินาที";
                    submitBtn.disabled = true; // ปิดปุ่มส่งคำตอบจนกว่าจะถึงเวลาเริ่ม
                } else if (now >= startTime && now < endTime) {
                    // เริ่มสอบแล้ว
                    if (!hasStarted) {
                        hasStarted = true; // เริ่มสอบแล้ว
                        submitBtn.disabled = false; // เปิดปุ่มส่งคำตอบ
                    }

                    // คำนวณเวลาที่เหลือ
                    var timeLeft = endTime - now;
                    var minutesLeft = Math.floor(timeLeft / 60000); // คำนวณนาที
                    var secondsLeft = Math.floor((timeLeft % 60000) / 1000); // คำนวณวินาที
                    timeDisplay.innerHTML =
                        "เวลาเหลือ: " +
                        minutesLeft +
                        " นาที " +
                        secondsLeft +
                        " วินาที";
                } else {
                    // หมดเวลาแล้ว
                    clearInterval(interval); // หยุดการนับเวลา
                    timeDisplay.innerHTML = "หมดเวลา";
                    submitBtn.disabled = true; // ปิดปุ่มส่งคำตอบ
                    submitBtn.value = "ส่งคำตอบแล้ว"; // เปลี่ยนข้อความในปุ่ม
                    setTimeout(() => {
                        submitBtn.click(); // กดปุ่มส่งคำตอบโดยอัตโนมัติ
                    }, 1000); // กดปุ่มอัตโนมัติหลังจาก 1 วินาที
                }
            }

            // เริ่มการนับถอยหลังทุก ๆ 1 วินาที
            interval = setInterval(updateTime, 1000);

            // เมื่อกดปุ่มส่งคำตอบ
            submitBtn.addEventListener('click', function (event) {
                event.preventDefault(); // ป้องกันการส่งฟอร์มทันที
                clearInterval(interval); // หยุดการอัปเดตเวลา

                // คำนวณเวลาที่ใช้ไป
                var now = new Date();
                var timeUsed = now - startTime;
                var minutesUsed = Math.floor(timeUsed / 60000); // คำนวณนาที
                var secondsUsed = Math.floor((timeUsed % 60000) / 1000); // คำนวณวินาที

                // แสดงเวลาที่ใช้ไป
                timeDisplay.innerHTML =
                    "เวลาใช้ไป: " +
                    minutesUsed +
                    " นาที " +
                    secondsUsed +
                    " วินาที";

                submitBtn.disabled = true; // ปิดปุ่มส่งคำตอบ
                submitBtn.value = "ส่งคำตอบแล้ว"; // เปลี่ยนข้อความปุ่ม
            });
        });
};
