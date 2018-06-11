<html>
<?php
	include_once("dbConnection.php");
	$username=$_POST['uname'];
	$password=$_POST['pass'];
	$command="Select * from users where username='".$username."' and password = '".$password."'";
	$result = mysqli_query($con,$command);
	$row = mysqli_fetch_array($result);
	if($row[1]==$username && $row[2]==$password){
		$cookie_value=$row[1];
		setcookie("uname",$cookie_value,time()+(86400*15),'/');
		echo $_COOKIE['uname'];
		$uid = $row[0];
		setcookie("id",$uid,time()+(86400*15),'/');
		$image = $row[3];
		setcookie("image",$image,time()+(86400*15),'/');
		echo "Login success...welcome " .$row[4]."." ;
		if($row[5]=='a')header("Location: http://localhost/E-cart/user.php");
		else
			header("Location: http://localhost/E-cart/index.php");
        
	
	}
	else {
		header("Location: http://localhost/E-cart/login.php?login=invalid");
	}
	$con -> close();
	
	
?>
</html>