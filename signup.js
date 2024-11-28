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
