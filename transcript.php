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

<title>Transcript</title>
</head>
<body>

<h2>Transcript</h2>

<div id='classes'></div>

<script>

 	var classes = document.getElementById("classes");
    
	var anObj = new XMLHttpRequest();
	anObj.open("POST", "controller.php", true);
	anObj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	anObj.send("studentClasses=1&id=" + <?php echo $_SESSION['id'] ?> );

	anObj.onreadystatechange = function () {
		if (anObj.readyState == 4 && anObj.status == 200) {
			var array = JSON.parse(anObj.responseText);

            var str = "<div class='transcript' align='left'>";

            for (var i = 0; i < array.length; i++) {
                str += "<div class='transcript_id'> " + array[i]["course_id"] + " </div><div class='transcript_title'> " + 
                		array[i]["title"] + " </div><div class='transcript_grade'> " + array[i]["grade"] + " </div><br>";
            }

			classes.innerHTML = str + "</div>";
		  }
   };

</script>
</body>
</html>