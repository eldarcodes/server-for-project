<?php
session_start();
require_once "connectToBD.php";
unset($_SESSION['response']);
$takeID = 11;
$checkUserID = mysqli_query($dbconnect, "SELECT * FROM `users` WHERE `id` = '$takeID'");
if (mysqli_num_rows($checkUserID) > 0) {
    $access = 1;
} else {
    $access = 0;
}
if($access == "1")
{
    $_SESSION['response'] = true;
    echo $_SESSION['response'];
}
else{
    $login = $_POST['login'];
    $password = $_POST['password'];
    $password = md5($password);
    
    $checkuser = mysqli_query($dbconnect, "SELECT * FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
    
    if (mysqli_num_rows($checkuser) > 0) {
        $user = mysqli_fetch_assoc($checkuser);
        switch ($user['lvluser']) {
            case 1:
                $_SESSION['user']['role'] = "Пользователь";
                break;
            case 2:
                $_SESSION['user']['role'] = "Менеджер";
                break;
            case 3:
                $_SESSION['user']['role'] = "Администратор";
                break;
            case 4:
                $_SESSION['user']['role'] = "Создатель";
                break;
        }
        $_SESSION['user'] = [
            'id' => $user['id'],
            'role' => $_SESSION['user']['role'],
            'message' => 'Вы успешно авторизовались!'
        ];
    } else {
        unset($_SESSION['user']);
        $checkLogin = mysqli_query($dbconnect, "SELECT * FROM `users` WHERE `login` = '$login'");
        $checkpassword = mysqli_query($dbconnect, "SELECT * FROM `users` WHERE `password` = '$password'");
        if (mysqli_num_rows($checkLogin) === 0) {
            $_SESSION['auth'] = [
                'id' => null,
                'role' => null,
                'message' => 'Пользователя не существует!'
            ];
        }
        else if (mysqli_num_rows($checkpassword) === 0) {
            $_SESSION['auth'] = [
                'id' => null,
                'role' => null,
                'message' => 'Вы ввели неверный пароль!'
            ];
        }
        
    }
    echo json_encode($_SESSION['auth']);
}
