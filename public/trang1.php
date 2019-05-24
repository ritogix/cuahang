<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="CSS/trangchu.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<?php
		session_start();
	?>
    <form action="trang2.php" method="post">
	<table class="table" cellpadding="0" cellspacing="0" width="800">
    	<tr>
        	<td class="login">
            	<?php
				if(isset($_SESSION["user"]))
				{
					echo "Xin Chào: <font color='#1FF40E'>".$_SESSION["user"]."</font>";
					echo "&nbsp;<a href='unlogin.php?dx=1'>Đăng Xuất</a>";
					echo "&nbsp;<a href='trang3.php'>Quản Trị</a>";
				}
				else
				{
            		echo "<a href='login.php'>Đăng Nhập</a> • <a href='dangky.php'>Đăng Ký</a>";
				}
				?>
            </td>
            <td class="login">
            <?php
            	$soluong = 0;
				if(isset($_SESSION["GioHang"]))
				{
					foreach($_SESSION["GioHang"] as $sp)
					{
						$soluong += $sp["soluong"];
					}
				}
				echo "Bạn Có: <font color='#4509D7'>".$soluong."</font> Sản Phẩm Trong";
				echo "&nbsp;<a href='ChiTietGioHang.php'>Giỏ Hàng</a>";
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
                        	<p>
                            <font color="#0066CC" class="td">SỰ KIỆN MỪNG SINH NHẬT</font><br />
							Đặc biệt chào mừng sinh nhật. Chúng tôi mang đến cho quý khách sự kiện ưu đãi đặc biệt sau:
Ngày: Bắt đầu từ ngày 06/09/2016
Nhận ngay voucher 100.000 đồng khi mua đơn hàng từ 500.000 đồng trở lên tại Linh Kiện 69 (chỉ áp dụng khi mua trực tiếp tại cửa hàng)
Chú ý: quý khách đến mua tại cửa hàng với đơn hàng trên 300.00đ sẽ vừa được chiết khấu và tặng voucher.
                            </p>
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