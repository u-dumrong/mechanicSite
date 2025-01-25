// teacher_script.js
window.onload = function() {
    // ดึงข้อมูลเวลาปัจจุบันจากฐานข้อมูล
    fetch('get_exam_time.php')
    .then(response => response.json())
    .then(data => {
        // แสดงเวลาเริ่มและหมดเวลาที่ตั้งไว้
        document.getElementById('currentStartTime').innerText = data.start_time || "ยังไม่ได้ตั้งเวลา";
        document.getElementById('currentEndTime').innerText = data.end_time || "ยังไม่ได้ตั้งเวลา";
    });
};
