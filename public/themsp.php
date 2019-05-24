<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link href="CSS/themsp.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function KiemTra()
{
	var TenSP=document.forms["form"]["TenSP"].value;
	var Gia = document.forms["form"]["Gia"].value;
	var MoTa = document.forms["form"]["MoTa"].value;
	if (TenSP == "" || Gia == "" || MoTa =="")
	{
		alert("Chưa Nhập Đầy Đủ Thông Tin");
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
			$TenSP = $_REQUEST["TenSP"];
			$Gia = $_REQUEST["Gia"];
			$MatHang = $_REQUEST["MatHang"];
			$TinhTrang = $_REQUEST["TinhTrang"];
			$MoTa = $_REQUEST["MoTa"];
			$name = $_FILES["Hinh"]["name"];
			if($name != NULL)
			{
				move_uploaded_file($_FILES["Hinh"]["tmp_name"],"ImageSQL/".$name);
			}
			$kn = mysql_connect("localhost","root","");
			mysql_select_db("cuahang",$kn);
			mysql_query("set names utf8");
			mysql_query("insert into sanpham(TenSP,Gia,MaMH,TinhTrang,Hinh,MoTa) values ('$TenSP','$Gia','$MatHang','$TinhTrang','$name','$MoTa')");
			$thongbao = "Nhập Thành Công";
		}
	?>
    <form action="themsp.php" method="post" enctype="multipart/form-data" name="form" onSubmit="return KiemTra()">
	<table border="1" cellpadding="0" cellspacing="0" width="500">
    	<tr>
        	<td colspan="2" align="center" height="50">
            	<font>Thêm Sản Phẩm</font>
            </td>
        </tr>
        <tr height="50">
        	<td width="100">
            	Tên Sản Phẩm
            </td>
            <td width="250" align="center">
            	<input type="text" name="TenSP">
            </td>
        </tr>
        <tr height="50">
        	<td width="100">
            	Giá
            </td>
            <td width="250" align="center">
            	<input type="number" name="Gia">
            </td>
        </tr>
        <tr height="50">
        	<td width="100">
            	Mặt Hàng
            </td>
            <td width="250" align="center">
                <select name="MatHang">
				<?php
                     $ketnoi = mysql_connect("localhost","root","");
                     if($ketnoi)
                     {
						mysql_query("set names utf8");
                        mysql_select_db("cuahang",$ketnoi);
                        $ketquaselect=mysql_query("select * from mathang",$ketnoi);
                        if(mysql_num_rows($ketquaselect)>0)
                        {
                            while ($dong = mysql_fetch_row($ketquaselect))
                            {
                                $mamhsl=$dong[0];
                                $tenmhsl=$dong[1];
                                echo "<option value='".$mamhsl."'>".$tenmhsl."</option>";
                            }
                     	}
                     }
                     mysql_close($ketnoi);
                 ?>
                </select>
            </td>
        </tr>
        <tr height="50">
        	<td width="100">
            	Tình Trạng
            </td>
            <td width="250" align="center">
            	<select name="TinhTrang">
                    <option value="1">Còn Hàng</option>
                    <option value="0">Hết Hàng</option>
                </select>
            </td>
        </tr>
        <tr height="50">
        	<td width="100">
            	Hình
            </td>
            <td width="250" align="center">
            	<input type="file" name="Hinh">
            </td>
        </tr>
        <tr height="100">
        	<td width="100">
            	Mô Tả
            </td>
            <td width="250" align="center">
            	<textarea name="MoTa"></textarea>
            </td>
        </tr>
        <tr>
        	<td colspan="2">
            	<input type="submit" name="sub" value="Gửi">
            </td>
        </tr>
        <tr>
        	<td colspan="2" align="center">
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