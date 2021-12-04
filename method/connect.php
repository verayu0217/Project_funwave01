<?php
$servername="localhost";
$username="funwave";
$password="20211013";
$dbname="funwave";

$conn=new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error){
    die("連線失敗:".$conn->connect_error);
}else{
//    echo "資料庫連線成功<br>";
}
