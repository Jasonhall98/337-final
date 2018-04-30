<?php session_start();
#returns to the login if the permissions dont allow for the user to enter this page
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

<div id='classes'></div>

<script>
var classes = document.getElementById('classes');

var anObj = new XMLHttpRequest();
anObj.open("POST", "controller.php", true);
anObj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
anObj.send("studentClasses=1&id=" + <?php echo $_SESSION['id']; ?> );

anObj.onreadystatechange = function () {
	if (anObj.readyState == 4 && anObj.status == 200) {
		var array = JSON.parse(anObj.responseText);

        var str = "<div>";

        for (var i = 0; i < array.length; i++) {
            str += "<div onclick='window.location.href=\"studentClassGrades.php?class=" + array[i]["course_id"] + "\"'>" + array[i]["course_id"] + " " + array[i]["title"] + "</div><br>";
        }

        str += '</div>';

		classes.innerHTML = str;
	}
}

</script>


</body>
</html>