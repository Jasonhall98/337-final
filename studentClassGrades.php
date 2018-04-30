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

<div id='grades'></div>


<script>
var grades = document.getElementById('grades');

var anObj = new XMLHttpRequest();
anObj.open("POST", "controller.php", true);
anObj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
anObj.send("studentClassGrades=1&id=" + <?php echo $_SESSION['id']; ?> + "&class=" + <?php echo $_GET['class']; ?> );

anObj.onreadystatechange = function () {
	if (anObj.readyState == 4 && anObj.status == 200) {
		var array = JSON.parse(anObj.responseText);

        var str = "<div>";

		var totalPoints = 0;
		var maxPoints = 0;
		
        for (var i = 0; i < array.length; i++) {
            var points = array[i]["points"];
            if (points === 'null') points = 0;
            str += "<div>" + array[i]["assignment"] + " " + points + "/" + array[i]['maxPoints'] + "</div><br>";

			totalPoints += parseInt(points);
			maxPoints += parseInt(array[i]['maxPoints']);
		}

		
        str += '</div><br>';

        str += 'total grade = ' + totalPoints + ' / ' + maxPoints;

		grades.innerHTML = str;
	}
}

</script>

</body>
</html>