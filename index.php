<?php
session_start();

if (isset($_SESSION['username'])) {
    // Kết nối đến cơ sở dữ liệu
    $link = new mysqli('localhost', 'root', '', 'hocsinh') or die('Kết nối thất bại');
    mysqli_query($link, 'SET NAMES UTF8');

    // Xử lý dữ liệu form nếu có
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Thực hiện xử lý dữ liệu form ở đây (nếu cần)
    }

    // Truy vấn lấy dữ liệu từ bảng tintuc
    $query = 'SELECT * FROM tintuc';
    $result = mysqli_query($link, $query);

    // HTML bắt đầu
    ?>
    <!DOCTYPE html>
    <html lang="vi">
    <head>
        <meta charset="utf-8">
        <title>SM - Trang chủ</title>
        <link rel="stylesheet" href="css/qlhs.css">
        <link rel="stylesheet" href="css/fontawesome/css/all.css">
        <link rel="shortcut icon" href="image/anh4.png">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iK7l5MYYAN3bVoaPUN4EjAIs9V44buRY" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <!-- Các đường link CSS khác nếu có -->
    </head>
    <body>
        <!-- Header -->
        <header>
            <div class="container">
                <div id="logo">
                    <div id="logoImg">
                        <img src="image/anh4.png" width="30px">
                    </div>
                    <a href="index.php">Trường THPT Xuân Phương</a>
                </div>
                <div id="accountName">
                    <p>Xin chào!</p>
                    <a href="dangxuat.php" alt="Đăng xuất"><img src="image/logout.png" width="25px"></a>
                </div>
            </div>
        </header>

        <!-- Body -->
        <div class="body">
            <div class="container">
                <!-- Menu -->
                <div id="menu">
                    <ul>
                        <li><a id="current" href="#"><i class="fas fa-home"></i>Trang chủ</a></li>
                        <li><a href="lop.php"><i class="fas fa-users"></i>LỚP</a></li>
                        <li><a href="hocsinh.php"><i class="fas fa-graduation-cap"></i>HỌC SINH</a></li>
                        <li><a href="giaovien.php"><i class="fas fa-chalkboard-teacher"></i>GIÁO VIÊN</a></li>
                        <li><a href="diemthi.php"><i class="fas fa-check"></i>ĐIỂM THI</a></li>
                        <li><a href="contact.php"><i class="fas fa-address-book"></i>Contact</a></li>
                    </ul>
                </div>

                
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <img src="image/anhtruong.jpg" alt="Ảnh trường">
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <h2 class='text-center' style='color: white'>Giới Thiệu</h2><<br>
                                    <p>Trường được xây dựng trên khu đất có diện tích 12.000 m2, với tổng mức đầu tư xây dựng 122 tỷ đồng, trường tọa lạc tại khu đô thị mới xinh đẹp thuộc phường Xuân Phương, quận Nam Từ Liêm, TP Hà Nội. Cảnh quan sư phạm Nhà trường đẹp đẽ, giao thông thông thoáng, khung cảnh yên bình.</p>
                                </div>
                                <div class="col-md-12">
                                    <p>Nhà trường khang trang hiện đại và đồng bộ với đầy đủ các phòng thí nghiệm thực hành của các môn học như Ngoại ngữ, Tin học, Vật lý, Hóa học, Sinh học, KTNN, KTCN, … nhà giáo dục thể chất, sân chơi, bãi tập.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="containerr">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-12">
                            <h2  class='text-center' style='color: white'>Chất Lượng Đào Tạo</h2>
                            </div>
                            <div class="col-md-12">
                                <p>Tỷ lệ giáo viên có trình độ thạc sĩ trở lên chiếm hơn 70%, trong đó có cả trình độ Tiến sĩ, đây là một tỷ lệ giáo viên trên chuẩn rất cao của Thành phố Hà Nội hiện nay</p>
                            </div>
                            <div class="col-md-12">
                                <p>y. Nhiều em đạt thành tích cao trong học tập, đạt giải Ba cấp Thành phố về Khoa học kỹ thuật, Huy chương Vàng, Huy chương Bạc về võ thuật Taewondo, giải Đặc biệt về văn nghệ cấp Quận và đạt 17 giải </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <img src="image/anhtruong2.jpg" alt="Ảnh trường 2">
                        </div>
                    </div>
                </div>

<h1 style='color: white' class='mt-3 mb-3'>Top 3 Học Sinh Xuất Sắc Nhất</h1>               
 <div id="cthome" class="black-text"> 
    
    <div class="student-container">
        <?php
        $link = new mysqli('localhost', 'root', '', 'hocsinh') or die('kết nối thất bại ');

        // Truy vấn để lấy thông tin của 3 sinh viên có điểm cao nhất
        $query = "SELECT hocsinh.name, hocsinh.address, hocsinh.avt, lophoc.tenlop
                FROM hocsinh
                INNER JOIN diemthi ON hocsinh.hocsinhID = diemthi.hocsinhID
                INNER JOIN lophoc ON hocsinh.lopID = lophoc.lopID
                ORDER BY (diemthi.toan + diemthi.ly + diemthi.hoa + diemthi.anh) DESC 
                LIMIT 3";
        
        $result = mysqli_query($link, $query);
        $num_rows = mysqli_num_rows($result);

        if ($num_rows > 0) {
            echo "<div class='student-container' style='display: flex;'>";// chứa tt hócsinh 
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='student'>";
                echo "<img src='upload/" . $row['avt'] . "' alt='Avatar' style='width: 200px; height: 200px; object-fit: cover; border-radius: 50%;'>";
                echo "<p><strong>Họ tên:</strong> " . $row['name'] . "</p>";
                echo "<p><strong>Lớp:</strong> " . $row['tenlop'] . "</p>";
                echo "</div>";
            }

            // Kiểm tra nếu có nhiều hơn 3 sinh viên có điểm cao nhất
            if ($num_rows > 3) {
            
                echo "<div class='student'>";
                echo "<p>Và còn nhiều học sinh  khác cũng có điểm cao nhất.</p>";
                echo "</div>";
            }

            echo "</div>";
        } else {
            echo "Không có học sinh  nào được tìm thấy.";
        }
        ?>
    </div>
</div>

                    
                    <div class="new">
                        <a href="lop.php"><i class="fas fa-users"></i></a>
                        <a href="hocsinh.php"><i class="fas fa-graduation-cap"></i></a>
                        <a href="giaovien.php"><i class="fas fa-chalkboard-teacher"></i></a>
                        <a href="diemthi.php"><i class="fas fa-check"></i></a>
                        <a href="contact.php"><i class="fas fa-address-book"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-r3HYB1CpxVGLs00l+L5T0wz26F3JDO5QKdKlQRsR+ChPnU2ZlDqXgGnFANdFf30F" crossorigin="anonymous"></script>
        <!-- Các đường link JS của Bootstrap và JS khác nếu có -->
    </body>
    </html>
    <?php
    // HTML kết thúc
} else {
    header('location: login.php');
}
?>
