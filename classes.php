<?php 

class Database{
    public $dbhost = "localhost";
    public $dblogin = "root";
    public $dbpassword = "123456";
    public $dbname = "identification";

    function connect(){
        $connect = mysqli_connect($this->dbhost,$this->dblogin,$this->dbpassword, $this->dbname);
        return $connect;
    }
    function checkNews(){
        $resultPost = mysqli_query($this->connect , "SELECT * FROM `posts`");
        if(mysqli_num_rows($resultPost) > 0)
        {
            $result = mysqli_fetch_assoc($resultPost);
            echo json_encode($result);
        }
        else
        {
            $result = "Постов не существует";
        }
    }
    
}