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


<div id='grades'></div>

<script>
var grades = document.getElementById('Grades');

var anObj = new XMLHttpRequest();
anObj.open("POST", "controller.php", true);
anObj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
anObj.send("getAssignmentGrades=1&course_id=" + <?php echo $_GET['course_id']; ?> + "&assignment=" + <?php echo $_GET['assignment']; ?> + "" );

anObj.onreadystatechange = function () {
	if (anObj.readyState == 4 && anObj.status == 200) {
		var array = JSON.parse(anObj.responseText);

        var str = "<div>";

        for (var i = 0; i < array.length; i++) {
            str += "<div>" + array[i]["first_name"] + " " + array[i]["last_name"] + " <input type='number' onchange='updateGrade(" + array[i]['student_id'] +
            																 ", this.value)' value='" + array[i]["grade"] + "'></div><br>";
        }

        str += '</div>';

		grades.innerHTML = str;
	}
}

</script>

</body>
</html>