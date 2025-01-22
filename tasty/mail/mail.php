<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // สำหรับ Composer
// หรือใช้ require 'path/to/PHPMailerAutoload.php' ถ้าใช้ไฟล์จาก GitHub

$mail = new PHPMailer(true);

try {
    // การตั้งค่าเซิร์ฟเวอร์ SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  // เปลี่ยนเป็น SMTP ของบริการอีเมลที่ใช้งาน
    $mail->SMTPAuth = true;
    $mail->Username = 'atentbszs@gmail.com';  // ใส่อีเมลของคุณ
    $mail->Password = '254792@Aten';  // ใส่รหัสผ่าน
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // ตั้งค่าผู้ส่งและผู้รับ
    $mail->setFrom('66309010042@gmail.ac.th', 'Aten');
    $mail->addAddress('atentbszs@gmail.com', 'Thiraphong');

    // ตั้งหัวเรื่องและเนื้อหาของอีเมล
    $mail->Subject = 'Test Email';
    $mail->Body    = 'This is a test email sent from XAMPP server.';

    // ส่งอีเมล
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
