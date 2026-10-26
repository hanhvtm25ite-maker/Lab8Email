
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . "/PHPMailer-master/PHPMailer-master/src/PHPMailer.php";
require __DIR__ . "/PHPMailer-master/PHPMailer-master/src/SMTP.php";
require __DIR__ . "/PHPMailer-master/PHPMailer-master/src/Exception.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit("Vui lòng gửi thông tin từ form.");
}

$email = trim($_POST["email"] ?? "");
$tieude = trim($_POST["tieude"] ?? "");
$content = trim($_POST["content"] ?? "");

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    exit("Email người nhận không hợp lệ.");
}

if ($tieude === "" || $content === "") {
    exit("Vui lòng nhập đầy đủ tiêu đề và nội dung.");
}

$mail = new PHPMailer(true);

try {
    // Cấu hình SMTP Gmail
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "hanhvtm.25ite@vku.udn.vn";
    $mail->Password = "vffs vsup udop fdox";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;
    $mail->CharSet = "UTF-8";

    // Thông tin người gửi và người nhận
    $mail->setFrom("hanhvtm.25ite@vku.udn.vn", "Bài tập Lab 8");
    $mail->addAddress($email);

    // Nội dung email
    $mail->isHTML(true);
    $mail->Subject = $tieude;
    $mail->Body = nl2br(htmlspecialchars(
        $content,
        ENT_QUOTES,
        "UTF-8"
    ));
    $mail->AltBody = $content;

    // Xử lý file đính kèm nếu người dùng chọn
    if (isset($_FILES["file"]) &&
        $_FILES["file"]["error"] !== UPLOAD_ERR_NO_FILE) {

        if ($_FILES["file"]["error"] !== UPLOAD_ERR_OK) {
            throw new Exception("Tải file lên thất bại.");
        }

        if ($_FILES["file"]["size"] > 5 * 1024 * 1024) {
            throw new Exception("File không được vượt quá 5 MB.");
        }

        $mail->addAttachment(
            $_FILES["file"]["tmp_name"],
            basename($_FILES["file"]["name"])
        );
    }

    $mail->send();
    echo "Gửi email thành công!";

} catch (Exception $e) {
    echo "Gửi email thất bại: " . htmlspecialchars(
        $mail->ErrorInfo ?: $e->getMessage(),
        ENT_QUOTES,
        "UTF-8"
    );
}
