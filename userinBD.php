<?php
session_start();
require_once "connectToBD.php";

$takeID = $_SESSION['id'];

$checkUserID = mysqli_query($dbconnect, "SELECT * FROM `users` WHERE `id` = '$takeID'");

if (mysqli_num_rows($checkUserID) > 0) {
    $_SESSION['access'] = 1;
} else {
    $_SESSION['access'] = 0;
}
