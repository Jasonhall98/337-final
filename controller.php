<?php
session_start();
include 'DatabaseAdapter.php';

if (isset($_POST['login'])) {
    $_SESSION['permissions'] = 1;
}

?>