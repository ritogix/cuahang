<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link href="CSS/sua.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function KiemTra()
{
	var TenSP = document.forms["form"]["TenSP"].value;
	var Gia = document.forms["form"]["Gia"].value;
	if (TenSP == "" || Gia == "")
	{
		alert("Chưa Nhập Tên Sản Phẩm Hoặc Giá");
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
		if(!isset($_REQUEST["suasp"]))
		{
			header("location:trang3.php");
		}
		function ThongTin()
		{
			if(isset($_REQUEST["suasp"]))
			{
					$masua = $_REQUEST["suasp"];	
			}
			else
			{
				$masua = $_REQUEST["MaSP"];
			}
			$ketnoi=mysql_connect("localhost","root","");
			mysql_select_db("cuahang",$ketnoi);
			mysql_query("set names utf8");
			$ketqua = mysql_query("select * from sanpham where MaSP = '$masua'");
			if(mysql_num_rows($ketqua)>0)
			{
				while($dong = mysql_fetch_row($ketqua))
				{
					$masp = $dong[0];
					$tensp = $dong[1];
					$gia = $dong[2];
					$mamh = $dong[3];
					$tt = $dong[4];
					$img = $dong[5];
					echo "<tr><td height='50'>Mã Sản Phẩm:</td><td>".$masp."</td></tr>
						<tr><td height='50'>Tên Sản Phẩm:</td><td>".$tensp."</td></tr>
						<tr><td height='50'>Giá:</td><td>".$gia."</td></tr>";
					$ketquamh = mysql_query("select * from mathang where MaMH = '$mamh'");
					while ($dongmh = mysql_fetch_row($ketquamh))
					{
						$tenmh = $dongmh[1];
						echo "<tr><td height='50'>Mặt Hàng:</td><td>".$tenmh."</td></tr>";
					}
					if($tt == 1)
					{
						echo "<tr><td height='50'>Tình Trạng:</td><td>Còn</td></tr>";
					}
					else
					{
						echo "<tr><td height='50'>Tình Trạng:</td><td>Hết</td></tr>";
					}
					if($img == "")
					{
						$img = "NoImg.jpg";
					}
					echo "<tr><td height='100'>Hình:</td><td height='100'><img src='ImageSQL/".$img."' width = '100' height = '100'></td></tr>";
				}
			}
			mysql_close($ketnoi);
		}
		$thongbao = "";
		if(isset($_REQUEST["sub"]))
		{
			$name = $_FILES["Hinh"]["name"];
			if($name != NULL)
			{
				move_uploaded_file($_FILES["Hinh"]["tmp_name"],"ImageSQL/".$name);
			}
			$MaSpNhap = $_REQUEST["MaSP"];
			$TenSpNhap = $_REQUEST["TenSP"];
			$GiaNhap = $_REQUEST["Gia"];
			$MatHangNhap = $_REQUEST["MatHang"];
			$TinhTrangNhap = $_REQUEST["TinhTrang"];
			$ketnoi = mysql_connect("localhost","root","");
			mysql_select_db("cuahang",$ketnoi);
			mysql_query("set names utf8");
			mysql_query("Update sanpham set TenSP = '$TenSpNhap', Gia = '$GiaNhap', MaMH = '$MatHangNhap', TinhTrang = '$TinhTrangNhap', Hinh ='$name' where MaSP = '$MaSpNhap'",$ketnoi);
			$thongbao = "Bạn Đã Nhập Thành Công";
			mysql_close($ketnoi);
		}
	?>
	<form action="sua.php" method="post" enctype="multipart/form-data" name="form" onSubmit="return KiemTra();">
	<table border="1" cellpadding="0" cellspacing="0" class="TableChinh">
    	<tr>
        	<td colspan="4" align="center">
            	<font color="#ED1C20" size="20">Trang Sửa Sản Phẩm</font>
            </td>
        </tr>
        <tr>
        	<td valign="top">
            	<table height="300" width="300" cellpadding="0" cellspacing="0">
            	<tr>
                	<td colspan="2" align="center" height="50">
            			<font color="#219214">Thông Tin Cũ</font>
                	</td>
                </tr>
                <?php
						if(isset($_REQUEST["sub"]))
						{
							ThongTin();
							echo "<tr><td colspan='2' align='center'>".$thongbao."</td></tr>";
						}
						else
						{
							ThongTin();
						}
				?>
                </table>
            </td>
            <td valign="top">
            	<table height="300" width="400" cellpadding="0" cellspacing="0" class="tableMoi">
                	<tr>
                    	<td colspan="2" align="center" height="50">
            				<font color="#219214">Thông Tin Mới</font>
                    	</td>
                    </tr>
                    <tr>
                    	<td height="50">
                        	Mã Sản Phẩm:
                        </td>
                        <td height="50">
                        	<?php echo isset($_REQUEST["suasp"])?$_REQUEST["suasp"]:"";
								echo isset($_REQUEST["MaSP"])?$_REQUEST["MaSP"]:""
							?>
                        	<input type="hidden" value="<?php echo isset($_REQUEST["suasp"])?$_REQUEST["suasp"]:"";
															echo isset($_REQUEST["MaSP"])?$_REQUEST["MaSP"]:""?>" name="MaSP" >
                        </td>
                    </tr>
                    <tr>
                    	<td height="50">
                        	Tên Sản Phẩm: 
                        </td>
                        <td height="50">
                        	<input type="text" name="TenSP">
                        </td>
                    </tr>
                    <tr>
                    	<td height="50">
                        	Giá:
                        </td>
                        <td height="50">
                        	<input type="number" name="Gia">
                        </td>
                    </tr>
                    <tr>
                    	<td height="50">
                        	Mặt Hàng:
                        </td>
                        <td height="50">
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
                    <tr>
                    	<td height="50">
                        	Tình Trạng:
                        </td>
                        <td height="50">
                        	<select name="TinhTrang">
                            	<option value="1">Còn Hàng</option>
                                <option value="0">Hết Hàng</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                    	<td height="50">
                        	Hình:
                        </td>
                        <td height="50">
                        	<input type="file" name="Hinh">
                        </td>
                    </tr>
                    <tr>
                    	<td colspan="2" height="50">
                        	<input type="submit" name="sub" value="Nhập">
                            <br><a href="trang3.php">Trở Về</a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    </form>
</body>
</html>