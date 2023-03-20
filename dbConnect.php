<?php
$host= "localhost";
$user = "root";
$pass ="";
$dbName = "exp_reminder";

$con = new mysqli($host, $user, $pass, $dbName);

if(!$con){
    die("Connection Failed");
}



