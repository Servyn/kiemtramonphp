<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin nhân viên</title>
    <link rel="stylesheet" href="site.css">
</head>

<body>
    <h1>Thông tin nhân viên</h1>
    <table border="1">
        <tr>
            <th>Mã NV</th>
            <th>Tên NV</th>
            <th>Phái</th>
            <th>Nơi Sinh</th>
            <th>Mã Phòng</th>
            <th>Lương</th>
        </tr>
        <?php
        // Kết nối đến cơ sở dữ liệu
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "ql_nhansu";

        $conn = new mysqli($servername, $username, $password, $database);

        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Kết nối đến cơ sở dữ liệu thất bại: " . $conn->connect_error);
        }
        
        $records_per_page = 5;

        // Xác định trang hiện tại
        if (isset($_GET['page']) && is_numeric($_GET['page'])) {
            $current_page = $_GET['page'];
        } else {
            $current_page = 1;
        }
        
        // Tính toán offset (vị trí bắt đầu của bản ghi trên trang hiện tại)
        $offset = ($current_page - 1) * $records_per_page;
        
        // Truy vấn SQL để lấy dữ liệu từ bảng NHANVIEN
        $sql = "SELECT * FROM NHANVIEN LIMIT $offset, $records_per_page";
        $result = $conn->query($sql);

        // Kiểm tra có dữ liệu trả về hay không
        if ($result->num_rows > 0) {
            // Hiển thị dữ liệu từ bảng NHANVIEN
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["Ma_NV"]."</td>";
                echo "<td>".$row["Ten_NV"]."</td>";
                // Kiểm tra giới tính và chèn hình ảnh tương ứng
                if ($row["Phai"] == "NU") {
                    echo '<td><img src="images\woman.jpg" alt="Woman" width="50"></td>';
                } else {
                    echo '<td><img src="images\man.png" alt="Man" width="50"></td>';
                }
                echo "<td>".$row["Noi_Sinh"]."</td>";
                echo "<td>".$row["Ma_Phong"]."</td>";
                echo "<td>".$row["Luong"]."</td>";
                echo "</tr>";
            }
        } else {
            echo "Không có dữ liệu";
        }

        // Đóng kết nối
        // $conn->close();
        ?>

    </table>
    <div class="pagination">
        <?php
    // Truy vấn SQL để lấy tổng số nhân viên
    $sql = "SELECT COUNT(*) AS total_records FROM NHANVIEN";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $total_records = $row['total_records'];

    // Tính tổng số trang
    $total_pages = ceil($total_records / $records_per_page);

    // Hiển thị liên kết đến các trang khác nhau
    for ($i = 1; $i <= $total_pages; $i++) {
        echo "<a href='nhanvien.php?page=$i'>$i</a>";
    }
    echo "<br>";
    echo "<br>";

    echo "<a href='add.php'>Thêm</a> | <a href='delete.php'>Xóa</a> | <a href='edit.php'>Sửa</a> ";
        $conn->close();

    ?>
    </div>
</body>

</html>