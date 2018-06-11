<?php
	require_once('config.php');

	function redirect($page){
		header('Location: '.$page);
		exit();
	}
	
	function check_login_status(){
		if(isset($_SESSION['logged_in'])){
				return $_SESSION['logged_in'];
		}
		return false;
	}
	
	function coneect_db(){
			
		// Create connection
		$conn = new mysqli(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
		//echo "<pre>"; print_r($conn); echo "</pre>"; die("Stop");
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		} 
		return $conn;
	}
	
?>
