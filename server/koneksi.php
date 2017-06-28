<?php
header("Access-Control-Allow-Origin: *");
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'spk_pk';

$conn = mysqli_connect($host, $user, $pass, $db);
if(!$conn){
    die('koneksi masalah!');
}

 ?>