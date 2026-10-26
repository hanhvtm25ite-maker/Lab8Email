
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài 2 - Gửi email</title>
</head>
<body>
    <h2>GỬI EMAIL CÓ FILE ĐÍNH KÈM</h2>

    <form action="mail.php" method="POST" enctype="multipart/form-data">
        <p>
            <label>Email người nhận:</label><br>
            <input type="email" name="email" required>
        </p>

        <p>
            <label>Tiêu đề:</label><br>
            <input type="text" name="tieude" required>
        </p>

        <p>
            <label>Nội dung:</label><br>
            <textarea name="content" rows="5" required></textarea>
        </p>

        <p>
            <label>Chọn file đính kèm (không bắt buộc):</label><br>
            <input type="file" name="file">
        </p>

        <button type="submit">Gửi email</button>
    </form>
</body>
</html>
