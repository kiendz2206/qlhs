<!DOCTYPE html>
<html>
<?php
	session_start();
	if (isset($_SESSION['username'])){
	$link = new mysqli('localhost','root','','hocsinh') or die('kết nối thất bại '); 
	mysqli_query($link, 'SET NAMES UTF8');
?>

    <head>
        <meta charset="utf-8">
        <title>GIÁO VIÊN </title>
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
        <!--endheader-->
        <div class="body">
			<div class="container"> 
				<div id="menu">
                  <ul>
                    <li><a href="index.php"><i class="fas fa-home"></i>Trang chủ</a></li>
                      <li><a href="lop.php"><i class="fas fa-users"></i>LỚP</a></li>
                      <li><a href="hocsinh.php" ><i class="fas fa-graduation-cap"></i>HỌC SINH</a></li>
                      <li><a href="giaovien.php"><i class="fas fa-chalkboard-teacher"></i>GIÁO VIÊN</a></li>
                      <li><a id = "current" href="diemthi.php"><i class="fas fa-check"></i>ĐIỂM THI</a></li>
                      <li><a href="contact.php"><i class="fas fa-address-book"></i>Contact</a></li>
                  </ul>
            	</div>
              <div id="main-contain"> 
			  <h2>ĐIỂM THI </h2>
				<div class= "chucnang">
						<div class="infgiaovien">
						<div>
							<a href="xemdiem.php"><img src="image/xem.jpg" width="120px" height="120px";>  </a>
						</div>
						<div>
							<b> XEM ĐIỂM </b> </br>
						</div>
					</div>
					<div class="infgiaovien">
						<div>
							<a href="suadiem.php"><img src="image/sua.jpg" width="120px" height="120px";>  </a>
						</div>
						<div>
							<b> SỬA ĐIỂM  </b> </br>
						</div>
					</div>
				</div>
				
              </div>
                    
            </div>
           
        </div>

       
    </body>
</html>
<?php
	}
	else 
	{
		 header('location: login.php');
	}
?>