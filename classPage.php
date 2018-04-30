<?php
//TODO:
//Display information about class from database, buttons to register for class or go back
//Show number of users in class
//Show name of teacher

?>
<script>
var anObj = new XMLHttpRequest();
anObj.open("POST", "controller.php", true);
anObj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
anObj.send("studentClasses=1&id=" + <?php echo $_SESSION['id'] ?> );

</script>
<div id="title">This is a class</div>
Number of students enrolled:
<button>Register</button>

<button>Go back</button>
