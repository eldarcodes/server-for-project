<?php
session_start();
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Content-Type: application/json');

$_POST = json_decode(file_get_contents('php://input'), true);

if ($_SERVER['REQUEST_URI'] == '/main/') {
    include "news.php";
}
if ($_SERVER['REQUEST_URI'] == '/registration') {
    include "userinBD.php";
    if ($_SESSION['access'] == "0") {
        include "registration.php";
        echo json_encode($_SESSION["Registration"]);
    } else {
        $message = true;
        echo json_encode($message);
    }
}
if ($_SERVER['REQUEST_URI'] == '/auth') {
    include "userinBD.php";
    if ($_SESSION['access'] == "0") {
        include "auth.php";
        if(isset($_SESSION['user']))
        {
            echo json_encode($_SESSION["user"]);
        }
        else{
            echo json_encode($_SESSION["auth"]);
        }
    } else {
        $message = true;
        echo json_encode($message);
    }

}

