<?php session_start();?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="style.css">
<title>Registration</title>
</head>
<body>

<form onsubmit="register();return false;">

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

<select id=permissions>
	<option value="1">Student</option>
	<option value="2">Teacher</option>
	<option value="3">Admin</option>

</select>

<input type="submit" value="Register">

</form>

<div id="tochange"></div>

<script>


function register() {
	var first = document.getElementById("first").value;
	var last = document.getElementById("last").value;
	var email = document.getElementById("email").value;
	var user = document.getElementById("user").value;
	var pass = document.getElementById("pass").value;

	var e = document.getElementById("permissions");
	var permissions = e.options[e.selectedIndex].value;
		
	var anObj = new XMLHttpRequest();
	anObj.open("POST", "controller.php", true);
	anObj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	anObj.send("register=1&first=" + first + "&last=" + last + "&email=" + email + "&user=" + user + "&pass=" + pass + "&permissions=" + permissions);

	alert('pause');
	anObj.onreadystatechange = function () {
		if (anObj.readyState == 4 && anObj.status == 200) {
			var success = anObj.responseText;
			if (success == '0') {
				// The action failed because another user with that username already exists
				document.getElementById('tochange').innerHTML = "Username already taken";
				
			} else {
			    window.location.href = 'main.php';
				

			}
			
		}
	}
	
}


</script>

</body>
</html>
