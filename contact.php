<?php
session_start();
error_reporting(0);
$userid=$_SESSION["userid"];
echo $_POST["id"];
echo"This is the id";
echo"hello hello";
if(!isset($userid)){
	header('Location:index.php');
	}

?>

<html>
<body>
<table width=100% height=80% border=1>
<tr>
<td colspan=2><a href="buyborrow.php">BACK</a></td>
</tr>
<tr>
<td width=20% height=80%>
<?php

if(isset($_SESSION['user2']) && isset($_POST["contact"]) && strcmp($_SESSION['user2'],$_POST["contact"])){
//echo"caught";
$_SESSION['user2']=$_POST["contact"];
$shownusn=$_SESSION['user2'];
}
if(!isset($_SESSION['user2'])){
$showusn=$_POST["contact"];
$_SESSION['user2']=$_POST["contact"];
}
else{
$showusn=$_SESSION['user2'];
}

/*
if(isset($_POST['contact']) && (strncmp(S_POST['contact'] && $_SESSION['user2']))){
$_SESSION['user2']=$_POST["contact"];
}
*/

//echo $showusn."See it";
$con_db=mysqli_connect("localhost","root","","hackbit");
$calldetails=mysqli_query($con_db,"SELECT * from seller where id like '$showusn'");


$b=0;
while($row2=mysqli_fetch_row($calldetails)){
for($i=0;$i<10;$i++){
$encylopedia[$b][$i]=$row2[$i];
}
$b++;
}
$showusnactual=$encylopedia[$b][1];
//print_r($encylopedia);
//echo"Job no ".$shownusn;
//echo"id".$_POST["contact"]."is".$_POST["id"];
//echo"sessions".$_session["user2"];

?>
	<table>
	<tr>
	<td style="background: white"><img src="<?php echo $encylopedia[0][9]; ?>" width=100%></img>
	<br>
	<?php
	echo"<b>Rs".$encylopedia[0][7]."/-</b></i><br>USN:".$encylopedia[0][1]."<br>Book Name".$encylopedia[0][2].""."<br>Branch:".$encylopedia[0][3].""
	."<br>Semester Book:".$encylopedia[0][4]."<br>"."Type:";
	if($encylopedia[0][5]==1)
	echo"book";
	else if($encylopedia[0][5]==2)
	echo"Calculator";
	else 
	echo"others";
	echo"<br>";
	?>
	</tr>
	</table>
<td style="vertical-align:top">
<form action="contact.php" method="post">
<center>
<form action="contact.php" method="post">
<textarea  name="text" rows="4" cols="100" placeholder="Message seller Mr.<?php echo $encylopedia[0][1]; ?>" >
</textarea>
<input type="hidden" name="action" value="1">
<input type="submit" name="sendmessage" value="Send">
</form>
</center>
<?php
	$seemessages="SELECT * FROM chat WHERE (send like '$userid' and receive like '$$showusnactual') or (send like '$$showusnactual' and receive like '$userid')
		ORDER BY id DESC";
	$con_db=mysqli_connect("localhost","root","","hackbit");
	$show=mysqli_query($con_db,$seemessages);
	
$b=0;
while($row2=mysqli_fetch_row($show)){
for($i=0;$i<4;$i++){
$encylopedia[$b][$i]=$row2[$i];
}
$b++;
}
echo"<table>";
for($i=0;$i<$b;$i++){
	echo"<tr><td>".$encylopedia[$i][1]."</td><td>".$encylopedia[$i][3]."</td></tr>";
	}
echo"</table>";
?>
	
</td>

	


</tr>
</table>
</body>
</html>
	
<?php
$action=isset($_POST["action"])?$_POST["action"]:NULL;

switch($action){
case '1':	echo"I m here";
			$mess=$_POST['text'];
			$inject="INSERT INTO chat(send,receive,message) VALUES('$userid','$$showusnactual','$mess')";
			$con_db=mysqli_connect("localhost","root","","hackbit");
			if(!mysqli_query($con_db,$inject)){
				echo"Message could not be sent";
			}
			else{
			echo"done";
			header('Location:contact.php');
			}
			mysqli_close($con_db);
			break;
}
?>			