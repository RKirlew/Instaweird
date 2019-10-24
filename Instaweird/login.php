<!DOCTYPE html>
<html>
<head>
	<title>InstaWeird Login</title>
	<style>
	.head{background-color:#00c5fc;
	}
	a{display:inline;
		float:right;
	}
	h1{font-family:"Arial";}
</style>
</head>
<body>
	<center><div class="head"><h1>InstaWeird Login</h1><a href="index.php">Not a member?</a></div>
		<form action="login.php" method="post">
			Username:<input type="text" name="uname">
			Password:<input type="password" name="pass">
			<button type="submit" name="submit">Login</button>
	</center>
<?php

	require_once("connectdb.php");
	if(isset($_POST['submit'])){
	$user=$password='';
	$user=$_REQUEST['uname'];
	$password=MD5($_REQUEST['pass']);
	$sql="SELECT * FROM userinfo WHERE username='$user' AND password='$password'";
	$result=mysqli_query($db,$sql);
	if(mysqli_num_rows($result)>0){
			while($row=mysqli_fetch_assoc($result)){
				$id=$row['id'];
				$user=$row['username'];
				session_start();
				$_SESSION['id']=$id;
				$_SESSION['username']=$user;
			}
			header("Location:home.php");
		}else{
			echo '<h4 style="color:red;">';
			echo "Username or password incorrect!";
			echo '</h4>';
		}
	}


?>
</body>
</html>