<!-- Class enrollment/class webpage site -->
<!-- Jason Hall -->
<!-- Andrew Rickus -->
<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="style.css">
<title>Class enrollment</title>
</head>
<body>


<?php
if (!isset($_SESSION['permissions'])) {
    echo '<div align="center"> <h3>Login</h3> <br>'; 
    echo '<form onsubmit="login();">';
    echo '<input placeholder="Username" id="user" required> <br> <br>';
    echo '<input placeholder="Password" id="pass" required> <br> <br>';
    echo '<input type="submit" value="Login">';    
    echo '</form></div>';
} else {    
    echo '<button onclick="logout();"> Logout </button>';
    
}
?>
<div id="write"></div>

<script>

function logout() {
	var anObj = new XMLHttpRequest();
	anObj.open("POST", "controller.php", true);
	anObj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	anObj.send("logout=1");

	anObj.onreadystatechange = function () {
		if (anObj.readyState == 4 && anObj.status == 200) {
			window.location.href = window.location.href;
		}
	}
}

function login() {
	var user = document.getElementById('user').value;
	var pass = document.getElementById('pass').value;

	var anObj = new XMLHttpRequest();
	anObj.open("POST", "controller.php", true);
	anObj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	anObj.send("login=1&user=" + user + "&pass=" + pass);

	anObj.onreadystatechange = function () {
		if (anObj.readyState == 4 && anObj.status == 200) {
			if (isset($_SESSION['permissions'])) {
				window.location.href = window.location.href;
			} else {
				
			}
		}
	}
	
}



</script>

</body>
</html>
