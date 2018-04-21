<?php
include 'DatabaseAdapter.php';

if (isset($_POST['login'])) {
    echo $theDBA->login($_POST['user'], $_POST['pass']);
} elseif (isset($_POST['logout'])) {
    session_unset();
} elseif (isset($_POST['getClasses'])) {
    echo json_encode($theDBA->getClasses());
} elseif (isset($_POST['register'])) {
    echo $theDBA->register($_POST['first'], $_POST['last'], $_POST['email'], $_POST['user'], $_POST['pass'], $_POST['permissions']);
} elseif (isset($_POST['classCreate'])) {
    echo $theDBA->createClass($_POST['id'], $_POST['title'], $_POST['description'], $_POST['teacherID']);
}

?>