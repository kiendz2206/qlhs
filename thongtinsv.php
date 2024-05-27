<?php
session_start();
if (isset($_SESSION['username'])) {
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>HỌC SINH: <?php echo $ten; ?></title>
    <link rel="stylesheet" href="css/qlhs.css">
    <link rel="stylesheet" href="style/fontawesome/css/all.css">
    <link rel="shortcut icon" href="image/anh4.png">
</head>
<body>
    <header> 
        <div class="container"> 
             <div id="logo">
                  <div id="logoImg">
                       <img src="image/anh4.png" width="30px">
                  </div>
                <a href="index.php">Trường THPT Xuân Phương</a>
             </div>
             <div id="accountName">
                <p> Xin chào ! </p>
                <a href="dangxuat.php" alt="Đăng xuất"> <img src="image/logout.png" width="25px"> </a>
             </div>
        </div>
    </header>
    <!--endheader-->
    <div class="body">
        <div class="container"> 
            <div id="menu">
              <ul>
                  <li><a  href="index.php"><i class="fas fa-home"></i>Trang chủ</a></li>
                  <li><a href="lop.php"><i class="fas fa-users"></i>LỚP</a></li>
                  <li><a id="current" href="hocsinh.php"><i class="fas fa-graduation-cap"></i>HỌC SINH</a></li>
                  <li><a href="giaovien.php"><i class="fas fa-chalkboard-teacher"></i>GIÁO VIÊN</a></li>
                  <li><a href="diemthi.php"><i class="fas fa-check"></i>ĐIỂM THI</a></li>
                  <li><a href="contact.php"><i class="fas fa-address-book"></i>Contact</a></li>
              </ul>
            </div>
            <div id="main-contain"> 
            <h2>HỌC SINH - Thông tin HỌC SINH</h2>
            <div id="thongtin">
                    <div id="avtgiaovien">
                        <?php 
                            $link = new mysqli('localhost', 'root', '', 'hocsinh') or die('kết nối thất bại');
                            mysqli_query($link, 'SET NAMES UTF8');

                            if (isset($_POST['upload'])) {
                                $file = $_FILES['avt'];
                                $file_name = $file['name'];
                                $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
                                $valid_extensions = ["jpg", "jpeg", "png", "gif"];

                                if (!in_array($file_ext, $valid_extensions)) {
                                    echo "<div style='color:red;'>Sai định dạng ảnh. Chỉ chấp nhận .jpg, .jpeg, .png, hoặc .gif.</div>";
                                } else {
                                    move_uploaded_file($file['tmp_name'], "upload/" . $file['name']);
                                    $link_avt = $file['name'];
                                    $q = 'UPDATE hocsinh SET avt = "' . $link_avt . '" WHERE hocsinhID = "' . $_GET['id'] . '"';
                                    mysqli_query($link, $q) or die('không cập nhật được');
                                    echo "<div>Đã cập nhật</div>";
                                }
                            }

                            $query = 'SELECT * FROM hocsinh WHERE hocsinhID = "' . $_GET['id'] . '"';
                            $result = mysqli_query($link, $query);
                            if (mysqli_num_rows($result) > 0) {
                                $r = mysqli_fetch_assoc($result);
                                $lopID = $r['lopID'];
                                $masv = $r['hocsinhID'];
                                $ten = $r['name'];
                                $ngaysinh = date("d-m-Y", strtotime($r['birthday']));
                                $sdt = $r['phonenumber'];
                                $quequan = $r['address'];
                                $sotruong = $r['so_truong'];
                                $avt = $r['avt'];
                            }

                            $q = 'SELECT tenlop FROM lophoc WHERE lopID = "' . $lopID . '"';
                            $rs = mysqli_query($link, $q);
                            $r1 = mysqli_fetch_assoc($rs);
                            $tenlop = $r1['tenlop'];
                            
                            if ($avt == "") {
                                echo '<img src= "image/test.jpg" width="200px" height="200px">';
                            } else {
                                echo '<img src= "upload/' . $avt . '" width="200px" height="200px">';
                            }
                            echo " <br><b> " . $ten . "</b>";
                            echo "<br> MSHS: " . $masv;
                        ?>
                        <form method="post" name="upload_avt" enctype="multipart/form-data">
                            <input type="file" name="avt" id="file" class="input_file"> 
                            <label for="file">chọn file</label>
                            <input type="submit" name="upload" value="upload">
                        </form>
                    </div>
                    <div id="chi_tiet">
                         <?php
                          echo "<big>Họ tên: ";
                          echo $ten. "</big>";
                          echo "<br>Lớp: " . $tenlop . "<br>";
                          echo "<br>Ngày sinh: " . $ngaysinh . "<br>";
                          echo "Số điện thoại: " . $sdt . "<br>";
                          echo "Quê quán: " . $quequan . "<br>";
                          if ($sotruong == "") {
                              echo 'Sở trường: Chưa cập nhật <br>
                                    <br> <span style="color:red">Cập nhật sở trường:</span> <br>
                                    <form method="post">
                                    <textarea name="so_truong"> </textarea>
                                    <input id="btnChapNhan" type="submit" value="Cập nhật học sinh thành công" name="thaydoi"/> ';
                                    if (isset($_POST['thaydoi'])) {
                                        $so_truong = $_POST['so_truong'];
                                        $query = "UPDATE hocsinh SET so_truong = '$so_truong' WHERE name = '$ten'";
                                        mysqli_query($link, $query) or die ('sai định dạng ảnh');
                                        header('location:hocsinh.php');
                                    }
                          } else {
                              echo "Sở trường: " . $sotruong . "<br>";
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
    header('location:login.php');
}
?>
