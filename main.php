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
    echo '<form onsubmit="logout();"><input type="submit"></form>';
    
    echo '<button onclick="logout();"> Logout </button>';
    
}
?>


<script>

function logout() {

	alert('unlog');
	
}

function login() {
	alert('word');
	var user = document.getElementById('user').value;
	var pass = document.getElementById('pass').value;

	var anObj = new XMLHttpRequest();
	anObj.open("POST", "controller.php", true);
	anObj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	anObj.send("login=1&user=" + user + "&pass=" + pass);

	anObj.onreadystatechange = function () {
		if (anObj.readyState == 4 && anObj.status == 200) {
			if (isset($_SESSION['permissions']) 
				window.location.href = this;
			else {
				
			}
		}
	}
	
}



</script>

</body>
</html>
