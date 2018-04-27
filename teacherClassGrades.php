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
<title>Teacher Grades</title>
</head>
<body>

<h3>Grades</h3>


<button onclick="assignment();">Create assignment</button>
<div id='assignmentCreate'></div>


<br><br>
<div id='Assignments'></div>


<script>

function assignment() {
	var assignmentCreate = document.getElementById('assignmentCreate');
	var str = "<form onsubmit='createAssignment(); return false;'>";

	str += "Assignment Name <br><input id='name'> <br>";
	str += "Max Points <br> <input type='number' id='points'> <br>";
	str += "<input type=submit value='Submit'><br><br></form>";
	
	assignmentCreate.innerHTML = str;
}

function createAssignment() {
	var assignment = document.getElementById('name').value;
	var points = document.getElementById('points').value;
	
	var anObj = new XMLHttpRequest();
	anObj.open("POST", "controller.php", true);
	anObj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	anObj.send("createAssignment=1&course_id=" + <?php echo $_GET['class']; ?> + "&assignment=" + assignment + "&points=" + points );

	anObj.onreadystatechange = function () {
		if (anObj.readyState == 4 && anObj.status == 200) {
			window.location.href = window.location.href;
		}
	}
	
}


var assignments = document.getElementById('Assignments');

var anObj = new XMLHttpRequest();
anObj.open("POST", "controller.php", true);
anObj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
anObj.send("getAssignments=1&course_id=" + <?php echo $_GET['class']; ?> );

anObj.onreadystatechange = function () {
	if (anObj.readyState == 4 && anObj.status == 200) {
		var array = JSON.parse(anObj.responseText);

        var str = "<div>";

        for (var i = 0; i < array.length; i++) {
            str += "<div onclick='window.location.href=\"teacherAssignmentGrades.php?course_id=" + array[i]['class_id'] +
            					 "&assignment=" + array[i]['assignment'] + "\"' >" + array[i]['assignment'] + "</div><br>";
        }

        str += '</div>';

		assignments.innerHTML = str;
	}
}


function updateGrade(student_id, value) {
	anObj.open("POST", "controller.php", true);
	anObj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	anObj.send("updateGrade=1&course_id=" + <?php echo $_GET['class']; ?> + "&student_id=" + student_id + "&value=" + value);

	anObj.onreadystatechange = function () {
		if (anObj.readyState == 4 && anObj.status == 200) {
		}
	}
	
}


</script>





</body>
</html>