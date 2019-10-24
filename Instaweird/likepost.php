<?php
require_once("connectdb.php");
//$test=("INSERT INTO posts(likedby)")
session_start();
$likeid=$_GET['id'];
$id=$_SESSION['id'];
$sql3=("SELECT liked_by FROM posts WHERE post_id=$likeid");
$result3=mysqli_query($db,$sql3);
if(!$result3){
	echo "Error requesting this resource";
}
if(mysqli_num_rows($result3)>0){
	while($row=mysqli_fetch_assoc($result3)){
		$likedBy=$row['liked_by'];
		if($likedBy===$id){
			$revoke="UPDATE posts SET likes=likes-1  WHERE post_id=$likeid";
			$reset="UPDATE posts SET liked_by=0 WHERE post_id=$likeid";
			$result4=mysqli_query($db,$revoke);
			$result5=mysqli_query($db,$reset);
			header('location:home.php');
			if(!$result4){
				echo "Error updating special table!";
			}
			//echo "You have already liked this post";
		}else{
			//session_start();

			$update=("UPDATE posts SET liked_by=$id WHERE post_id=$likeid");
			$sql=("UPDATE posts SET likes=likes+1 where post_id=$likeid");
						
			$result=$db->query($sql);
			$result2=$db->query($update);

			if(!$result2){
				echo 'Error!';
			}
			header('location:home.php');
			
		}
		
	}
 }


?>