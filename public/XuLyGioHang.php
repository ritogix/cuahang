<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
	<form action="#" method="post">
	<?php
		session_start();
		if(isset($_REQUEST["id"]))
		{
			$soluong = $_REQUEST["SoLuong"];
			$id = $_REQUEST["id"];
			$ketnoi = mysql_connect("localhost","root","");
			mysql_select_db("cuahang",$ketnoi);
			mysql_query("set names utf8");
			$kq = mysql_query("Select * from sanpham where MaSP = '$id'");
			$dong = mysql_fetch_row($kq);
			$MaSP = $dong[0];
			$TenSP = $dong[1];
			$Gia = $dong[2];
			$Hinh = $dong[5];
			$spdc = array();
			$spdc[$MaSP]["masanpham"] = $MaSP;
			$spdc[$MaSP]["tensanpham"] = $TenSP;
			$spdc[$MaSP]["hinhanh"] = $Hinh;
			$spdc[$MaSP]["gia"] = $Gia;
			if(!isset($_SESSION["GioHang"]))
			{
				$spdc[$MaSP]["soluong"] = $soluong;
				$_SESSION["GioHang"][$MaSP]= $spdc[$MaSP];
			}
			else
			{
				if(array_key_exists($MaSP,$_SESSION["GioHang"]))
				{
					$_SESSION["GioHang"][$MaSP]["soluong"] += $soluong;
				}
				else
				{
					$spdc[$MaSP]["soluong"] = $soluong;
					$_SESSION["GioHang"][$MaSP] = $spdc[$MaSP];
				}					
			}
			header("location:trang1.php");			
		}
	?>
    </form>
</body>
</html>