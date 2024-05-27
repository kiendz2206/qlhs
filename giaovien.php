<!DOCTYPE html>
<html>
	<?php
		session_start();
		$link = new mysqli('localhost','root','','hocsinh') or die('kết nối thất bại '); 
		mysqli_query($link, 'SET NAMES UTF8');
		$query = 'SELECT * FROM giaovien '; 
		$result = mysqli_query($link, $query);
		if (isset($_SESSION['username'])){
 	
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
			<div class ="ct"> 
						<div class="container"> 
							<div id="menu">
							<ul>
									<li><a  href="index.php"><i class="fas fa-home"></i>Trang chủ</a></li>
			                      <li><a href="lop.php"><i class="fas fa-users"></i>LỚP</a></li>
			                      <li><a href="hocsinh.php" ><i class="fas fa-graduation-cap"></i>HỌC SINH</a></li>
			                      <li><a id = "current" href="giaovien.php"><i class="fas fa-chalkboard-teacher"></i>GIÁO VIÊN</a></li>
			                      <li><a href="diemthi.php"><i class="fas fa-check"></i>ĐIỂM THI</a></li>
			                      <li><a href="contact.php"><i class="fas fa-address-book"></i>Contact</a></li>
							</ul>

							</div>
							<div id="main-contain"> 
							<h2>GIÁO VIÊN KHOA </h2>
								
								
										<?php
												if( mysqli_num_rows($result) > 0 )
												{
													$i = 0; 
													while($row= mysqli_fetch_assoc($result))
													{
														$i++;
														$maso = $row['masoGV'];
														$hotenGV = $row['hoten'];
														$trinhdoGV = $row['trinhdo'];
														$chuyenmonGV = $row['chuyenmon'];
														$email = $row['email'];
														$sdt = $row['sdt'];
														$avt = $row['link_avt_GV'];
														echo '<div class="infgiaovien">
																	<div>
																	<a href="thongtingiaovien.php?id='.$maso.'"><img src="image/';
																	
																if ($avt == '') {
																	echo 'test.jpg';
																}
																else{
																echo $avt;}

																echo '" width="120px" height = "120px">  </a>
																	</div>
																<div>
																';
															echo "<b>$hotenGV</b><br>";
															echo "<i><small>$maso</small></i><br>";
															echo "<i><small>$trinhdoGV</small></i><br>";
															echo "<i><small>email: $email</small></i><br>";
															echo "</div>";
														echo "</div>";
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
	}
	else{
		header('location:dangxuat.php');
	}
?>