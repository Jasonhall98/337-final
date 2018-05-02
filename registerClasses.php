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
<h2 class = "select_class">Select a class to register</h2>

<div id="classes"></div>
<div class = "back_div">
<button class = "back_button" onclick='window.location.href="student.php"'>Back</button>
</div>
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
                str += "<div class='a_class' onclick='window.location.href=\"classPage.php?id=" + array[i]["course_id"] + "\"'> " + array[i]["course_id"] + " " + array[i]["title"] + "</div><br>";
            }

			classes.innerHTML = str;
		  }
   }

   
</script>




</body>
</html>