<?php
require_once("connectdb.php");
session_start();
$id=$_SESSION['id'];
$where=$_GET['id'];
echo $id;
$sql= "DELETE FROM posts WHERE post_id=$where AND user_id=$id";

$result=$db->query($sql);

if(!$result){
	echo 'Error deleting post';
}else{
	header("location:home.php");
}
?>