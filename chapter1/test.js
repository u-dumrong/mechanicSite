function checkAnswers() {
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
}
