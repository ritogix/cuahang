<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="CSS/GioHang.css" rel="stylesheet" type="text/css" />
<title>Untitled Document</title>
</head>

<body>
	<?php
		session_start();
		if(isset($_SESSION["GioHang"]))
		{
			echo "
			<table cellpadding='0' cellspacing='0' align='center'>
				<tr>
					<td colspan='7' align='center'>
						<font color='#F5070B' size='20'>THÔNG TIN GIỎ HÀNG</font>
					</td>
				</tr>
				<tr class='thongtin'>
					<td width='100' align='center'>
						Mã Sản Phẩm
					</td>
					<td width='100' align='center'>
						Tên Sản Phẩm
					</td>
					<td width='100' align='center'>
						Giá
					</td>
					<td width='100' align='center'>
						Hình
					</td>
					<td width='100' align='center'>
						Số Lượng
					</td>
					<td width='100' align='center'>
						Thanh Tien
					</td>
					<td width='100' align='center' id='cuoi'>
						Xoa
					</td>
				</tr>";
					foreach($_SESSION["GioHang"] as $sp)
					{
						$masp = $sp["masanpham"];
						$tensp = $sp["tensanpham"];
						$hinh = $sp["hinhanh"];
						$gia = $sp["gia"];
						$soluong = $sp["soluong"];
						$thanhtien = $soluong * $gia;
						if($hinh == "")
						{
							$hinh = "NoImg.jpg";
						}
						echo "<tr class='thongtinnd'>
								<td width='100' align='center'>".$masp."</td>
								<td width='100' align='center'>".$tensp."</td>								
								<td width='100' align='center'>".$gia."</td>
								<td width='100' align='center'><img src='ImageSQL/".$hinh."' width = '100' height = '100'></td>
								<td width='100' align='center'>".$soluong."</td>
								<td width='100' align='center'>".$thanhtien."</td>
								<td width='100' align='center' id='cuoi'><a href='xoagiohang.php?id=$masp'>Xóa</a></td>
							</tr>";
					}
			echo "<tr><td colspan='7' align='right'><a href='trang1.php'>Tiếp Tục Mua Hàng</a></td></tr></table>";
		}
	?>
</body>
</html>