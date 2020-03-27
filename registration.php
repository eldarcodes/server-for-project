<?php
session_start();
require_once "connectToBD.php";
include "userinBD.php";
unset($_SESSION['response']);
$takeID = 5;
$checkUserID = mysqli_query($dbconnect, "SELECT * FROM `users` WHERE `id` = '$takeID'");
if (mysqli_num_rows($checkUserID) > 0) {
    $access = 1;
} else {
    $access = 0;
}
if($access == "1")
{
    $_SESSION['response'] = true;
}
else{
$_SESSION['response'] == "";
$defaultAvatar = "../assets/img/photo_2020-03-12_22-13-50.jpg";
$userlogin = $_POST['login'];
$userpassword = $_POST['password'];
$useremail = $_POST['email'];
$username = $_POST['name'];
$usersurname = $_POST['surname'];
$user_register_date = date("Y-m-d");

$checkLogin = mysqli_query($dbconnect, "SELECT * FROM `users` WHERE `login` = '$userlogin'");
$checkEmail = mysqli_query($dbconnect, "SELECT * FROM `users` WHERE `email` = '$useremail'");

if ((mysqli_num_rows($checkLogin)) > 0) {
    $_SESSION['response'] = "Пользователь с таким логином зарегистрирован!";
}
else if ((mysqli_num_rows($checkEmail)) > 0) {
    $_SESSION['response'] = "Пользователь с данной почтой существует!";
}
else if ((mysqli_num_rows($checkEmail)) > 0 && (mysqli_num_rows($checkLogin)) > 0) {
    $_SESSION['response'] = "Пользователь с таким логином и почтой - существует!";
}
else if ((mysqli_num_rows($checkEmail)) ==  0 && (mysqli_num_rows($checkLogin)) == 0) {
    $userpassword = md5($userpassword);
    mysqli_query($dbconnect, "INSERT INTO `users`(`id`, `name`, `surname`, `login`, `email`, `password`, `lvluser`, `date_registration`, `city`, `gender`, `avatar`, `date_birhday`) VALUES (NULL,'$username','$usersurname','$userlogin','$useremail','$userpassword','1','$user_register_date','','','$defaultAvatar','')");
    $_SESSION['response'] = "Вы успешно зарегистрировались";
}
}
echo json_encode($_SESSION['response']);