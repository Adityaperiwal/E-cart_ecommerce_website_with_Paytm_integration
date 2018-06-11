<!DOCTYPE html>

<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
 
<style>body{background-color:grey; background-repeat:no-repeat; height: 100%; background-size:cover;background-attachment:fixed;}.div1{background-color:#211D1C;font-size:20px;color:white; position:absolute; top:100px; left:400px; outline: white solid thick; outline-width:2px; padding-top: 100px;padding-right: 50px;padding-bottom: 60px;padding-left: 50px;} </style>
</Head>
<body >
<div class="div1">
<form action="getRecords.php" method="post">
<table>
<div style="text-align:center;"><tr><td><h1>E-cart</h1> login</td></tr></div>
<?php if(isset($_GET['login'])) echo "<span style='color:red;'>Invalid username or password</span>"; ?>
<tr><td><div style="margin-bottom:10px;">Username:</div></td>
<td><input type="text" name="uname"style="margin-bottom:10px;" required=""/></td></tr>
<tr><td><div style="margin-bottom:50px;">Password:</div></td>
<td><input type="password" name="pass"style="margin-bottom:50px;" required=""/></td></tr>
<tr><td colspan="2">
<center><input type="submit" value="Log in!" name="button"></center></td></tr>
<tr><td colspan="2"><center><p>Press <a href="signup.php">here</a> to sign up.</p>
</table>
</div>   
  

</div>
</body>
</html>