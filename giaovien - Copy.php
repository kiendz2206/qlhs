<!DOCTYPE html>
<html>
<?php
	$link = new mysqli('localhost','root','','hocsinh') or die('kết nối thất bại '); 
	mysqli_query($link, 'SET NAMES UTF8');
	$query = 'SELECT * FROM giaovien '; 
	$result = mysqli_query($link, $query);
	if( mysqli_num_rows($result) > 0 )
									
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

?>

    <head>
        <meta charset="utf-8">
        <title>GIÁO VIÊN </title>
        <link rel="stylesheet" href="style/qlhs.css">
         <link rel="stylesheet" href="style/fontawesome/css/all.css">
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
					<a href="" alt="Đăng xuất"> <img src="image/logout.png" width="25px"> </a>
				 </div>
            </div>
			
        </header>
        <!--endheader-->
        <div class="body">
			<div class="container"> 
				<div id="menu">
                  <ul>
                      <li> <a href="index.php">Trang chủ</a> </li>
					  <li><a href="lop.php">LỚP</a></li>
                      <li> <a href="hocsinh.php">HỌC SINH</a> </li>
                      <li> <a id="current"  href="giaovien.php">GIÁO VIÊN</a> </li>
                      <li><a href="diemthi.php">ĐIỂM THI</a></li>
                      <li><a href="contact.php">Contact</a></li>
                  </ul>

              </div>
              <div id="main-contain"> 
			  <h2>GIÁO VIÊN KHOA </h2>
			  	<div id= "box_giaovien" > 
			  		
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
											echo "<b>$hotenGV</b></br>";
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
           
        </div>
        <!--endbody-->

       
    </body>
</html>