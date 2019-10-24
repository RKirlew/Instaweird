<?php
require_once("connectdb.php");
if(isset($_POST['submit'])){
	$user=$password=$pwd='';
	$user=strip_tags($_POST['user']);
	$pwd=$_POST['pass'];
	$password=MD5($pwd);
	$sql1="SELECT * FROM  userinfo WHERE username='$user'";
	$result1=mysqli_query($db,$sql1);
	$data=mysqli_fetch_array($result1,MYSQLI_NUM);
	if($data[0]>1){
			echo "User already exists";
		}else{
	$sql="INSERT INTO userinfo(username,password) VALUES('$user','$password')";
	$result=mysqli_query($db,$sql);


	if($result){
		header("Location:login.php");
	}else{

		echo "Registration failed";
	}
}}

?>