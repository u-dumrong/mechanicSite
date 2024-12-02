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
        .then(response => response.text()) // รับข้อความตอบกลับจาก PHP
        .then(data => {
            console.log("Server response:", data); // ตรวจสอบว่าข้อมูลที่ได้รับจาก PHP คืออะไร
            alert(data); // แสดงข้อความตอบกลับ
            if (data.trim() === "ล็อกอินสำเร็จ!") {
                console.log("Login success, redirecting...");
                window.location.href = "main.html"; // เปลี่ยนหน้าเมื่อสำเร็จ
            } else {
                console.log("Login failed or incorrect response: ", data);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
});

document.getElementById("signupButton").addEventListener("click", function() {
    // เปลี่ยนเส้นทางไปยังหน้า signup.html
    window.location.href = "signup.html";
});
