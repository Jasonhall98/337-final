<?php session_start();
#returns to the login if the permissions dont allow for the user to enter this page
if (!isset($_SESSION['permissions']) || $_SESSION['permissions'] != 3) {
    echo '<script> window.location.href = "main.php" </script>';
    
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="style.css">
<title>Admin Main</title>
</head>
<body>

<?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name'] ?>

<div class="blue">
<button onclick="logout();"> Logout </button>
</div>

<button onclick="window.location.href='register.php';"> Registration </button>

<button onclick="window.location.href='createClass.php';">Create Class</button>


<div id="classes"></div>
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

</script>
</body>
</html>