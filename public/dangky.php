<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="CSS/dangky.css" />
<script language="javascript">
function KiemTra()
{
	var username=document.forms["form"]["user"].value;
	var password = document.forms["form"]["pass"].value;
	var ckpassword = document.forms["form"]["checkpass"].value;
	if (username == "" || password == "" || ckpassword == "")
	{
		alert("Chưa Nhập Đầy Đủ Thông Tin");
		return false;
	}
	if(password != ckpassword)
	{
		alert("Mật Khẩu Và Xác Nhận Mật Khẩu Sai");
		return false;
	}
	return true;
}
</script>
</head>

<body>
	<?php
		session_start();
		$thongbao = "";
		if(isset($_REQUEST["sub"]))
		{
			$user = $_REQUEST["user"];
			$pass = $_REQUEST["pass"];
			$kn = mysql_connect("localhost","root","");
			mysql_select_db("cuahang",$kn);
			mysql_query("set names utf8");
			$checkuser = mysql_query("select * from user where UserName = '$user'");
			if(mysql_num_rows($checkuser)>0)
			{
				$thongbao = "User Đã Có Người Sử Dụng";
			}
			else
			{
				mysql_query("insert into user(UserName,Password,Admin) values ('$user','$pass',0)");
				$_SESSION["user"] = $user;
				$_SESSION["login"] = 0;
				header("location:login.php");
			}
		}
	?>
    <form action="dangky.php" method="post" name="form" onsubmit="return KiemTra()">
        <table class="dk-card">
            <tr>
                <td align='center'>
                    Đăng Ký
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" name="user" placeholder="Tài Khoản">
                    <input type="password" name="pass" placeholder="Mật Khẩu">
                    <input type="password" name="checkpass" placeholder="Nhập Lại Mật Khẩu" />
                    <input type="submit" name="sub" value="Đăng Ký">
                </td>
            </tr>
            <tr>
            	<td align="center">
                	<?php
						if($thongbao != "")
						{
							echo $thongbao;
						}
					?>
                </td>
            </tr>
            <tr>    
                <td class="help">
                    <a href="login.php">Đăng Nhập</a> • <a href="trang1.php">Trang Chủ</a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>
