<?php
session_start();
?>

<!DOCTYPE html>
<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
<head>
	<title>InstaWeird Home</title>
	<style>
	
	h1{font-family:'Pacifico', cursive;
		color:#ff5959;
		font-size:25px;
	}
	a{display:inline;
		float:right;
	}
	a.likebutton{
		float:none;
	}
	a.notif{float:none;
		padding-left: 1190px;}
	.user{background-color:#00ff90;}
	.feed{text-align:center;

	}
	a.userid{
		float:none;
		text-decoration:none;
		text-decoration-color:black;
		color:black;

	}
	a.users{float:none;
			text-decoration:none;
			font-size:20px;
			color:white;
			font-family:"Arial";
	}
	a.profile{float:none;
				padding-left: 62px;

	}
	

</style>
</head>
<body>
<center><div class="head"><h1> InstaWeird Homepage</h1><?php


$id=$_SESSION['id'];
echo '<a class="profile" href="profiles.php?userid='.$id.'"><img src="https://pngimage.net/wp-content/uploads/2018/06/profile-png.png" width="20" height="20" alt="My Profile"></a>';
?>

	<a class="notif" href="notifications.php"><img src="https://imageog.flaticon.com/icons/png/512/60/60977.png?" alt="Notifications" width="20" height="20"></a> <a href="logout.php"><img src="https://cdn.iconscout.com/icon/premium/png-256-thumb/logout-93-1183723.png" width="20" height="20"> </a></div></center>
<center>
	<div class="head">
	<form action="search.php" method="POST">
		<input type="text" name="query"  placeholder="Search for a friend">
		<button type="submit" name="data">Search</button>
	</form>
</div>
</center>

<?php
if(empty($_SESSION['username'])){
	header("Location:login.php");
	die();
}else{
	echo '<div class="user">';
echo "Logged in as: <b>".$_SESSION['username'].'</b>';
echo '</div>';

if(isset($_GET['logout'])){
	session_destroy();
}
}
$id=$_SESSION['id'];
?>
<br>
<center>
	<form method="post" action="poststatus.php">
			<textarea name="status" class="name" rows="2" cols="50"></textarea>
				<input type="submit" name="submit" value="Post Status">
	</form>
</center>
<div class="feed">
<?php
function checkFriend($specid,$friendid){
		$db=mysqli_connect("localhost","root","","instareg");

		$friend="SELECT * FROM friends WHERE id=$specid";

		$result=$db->query($friend);
		if(!$result){
			echo 'Error';
		}
		 else{
		 	while($row=mysqli_fetch_assoc($result)){
		 		$friend=$row['friendid'];
		 		$you=$row['id'];
		 		//echo $friend; echo $friendid;
		 		if($friend==$friendid){
		 			$sql="SELECT * FROM posts WHERE user_id=$friend OR  user_id=$you ORDER BY post_id DESC";
					$results=mysqli_query($db,$sql);
					if(!$results){
						echo 'Error';
					}
					if(mysqli_num_rows($results)>0){
						while($row=mysqli_fetch_assoc($results)){
					$status=$row['status'];
					$poster=$row['username'];
					$poster_id=$row['user_id'];
					$posts_id=$row['post_id'];
					
					$likes=$row['likes'];
					$comments=$row['comments'];

					$html="><img src='https://www.freeiconspng.com/uploads/like-button-png-2.png' alt='Like' width='20' height='20'></a>";
					$html2="><img src='https://image.flaticon.com/icons/png/512/25/25663.png' alt='Like' width='20' height='20'></a>";
					echo '<br>';
					echo '<b>';
					$html3='<a class="userid" href="profiles.php?userid='.$poster_id.'">';
					echo $html3;
					echo $poster; echo '</b>';
					echo "</a>";
					echo "<br>";
					echo $status."<a class='likebutton' href='likepost.php?id=".$posts_id;
					echo"'";echo $html.$likes." "."<a class='likebutton' href='commentpost.php?cid=$posts_id'".$html2.$comments;
					echo '<hr>';
			}
		}
		 		}
		 	}
		 }

}
?>
<?php
	function searchAll(){
	$id=$_SESSION['id'];
	$db=mysqli_connect("localhost","root","","instareg");
	$sql="SELECT * FROM userinfo";
	$result=$db->query($sql);
	if(!$result){
		echo "Error!";
	}
	if(mysqli_num_rows($result)>0){
		while($row=mysqli_fetch_assoc($result)){
			$users=$row['id'];
			if(checkFriend($id,$users)){
				return 1;
			}
		}
	}
}

if(searchAll() ==1){
	$you=$_SESSION['username'];
	$db=mysqli_connect("localhost","root","","instareg");
	$sql="SELECT * FROM userinfo";
	$result=$db->query($sql);
	echo 'No friends yet! Use the search function to find friends';
	echo '<center><h3> People You May Know</h3></center>';
	if(mysqli_num_rows($result)>0){
		while($row=mysqli_fetch_assoc($result)){
			$users=$row['username'];
			$id=$row['id'];
			if($you==$users){
				continue;
			}
			echo '<div class="user">';
			echo '<center><a class="users" href="profiles.php?userid='.$id.'"<h2>'.$users.'</h2></center>';
			echo '</div>';
		}
	}
}


	
?>
	
</div>

</body>
</html>