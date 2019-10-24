<?php
session_start();
?>
<?php
if(empty($_SESSION['username'])){
	header("Location:login.php");
	die();
}
?>
<?php
	require_once("connectdb.php");
	if(isset($_POST['submit'])){
		$status='';
		$user=$_SESSION['username'];
		$id=$_SESSION['id'];
		$status=$_POST['status'];
		$sql="INSERT INTO posts(status,username,user_id) VALUES('$status','$user','$id')";
		$result=mysqli_query($db,$sql);
		if(!$result){
			echo 'Error posting status';
			echo 'Try again <a href="home.php">';
		}else{
			echo 'Status posted!';
			header('location:home.php');
		}
	}
?>