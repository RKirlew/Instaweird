<!DOCTYPE html>
<link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">

<html>
<head>
	<title>InstaWeird User</title>


</head>
<style>
h1{background-color: #00ff90;
	font-family:"Pacifico";
}
h2{font-family: "Helvetica";
	background-color: #43baf9;
}
.posts{
	background-color:#2bb5ff;
	font-size:25px;
	font-family:"Helvetica";
}
.head{background-color:white;
	}
h1.name{font-family:'Pacifico', cursive;
		color:#ff5959;
		background-color: white;
	}
	a{display:inline;
		float:right;
	}
	a.likebutton{
		float:none;
	}
	a.notif{float:none;
		padding-left: 1230px;}
    a.do{float:none;
    	text-decoration:none;
    }
    a.del{float:none;
    	text-decoration: none;
    	color:blue;
    }
    button.friend-r{background-color:lime;}
</style>
<body>
	<center><a class="do" href="home.php"><h1 class="name"> InstaWeird</h1></a><div class="head"><a class="notif" href="notifications.php"><img src="https://imageog.flaticon.com/icons/png/512/60/60977.png?" alt="Notifications" width="20" height="20"></a> <a href="logout.php"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7c/User_font_awesome.svg/2000px-User_font_awesome.svg.png" width="20" height="20"> </a></div></center>
<?php
session_start();
$you=$_SESSION['id'];
require_once("connectdb.php");
function getPosts(){
	$you=$_SESSION['id'];
	$db=mysqli_connect("localhost","root","","instareg");
	echo '<center><h2>Posts</h2></center';
	$user_id=$_GET['userid'];

	$sql1="SELECT * FROM posts WHERE user_id=$user_id";
	$result1=$db->query($sql1);
	echo '<center>';
	if(mysqli_num_rows($result1)>0){
		$num=0;
		while($row=mysqli_fetch_assoc($result1)){
			$num++;
			$statuses=$row['status'];
			$ids=$row['post_id'];
			echo '<div class="posts">';

			echo $num.')'.' '.$statuses.'.';

			echo '<br>';
			echo '</div>';
			echo '</center>';
			if ($user_id==$you){
				
				echo '<center><h1><a class="del" href="deletepost.php?id='.$ids.'">Delete</a></h1></center>';
				
			}else{
				continue;
			}

		//echo '<h1>'.$user.'</h1>';
		
		
	}
}

}

$user_id=$_GET['userid'];
$sql2="SELECT * FROM friends WHERE friendid=$user_id";
$result3=$db->query($sql2);
if(mysqli_num_rows($result3)>0){
	while($row2=mysqli_fetch_assoc($result3)){
		$friendship=$row2['friendid'];
		if($friendship==$user_id){
			if ($user_id==$you){
				echo "<b>This is you</b>";
				break;
				
			}
			echo "You are friends with this user!";
			break;

		}
		
	}
	
}else{
			if ($user_id!==$you){
		echo '<form method="post" action="sendrequest.php?uid='.$user_id.'">';
		echo '<button class="friend-r" type="submit" name="send" formaction="sendrequest.php?uid='.$user_id.'">Send Friend Request</button>';
		echo '</form>';
	}
		}



$sql="SELECT * FROM posts WHERE user_id=$user_id";

$result=$db->query($sql);
echo '<center>';
if(mysqli_num_rows($result)>0){
	while($row=mysqli_fetch_assoc($result)){

		$user=$row['username'];

		$statuses=$row['status'];
		
		//echo '<h1>'.$user.'</h1>';
		
		
	}
}else if ($user_id!==$you){
		echo "This person has no posts yet!";
		
	}
	else if ($user_id==$you){
		echo "You have no posts yet!";
	}
	
if(!isset($user)){
		echo '<h1>'.$_SESSION['username'].'</h1>';
		echo '</center>';

	}else{
	echo '<h1>'.$user.'</h1>';
	getPosts();
}
?>

</body>
</html>