<!DOCTYPE html>
<html>
<?php
session_start();
if (isset($_SESSION['username'])) {
    $link = new mysqli('localhost', 'root', '', 'hocsinh') or die('kết nối thất bại');
    mysqli_query($link, 'SET NAMES UTF8');
?>

<head>
    <meta charset="utf-8">
    <title>HỌC SINH</title>
    <link rel="stylesheet" href="../css/qlhs.css">
    <link rel="stylesheet" href="../style/fontawesome/css/all.css">
    <link rel="shortcut icon" href="../image/anh4.png">
</head>

<body>
    <header>
        <div class="container">
            <div id="logo">
                <div id="logoImg">
                    <img src="../image/anh4.png" width="30px">
                </div>
                <a href="../index.php">Trường THPT Xuân Phương</a>
            </div>
            <div id="accountName">
                <p> Xin chào! </p>
                <a href="../dangxuat.php" alt="Đăng xuất"> <img src="../image/logout.png" width="25px"> </a>
            </div>
        </div>
    </header>
    <!--endheader-->
    <div class="body">
        <div class="container">
            <div id="menu">
                <ul>
                    <li><a href="../index.php"><i class="fas fa-home"></i>Trang chủ</a></li>
                    <li><a href="lop.php"><i class="fas fa-users"></i>LỚP</a></li>
                    <li><a id="current" href="../hocsinh.php"><i class="fas fa-graduation-cap"></i>HỌC SINH</a></li>
                    <li><a href="../giaovien.php"><i class="fas fa-chalkboard-teacher"></i>GIÁO VIÊN</a></li>
                    <li><a href="../diemthi.php"><i class="fas fa-check"></i>ĐIỂM THI</a></li>
                    <li><a href="../contact.php"><i class="fas fa-address-book"></i>Contact</a></li>
                </ul>
            </div>
            <div id="main-contain">
                <h2>Thêm HỌC SINH</h2>

                <div class="form">
                    <span style="font-size: 20px; color: red; font-style: italic"><b>Mời nhập thông tin HỌC SINH:</b></span>
                    <br>
                    (Chú ý điền đủ thông tin)

                    <br><br>
                    <form method="post">
                        <table>
                            <tr>
                                <td>Họ tên</td>
                                <td><input type="text" name="ten" autofocus></td>
                            </tr>
                            <tr>
                                <td>Ngày sinh</td>
                                <td><input type="date" name="ngaysinh"></td>
                            </tr>
                            <tr>
                                <td>Số điện thoại</td>
                                <td><input type="text" name="sdt"></td>
                            </tr>
                            <tr>
                                <td>Quê quán</td>
                                <td><input type="text" name="quequan"></td>
                            </tr>
                            <tr>
                                <td>Chọn Lớp</td>
                                <td>
                                    <select name="lop">
                                        <?php
                                            $q = "SELECT * FROM lophoc";
                                            $rs = mysqli_query($link, $q);
                                            if (mysqli_num_rows($rs) > 0) {
                                                while ($row = mysqli_fetch_assoc($rs)) {
                                                    $lopID = $row['lopID'];
                                                    $tenlop = $row['tenlop'];
                                                    echo "<option value='$lopID'>$tenlop</option>";
                                                }
                                            }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td colspan=2>
                                    <input id="btnChapNhan" type="submit" value="Hoàn tất" name="them"/>
                                </td>
                            </tr>
                        </table>
                    </form>

                    <?php
                    if (isset($_POST['them'])) {
                        $hotenSV = $_POST['ten'];
                        $ngaySinh = $_POST['ngaysinh'];
                        $lopID = $_POST['lop'];
                        $sDt = $_POST['sdt'];
                        $queQuan = $_POST['quequan'];

                        function isValidPhoneNumber($number) {
                            return preg_match('/^0\d{9}$/', $number);
                        }

                        if (empty($hotenSV) || empty($ngaySinh) || empty($sDt) || empty($queQuan)) {
                            echo '<p style="color:red;font-weight:bold;">Bạn chưa nhập thông tin đầy đủ!</p>';
                        } elseif (!isValidPhoneNumber($sDt)) {
                            echo '<p style="color:red;font-weight:bold;">Số điện thoại không hợp lệ: Phải gồm 10 chữ số và bắt đầu bằng số 0, không có ký tự đặc biệt.</p>';
                        } else {
                            $query = "INSERT INTO hocsinh (name, lopID, birthday, phonenumber, address) VALUES ('$hotenSV', '$lopID', '$ngaySinh', '$sDt', '$queQuan')";
                            mysqli_query($link, $query) or die("thêm dữ liệu thất bại");
                            header('location:../hocsinh.php');
                        }
                    }
                    ?>

                    <br>
                    Chọn menu bên trái hoặc click vào <a href="../hocsinh.php" style="color: blue; text-decoration:underline; font-weight:bold;">đây</a> để quay lại danh sách HỌC SINH.
                    <br>
                    <br>

                </div>
            </div>
        </div>
    </div>

</body>
</html>

<?php
} else {
    header('location:../login.php');
}
