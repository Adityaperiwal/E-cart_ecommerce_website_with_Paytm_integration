
<!DOCTYPE html>
<?php session_start();
session_destroy();
setcookie("id","",time()-3600,'/');
setcookie("id","",time()-3600,'/');
header("Location:http://localhost/e-cart2/login.php");
  ?>
