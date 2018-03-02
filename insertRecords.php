<?php
	include_once("dbConnection.php");
	
	$name = $_POST['name'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	if($name==""||$username==""||$password=="")
	{
		die("There is some problem with your input. Please try again.");
	}
	else{
	
	$command = "insert into Users(name, username, password) values('".$name."','".$username."','".$password."')";
	
	$con -> query($command);
	echo "Your id has been created successfully.";
header("Location:http://localhost/e-cart2/login.php");	
}
	
	
?>