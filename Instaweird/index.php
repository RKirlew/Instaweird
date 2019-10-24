<!DOCTYPE html>
<html>
<head>
	<body background="https://images5.alphacoders.com/439/thumb-1920-439361.jpg">
	<title>InstaWeird- Instagram Clone</title>
	<style>
	.head{background-color:#c9ddff;

		
	}
	.login{
		
	}
	h1{font-family:"Arial";}
	a{float:right;
		

	}
	h3{font-family:"Arial";
		font-size:15px;
		color:black;
}
</style>
</head>
<body>
	<?php
		require_once("connectdb.php");
		?>
	<center>
		<div class="head">
		<h1>Register For InstaWeird</h1></div>
		<div class="login">

	<form action="register.php" method="POST">
		<h3>Username:</h3><input type="text" name="user"><br>
		<h3>Password:</h3><input type="password" name="pass"><br>
		<center><button type="submit" name="submit">Register</button></center>
		<a href="login.php">Already Registered? </a>
	</form>

</div>
</center>
</body>
</html>