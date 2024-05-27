
<!DOCTYPE html>
<html>
<?php
session_start();
if (isset($_SESSION['username'])) {
    $link = new mysqli('localhost', 'root', '', 'hocsinh') or die('kết nối thất bại ');
    mysqli_query($link, 'SET NAMES UTF8');

    // Xử lý sự kiện khi biểu mẫu được gửi đi
    if (isset($_GET['sapxep'])) {
        $sapXepOption = $_GET['sapxep'];

        // Câu truy vấn SQL  dựa trên giá trị của biến sapxep
        $query = "SELECT hocsinh.name, diemthi.toan, diemthi.ly, diemthi.hoa, diemthi.anh 
                  FROM hocsinh, diemthi 
                  WHERE hocsinh.hocsinhID = diemthi.hocsinhID";

        if ($sapXepOption === 'Cao') {
            $query .= " ORDER BY (diemthi.toan + diemthi.ly + diemthi.hoa + diemthi.anh) DESC";
        } elseif ($sapXepOption === 'Thap') {
            $query .= " ORDER BY (diemthi.toan + diemthi.ly + diemthi.hoa + diemthi.anh) ASC";
        }
    } else {
        // Mặc định sắp xếp từ cao đến thấp
        $query = "SELECT hocsinh.name, diemthi.toan, diemthi.ly, diemthi.hoa, diemthi.anh 
                  FROM hocsinh, diemthi 
                  WHERE hocsinh.hocsinhID = diemthi.hocsinhID
                  ORDER BY (diemthi.toan + diemthi.ly + diemthi.hoa + diemthi.anh) DESC";
    }

    $result = mysqli_query($link, $query);
?>

    <head>
        <meta charset="utf-8">
        <title>HỌC SINH</title>
        <link rel="stylesheet" href="css/qlhs.css">
        <link rel="stylesheet" href="style/fontawesome/css/all.css">
		<link rel="shortcut icon" href="image/anh4.png">
    </head>
    <body>
        <header> 
            <div class="container"> 
                 <div id="logo">
					  <div id="logoImg">
						   <img src="image/anh4.png " width="30px">
					  </div>
					<a href="index.php">Trường THPT Xuân Phương</a>
				 </div>
				<div id="accountName">
					
					<p> Xin chào ! </p>
					<a href="dangxuat.php" alt="Đăng xuất"> <img src="image/logout.png" width="25px"> </a>
				</div>
            </div>
			
        </header>
        
        <div class="body">
			<div class="container"> 
				<div id="menu">
                  <ul>
                     <li><a  href="index.php"><i class="fas fa-home"></i>Trang chủ</a></li>
                      <li><a href="lop.php"><i class="fas fa-users  "></i>LỚP</a></li>
                      <li><a href="hocsinh.php" ><i class="fas fa-graduation-cap"></i>HỌC SINH</a></li>
                      <li><a href="giaovien.php"><i class="fas fa-chalkboard-teacher"></i>GIÁO VIÊN</a></li>
                      <li><a id="current" href="diemthi.php"><i class="fas fa-check"></i>ĐIỂM THI</a></li>
                      <li><a href="contact.php"><i class="fas fa-address-book"></i>Contact</a></li>
                  </ul>
             	</div>
             	 <div id="main-contain"> 
			  			<h2>BẢNG ĐIỂM </h2></br>
						  <form method="GET" action="">
                    <div class="form-group">
                        <label for="sapxep">Sắp Xếp</label>
                        <select class="form-control" name="sapxep" id="sapxep">
                            <option value="Cao">Cao đến Thấp</option>
                            <option value="Thap">Thấp đến Cao</option>
                        </select>
                        <input type="submit" value="Ok">
                    </div>
                </form>
				<div id="listSV">
                    <table width="70%">
                        
                        <tr>
                            <th>STT</th>
                            <th>Học Sinh</th>
                            <th>Toán</th>
                            <th>Lý</th>
                            <th>Hóa</th>
                            <th>Anh</th>
                            <th>TBC</th>
                            <th>Xếp loại</th>
                        </tr>

                        <?php
                        $i=0;
                       while ($r = mysqli_fetch_assoc($result)) {   // trích xuất dữ liệu của mỗi hàng dưới dạng một mảng kết hợp
                        $i++;
                        $ten = $r['name'];
                        $toan = $r['toan'];
                        $ly = $r['ly'];
                        $hoa = $r['hoa'];
                        $anh = $r['anh'];  
                        $TBC = ($toan + $ly + $hoa + $anh) / 4;
                    
                        
                        if ($TBC >= 9) {
                            $xepLoai = 'Xuất sắc';
                        } elseif ($TBC >= 8) {
                            $xepLoai = 'Giỏi';
                        } elseif ($TBC >= 6.5) {
                            $xepLoai = 'Khá';
                        } elseif ($TBC >= 5) {
                            $xepLoai = 'Trung bình';
                        } else {
                            $xepLoai = 'Yếu';
                        }
                    
                        echo "<tr> ";
                        echo "<td>$i</td>";
                        echo "<td>$ten</td>";
                        echo "<td align= 'center'>$toan</td>";
                        echo "<td align= 'center'>$ly</td>";
                        echo "<td align= 'center'>$hoa</td>";
                        echo "<td align= 'center'>$anh</td>";
                        echo "<td align= 'center'>$TBC</td>";
                        echo "<td align= 'center'>$xepLoai</td>";
                        echo "</tr>";
                    }
                    
                        ?>
                    </table>
                </div>
						<form id="formChucnang">
							<a href="chucnang/themdiem.php" ><input  id="btnThemSV" type="button" value="THÊM ĐIỂM"> </a>
						</form>
              		</div>
            </div>
           
        </div>
       
    </body>
</html>
<?php
	}
	else {
		header('location:login.php');
	}
?>