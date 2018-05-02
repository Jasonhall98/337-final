<?php session_start();
// TODO:
// Display information about class from database, buttons to register for class or go back
// Show number of users in class
// Show name of teacher
if (!isset($_SESSION['permissions']) || $_SESSION['permissions'] != 1) {
	echo '<script> window.location.href = "main.php" </script>';
	
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="style.css">
<title>Student Main</title>
</head>
<body>
<script>

var title = document.getElementById('title');
var instructor = document.getElementById('instructor');
var teacher_id;


var anObj = new XMLHttpRequest();
anObj.open("POST", "controller.php", true);
anObj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
anObj.send("getClassInfo=1&course_id=" + <?php echo $_GET['id']?>);

//alert();
anObj.onreadystatechange = function () {
	if (anObj.readyState == 4 && anObj.status == 200) {
		var title = document.getElementById('title');
		var instructor = document.getElementById('instructor');
		//alert(anObj.responseText);
		var array = JSON.parse(anObj.responseText);
		//alert(array);
		title.innerHTML = array[0]["title"];
		desc.innerHTML = array[0]["description"];
		instructor.innerHTML = array[0]["first_name"] + array[0]["last_name"]
		teacher_id = array[0]["id"]
	}
}		


function register() {
	//alert("Registered!");
	var anObj = new XMLHttpRequest();
	anObj.open("POST", "controller.php", true);
	anObj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	anObj.send("studentRegisterClasses=1&course_id=" + <?php echo $_GET['id']?> 
			+ "&teacher_id=" + teacher_id
			+ "&student_id=" + <?php echo $_SESSION['id'] ?>);
	anObj.onreadystatechange = function () {
		if (anObj.readyState == 4 && anObj.status == 200) {
			//alert(anObj.responseText);
		}		

	}
}	


function backToMain() {
	window.location.href = 'student.php';
}

</script>
<h2 id="title">This is a class</h2>
<div id="desc">This is a description</div><br>
<div>
Instructor: <div id = "instructor"></div>
</div>
<div>
<button onclick = "register()">Register</button>

<button onclick ="backToMain()">Go back</button>
</div>
</body>
</html>
