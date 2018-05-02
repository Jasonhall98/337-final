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
<title>Student Class Registration</title>
</head>
<body>


<div id="classes"></div>

<button onclick='window.location.href="student.php"'>Back</button>

<script>
 	var classes = document.getElementById("classes");
    
	var anObj = new XMLHttpRequest();
	anObj.open("POST", "controller.php", true);
	anObj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	anObj.send("classes=1");

	anObj.onreadystatechange = function () {
		if (anObj.readyState == 4 && anObj.status == 200) {
			var array = JSON.parse(anObj.responseText);

            var str = "";

            for (var i = 0; i < array.length; i++) {
                str += "<div onclick='window.location.href=\"classPage.php?id=" + array[i]["course_id"] + "\"'> " + array[i]["course_id"] + " " + array[i]["title"] + "</div><br>";
            }

			classes.innerHTML = str;
		  }
   }

   
</script>




</body>
</html>