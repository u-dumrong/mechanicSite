/*
function signUp() {
    // ตรวจสอบการกรอกข้อมูล เช่นชื่อผู้ใช้และรหัสผ่านที่ถูกต้อง
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;
    const confirm = document.getElementById("confirm").value;

    if (username && password && confirm) {
        // นำไปยังหน้าเข้าสู่ระบบ
        if (password == confirm) {
            window.location.href = "index.html";
        } else {
            alert("รหัสผ่านไม่ตรงกัน");
        }
    } else {
        alert("กรุณากรอกข้อมูลให้ครบ");
    }
}
*/
// ผู้ใช้คลิกปุ่ม signupButton แล้ว JavaScript สร้างข้อมูลฟอร์ม (FormData) จากฟอร์ม signupForm
document.getElementById('signupButton').addEventListener('click', function () {
    const formData = new FormData(document.getElementById('signupForm'));

    // ใช้ Fetch API ส่งข้อมูลนี้ไปยังไฟล์ PHP (processSignup.php) ด้วยเมธอด POST
    fetch('processSignup.php', {
        method: 'POST',
        body: formData
    })
        .then(response => response.text()) // ไฟล์ PHP ประมวลผลข้อมูลแล้วส่งข้อความตอบกลับ (Response) กลับมา
        .then(data => {
            alert(data); // แสดงข้อความตอบกลับด้วย alert() หรือพิมพ์ข้อผิดพลาดในคอนโซลหากเกิดปัญหา
        })
        .catch(error => {
            console.error('Error:', error);
        });
});
