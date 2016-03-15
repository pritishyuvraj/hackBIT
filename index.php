<html>
<body background="photos/Books-Background-7.jpg">
<table width=100% height=100%>
<tr>
<td height=20% align="right">

<form method="post" action="index.php">
<font style="font-family:'Impact'; color:white; font-size:125%;">
SignIN:
<input name="username" type="text" placeholder="Username">
<input name="password" type="password" placeholder="Password">
<input name="action" type="hidden" value="login">
<input type="submit" value="Login">
</font>
</form>

</td>
</tr>
<tr>
<td colspan=2>
<font style="font-family:'Impact'; color:white; font-size:150%;">
"If you only read the books that everyone else is reading,  <br>you can only think what everyone else is thinking"<br>-Haruki Murakami
</font>
</td>
</tr>
<tr>
<td height=80% align="center">
<font style="font-family:'Impact'; color:white; font-size:175%;">
Register here:
</font>
<form method="post" action="index.php">
<input name="usn" type="text" placeholder="USN"><br><br>
<input name="name" type="text" placeholder="Name"><br><br>
<input name="email" type="email" placeholder="Email"><br><br>
<input name="pass" type="password" placeholder="Password"><br><br>
<input name="action" type="hidden" value="signup">
<input value="SignUp" type="submit">
</form>

</td>
</tr>

</table>
</body>
</html>
<?php
session_start();
$action=isset($_POST['action'])?$_POST['action']:NULL;
switch($action){
case 'signup':	$usn=$_POST['usn'];
				$name=$_POST['name'];
				$email=$_POST['email'];
				$pass1=$_POST['pass'];
				
				$sql_inject="INSERT INTO members (usn,name,email,password) VALUES ('$usn','$name','$email','$pass1')";
				$con_db=mysqli_connect("localhost","root","","hackbit");
				if(mysqli_query($con_db,$sql_inject)){
				$_SESSION['userid']=$usn;
				
				header('Location:page2.php');
					//header('Location:my_profile.php');
				}
				else{
				echo"Error registering user!";
				}
				break;
case 'login':	$query_login=mysqli_connect("localhost","root","","hackbit");
				$username=$_POST['username'];
				$password=$_POST['password'];
				$call="SELECT usn FROM members WHERE usn='$username' AND password='$password'";
				$Logging_in=mysqli_query($query_login,$call);

	while($row=mysqli_fetch_assoc($Logging_in))
	{
	$_SESSION['userid']=$username;
	//echo "this is the userid people".$_SESSION['userid']."is what is stored".$username;
	header('Location:page2.php');
	}
	echo"<h2 style='color:red;'>User entered invalid username or password</h2>";
	break;
				
			}
			?>