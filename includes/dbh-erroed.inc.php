<?php

$servername = "localhost:3306";
$username = "kyucuco1_kyucuco1";
$password = "0791342771KYUCU.";
$dbname="kyucuco1_cudb";



$conn = mysqli_connect($servername, $username, $password,$dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connec_error());
} 
else{echo "connection successful";}
