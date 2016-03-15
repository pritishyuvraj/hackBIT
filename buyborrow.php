<?php
session_start();
error_reporting(0);
$userid=$_SESSION['userid'];
if(!isset($userid)){
	header('Location:index.php');
}
$con_db=mysqli_connect("localhost","root","","hackbit");
if(!isset($_POST["searchBy"])){
//echo"I at default";
	$store="SELECT * FROM seller WHERE approval=0";
	$items=mysqli_query($con_db,$store);
}
else if(isset($_POST["name"]) && isset($_POST["searchBy"])){
//echo"here too";
	$name="%".$_POST["name"]."%";
	//echo $name;
	$itemsname="SELECT * FROM seller WHERE approval=0 and book like '$name'";
	$items=mysqli_query($con_db,$itemsname);
}
else if(isset($_POST["branch"]) && isset($_POST["searchBy"])){
	$branch="%".$_POST["branch"]."%";
//	echo $branch;
	$itemsbranch="SELECT * FROM seller WHERE approval=0 and branch like '$branch'";
	$items=mysqli_query($con_db,$itemsbranch);
}
else if(isset($_POST["sem"]) && isset($_POST["searchBy"])){
	$sem="%".$_POST["sem"]."%";
//	echo $sem;
	
	$itemssem="SELECT * FROM seller WHERE approval=0 and sem like '$sem'";
	$items=mysqli_query($con_db,$itemssem);
//	echo "The error is".mysqli_error($con_db);
}

else if(isset($_POST["type"]) && isset($_POST["searchBy"])){
	$branch="%".$_POST["type"]."%";
	//echo $branch;
	$itemsbranch="SELECT * FROM seller WHERE approval=0 and type like '$branch'";
	$items=mysqli_query($con_db,$itemsbranch);
}


$b=0;
while($row2=mysqli_fetch_row($items)){
//echo"here";
for($i=0;$i<10;$i++){
$encylopedia[$b][$i]=$row2[$i];
}
$b++;
}

/*
print_r($encylopedia);
echo"checkout";
*/
?>

<html>
<body>
<table width=100% height=95% border=1>
<tr>
<td colspan=2 height=20% style="background: url(photos/p189opn3qct101j9610go2tj11d75-details.jpg)"><center>
<a href="page2.php" style="color: white; text-decoration:none;">Home</a>

</center></td>
</tr>
<tr>
<td width=20% height=70% style="background: url(photos/p189opn3qct101j9610go2tj11d75-details.jpg) no-repeat center"><center>
	<table height=100%>
	<tr>
	<td width=100%>
	<form action="buyborrow.php" method="post">
	<input type="text" name="name" placeholder="BookName">
	<input type="hidden" name="searchBy" value="yes">
	<input type="submit" value="Sort">
	</form>
	</td>
	</tr>
	
	<tr>
	<td width=100%>
	<form actiton="buyborrow.php" method="post">
	
	<select name="branch">
	<option value="Computer">Computer Science And Engineering</option>
		<option value="Civil">Civil Engineering</option>
		<option value="Telecommunication">Telecommunication Engineering</option>
		<option value="Instrumentation">Instrumentation Engineering</option>
		<option value="Electronics">Electronics Engineering</option>
		<option value="Mechanical">Mechanical Engineering</option>
	</select>
	
	<input type="hidden" name="searchBy" value="yes">
	<input type="submit" value="Sort">
	</form>
	</td>
	</tr>
	<tr>
	<td width=100%>
	<form action="buyborrow.php" method="post">
	
	<select name="sem">
	<option value="1">First Semester</option>
		<option value="2">Second Semester</option>
		<option value="3">Third Semester</option>
		<option value="4">Fourth Semester</option>
		<option value="5">Fifth Semester</option>
		<option value="6">Sixth Semester</option>
		<option value="7">Seventh Semester</option>
		<option value="8">Eigth Semester</option>
	</select>
	<input type="hidden" name="searchBy" value="yes">
	<input type="submit" value="Sort">
	</form>
	</td>
	</tr>
	<tr>
	<td>
		<form action="buyborrow.php" method="post">
		<select placeholder="Material?" name="type">
		<option value="1">Calculator</option>
		<option value="2">Books</option>
		<option value="3">Others</option>
		<input type="hidden" name="searchBy" value="yes">
		<input type="submit" value="Sort">
		</form>
	</td>
	</tr>
	
	</table>
</td>
<td width=80% height=70% style="vertical-align:top" align="left" border=1>
<div style="overflow:scroll; height:100%">
	<?php //echo $encylopedia[0][0];
echo"<table border='1' style='vertical-align:top; overflow-y:scroll;   height:100px;   display:block;' height='100%'>";
$z=$b/4;
//$z=$z;
$y=0;
for($j=0;$j<=$z;$j++){
echo"<tr>";
	for($i=0;$i<4 && $i<$b;$i++){
	
	echo"<td>";
	if($encylopedia[$y][6]==1)
		echo"Buy";
	else if($encylopedia[$y][6]==2)
		echo"Borrow";
	else
		echo"Buy/Borrow";
	echo"<br>";
	echo"<img src=".$encylopedia[$y][9]." height='10%'><br>BookName:".$encylopedia[$y][2]."<br>
	Branch:".$encylopedia[$y][3]."<br>Semester:".$encylopedia[$y][4]."<br>Rs. ".$encylopedia[$y][7]."/-<br>";
	echo"<form action='contact.php' method='post'><input type='submit' name='contact' value=".$encylopedia[$y][0].">
		<input type='hidden' name='id' value=".$encylopedia[$y][0]."<br></td>";
	$y++;
	}
	
echo"</tr>";	
}
echo"</table>";

?>
</div>
</td>
</tr>
</table>
</body>
</html>