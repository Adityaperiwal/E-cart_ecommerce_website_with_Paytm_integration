<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
 
<style>body{background-color:grey; background-repeat:no-repeat; height: 100%; background-size:cover;}.div1{background-color:#211D1C;font-size:20px;color:white; position:absolute; top:100px; left:400px; outline: white solid thick; outline-width:2px; padding-top: 100px;padding-right: 50px;padding-bottom: 60px;padding-left: 50px;} </style>
</head>
<body >
<div class="div1">
<form onsubmit="return validate()"action="insertRecords.php" method="post">
<table>

<div style="text-align:center;"><tr><td><h1>E-cart</h1> Signup</td></tr></div>
<tr><td><div style="margin-bottom:10px;">Name:</div> </td><td><input type="text" name="name" style="margin-bottom:10px;" required/></td></tr>
<tr><td><div style="margin-bottom:10px;">Username:</div></td><td><input type="text" name="username"style="margin-bottom:10px;" required/></td></tr>
<tr><td><div style="margin-bottom:50px;">Password:</div></td><td><input type="password" id="pass" name="password"style="margin-bottom:50px;" required/></td></tr>
<tr><td colspan="2"><center><input type="submit" value="Sign Up!" ></center></td></tr>
<tr><td colspan="2"><center><p>Press <a href="login.php">here</a> to log in.</p>
</table>
</form>
</div>   
</div>
<script >
function validate(){
	var x=document.getElementById("pass").value;
	if(x.length<4)
	{
		alert("Password must be greater than 4 characters");
		return false;
	}
	else return true;
}
</script>
</body>
</html>
