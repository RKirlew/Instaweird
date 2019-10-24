<!DOCTYPE html>
<html>
<head>
	<title>Instaweird Search Results</title>
	<style>
	.result{
		background-color:#00c5fc;
	}
</style>
</head>
<body>
	<?php
	require_once("connectdb.php");
	if (isset($_POST['data'])){
		$name=$_POST['query'];
		$name=mysql_real_escape_string($name);
		 $sql="SELECT * FROM userinfo WHERE username='$name'";
		 $result=$db->query($sql);
		 if(!$result){
		 	echo "Error searching for user";
		 }
		 if(mysqli_num_rows($result)>0){
		 	while($row=mysqli_fetch_assoc($result)){
		 		$results=$row['username'];
		 		$id=$row['id'];
		 		echo '<div class="result">';
		 		echo 'Results found:'.mysqli_num_rows($result);
		 		echo "<br>";
		 		echo 'User:'.'<a href="profiles.php?userid='.$id.'">'. $results.'</a>';
		 		echo '</div>';
		 	}
		 }else{
		 	echo "User:".$name." not found!";
		 }
	}
?>

</body>
</html>