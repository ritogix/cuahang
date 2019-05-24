<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
<link rel="stylesheet" href="CSS/dangky.css" />
<script language="javascript">
function KiemTra()
{
	var passwordcu =document.forms["form"]["passcu"].value;
	var passwordmoi = document.forms["form"]["passmoi"].value;
	var ckpassword = document.forms["form"]["checkpass"].value;
	if (passwordcu == "" || passwordcu == "" || ckpassword == "")
	{
		alert("Chưa Nhập Đầy Đủ Thông Tin");
		return false;
	}
	if(passwordmoi != ckpassword)
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
		if(!isset($_SESSION["user"]))
		{
			header("location:trang1.php");
		}
		if(isset($_REQUEST["sub"]))
		{
			$passcu = $_REQUEST["passcu"];
			$passmoi = $_REQUEST["passmoi"];
			$user = $_SESSION["user"];
			$kn = mysql_connect("localhost","root","");
			mysql_select_db("cuahang",$kn);
			mysql_query("set names utf8");
			$checkpass = mysql_query("select * from user where Password = '$passcu'");
			if(mysql_num_rows($checkpass)>0)
			{
				mysql_query("update user set Password = '$passmoi' where UserName = '$user'");
				$thongbao = "Đổi Mật Khẩu Thành Công";
			}
			else
			{
				$thongbao = "Mật Khẩu Cũ Sai";
			}
		}
	?>
    <form action="changepass.php" method="post" name="form" onsubmit="return KiemTra()">
        <table class="dk-card">
            <tr>
                <td align='center'>
				<?php
					if($thongbao !="")
					{ 
						echo $thongbao;
					}
					else
					{
                   		echo "Đổi Mật Khẩu Của Account:".$_SESSION["user"]; 
					}
				?>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="password" name="passcu" placeholder="Mật Khẩu Cũ">
                    <input type="password" name="passmoi" placeholder="Mật Khẩu Mới">
                    <input type="password" name="checkpass" placeholder="Nhập Lại Mật Khẩu" />
                    <input type="submit" name="sub" value="Đăng Ký">
                </td>
            </tr>
            <tr>    
                <td class="help">
                    <a href="trang1.php">Trang Chủ</a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>