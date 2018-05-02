<!-- Class enrollment/class webpage site -->
<!-- Jason Hall -->
<!-- Andrew Rickus -->
<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="style.css">
<title>Login</title>
</head>
<body>

<div class="login_box">
<?php
if (!isset($_SESSION['permissions'])) {
    echo '<div class= "login_text" align="center"> <h3>Login</h3> <br>'; 
    echo '<form onsubmit="login(); return false;">';
    echo '<input class="login_inputs" placeholder="Username" id="user" required> <br> <br>';
    echo '<input class="login_inputs" placeholder="Password" id="pass" type="password" required> <br> <br>';
    echo '<input type="submit" value="Login">';    
    echo '</form></div>';
} else if ($_SESSION['permissions'] == 1) {
    echo "<script> window.location.href = 'student.php' </script>";
} else if ($_SESSION['permissions'] == 2) {
    echo "<script> window.location.href = 'teacher.php' </script>";
} else if ($_SESSION['permissions'] == 3) {
    echo "<script> window.location.href = 'admin.php' </script>";
};
    
?>
</div>
<div id="write"></div>

<script>



function login() {
	var user = document.getElementById('user').value;
	var pass = document.getElementById('pass').value;

	var anObj = new XMLHttpRequest();
	anObj.open("POST", "controller.php", true);
	anObj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	anObj.send("login=1&user=" + user + "&pass=" + pass);

	anObj.onreadystatechange = function () {
		if (anObj.readyState == 4 && anObj.status == 200) {
			if (anObj.responseText == 1) {
				window.location.href = window.location.href;
			} else {
				var change = document.getElementById('write');
				alert("invalid Username or Password");
			}
		}
	}
	
}


</script>

</body>
</html>
