<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
	<?php
		if(isset($_REQUEST["mamh"]))
		{
			$mamh = $_REQUEST["mamh"];
			$kn = mysql_connect("localhost","root","");
			mysql_select_db("cuahang",$kn);
			mysql_query("Delete From mathang Where MaMH=".$mamh."");
			header("location:themmh.php");
		}
	?>
</body>
</html>