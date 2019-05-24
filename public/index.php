<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link  href="CSS/login.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function KiemTra()
{
	var username=document.forms["form"]["user"].value;
	var password = document.forms["form"]["pass"].value;
	if (username == "" || password == "")
	{
		alert("Chưa Nhập Tài Khoản Hoặc Mật Khẩu");
		return false;
	}
	return true;
}
</script>
</head>

<body>
	<?php
		session_start();
		$thongbao="";
		if(isset($_REQUEST["dx"]))
		{
			unset($_SESSION["login"]);
			unset($_SESSION["user"]);
		}
	?>
	<form action="login.php" name="form" method="post">
        <table class="login-card">
        <?php
			echo "<tr><td align='center'>";
			if(isset($_REQUEST["login"]))
			{
				$user = $_REQUEST["user"];
				$pass = $_REQUEST["pass"];
				$kn=mysql_connect("localhost","root","");
				mysql_select_db("cuahang",$kn);
				mysql_query("set names utf8");
				$kq = mysql_query("select * from user where UserName = '$user' and Password = '$pass'");
				if(mysql_num_rows($kq)>0)
				{
					while($dong = mysql_fetch_row($kq))
					{
						$_SESSION["user"] = $dong[1];
						$_SESSION["login"] = $dong[3];
					}
					echo "Chào Bạn: <font color='#198F39'>".$_SESSION["user"]."</font><br>";
					if($_SESSION["login"] == 1)
					{
						echo "Bạn Đang Sử Dụng Tài Khoản Quản Trị Viên<br><a href='trang1.php'>Trang Chủ</a>&nbsp;<a href='trang3.php'>Trang Quản Trị</a>";
					}
					else
					{
						echo "Bạn Đang Sử Dụng Tài Khoản Người Dùng<br><a href='trang1.php'>Trang Chủ</a>";
					}
				}
				else
				{
					$thongbao = "Sai user hoac pass";
				}
				echo "<br><a href='login.php?dx=1'>Đăng Xuất</a>";
				mysql_close($kn);
				echo "</td></tr>";
			}
			else
			{
				if(isset($_SESSION["login"]))
				{	
					echo "<tr><td align='center'>";
					echo "Chào Bạn: <font color='#198F39'>".$_SESSION["user"]."</font><br>";			
					if($_SESSION["login"] == 1)
					{
						
						
						echo "Bạn Đang Sử Dụng Tài Khoản Quản Trị Viên<br><a href='trang1.php'>Trang Chủ</a>&nbsp;<a href='trang3.php'>Trang Quản Trị</a>";
					}
					else
					{						
						echo "Bạn Đang Sử Dụng Tài Khoản Người Dùng<br><a href='trang1.php'>Trang Chủ</a>";
					}
					echo "<br><a href='login.php?dx=1'>Đăng Xuất</a>";
					echo "</td></tr>";
				}
				else
				{
					echo "
					<tr>
						<td align='center'>
							Đăng Nhập
						</td>
					</tr>
					<tr>
						<td>
							<input type='text' name='user' placeholder='Tài Khoản'>
							<input type='password' name='pass' placeholder='Mật Khẩu'>
							<input type='submit' name='login' class='login-submit' value='Đăng Nhập' onClick='return KiemTra()'>
						</td>
					</tr>
					<tr>
						<td class='login-help'>
							<a href='dangky.php'>Đăng Ký</a> • <a href='#'>Quên Mật Khẩu</a><br /><a href='trang1.php'>Trang Chủ</a>
						</td>
					</tr>";
					}
			}
		?>
        </table>
    </form>
</body>
</html>