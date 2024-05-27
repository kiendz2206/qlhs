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
                        <li><a href="../lop.php"><i class="fas fa-users"></i>LỚP</a></li>
                        <li><a href="../hocsinh.php"><i class="fas fa-graduation-cap"></i>HỌC SINH</a></li>
                        <li><a id="current" href="../diemthi.php"><i class="fas fa-check"></i>ĐIỂM THI</a></li>
                        <li><a href="../contact.php"><i class="fas fa-address-book"></i>Contact</a></li>
                    </ul>
                </div>
                <div id="main-contain">
                    <h2>Nhập điểm</h2>

                    <div class="form">
                        <br>
                        <br>
                        <form method="post">
                            <table>
                                <tr>
                                    <td>Họ tên </td>
                                    <td>
                                        <select name="ten">
                                            <?php
                                            $q = "SELECT * FROM hocsinh";
                                            $rs = mysqli_query($link, $q);
                                            if (mysqli_num_rows($rs) > 0) {
                                                while ($row = mysqli_fetch_assoc($rs)) {
                                                    $svID = $row['hocsinhID'];
                                                    $tensv = $row['name'];
                                                    echo '<option value="' . $svID . '">' . $tensv . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td>Toán: </td>
                                    <td><input type="text" name="toan"></td>
                                </tr>
                                <tr>
                                    <td>Lý: </td>
                                    <td><input type="text" name="ly"></td>
                                </tr>
                                <tr>
                                    <td>Hóa: </td>
                                    <td><input type="text" name="hoa"></td>
                                </tr>
                                <tr>
                                    <td>Anh: </td>
                                    <td><input type="text" name="anh"></td>
                                </tr>
                                <tr>
                                    <td colspan=2>
                                        <input id="btnChapNhan" type="submit" value="Hoàn tất" name="themdiem"/>
                                    </td>
                                </tr>
                            </table>
                        </form>

                        <?php
                        function validateScore($score) {
                            // Check if the score contains only numbers and is between 0 and 10
                            return is_numeric($score) && $score >= 0 && $score <= 10;
                        }

                        if (isset($_POST['themdiem'])) {
                            $ten = $_POST['ten'];
                            $toan = $_POST['toan'];
                            $ly = $_POST['ly'];
                            $hoa = $_POST['hoa'];
                            $anh = $_POST['anh'];

                            $errorMessages = [];
                            
                            if (!validateScore($toan)) {
                                $errorMessages[] = "Điểm Toán không hợp lệ";
                            }
                            if (!validateScore($ly)) {
                                $errorMessages[] = "Điểm Lý không hợp lệ";
                            }
                            if (!validateScore($hoa)) {
                                $errorMessages[] = "Điểm Hóa không hợp lệ";
                            }
                            if (!validateScore($anh)) {
                                $errorMessages[] = "Điểm Anh không hợp lệ";
                            }

                            if (count($errorMessages) > 0) {
                                foreach ($errorMessages as $msg) {
                                    echo "<p style='color: red;'>$msg</p>";
                                }
                            } else {
                                $query = "INSERT INTO `diemthi`(`hocsinhID`, `toan`, `ly`, `hoa`, `anh`) VALUES ('$ten', '$toan', '$ly', '$hoa', '$anh')";
                                mysqli_query($link, $query) or die("Thêm dữ liệu thất bại");
                                header('location:../xemdiem.php');
                            }
                        }
                        ?>

                        <br>
                        Chọn menu bên trái hoặc click vào <a href="../xemdiem.php" style="color: blue; text-decoration:underline; font-weight:bold;">đây</a> để quay lại bảng điểm.
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
?>
