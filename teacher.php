<?php session_start();
#returns to the login if the permissions dont allow for the user to enter this page
if (!isset($_SESSION['permissions']) || $_SESSION['permissions'] != 2) {
    echo '<script> window.location.href = "main.php" </script>';
    
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="style.css">
<title>Teacher Main</title>
</head>
<body>

<?php echo $_SESSION['first_name'] . " " . $_SESSION['last_name'] ?>

<div class="blue">
<button onclick="logout();"> Logout </button>
</div>

<button onclick='window.location.href="teacherGrades.php"'>Grades</button>

<div id='classes'></div>


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

var anObj = new XMLHttpRequest();
anObj.open("POST", "controller.php", true);
anObj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
anObj.send("teacherClasses=1&id=" + <?php echo $_SESSION['id']; ?> );

anObj.onreadystatechange = function () {
	if (anObj.readyState == 4 && anObj.status == 200) {
		var classes = document.getElementById('classes');
		var array = JSON.parse(anObj.responseText);

        var str = "";

        for (var i = 0; i < array.length; i++) {
            str += array[i]["course_id"] + " " + array[i]["title"] + "<br>";
        }

		classes.innerHTML = str;
	}
}

</script>
</body>
</html>