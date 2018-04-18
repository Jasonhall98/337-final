<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="style.css">
<title>Registration</title>
</head>
<body>

<form onsubmit="register();">

First Name <br>
<input id="first" required> <br>

Last Name <br>
<input id="last" required> <br>

Email <br>
<input id="email"> <br>

UserName <br>
<input id="user" required> <br>

Password <br>
<input id="pass" required> <br>

<input type="submit" value="Register">

</form>

<script>

function register() {
	var first = document.getElementById("first").value;
	var last = document.getElementById("last").value;
	var email = document.getElementById("email").value;
	var user = document.getElementById("user").value;
	var pass = document.getElementById("pass").value;
	
	
	var anObj = new XMLHttpRequest();
	anObj.open("POST", "controller.php", true);
	anObj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	anObj.send("register=1&first=" + first + "&last=" + last + "&email=" + email + "&user=" + user + "&pass=" + pass);

	anObj.onreadystatechange = function () {
		if (anObj.readyState == 4 && anObj.status == 200) {
			
		}
	}
	
}


</script>


