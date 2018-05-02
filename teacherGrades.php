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
<div class = "blue"></div>

<div id='classes'></div>

<button class = "back_button" onclick='window.location.href="teacher.php"'>Back</button>

<script>
var classes = document.getElementById('classes');

var anObj = new XMLHttpRequest();
anObj.open("POST", "controller.php", true);
anObj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
anObj.send("teacherClasses=1&id=" + <?php echo $_SESSION['id']; ?> );

anObj.onreadystatechange = function () {
	if (anObj.readyState == 4 && anObj.status == 200) {
		var array = JSON.parse(anObj.responseText);

        var str = "<div>";

        for (var i = 0; i < array.length; i++) {
            str += "<div class = 'a_class' onclick='window.location.href=\"teacherClassGrades.php?class=" + array[i]["course_id"] + "\"'>" + array[i]["course_id"] + " " + array[i]["title"] + "</div><br>";
        }

        str += '</div>';

		classes.innerHTML = str;
	}
}

</script>





</body>
</html>