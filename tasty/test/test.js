function updateContentVisibility() {
    // ดึงสถานะจาก Local Storage
    const content = document.getElementById("container");
    const isVisible = localStorage.getItem("contentVisibility") === "true";
    content.style.display = isVisible ? "block" : "none";
}

// เรียกใช้ฟังก์ชันเมื่อโหลดหน้า
window.onload = updateContentVisibility;

// ตั้งตัวฟังเพื่อตรวจจับการเปลี่ยนแปลงของ Local Storage
window.addEventListener("storage", updateContentVisibility);

document.getElementById('checkAnswers').addEventListener('click', function () {
    const correctAnswers = {
        q1: "2",  // มีแรงคืนตัวแปรผันตามการกระจัด
        q2: "2",  // วัตต์
        q3: "2",  // แรงดันสัมบูรณ์
        q4: "3",  // กิโลกรัม-เมตร²
        q5: "1",  // ระบบที่ไม่มีแรงเสียดทาน
        q6: "2",  // น้ำมันเชื้อเพลิง
        q7: "1",  // F = ma
        q8: "4",  // แรงเสียดทานสถิต
        q9: "3",  // กระบวนการอะเดียแบติก
        q10: "3"  // ไมโครมิเตอร์
    };

    const form = document.getElementById("quizForm");
    const formData = new FormData(form);

    let score = 0;
    for (let [question, answer] of formData.entries()) {
        if (correctAnswers[question] === answer) {
            score++;
        }
    }
    /*
        const resultElement = document.getElementById("result");
        resultElement.textContent = `คุณได้คะแนน ${score} จาก ${Object.keys(correctAnswers).length}`;
    */

    const totalQuestions = Object.keys(correctAnswers).length;
    alert(`คุณได้คะแนน ${score} เต็ม ${totalQuestions}`);

    // ลบค่าเวลาใน localStorage
    //localStorage.removeItem('timeRemaining');

    // ส่งคะแนนไปยังเซิร์ฟเวอร์
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "updateScore.php", true);
    xhr.setRequestHeader("Content-Type", "application/json");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);
            window.location.href = '../../profile.php';
        }
    };
    const data = { score: score };
    xhr.send(JSON.stringify(data));
});

const countdownDisplay = document.getElementById('countdown');

function formatTime(seconds) {
    const hours = Math.floor(seconds / 3600);
    const minutes = Math.floor((seconds % 3600) / 60);
    const secs = seconds % 60;
    return `${hours}:${String(minutes).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
}

function updateCountdown() {
    const endTime = localStorage.getItem('endTime');
    if (!endTime) {
        countdownDisplay.textContent = 'ยังไม่ได้ตั้งเวลา';
        return;
    }

    const now = Date.now();
    const timeLeft = Math.max(0, Math.floor((endTime - now) / 1000)); // เวลาเหลือในวินาที

    if (timeLeft <= 0) {
        countdownDisplay.textContent = 'หมดเวลา!';
        clearInterval(intervalId);
        return;
    }

    countdownDisplay.textContent = formatTime(timeLeft);
}

const intervalId = setInterval(updateCountdown, 1000);
updateCountdown();
