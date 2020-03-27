<?php
session_start();
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json');

include "./connectToBD.php";

$_POST = json_decode(file_get_contents('php://input'), true);

$takeID = $_POST['id'];

$checkUserID = mysqli_query($dbconnect, "SELECT * FROM `users` WHERE `id` = '$takeID'");

if (mysqli_num_rows($checkUserID) > 0) {
    $access = 1;
} else {
    $access = 0;
}
if ($_SERVER['REQUEST_URI'] == '/main') {
    include "news.php";
}
if ($_SERVER['REQUEST_URI'] == '/registration') {
    if ($access !== 0) {
        $message = true;
        echo json_encode($message);
    } else {
        include "registration.php";
        echo json_encode($_SESSION["Registration"]);
    }
}
if ($_SERVER['REQUEST_URI'] == '/auth') {
    if ($_SESSION['access'] == "0") {
        include "auth.php";
        if (isset($_SESSION['user'])) {
            echo json_encode($_SESSION["user"]);
        } else {
            echo json_encode($_SESSION["auth"]);
        }
    } else {
        $message = true;
        echo json_encode($message);
    }
}
