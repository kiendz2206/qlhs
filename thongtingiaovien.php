
<?php
	session_start();
	if (isset($_SESSION['username'])){
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>GIÁO VIÊN: <?php echo $hotenGV; ?> </title>
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
                       <li><a  href="index.php"><i class="fas fa-home"></i>Trang chủ</a></li>
                      <li><a href="lop.php"><i class="fas fa-users"></i>LỚP</a></li>
                      <li><a href="hocsinh.php" ><i class="fas fa-graduation-cap"></i>HỌC SINH</a></li>
                      <li><a id="current" href="giaovien.php"><i class="fas fa-chalkboard-teacher"></i>GIÁO VIÊN</a></li>
                      <li><a href="diemthi.php"><i class="fas fa-check"></i>ĐIỂM THI</a></li>
                      <li><a href="contact.php"><i class="fas fa-address-book"></i>Contact</a></li>
                  </ul>

              </div>
              <div id="main-contain"> 
			  <h2>GIÁO VIÊN - Thông tin GIÁO VIÊN </h2>
			  	<div id="thongtin">
			  			<div id="avtgiaovien">
			  				<?php 
			  					$link = new mysqli('localhost','root','','hocsinh') or die('kết nối thất bại '); 
								mysqli_query($link, 'SET NAMES UTF8');
								if (isset($_POST['upload'])){
									$file = $_FILES['avt'];
									move_uploaded_file($file['tmp_name'], "upload/".$file['name']);
									$link_avt = $file['name'];
									$query = 'UPDATE giaovien SET link_avt_GV = "'.$link_avt.'" WHERE  masoGV ="'.$_GET['id'].'"';
									mysqli_query($link, $query) or die('không thành công');
								}
								$query = 'SELECT * FROM giaovien WHERE masoGV = "'.$_GET['id'].'" '; 
								$result = mysqli_query($link, $query);
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
										}
									}
			  					if ($avt == '') {
												echo '<img src= "image/test.jpg" width="200px" height="200px">';
											}
			  					else echo '<img src= "upload/'.$avt.'" width="200px" height="200px">';
			  					echo " <br><b> ".$hotenGV."</b>";
			  				?>
			  				<form method="post" name="upload_avt" enctype="multipart/form-data">
			  					<input type="file" name = "avt" id="file" class="input_file"> 
			  					<label for ="file"> Chọn ảnh</label>
			  					<input type="submit" name = "upload" value= "Thay đổi">

			  				</form>
			  				
			  			</div>
			  			<div id="chi_tiet">
			  				 <?php
			  				  
			  				  echo "<big>".$hotenGV. "</big><br><br>";
			  				  echo $trinhdoGV . "<br>";
			  				  echo "MSGV: " .$maso . "<br>";
			  				  echo "Email: " .$email . "<br>";
			  				  echo "Điện thoại: " .$sdt. ".";
			  				?>
			  			</div>
			  	</div>
				
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