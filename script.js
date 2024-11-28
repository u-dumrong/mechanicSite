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
