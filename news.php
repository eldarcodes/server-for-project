<?php
require_once "classes.php";
require_once "connectToBD.php";
$resultPost = mysqli_query($dbconnect,"SELECT * FROM `posts`");
$array = mysqli_num_rows($resultPost);
if($array > 0 )
{
    $result[$array];
    for($i = 0 ; $i < $array; $i++)
    {
        $checkPost = mysqli_fetch_assoc($resultPost);
        $result[$i] = $checkPost;
        $checkCreator = $result[$i]['creator'];
        $checkUserName = mysqli_query($dbconnect, "SELECT * FROM `users` WHERE `id` = '$checkCreator'");
        $resultName = mysqli_fetch_assoc($checkUserName);
        $result[$i]['creator'] = $resultName['name'];
    }
    
    echo json_encode($result);
}
else{
    echo "Меньше 0";
}

?>