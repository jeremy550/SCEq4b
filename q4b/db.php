<?php

$server_name = 'localhost:3308';
$user_name = 'root';
$db_password = '';
$db_name = 'q4';
 
$link = mysqli_connect($server_name, $user_name, $db_password, $db_name);
 
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>