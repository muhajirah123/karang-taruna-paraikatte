<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = getenv('SMTP_EMAIL');  // dari environment variable
    $mail->Password = getenv('SMTP_PASSWORD');
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom(getenv('SMTP_EMAIL'), 'Website Kontak');
    $mail->addAddress(getenv('SMTP_EMAIL'));

    $mail->isHTML(true);
    $mail->Subject = 'Pesan dari Form Kontak';
    $mail->Body = "
        <b>Nama:</b> {$_POST['name']}<br>
        <b>Email:</b> {$_POST['email']}<br>
        <b>Nomor HP:</b> {$_POST['phone']}<br>
        <b>Pesan:</b> {$_POST['message']}
    ";

    $mail->send();
    echo "Pesan berhasil dikirim!";
} catch (Exception $e) {
    echo "Gagal kirim email: {$mail->ErrorInfo}";
}
?>
