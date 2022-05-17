<?php

$server="localhost";
$user="root";
$password="";
$db_name="guest_log";

$db=mysqli_connect($server, $user, $password, $db_name);

if(!$db){
    die("Failed to connect to database: ".mysqli_connect_error());
}

?>