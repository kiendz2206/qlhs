<?php
session_start();
$link = new mysqli('localhost', 'root', '', 'hocsinh') or die('kết nối thất bại '); 
mysqli_query($link, 'SET NAMES UTF8');

if(isset($_POST['DangKy'])){
    $username = $_POST['taikhoan'];
    $password = $_POST['password']; 
    $email = $_POST['email'];
    
    // Mã hóa mật khẩu
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Thực hiện truy vấn để chèn dữ liệu vào cơ sở dữ liệu
    $query = "INSERT INTO dangnhap (account, password, email) VALUES (?, ?, ?)";
    $stmt = $link->prepare($query);
    $stmt->bind_param("sss", $username, $hashed_password, $email);
    $result = $stmt->execute();
    
    // Kiểm tra xem việc đăng ký đã thành công hay không
    if($result){
        echo '<p style="color:green;">Chúc mừng bạn đã đăng ký thành công!</p>';
        // Xóa các giá trị đã nhập để người dùng có thể đăng ký mới nếu muốn
        $_POST['taikhoan'] = '';
        $_POST['password'] = '';
        $_POST['email'] = '';
    } else {
        echo '<p style="color:red;">Đăng ký không thành công. Vui lòng thử lại!</p>';
    }

    // Đóng Prepared Statement
    $stmt->close();
}

if(isset($_POST['login'])) {
    $username = $_POST['taikhoan'];
    $password = $_POST['password'];

    // Lấy mật khẩu đã mã hóa từ cơ sở dữ liệu
    $query = "SELECT password FROM dangnhap WHERE account = ?";
    $stmt = $link->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();

    // Kiểm tra mật khẩu
    if (password_verify($password, $hashed_password)) {
        // Mật khẩu hợp lệ, tiến hành đăng nhập
        $_SESSION['username'] = $username;
        header('location: index.php');
        exit();
    } else {
        // Mật khẩu không hợp lệ
        echo '<p style="color:red;">Sai tên đăng nhập hoặc mật khẩu!</p>';
    }

    $stmt->close();
    $link->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Đăng ký admin</title>
    <link rel="stylesheet" href="css/qlhs.css">
    <link rel="shortcut icon" href="image/anh4.png">
</head>
<body>
<header>
    <div class="container">
        <h1 align="center">ADMIN REGISTRATION</h1>
    </div>
</header>
<!--endheader-->
<div class="body">
    <div class="container">
        <div id="formlogin">
            <form method="post" name="register-form">
                <h3>Form Đăng ký</h3>
                <br>
                <table>
                    <tr height="50px">
                        <td>Tên tài khoản</td>
                        <td><input type="text" name="taikhoan" value="<?php if(isset($_POST['taikhoan'])) echo $_POST['taikhoan']; ?>"></td>
                    </tr>
                    <tr>
                        <td>Mật khẩu</td>
                        <td><input type="password" name="password"></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><input type="email" name="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>"></td>
                    </tr>
                </table>

                <input id="btndangnhap" type="submit" name="DangKy" value="Đăng Ký">
            </form>
            <p>Đã có tài khoản? <a href="login.php">Đăng nhập ngay</a></p>
        </div>
    </div>
</div>
<!--endbody-->
<footer>
    <div class="container">
        <div id="ftcontent">Trường THPT Xuân Phương Application Version 1.0 - Test</div>
    </div>
</footer>
</body>
</html>