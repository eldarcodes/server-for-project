<?php
session_start();
require_once "connectToBD.php";
$_SESSION['Registration'] == "";
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
    $_SESSION['Registration'] = "Пользователь с таким логином зарегистрирован!";
} 
if ((mysqli_num_rows($checkEmail)) > 0) {
    $_SESSION['Registration'] = "Пользователь с данной почтой существует!";
}
if((mysqli_num_rows($checkEmail)) > 0 && (mysqli_num_rows($checkLogin)) > 0)
{
    $_SESSION['Registration'] = "Пользователь с таким логином и почтой - существует!";
}
if((mysqli_num_rows($checkEmail)) ==  0 && (mysqli_num_rows($checkLogin)) == 0)
{
$userpassword = md5($userpassword);
mysqli_query($dbconnect, "INSERT INTO `users`(`id`, `name`, `surname`, `login`, `email`, `password`, `lvluser`, `date_registration`, `city`, `gender`, `avatar`, `date_birhday`) VALUES (NULL,'$username','$usersurname','$userlogin','$useremail','$userpassword','1','$user_register_date','','','$defaultAvatar','')");
$_SESSION['Registration'] = "Вы успешно зарегистрировались";
}



