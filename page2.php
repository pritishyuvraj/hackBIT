<?php
session_start();
$userid=$_SESSION['userid'];
echo "is the userid".$userid;
if(!isset($userid)){
header('Location:index.php');
}

?>

<html>
<body background="photos/books-wallpaper-books-to-read-28990406-1024-768.jpg">
<table width=100% height=100%>
	<tr>
	<td colspan=4 height=10% style="font-family:'Verdana' width: 300px;    height: 100px;    ">
	<b><center><b>
	<font style="font-family:'Impact'; color:white; font-size:250%;">
	Click Here To:
	</font>
	</b></center></b></td>
	</tr>
	<tr>
		<td height=40% colspan=2 style="font-family:'Verdana' width: 300px;    height: 100px; text-decoration:none;"
		><center><i><font size=12><a href="buyborrow.php" style="color: white; text-decoration:none;">Buy<br>OR<br>Borrow</a></font></i></center></td>
		<td height=40% colspan=2 style="font-family:'Verdana' width: 300px;    height: 100px;   ">
		<center><i><font size=12><a href="register.php" style="color: white; text-decoration:none;";>Sell<br>OR<br>Rent</a></font></i></center></td>
	</tr>
	<tr>
		<td height=40% colspan=2 style="font-family:'Verdana' width: 300px;    height: 100px;   "
		><center><i><font size=12><a href="buyborrow.php" style="color: white";></a></font></i></center></td>
		<td height=40% colspan=2 style="font-family:'Verdana' width: 300px;    height: 100px;   "
		><center><i><font size=12><a href="register.php" style="color: white";></a></font></i></center></font></td>
	</tr>
	
	<tr>
	<td colspan=4 height=10%>Developers</td>
	</tr>
</table>
</body>
</html>
	