<?php
	//Include required Mysql config file and function
	require_once('config.php');
	require_once('function.php');

	//Session Start
	session_start();

	//Check if user is already logged in
	if($_SESSION['logged_in'] == true){
			//if already logged in then redirects user to main page
			redirect('../user_group.php');
	}else{
			//Make sure that user submitted a username and password
			if((!isset($_POST['username'])) || (!isset($_POST['password']))){
					redirect('../login.php');
			}

			//connect to database
			$conn = coneect_db();
			$username = $_POST['username'];
			$password = $_POST['password'];
			$sql = "SELECT * from administrator where username = '".$username."' AND password = '".$password."'";
			$result = $conn->query($sql);
			///echo "<pre>"; print_r($result); echo "</pre>";die("Hii");
			if ($result->num_rows > 0) {
				//Set Login status to 1
				$_SESSION['logged_in'] = true;
				redirect('../user.php');
			}else{
				//if no user found redirect it to login page
				redirect('../login.php');
			}
	}

?>
