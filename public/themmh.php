<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link href="CSS/themmh.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function KiemTra()
{
	var TenMH=document.forms["form"]["TenMH"].value;
	if (TenMH == "")
	{
		alert("Chưa Nhập Tên Mặt Hàng");
		return false;
	}
	return true;
}
function Max()
{
	var TenMH=document.forms["form"]["TenMH"].value.length;
	if(TenMH >20)
	{
		alert("Bạn Nhập Tên Mặt Hàng QUá Dài");
		return false;
	}
	return true;
}
</script>
</head>

<body>
	<?php
		session_start();
		if($_SESSION["login"] != 1)
		{
			header("location:trang1.php");
		}
		$thongbao = "";
		if(isset($_REQUEST["sub"]))
		{
			$TenMH = $_REQUEST["TenMH"];
			$kn = mysql_connect("localhost","root","");
			mysql_select_db("cuahang",$kn);
			mysql_query("set names utf8");
			mysql_query("insert into mathang(TenMH) values ('$TenMH')");
			$thongbao = "Nhập Thành Công";
			mysql_close($kn);
		}
	?>
    <form action="themmh.php" method="post" enctype="multipart/form-data" name="form" onSubmit="return KiemTra()">
	<table  cellpadding="0" cellspacing="0">
    	<tr>
        	<td colspan="3" align="center" height="50">
            	<font color="#ED0D10" size="15">Thêm Sản Phẩm</font>
            </td>
        </tr>
        <tr height="50">
        	<td width="100">
            	Tên Mặt Hàng
            </td>
            <td width="250" align="center" colspan="2">
            	<input type="text" name="TenMH" onKeyPress="return Max()">
            </td>
        </tr>
        <tr>
        	<td colspan="3" align="center">
            	<font color="#ED0D10" size="5">Mặt Hàng Đang Có</font>
            </td>
        </tr>
        <tr>
        	<td align="center">
            	Mã Mặt Hàng
            </td>
            <td align="center">
            	Tên Mặt Hàng
            </td>
            <td align="center">
            	Xóa
            </td>
        </tr>
        	<?php
				$kn = mysql_connect("localhost","root","");
				mysql_select_db("cuahang",$kn);
				mysql_query("set names utf8");
				$kq = mysql_query("select * from mathang");
				if(mysql_num_rows($kq)>0)
				{
					while($dong = mysql_fetch_row($kq))
					{
						$MaMH = $dong[0];
						$TenMH = $dong[1];
						echo "<tr><td align='center'>".$MaMH."</td><td align='center'>".$TenMH."</td><td align='center'><a href='xoamh.php?mamh=$MaMH'>Xóa</a></tr>";
					}
				}
				mysql_close($kn);
			?>
        <tr>
        	<td colspan="3">
            	<input type="submit" name="sub" value="Gửi">
            </td>
        </tr>
        <tr>
        	<td colspan="3" align="center">
            	<?php
					if($thongbao != "")
					{
						echo $thongbao."<br>";
					}
				?>
                <a href="trang3.php">Trở Lại</a>
            </td>
        </tr>
    </table>
    </form>
</body>
</html>