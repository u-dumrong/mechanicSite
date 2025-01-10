/*
function login() {
    // ตรวจสอบการกรอกข้อมูล เช่นชื่อผู้ใช้และรหัสผ่านที่ถูกต้อง
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    if (username && password) {
        // นำไปยังหน้าหลัก
        window.location.href = "main.html";
    } else {
        alert("กรุณากรอกข้อมูลให้ครบ");
    }
}

function signUp() {
    // ในที่นี้สามารถนำไปยังหน้าสมัครสมาชิกได้
    window.location.href = "signup.html";
}
*/

document.getElementById('loginButton').addEventListener('click', function () {
    const formData = new FormData(document.getElementById('loginForm'));

    // ใช้ Fetch API เพื่อส่งคำขอไปยังไฟล์ PHP
    fetch('processLogin.php', {
        method: 'POST',
        body: formData
    })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json(); // แปลงเป็น JSON
        })
        .then(data => {
            console.log("Server response:", data); // ตรวจสอบว่าข้อมูลที่ได้รับจาก PHP คืออะไร
            //alert(data); // แสดงข้อความตอบกลับ

            if (data.status === 'success') {
                alert("ล็อกอินสำเร็จ!");
                if (data.role === 'teacher') {
                    window.location.href = "teacherMain.html"; // เปลี่ยนไปหน้าหลักของครู
                } else if (data.role === 'student') {
                    window.location.href = "main.php"; // เปลี่ยนไปหน้าหลักของนักเรียน
                }
            } else {
                alert(data.message); // แสดงข้อความผิดพลาดจาก PHP
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert("เกิดข้อผิดพลาดในการเชื่อมต่อกับเซิร์ฟเวอร์!");
        });
});

document.getElementById("signupButton").addEventListener("click", function() {
    // เปลี่ยนเส้นทางไปยังหน้า signup.html
    window.location.href = "signup.html";
});
