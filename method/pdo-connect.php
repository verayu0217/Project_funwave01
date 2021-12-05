<?php
$servername="localhost";
$username="funwave";
$password="20211013";
$dbname="funwave";

try{
    $db_host= new PDO(
        "mysql:host={$servername};dbname={$dbname};charset=utf8",
        $username, $password
    );
//    echo "資料庫連線成功";

}catch(PDOException $e){
    echo "資料庫連線失敗";
    echo "error: ".$e->getMessage();
}

?>