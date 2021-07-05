<?php

$dsn = 'mysql:dbname=oat;host=localhost;charset=utf8';
$user = 'root';
$password = '123456';

try{
  $conn = new PDO($dsn, $user, $password);
}catch (PDOException $e){
  die('DB Error: ' . $e->getMessage());
}

?>