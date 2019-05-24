<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="CSS/trangadmin.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function KiemTra()
{
	if (confirm('Bạn Muốn Xóa Dữ Liệu Không?')) 
	{
		return true;
	}
	return false;
}
</script>
</head>
</head>

<body>
	<?php
		session_start();
		function ThongTin()
		{
			if(isset($_REQUEST["mamh"]))
			{
				$page = 0;
				$rpp=12;
				if(isset($_REQUEST["page"]))
				{
					$page = $_REQUEST["page"];
				}
				$rpg = $rpp*$page;
				$i = 0;
				$mathang = $_REQUEST["mamh"];																													
				$ketqua1 = mysql_query("select * from sanpham where MaMH = '$mathang'");
				$ketqua2 = mysql_query("select * from sanpham where MaMH = '$mathang' limit $rpg,$rpp"); 
				$sd = mysql_num_rows($ketqua1);																														
				if($sd % $rpp == 0)
				{
					$st = ($sd/$rpp) - 1;
				}
				else
				{
					$st = $sd/$rpp;
				}
				if(mysql_num_rows($ketqua2)>0)
				{
					echo "<tr>";
					while ($dong2 = mysql_fetch_row($ketqua2))
					{
						$masp = $dong2[0];
						$tensp = $dong2[1];
						$gia = $dong2[2];
						$tinhtrang = $dong2[4];
						$img = $dong2[5];
						echo "<td width='180' class='nd'  align='center'>";
						if($img == "")
						{
							$img = "NoImg.jpg";
						}
						echo "<img src='ImageSQL/".$img."' width = '100' height = '100'><br>";
						echo $tensp."<br><font color='#0000FF'>".$gia." Đồng </font>";
						if($tinhtrang == 1)
						{
							echo "<br>Tình Trạng:<font color='#00FF00'>Còn Hàng</font>";
						}
						else
						{
							echo "<br>Tình Trạng:<font color='#666600'>Hết Hàng</font>";
						}
						echo "<br><a href='sua.php?suasp=$masp'>Sửa</a>&nbsp;&nbsp;<a href='trang3.php?mamh=$mathang&xoasp=$masp' onclick='return KiemTra();'>Xóa</a>";
						$i ++;
						if($i ==3)
						{
							echo "</tr><tr>";
							$i=0;
						}
					}
					echo "</tr>";
					echo "<tr><td colspan='3'>";
                    for ($c = 0; $c<=$st; $c++)
					{
						$trang = $c+1;
						echo "<a href='trang3.php?page=$c&mamh=$mathang'>".$trang."</a>&nbsp;&nbsp;";
					} 
                    echo "</td></tr>";										
				}
			}
		}
		if($_SESSION["login"] != 1)
		{
			header("location:trang1.php");
		}
		if(isset($_REQUEST["xoasp"]))
		{
			$maxoasp = $_REQUEST["xoasp"];
			$ketnoixoa = mysql_connect("localhost","root","");
			if($ketnoixoa)
			{	
				mysql_select_db("cuahang",$ketnoixoa);
				mysql_query("Delete From sanpham Where MaSP=".$maxoasp."",$ketnoixoa);	
			}
			mysql_close($ketnoixoa);
		}
	?>
    <form action="trang3.php" method="post">
	<table class="table" border="1" cellpadding="0" cellspacing="0" width="800">
    	<tr>
        	<td class="login" colspan="2">
            	<?php
				if(isset($_SESSION["user"]))
				{
					echo "Xin Chào: <font color='#1FF40E'>".$_SESSION["user"]."</font>";
					echo "&nbsp;<a href='unlogin.php?dx=1'>Đăng Xuất</a>";
				}
				else
				{
            		echo "<a href='login.php'>Đăng Nhập</a> • <a href='dangky.html'>Đăng Ký</a>";
				}
				?>
            </td>
        </tr>
    	<tr>
        	<!-- Banner -->
        	<td colspan="2" width="800" height="200">
            	<img src="Image/quan-tri-website.jpg" width="800" height="200" />
            </td>
        </tr>
        <tr>
        	<!--menu ngang-->
        	<td colspan="2" width="800" height="27" class="menungang">
            	<a href="trang1.php">Trang Chủ</a> | <a href="themsp.php">Thêm Sản Phẩm</a> | <a href="themmh.php">Quản Trị Mặt Hàng</a>        
                <input type="submit" name="SubTimKiem" value=""/>
                <input type="text" name="TimKiem" placeholder="Tìm Kiếm Sản Phẩm"/>
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
									echo "<tr><td class='nemungangMH' height='30'><a href='trang3.php?mamh=$MaMH' class='a'>".$TenMH."</a>
									</td></tr>";
								}
							}
						}
					?>
                </table>
            </td>
            <!-- Nội Dung -->
            <td width="550" valign="top">
            	<table width="550">
                	<tr>
                    	<td class="tdmenu">
                        	<?php
								if(isset($_REQUEST["mamh"]))
								{
									$mathang = $_REQUEST["mamh"];
									$ketqua = mysql_query("select * from mathang where MaMH = '$mathang'");
									if(mysql_num_rows($ketqua)>0)
									{
										while ($dong1 = mysql_fetch_row($ketqua))
										{
											echo $dong1[1];
										}										
									}
								}
							?>
                        </td>
                    </tr>
                    <tr>
                    	<td>
							<table width="550" class="tblNoiDung">
                            	<tr>
                                	<td></td><td></td><td></td>
                                </tr>
                            	<?php
									if(isset($_REQUEST["TimKiem"]))
									{
										$i = 0;
										$TimKiem = $_REQUEST["TimKiem"];
										mysql_query("set names utf8");
										$qrTimKiemMaSP = mysql_query("select * from sanpham where MaSP = '$TimKiem'");
										$qrTimKiemTenSP = mysql_query("select * from sanpham where TenSP = '$TimKiem'");
										if(mysql_num_rows($qrTimKiemMaSP)>0)
										{
											echo "<tr>";
											while ($dong2 = mysql_fetch_row($qrTimKiemMaSP))
											{
												$masp = $dong2[0];
												$tensp = $dong2[1];
												$gia = $dong2[2];
												$tinhtrang = $dong2[4];
												$img = $dong2[5];
												$mathang = $dong2[3];
												echo "<td width='180' class='nd'  align='center'>";
												if($img == "")
												{
													$img = "NoImg.jpg";
												}
												echo "<img src='ImageSQL/".$img."' width = '100' height = '100'><br>";
												echo $tensp."<br><font color='#0000FF'>".$gia." Đồng </font>";
												if($tinhtrang == 1)
												{
													echo "<br>Tình Trạng:<font color='#00FF00'>Còn Hàng</font>";
												}
												else
												{
													echo "<br>Tình Trạng:<font color='#666600'>Hết Hàng</font>";
												}
													echo "<br><a href='sua.php?suasp=$masp'>Sửa</a>&nbsp;&nbsp;<a href='trang3.php?TimKiem=$masp&xoasp=$masp' onclick='return KiemTra();'>Xóa</a>";
												$i ++;
												if($i ==3)
												{
													echo "</tr><tr>";
													$i=0;
												}
											}
											echo "</tr>";
											echo "<tr><td colspan='3'>";
                           		 			for ($c = 0; $c<=$st; $c++)
											{
												$trang = $c+1;
												echo "<a href='trang3.php?page=$c&mamh=$mathang'>".$trang."</a>&nbsp;&nbsp;";
											} 
                            				echo "</td></tr>";
										}
										else
										{
											if(mysql_num_rows($qrTimKiemTenSP)>0)
											{
												echo "<tr>";
											while ($dong2 = mysql_fetch_row($qrTimKiemTenSP))
											{
												$masp = $dong2[0];
												$tensp = $dong2[1];
												$gia = $dong2[2];
												$tinhtrang = $dong2[4];
												$img = $dong2[5];
												$mathang = $dong2[3];
												echo "<td width='180' class='nd'  align='center'>";
												if($img == "")
												{
													$img = "NoImg.jpg";
												}
												echo "<img src='ImageSQL/".$img."' width = '100' height = '100'><br>";
												echo $tensp."<br><font color='#0000FF'>".$gia." Đồng </font>";
												if($tinhtrang == 1)
												{
													echo "<br>Tình Trạng:<font color='#00FF00'>Còn Hàng</font>";
												}
												else
												{
													echo "<br>Tình Trạng:<font color='#666600'>Hết Hàng</font>";
												}
													echo "<br><a href='sua.php?suasp=$masp'>Sửa</a>&nbsp;&nbsp;<a href='trang3.php?TimKiem=$tensp&xoasp=$masp' onclick='return KiemTra();'>Xóa</a>";
												$i ++;
												if($i ==3)
												{
													echo "</tr><tr>";
													$i=0;
												}
											}
											echo "</tr>";											
											}
											else
											{
												echo "Không Tìm Thấy";
											}
										}
									}
									else
									{
										ThongTin();
									}
									mysql_close($kn);									
								?>
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