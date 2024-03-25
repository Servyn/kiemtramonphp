<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kết nối đến cơ sở dữ liệu
    $servername = "localhost";
    $username_db = "tên_người_dùng";
    $password_db = "mật_khẩu";
    $database = "tên_cơ_sở_dữ_liệu";

    $conn = new mysqli($servername, $username_db, $password_db, $database);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
    }

    // Lấy dữ liệu từ form
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];

    // Thực thi câu lệnh SQL để thêm người dùng mới
    $sql = "INSERT INTO webuser (username, password, fullname, email, role) VALUES ('$username', '$password', '$fullname', '$email', 'user')";

    if ($conn->query($sql) === TRUE) {
        echo "Thêm người dùng mới thành công.";
    } else {
        echo "Lỗi: " . $sql . "<br>" . $conn->error;
    }

    // Đóng kết nối
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm người dùng</title>
</head>

<body>
    <h2>Thêm người dùng mới</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="username">Tên đăng nhập:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Mật khẩu:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="fullname">Họ và tên:</label>
        <input type="text" id="fullname" name="fullname" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <button type="submit">Thêm</button>
    </form>
</body>

</html>