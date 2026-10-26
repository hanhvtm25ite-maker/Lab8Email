
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . "/PHPMailer-master/PHPMailer-master/src/PHPMailer.php";
require __DIR__ . "/PHPMailer-master/PHPMailer-master/src/SMTP.php";
require __DIR__ . "/PHPMailer-master/PHPMailer-master/src/Exception.php";

// Danh sách email người nhận
$recipients = [
    "myhanh17042k7@gmail.com",
    "vomyhanh17042k7@gmail.com",
    
];

$mail = new PHPMailer(true);

try {
    // Cấu hình SMTP Gmail giống Bài 2
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "hanhvtm.25ite@vku.udn.vn";
    $mail->Password = "vffs vsup udop fdox";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;
    $mail->CharSet = "UTF-8";

    // Người gửi
    $mail->setFrom(
        "hanhvtm.25ite@vku.udn.vn",
        "Bài tập Lab 8"
    );

    // Thêm nhiều người nhận bằng BCC
    $count = 0;

    foreach ($recipients as $email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $mail->addBCC($email);
            $count++;
        }
    }

    if ($count === 0) {
        throw new Exception("Không có email người nhận hợp lệ.");
    }

    // Nội dung email
    $mail->isHTML(true);
    $mail->Subject = "Thong bao tu PHP";
    $mail->Body = "Day la email gui den nhieu nguoi.";
    $mail->AltBody = "Day la email gui den nhieu nguoi.";

    // Gửi email
    $mail->send();

    echo "Gửi email thành công đến $count người nhận.";

} catch (Exception $e) {
    echo "Gửi email thất bại: "
        . htmlspecialchars(
            $mail->ErrorInfo ?: $e->getMessage(),
            ENT_QUOTES,
            "UTF-8"
        );
}
