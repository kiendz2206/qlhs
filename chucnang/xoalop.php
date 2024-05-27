

<?php
	$link = new mysqli('localhost','root','','hocsinh') or die('kết nối thất bại '); 
	mysqli_query($link, 'SET NAMES UTF8');
						
	if(isset($_GET['id'])){
	$idlop = $_GET['id'];
	$query = "DELETE FROM `lophoc` WHERE lopID='$idlop'";
	mysqli_query($link,$query) or die("lớp có HỌC SINH không thể xóa");
    header('location:../lop.php');
						}
?>