<?php
// TODO:
// Display information about class from database, buttons to register for class or go back
// Show number of users in class
// Show name of teacher
?>
<script>

var title = document.getElementById('title');
var instructor = document.getElementById('instructor');

var anObj = new XMLHTTPRequest();
anObj.open("POST", "controller.php", true);
anObj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
anObj.send("studentRegisterClass=1&course_id=" + <?php echo $_GET['course_id']?> 
+ "&teacher_id=" + <?php echo $_GET['teacher_id'] ?>
+ "&student_id=" + <?php echo $_GET['student_id'] ?>);
anObj.onreadystatechange = function () {
	if (anObj.readyState == 4 && anObj.status == 200) {
		var array = JSON.parse(anObj.responseText);
		array[0]["teacher_id"]
	}
}		


function register() {
var anObj = new XMLHttpRequest();
anObj.open("POST", "controller.php", true);
anObj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
anObj.send("studentRegisterClass=1&course_id=" + <?php echo $_GET['course_id']?> 
			+ "&teacher_id=" + <?php echo $_GET['teacher_id'] ?>
			+ "&student_id=" + <?php echo $_GET['student_id'] ?>);
}


</script>
<div id="title">This is a class</div>

Instructor: <div id = "instructor"></div>
<button onclick = "register()">Register</button>

<button>Go back</button>
