<?php
session_start();
if (isset($_SESSION['username'])) {
    $link = new mysqli('localhost', 'root', '', 'hocsinh') or die('kết nối thất bại');
    mysqli_query($link, 'SET NAMES UTF8');
    
    $id = $_GET['id'];
    $query = 'SELECT * FROM hocsinh WHERE hocsinhID = "' . $id . '"';
    $result = mysqli_query($link, $query);
    
    if (mysqli_num_rows($result) > 0) {
        $ten = '';
        $ngaysinh = '';
        $sdt = '';
        $quequan = '';
        while ($r = mysqli_fetch_assoc($result)) {
            $ten = $r['name'];
            $ngaysinh = $r['birthday'];
            $sdt = $r['phonenumber'];
            $quequan = $r['address'];
        }
    }

    function isValidPhoneNumber($number) {
        return preg_match('/^0\d{9}$/', $number);
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sửa thông tin HỌC SINH</title>
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
                <p> Xin chào!</p>
                <a href="../dangxuat.php" alt="Đăng xuất"><img src="../image/logout.png" width="25px"></a>
            </div>
        </div>
    </header>
    <div class="body">
        <div class="container">
            <div id="menu">
                <ul>
                    <li><a href="../index.php"><i class="fas fa-home"></i>Trang chủ</a></li>
                    <li><a href="../lop.php"><i rfas fa-users"></i>LỚP</a></li>
                    <li><a id="current" href="../hocsinh.php"><i class="fas fa-graduation-cap"></i>HỌC SINH</a></li>
                    <li><a href="../giaovien.php"><i class="fas fa-chalkboard-teacher"></i>GIÁO VIÊN</a></li>
                    <li><a href="../diemthi.php"><i class="fas fa-check"></i>ĐIỂM THI</a></li>
                    <li><a href="../contact.php"><i class="fas fa-address-book"></i>Contact</a></li>
                </ul>
            </div>
            <div id="main-contain">
                <h2>Sửa thông tin HỌC SINH</h2>
                <div class="form">
                    <span style="font-size: 20px; color: red; font-style: italic;"><b>Mời nhập lại thông tin HỌC SINH <?php echo $ten; ?>:</b></span>
                    <br>(Chú ý điền đủ thông tin)
                    <br><br>
                    <form method="post">
                        <table>
                            <tr>
                                <td>Họ tên</td>
                                <td><input type="text" name="ten" value="<?php echo $ten; ?>"></td>
                            </tr>
                            <tr>
                                <td>Ngày sinh</td>
                                <td><input type="date" name="ngaysinh" value="<?php echo $ngaysinh; ?>"></td>
                            </tr>
                            <tr>
                                <td>Số điện thoại</td>
                                <td><input type="text" name="sdt" value="<?php echo $sdt; ?>"></td>
                            </tr>
                            <tr>
                                <td>Quê quán</td>
                                <td><input type="text" name="quequan" value="<?php echo $quequan; ?>"></td>
                            </tr>
                            <tr>
                                <td colspan=2>
                                    <input type="submit" value="Hoàn tất" name="sua"/>
                                </td>
                            </tr>
                        </table>
                    </form>
                    <?php
                    if (isset($_POST['sua'])) {
                        $hotenSV = $_POST['ten'];
                        $ngaySinh = $_POST['ngaysinh'];
                        $sDt = $_POST['sdt'];
                        $queQuan = $_POST['quequan'];

                        if (empty($hotenSV) || empty($ngaySinh) || empty($sDt) || empty($queQuan)) {
                            echo '</br><p style="color:red;font-weight:bold;">Vui lòng không để trống các trường!</p></br>';
                        } elseif (!isValidPhoneNumber($sDt)) {
                            echo '</br><p style="color:red;font-weight:bold;">Số điện thoại không hợp lệ: Phải gồm 10 chữ số và bắt đầu bằng số 0, không có ký tự đặc biệt.</p></br>';
                        } else {
                            $query = "UPDATE hocsinh SET name = '$hotenSV', birthday = '$ngaySinh', phonenumber = '$sDt', address = '$queQuan' WHERE hocsinhID = '$id'";
                            mysqli_query($link, $query) or die("sửa không thành công");
                            header('location:../hocsinh.php');
                        }
                    }
                    ?>
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
