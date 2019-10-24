<?php
require_once("connectdb.php");
session_start();

if(isset($_POST['send'])){
	$id=$_SESSION['id'];
	$request=$_GET['uid'];

	$sql="INSERT INTO friends(id,friendid) VALUES($id,$request)";

	$result=$db->query($sql);

	if(!$result){
		echo 'Error forming friendship';
	}else{
		header("location:home.php");
	}
}

?>