<?php
session_start();

if(isset($_POST['login'])) {
    $link = new mysqli('localhost', 'root', '', 'hocsinh') or die('kết nối thất bại '); 
    mysqli_query($link, 'SET NAMES UTF8');
    
    if (empty($_POST['taikhoan']) || empty($_POST['password'])) {
        echo '<p style="color:red;">Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu!</p>';
    } else {
        $username = $_POST['taikhoan'];
        $password = $_POST['password'];

        // Sử dụng Prepared Statements để tránh SQL Injection
        $query = "SELECT password FROM dangnhap WHERE account = ?";
        $stmt = $link->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        // Kiểm tra mật khẩu đã nhập với mật khẩu trong cơ sở dữ liệu
        if (password_verify($password, $hashed_password)) {
            $_SESSION['username'] = $username;
            header('location: index.php');
            exit();
        } else {
            echo '<p style="color:red;">Sai tên đăng nhập hoặc mật khẩu!</p>';
        }

        $stmt->close();
    }

    $link->close();
}
?>

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Đăng nhập admin</title>
    <link rel="stylesheet" href="css/qlhs.css">
    <link rel="shortcut icon" href="image/anh4.png">
</head>
<body>
<header> 
    <div class="container"> 
        <h1 align="center">ADMIN LOGIN </h1>
    </div>
</header>

<div class="body">
    <div class="container"> 
        <div id="formlogin">
            <form method="post" name="login-form">
                <h3>Login System for admin</h3>
                <br>
                <table>
                    <tr height="50px">
                        <td>Account</td>
                        <td><input type="text" name="taikhoan"></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><input type="password" name="password"></td>
                    </tr>
                </table>
                <input id="btndangnhap" type="submit" name="login" value="Login">
                <p>Chưa có tài khoản? <a href="dangky.php">Đăng ký ngay</a></p>
            </form>
        </div>
    </div>
</div>
<footer>
    <div class="container"> 
    </div>
</footer>
</body>
</html>
