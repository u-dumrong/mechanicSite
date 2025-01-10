<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // รับข้อมูลจากฟอร์ม
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // ตั้งค่าการส่งอีเมล
    $to = "atentbszs@gmail.com"; // เปลี่ยนเป็นอีเมลของคุณ
    $subject = "New Contact Form Submission";
    $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
    $headers = "From: $email";

    // ส่งอีเมล
    if (mail($to, $subject, $body, $headers)) {
        echo "Thank you, $name. Your message has been sent successfully.";
    } else {
        echo "Sorry, there was an error sending your message. Please try again.";
    }
}
?>
