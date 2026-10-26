
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . "/PHPMailer-master/PHPMailer-master/src/PHPMailer.php";
require __DIR__ . "/PHPMailer-master/PHPMailer-master/src/SMTP.php";
require __DIR__ . "/PHPMailer-master/PHPMailer-master/src/Exception.php";

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;

    // Thay bang Gmail cua ban
    $nguoigui = 'hanhvtm.25ite@vku.udn.vn';

    // Mat khau ung dung Gmail
    $mail->Password = getenv('GMAIL_APP_PASSWORD');

    $mail->Username = $nguoigui;
    $mail->Password = $matkhau;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;
    $mail->CharSet = 'UTF-8';

    $mail->setFrom($nguoigui, 'Nguoi gui');

    // Email nhan
    $mail->addAddress('myhanh17042k7@gmail.com');

    $mail->isHTML(true);
    $mail->Subject = 'Gui thu tu PHP';
    $mail->Body = '<h3>Chao ban nha!</h3><p>Chuc ban mot ngay tot lanh!</p>';

    $mail->send();

    echo 'Gui email thanh cong!';
} catch (Exception $e) {
    echo 'Gui email that bai: ' . $mail->ErrorInfo;
}
?>
