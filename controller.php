<?php
session_start();
include 'DatabaseAdapter.php';

if (isset($_POST['login'])) {
    $_SESSION['permissions'] = 1;
} elseif (isset($_POST['logout'])) {
    session_unset();
} elseif (isset($_POST['getClasses'])) {
    echo json_encode($theDBA->getClasses());
} elseif (isset($_POST['register'])) {
    echo $theDBA->register($_POST['first'], $_POST['last'], $_POST['email'], $_POST['user'], $_POST['pass']);
}

?>