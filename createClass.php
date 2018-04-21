<?php 
include 'DatabaseAdapter.php';
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="style.css">
<title>ClassCreation</title>
</head>
<body>

<form onsubmit="createClass();return false;">

Course Id <br>
<input id="id" required> <br>

Title <br>
<input id="title" required> <br>

Course Description <br>
<input id="description"> <br>

Teacher <br>
<select id='teacher'>
	<?php 
        $teachers = $theDBA->getTeachers();
        for ($i = 0; $i < count($teachers); $i++) {
            echo '<option value="' . $teachers[$i]['id'] . '">' . $teachers[$i]['first_name'] . ' ' . $teachers[$i]['last_name'] . '</option>';
            
        }
	
	?>

</select> 
<br>


<input type="submit" value="Create">

</form>

<div id="tochange"></div>

<script>


function createClass() {
	var id = document.getElementById("id").value;
	var title = document.getElementById("title").value;
	var description = document.getElementById("description").value;

	var e = document.getElementById("teacher");
	var teacher = e.options[e.selectedIndex].value;
			
	var anObj = new XMLHttpRequest();
	anObj.open("POST", "controller.php", true);
	anObj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	anObj.send("classCreate=1&id=" + id + "&title=" + title + "&description=" + description + "&teacherID=" + teacher);

	anObj.onreadystatechange = function () {
		if (anObj.readyState == 4 && anObj.status == 200) {
			var success = anObj.responseText;

			if (success == '0') {
				// The action failed because another user with that username already exists
				document.getElementById('tochange').innerHTML = "Class already Exists";
				
			} else {
			    window.location.href = 'admin.php';
				

			}
			
		}
	}
	
}


</script>

</body>
</html>
