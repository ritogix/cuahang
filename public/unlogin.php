<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
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
		header("location:trang1.php");
	?>
</body>
</html>