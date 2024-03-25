<?php
// Kiểm tra nếu người dùng đã gửi dữ liệu đăng nhập
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Kết nối đến cơ sở dữ liệu
    $servername = "localhost";
    $username_db = "root";
    $password_db = "";
    $database = "ql_nhansu";

    $conn = new mysqli($servername, $username_db, $password_db, $database);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
    }

    // Lấy dữ liệu từ form đăng nhập
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Truy vấn SQL để kiểm tra đăng nhập
    $sql = "SELECT * FROM webuser WHERE username='$username' AND password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Đăng nhập thành công, chuyển hướng đến trang nhanvien.php
        header("Location: nhanvien.php");
        exit();
    } else {
        // Đăng nhập không thành công, hiển thị thông báo lỗi
        echo "Tên đăng nhập hoặc mật khẩu không đúng.";
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
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="site.css">
</head>

<body>
    <h2>Đăng nhập</h2>
    <form action="nhanvien.php" method="post">
        <div class="container">
            <label for="username"><b>Tên đăng nhập</b></label>
            <input type="text" placeholder="Nhập tên đăng nhập" name="username" required>

            <label for="password"><b>Mật khẩu</b></label>
            <input type="password" placeholder="Nhập mật khẩu" name="password" required>

            <button type="submit">Đăng nhập</button>
        </div>
    </form>
</body>

</html>