<!DOCTYPE html>
<link href="https://fonts.googleapis.com/css?family=Fira+Sans+Condensed|Pacifico" rel="stylesheet">
<head>
	<title>InstaWeird- Notifications</title>
</head> 
<style>
.stat{
	font-family:"Helvetica";
	
	background-color:#00ff90;
}


.head h1{font-family:'Pacifico';
	color:#ff5959;}

a.do{
	text-decoration:none;
}
</style>
<body>
	<center><div class="head"><a class="do" href="home.php"><h1>InstaWeird</h1></a></div></center>
	<?php
		require_once("connectdb.php");
		function checkValid(){
			$sql3="SELECT id,username FROM userinfo";
			$sql="SELECT liked_by,user_id FROM posts";
		}
	?>
	<?php
		session_start();
		$id=$_SESSION['id'];
		//echo $id;
		require_once("connectdb.php");
		$sql="SELECT liked_by,user_id,status,post_id FROM posts ORDER BY post_id DESC";
		$result=$db->query($sql);
		if(!$result){
			echo 'Error';
		}
		if(mysqli_num_rows($result)>0){
			while($row=mysqli_fetch_assoc($result)){
				$notifs=$row['liked_by'];
				$posterid=$row['user_id'];
				$likedthing=$row['status'];
				$post_id=$row['post_id'];

				// I swear I have no idea why  this works despite typing it mysql. 9:46PM 2/28/2019 Day 5 of PHP
				if($posterid===$id){
					
				
				$sql2=" SELECT username FROM userinfo WHERE id=$notifs";
				$result2=$db->query($sql2);
				if(mysqli_num_rows($result2)>0){
					while($row2=mysqli_fetch_assoc($result2)){
						if($notifs!==$id){
						$user=$row2['username'];
						echo $user." liked your post! ".'<div class="stat">"'.$likedthing.'"</div>';	
						echo '<br>';
					}

					}
				}
				else{
					echo "<center>No notifications to show.</center>";
					break;
				}
			}
		}
		}

	?>

</body>
</html>