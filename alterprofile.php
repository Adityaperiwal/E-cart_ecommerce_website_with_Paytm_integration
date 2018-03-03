<?php
include_once("dbConnection.php");
$name=$_POST['name'];
$pass=$_POST['pass'];
$pic=$_FILES["profilepic"]["name"];
$folder="C:/xampp/htdocs/E-cart/images/";
move_uploaded_file($_FILES['profilepic']['tmp_name'],$folder.$pic);
$com ="Update users set name='".$name."', password='".$pass."',image='".$pic."' where uid='".$_COOKIE['id']."'";
$res=mysqli_query($con,$com);
header("Location:http://localhost/E-cart/index.php");
?>