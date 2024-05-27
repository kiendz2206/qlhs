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
					<a href="dangxuat.php" alt= "Đăng xuất"> <img src="image/logout.png" width="25px"> </a>
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
                      <li><a id="current" href="hocsinh.php" ><i class="fas fa-graduation-cap"></i>HỌC SINH</a></li>
                      <li><a href="giaovien.php"><i class="fas fa-chalkboard-teacher"></i>GIÁO VIÊN</a></li>
                      <li><a href="diemthi.php"><i class="fas fa-check"></i>ĐIỂM THI</a></li>
                      <li><a href="contact.php"><i class="fas fa-address-book"></i>Contact</a></li>
                  </ul>

              </div>
              <div id="main-contain"> 
			  <h2>DANH SÁCH HỌC SINH </h2><br>
			  <div id="listSV">
				<form method= "post" id= "f_search"> <input id = "txtSearch" type="search" name= "search" placeholder = "Nhập tên hoặc MSHS">
				<input id= "btnSearch" type = "submit" name = "tim" value="" > 
				</form> 

							  <table width = "70%">
								<tr>
									<th>STT</th>
									
									<th>Họ Tên</th>
									<th>MSHS</th>
									<th>Ngày sinh</th>
									<th>SĐT</th>
									<th>Địa chỉ</th>
									<th>Chức năng</th>
								</tr>
							 
							<?php
								if (isset($_POST['tim'])){
									$giatri = $_POST['search'];
									//echo $giatri;
									if (empty($giatri))
									{
										echo "Bạn muốn tìm gì?";
									}
									   else
									{
										$query = "SELECT * FROM hocsinh WHERE hocsinh.name LIKE '%".$giatri."%' or hocsinh.hocsinhID = '$giatri'";
									}
									}
								else{
								$query = "SELECT * FROM hocsinh";
								}
								$result = mysqli_query($link, $query);
								if(mysqli_num_rows($result) > 0){
									$i=0;
									while ($r = mysqli_fetch_assoc($result)){
										$i++;
										$hocsinhID = $r['hocsinhID'];
										$ten= $r['name'];
										$ngaysinhsql =$r['birthday'];
										$ngaysinh = date("d-m-Y", strtotime($ngaysinhsql));
										$sdt = $r['phonenumber'];
										$quequan = $r['address'];
										echo "<tr> ";
										echo "<td>$i</td>";	
										echo "<td>$ten</td>"	;
										echo "<td>$hocsinhID</td>";
										echo "<td>$ngaysinh</td>";	
										echo "<td>$sdt</td>"	;
										echo "<td>$quequan</td>"	;
										echo " <td style='text-align: center;'> <a href='chucnang/suasv.php?id=$hocsinhID'><input id='btnSua' type='button' value='sửa' '></a>   <a href='chucnang/xoasv.php?id=$hocsinhID'><input id='btnXoa' type='button' value='xóa'></a> <a href='thongtinsv.php?id=$hocsinhID'><input id='btnChitiet' type='button' value='chi  tiết' '></a>  </td>";
			
										}
									}
								
							?>
							</table>
					  </div>
					
			  <br>
				<form id="formChucnang">
				<a href="chucnang/themSV.php" ><input  id="btnThemSV" type="button" value="THÊM HS"> </a>
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