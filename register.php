<html>
<body background="photos/vintage-books-grunge-background-6698376.jpg">
<table height=80% width=100%>
<tr>
<td align="center">
	<form action="register.php" method="post" enctype="multipart/form-data">
	<font style="font-size:125%; font='Impact';">
<h1><b><u>	Register your Material here:</h1></b></u>
	</font>
	Name of Book:<input type="text" name="bookname" placeholder="Name"><br><br>
	Branch Related<select name="branch"><br><br>
		<option value="Computer Science And Engineering">Computer Science And Engineering</option>
		<option value="Civil Engineering">Civil Engineering</option>
		<option value="Telecommunication Engineering">Telecommunication Engineering</option>
		<option value="Instrumentation Engineering">Instrumentation Engineering</option>
		<option value="Electronics Engineering">Electronics Engineering</option>
		<option value="Mechanical Engineering">Mechanical Engineering</option>
	</select>
	<br><br>
	Semester<select name="sem">
		<option value="1">First Semester</option>
		<option value="2">Second Semester</option>
		<option value="3">Third Semester</option>
		<option value="4">Fourth Semester</option>
		<option value="5">Fifth Semester</option>
		<option value="6">Sixth Semester</option>
		<option value="7">Seventh Semester</option>
		<option value="8">Eigth Semester</option>
	</select>
	Rs<input type="text" name="rupees" placeholder="Amount">
	<br><br>
	Choose a method:
	<input type="radio" name="method" value="1">Sell</input>
	<input type="radio" name="method" value="2">Rent</input>
	<input type="radio" name="method" value="3">Sell or Rent</input><br><br>
	
	Type<select name="type">
		<option value="1">Calculator</option>
		<option value="2">Books</option>
		<option value="3">Others</option>
	</select>
	<br><br>
	Upload Photo:
	<input type="file" name="file" id="file">
	<input type="hidden" name="action" value="yes">
	<input type="submit">
	
</form>

</td>
</tr>
</table>
</body>
</html>
	
<?php
session_start();
$userid=$_SESSION['userid'];
$action=isset($_POST["action"])?$_POST["action"]:NULL;

switch($action){
case 'yes':	$usn=$userid;
			$book=$_POST["bookname"];
			$branch=$_POST["branch"];
			$sem=$_POST["sem"];
			$method=$_POST["method"];
			$type=$_POST["type"];
			$price=$_POST["rupees"];
			$photo="abc";
			
			
			$usn="photos";
//mkdir($usn);
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 4000000)
&& in_array($extension, $allowedExts))
  {
  $size = 50; // the thumbnail height

	$filedir =$usn.'/'; // the directory for the original image
	$thumbdir =$usn.'/'; // the directory for the thumbnail image
	$prefix = 'thumbsup_'; // the prefix to be added to the original name

	$maxfile = '2000000';
	$mode = '0666';
	
	$userfile_name = $_FILES["file"]["name"];
	$userfile_tmp = $_FILES["file"]["tmp_name"];
	$userfile_size = $_FILES["file"]["size"];
	$userfile_type = $_FILES["file"]["type"];
	
	if (isset($_FILES["file"]["name"])) 
	{
		$prod_img = $filedir.$userfile_name;

		$prod_img_thumb = $thumbdir.$prefix.$userfile_name;
		move_uploaded_file($userfile_tmp, $prod_img);
		chmod ($prod_img, octdec($mode));
		
		$sizes = getimagesize($prod_img);

		$aspect_ratio = $sizes[1]/$sizes[0]; 

		if ($sizes[1] <= $size)
		{
			$new_width = $sizes[0];
			$new_height = $sizes[1];
		}else{
			$new_height = $size;
			$new_width = abs($new_height/$aspect_ratio);
		}

		$destimg=ImageCreateTrueColor($new_width,$new_height)
			or die('Problem In Creating image');
		$srcimg=ImageCreateFromJPEG($prod_img)
			or die('Problem In opening Source Image');
		if(function_exists('imagecopyresampled'))
		{
			imagecopyresampled($destimg,$srcimg,0,0,0,0,$new_width,$new_height,ImageSX($srcimg),ImageSY($srcimg))
			or die('Problem In resizing');
		}else{
			Imagecopyresized($destimg,$srcimg,0,0,0,0,$new_width,$new_height,ImageSX($srcimg),ImageSY($srcimg))
			or die('Problem In resizing');
		}
		ImageJPEG($destimg,$prod_img_thumb,90)
			or die('Problem In saving');
		imagedestroy($destimg);
  
//      echo "Stored in: ".$prod_img;
//      echo "thumbnails at:".$prod_img_thumb."<br>";
	  $profile_pic_location=$prod_img;
	$thumbnails=$prod_img_thumb;
	  }
  }
  
else
  {
  echo "Invalid file";
  }
			
			
			
			$injectsql="INSERT INTO seller(usn,book,branch,sem,type,method,price,photo)
						VALUES('$userid','$book','$branch','$sem','$type','$method','$price','$profile_pic_location')";
			$con_db=mysqli_connect("localhost","root","","hackbit");
			if(!mysqli_query($con_db,$injectsql)){
				echo"Problem".mysqli_error($con_db);
				}
			else{
				echo"Book waiting for authorization!<html><body><a href='page2.php'>Back</a>";
				}
			}
?>
			
						
			
