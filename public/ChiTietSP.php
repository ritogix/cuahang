<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="CSS/ChitietSP.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<?php
		session_start();
		if(isset($_REQUEST["MaSP"]))
		{
			$MaSP = $_REQUEST["MaSP"];
			$kn = mysql_connect("localhost","root","");
			mysql_select_db("cuahang",$kn);
			mysql_query("set names utf8");
			$kq = mysql_query("select * from sanpham where MaSP = '$MaSP'");
			$dong = mysql_fetch_row($kq);
			$TenSP = $dong[1];
			$Gia = $dong[2];
			$MaMH = $dong[3];
			$TinhTrang = $dong[4];
			$Hinh = $dong[5];
			$MoTa = $dong[6];
		}
	?>
    <form action="XuLyGioHang.php" method="post">
	<table class="table" border="1" cellpadding="0" cellspacing="0" width="800">
    	<tr>
        	<td class="login" colspan="2">
            	<?php
				if(isset($_SESSION["user"]))
				{
					echo "Xin Chào: <font color='#1FF40E'>".$_SESSION["user"]."</font>";
					echo "&nbsp;<a href='unlogin.php?dx=1'>Đăng Xuất</a>";
					echo "&nbsp;<a href='trang3.php'>Trang Quản Trị</a>";
				}
				else
				{
            		echo "<a href='login.php'>Đăng Nhập</a> • <a href='dangky.php'>Đăng Ký</a>";
				}
				?>
            </td>
        </tr>
    	<tr>
        	<!-- Banner -->
        	<td colspan="2" width="800" height="200">
            	<img src="Image/Banner.jpg" width="800" height="200" />
            </td>
        </tr>
        <tr>
        	<!--menu ngang-->
        	<td colspan="2" width="800" height="27" class="menungang">
            	<a href="trang1.php"><img src="Image/TC1.gif" onmouseover="this.src='Image/TC2.gif'" onmouseout="this.src='Image/TC1.gif'"/></a>
            	<a href="trang1.php"><img src="Image/GT1.gif" onmouseover="this.src='Image/GT2.gif'" onmouseout="this.src='Image/GT1.gif'"/></a>
                <a href="trang1.php"><img src="Image/DV1.gif" onmouseover="this.src='Image/DV2.gif'" onmouseout="this.src='Image/DV1.gif'"/></a>                
                <a href="trang1.php"><img src="Image/LH1.gif" onmouseover="this.src='Image/LH2.gif'" onmouseout="this.src='Image/LH1.gif'"/></a>
                <input type="text" name="TimKiem" placeholder="Tìm Kiếm Sản Phẩm"/>
                <input type="submit" value="" name="SubTimKiem"/></td>
        </tr>
        <tr>
        	<!--menu trai-->
        	<td width="250" valign="top" class="menutrai">
            	<table width="250" cellpadding="0" cellspacing="0">
                	<tr>
                    	<td class="tdmenu" align="center" height="25">
                        	DANH SÁCH CÁC SẢN PHẨM
                        </td>
                    </tr>
                    
                    <?php
						$kn = mysql_connect("localhost","root","");
						if($kn)
						{
							mysql_select_db("cuahang",$kn);
							mysql_query("set names utf8");
							$kq = mysql_query("Select * From mathang");
							if(mysql_num_rows($kq)>0)
							{
								while($dong = mysql_fetch_row($kq))
								{
									$MaMH = $dong[0];
									$TenMH = $dong[1];
									echo "<tr><td class='nemungangMH' height='30'><a href='trang2.php?mamh=$MaMH'>".$TenMH."</a></td></tr>";
								}
							}
						}
						mysql_close($kn);
					?>
                </table>
            </td>
            <!-- Nội Dung -->
            <td width="550" valign="top">
            	<table width="550">
                	<tr>
                    	<td class="tdmenu">
                        	BẢN TIN CỬA HÀNG
                        </td>
                    </tr>
                    <tr>
                    	<td>
                        	<table width="550" class="noidung">
                            	<tr>
                                	<td colspan="2" align="center">
                                    	<font color="#F7070B">Thông Tin Sản Phẩm <?php echo $TenSP; ?></font>
                                    </td>
                                </tr>
								<?php      
									if($Hinh =="")
									{
										$Hinh = "NoImg.jpg";
									}
                                    	echo "<tr valign='top'>
													<td width='250'><img src='ImageSQL/".$Hinh."' width = '250' height = '250'></td>";
										echo "		<td width='300'>".$MoTa."</td>
											</tr>";	
										echo "<tr width='550'><td colspan='2' align='center'>Số Lượng: <input type='text' name='SoLuong'><br>
											<input type='submit' name='sub' value='Đặt Hàng'>
											<a href='trang1.php'>Quay Lại Trang Chủ</a>
											</td>";						
								?>
                                <input type="hidden" value="<?php echo $MaSP;?>" name="id">
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
        	<td colspan="2">
            	booter
            </td>
        </tr>
    </table>
    </form>
</body>
</html>