<?php 
include_once("dbConnection.php");
$pid =$_GET['pid'];
$uid =$_COOKIE['id'];
$task=$_GET['task'];
if($task=="add")
{$q1="Insert into cart values('".$uid."','".$pid."','1');";
$r1=mysqli_query($con,$q1);
echo "<input type='button'  onclick='removeFromCart($pid)' class='button' value='Remove from cart'>";	
}
else{
$q1="Delete from cart where uid='".$uid."' and pid='".$pid."';";
$r1=mysqli_query($con,$q1);
echo "<input type='button'  onclick='addToCart($pid)' class='button' value='Add to cart'>";
}
?>