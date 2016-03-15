<?php
$con=mysqli_connect("localhost","root","");
if(mysqli_query($con,"CREATE DATABASE hackbit")){
	mysqli_close($con);
	$con_db=mysqli_connect("localhost","root","","hackbit");
	$createTable="CREATE TABLE members(usn char(30),name char(30),email char(30),password char(30),thumbnail char(30))";
	if(mysqli_query($con_db,$createTable)){
		echo"everything successful!";
		$createSellers="CREATE TABLE seller(id int not null auto_increment,usn char(30),book char(30),branch char(30),sem char(30),type char(30),
						method char(30),price char(30),approval int default 0,photo varchar(255),primary key(id))";
		if(!mysqli_query($con_db,$createSellers)){
			echo"Could not create sellers table".mysqli_error($con_db);
			}
		else{
			echo"Created!".mysqli_error($con_db);
			$createChat="CREATE TABLE chat(id int not null auto_increment,send char(30),receive char(30),message varchar(255),primary key(id))";
			if(!mysqli_query($con_db,$createChat)){
				echo"could not pull off";
				}
			}
			
		
		}
		}
?>
	